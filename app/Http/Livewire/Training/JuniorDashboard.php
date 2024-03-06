<?php

namespace App\Http\Livewire\Training;

use App\Models\Demo;
use App\Models\FeedBack;
use App\Models\LeadHistory;
use App\Models\LeadStatus;
use App\Models\Slot;
use App\Models\User;
use App\Services\SmsService;
use Livewire\Component;
use App\Services\InappNotificationService;
use App\Services\WhatsappService;
use App\Services\ActionsService;

class JuniorDashboard extends Component
{

    public $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $langaugesknown, $gender, $comments;

    public $whatsappnumber, $leadkeyword, $leadtype = 1;
    public $demodone = 0, $demopending = 0, $demostatus = 0, $currentfeedbackid = 0, $studentid = 0, $demoid = 0, $leadstatusfordemo, $leadhistorycomment;
    public $demolink = [];
    public $leadhistorydata = [];
    public $rating = '', $comment = '', $behaviour = '', $interested = '';

    public $slot = '', $date = '', $assignto = '', $editID, $statsswitch = 0;
    
    public $converteddemo = [];

    public $demo_taken=0,$fathername="",$fatheroccupation="",$dropreason="",$selectedcourse="";

    public function mount()
    {
        $this->statsRefresh();
    }

    public function statsRefresh()
    {
        // dd(auth()->user()->id);
        $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0, 'is_paid' => 0])->pluck('id');
        $leadpaid = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0, 'is_paid' => 1])->pluck('id');
        $this->demodone = Demo::whereIn('leadstatus', $leadids)->where('is_demodone', 1)->count();
        $this->demopending = Demo::whereIn('leadstatus', $leadids)->where('is_demodone', 0)->count();
        $this->converteddemo = Demo::whereIn('leadstatus', $leadpaid)->count();
    }

    public function getleadHistory($leadid, $leadstatusfordemo)
    {

        $this->leadhistorydata = LeadHistory::where('leadid', $leadid)->orderBy('id', 'desc')->get();
        $this->leadstatusfordemo = $leadstatusfordemo;
    }
    public function leadhistorycommentstore()
    {
        $leadstatus = LeadStatus::findorFail($this->leadstatusfordemo);
        $leadid = $leadstatus->leadid;
        leadHistorycomment($this->leadhistorycomment, $leadid);
        $this->leadhistorydata = LeadHistory::where('leadid', $leadid)->orderBy('id', 'desc')->get();
        $this->leadhistorycomment = '';
    }

    public function edit($id)
    {
        
        $editdata = User::findorFail($id);

        $this->name = $editdata->name;
        $this->email = $editdata->email;
        $this->mobilecode = $editdata->mobilecode;
        $this->mobile = $editdata->mobile;
        $this->whatsappnumber = $editdata->whatsappnumber;
        $this->leadkeyword = $editdata->leadkeyword;
        $this->leadtype = $editdata->leadtype;
        $this->state = optional($editdata->userDetails)->state;
        $this->growth = optional($editdata->userDetails)->growth;
        $this->edulevel = optional($editdata->userDetails)->edulevel;
        $this->gender = optional($editdata->userDetails)->gender;
        $this->comments = optional($editdata->userDetails)->comments;
        $this->reference = optional($editdata->userDetails)->refrence;
    }

    public function demoschdule($id)
    {

        $demolink = reset($this->demolink);
        $trainerid = auth()->user()->id;
        $demowork = Demo::find($id);
        // $leaddetails = User::findorFail($demowork->leadid);
        $demowork = $demowork->update(['demolink' => $demolink, 'trainerid' => $trainerid]);
        // SmsService::sendDemolink($leaddetails->mobile, $leaddetails->email);
        WhatsappService::senddemolink($id,auth()->user()->name,$demolink);
        SmsService::clientsendlink($id,auth()->user()->name,$demolink);
        $this->demolink = [];
    }

    public function demoDone()
    {
        $this->demostatus = 1;
    }

    public function demoNotdone()
    {
        $this->demostatus = 0;
    }

    public function statsswitchHandel($id)
    {
        $this->statsswitch = $id;
    }

    public function feedbackshow($id, $demoid, $studentid)
    {

        $this->currentfeedbackid = $id;
        $this->studentid = $studentid;
        $this->demoid = $demoid;
    }

    public function store()
    {
        
      
        
        Demo::findorFail($this->demoid)->update(['is_demodone' => 1, 'feedback' => 1, 'certificate' => 1]);
        $data=['leadstatus' => $this->currentfeedbackid, 'demoid' => $this->demoid,
        'feedback_from' => auth()->user()->id, 'feedback_to' => $this->studentid,
         'feedback_type' => 1, 'comment' => $this->comment, 
         'behaviour' => $this->behaviour, 'interested' => $this->interested,'demo_taken'=>$this->demo_taken,'fathername'=>$this->fathername,'course'=>$this->selectedcourse,'reason'=>$this->dropreason,'fatheroccupation'=>$this->fatheroccupation];
       
        FeedBack::create($data);
        if ($this->demo_taken) {
            ActionsService::demosuccessfullycompletedbytrainer($this->studentid);
            
        }else{
            InappNotificationService::demounsuccessfull($this->studentid);
        }
        leadHistorytrainerfeedback($this->studentid);
        $this->statsRefresh();
        $this->resetInputs();
        $this->emit('flashmessage', 'Feedback submitted successfully');
       
    }

    public function resetInputs()
    {
        $this->currentfeedbackid = '';
        $this->studentid = '';
        $this->rating = 0;
        $this->comment = '';
        $this->behaviour = '';
        $this->interested = '';
    }

    public function editassign($id)
    {
        $this->editID = $id;
        $getdemodetails = Demo::find($id);
        if ($getdemodetails) {
            $this->slot = $getdemodetails->slot;
            $this->date = $getdemodetails->date;
        } else {
            $this->slot = '';
            $this->date = '';
        }
        $getseniortrainer = LeadStatus::where(['demoid' => $id, 'department' => 4, 'level' => 2])->first();
        if ($getseniortrainer) {
            $this->assignto = $getseniortrainer->assignedto;
        } else {
            $this->assignto = '';
        }
    }

    public function reassign()
    {
        $demo = Demo::findorFail($this->editID);
        // dd($demo);
        $slot=Slot::find($demo->slot);
        $formattedolddate=dateformater($demo->date);
        $oldtime="{$slot->from} {$formattedolddate}";
        Demo::findorFail($this->editID)->update(['slot' => $this->slot, 'date' => $this->date]);
        $newslot=Slot::find($this->slot);
        $formattednewdate=dateformater($this->date);
        $newtime="{$newslot->from}";
        demoreschedulelead(auth()->user()->id, $this->editID, $demo->leadid);
        $user=User::find($demo->leadid);
        WhatsappService::rescheduledemo($demo->leadid,$this->date,$newtime);
        SmsService::clientrescheduling($user->name,$formattednewdate,$newtime,$user->mobile);
        InappNotificationService::reschedulingjrtrainer($user->name,auth()->user()->name,$oldtime,$newtime,$this->editID);
        $this->emit('flashmessage', 'Slot time Updated Successfully!');
    }

    public function render()
    {

        switch ($this->statsswitch) {
            case 0:
                $data = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0,'is_paid'=>0])->whereHas('demoRelation', function ($q) {
                    $q->where('is_demodone', 0);
                })->paginate(10);
                // dd($data);
                break;
            case 1:
                $data = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0,'is_paid'=>0])->whereHas('demoRelation', function ($q) {
                    $q->where('is_demodone', 1);
                })->paginate(10);
                // dd('dd');
                break;
            case 2:
                $data = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0,'is_paid'=>1])->whereHas('demoRelation', function ($q) {
                    $q->where('is_demodone', 1);
                })->paginate(10);
                break;
            default:
                # code...
                break;
        }
        // dd($data);
        $slots = Slot::all();
        $seniortrainers = User::where(['department' => 4, 'role' => 2])->withCount('assignedusers')->get();
        return view('livewire.training.junior-dashboard', ['data' => $data, 'slots' => $slots, 'seniortrainers' => $seniortrainers]);
    }
}
