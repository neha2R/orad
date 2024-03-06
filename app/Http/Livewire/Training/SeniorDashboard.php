<?php

namespace App\Http\Livewire\Training;

use App\Models\Content;
use App\Models\Demo;
use App\Models\LeadStatus;
use App\Models\Slot;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\UserDetail;
use App\Models\LeadHistory;
use App\Services\InappNotificationService;
use App\Services\WhatsappService;
use App\Services\SmsService;
class SeniorDashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $editID, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $langaugesknown, $gender, $comments;

    public $whatsappnumber,$leadkeyword,$leadtype=1;
    public $search, $slot, $date, $assignid, $trainers=[], $assignto, $assignedtable=0, $assignedleads, $unassignedleads, $rescheduledleads, $unassignedtable=0, $rescheduledtable=0;
    public $demoidforjuniortrainerassign,$leadidforjuniortrainerassign;
    // protected $listeners = ['assignlead' => 'assign'];
    public $leadhistorydata=[],$leadstatusfordemo,$leadhistorycomment;

    public $statsstatusswitch=0,$paidleads=0;

    public function statusswitchhandel($id){
        $this->statsstatusswitch=$id;
    }

    public $reassignstatus=0;
    public function mount(){
        $this->assignedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1,'is_paid'=>0])->count();
        $this->unassignedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0])->count();
        $this->paidleads=LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' =>1 ])->count();
       
    }
    public function leadhistorycommentstore(){
        $leadstatus=LeadStatus::findorFail($this->leadstatusfordemo);
        $leadid=$leadstatus->leadid;
        leadHistorycomment($this->leadhistorycomment,$leadid);
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadhistorycomment='';
    }

    public function updatedMobile($value){
        $this->whatsappnumber=$value;
    }

    public function showUnassignedTable(){
        $this->assignedtable=0;
    }
    public function showAssignedTable(){
        $this->assignedtable=1;
    }

    public function hydrate(){
        $this->assignedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1])->count();
        $this->unassignedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0])->count();
    }
    public function getleadHistory($leadid,$leadstatusfordemo){
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadstatusfordemo=$leadstatusfordemo;
    }   
    public function edit($id){
        $this->emit('taginput', 1);
        $this->editID = $id;
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
    public function updateLead(){
        $id = $this->editID;
        $validatedData = $this->validate(
            ['name' => 'required'],
            ['email' => 'required'],
            ['mobilecode' => 'required'],
            ['mobile' => 'required'],
            ['leadkeyword' => 'nullable'],
            ['whatsappnumber' => 'nullable'],
            ['leadtype' => 'required'],
            ['state' => 'nullable'],
            ['refrence' => 'nullable'],
            ['growth' => 'required'],
            ['edulevel' => 'nullable'],
            ['gender' => 'required'],
            ['comments' => 'nullable'],
            
        );
        $user=['name'=>$this->name,'email'=>$this->email,'mobilecode'=>$this->mobilecode,'mobile'=>$this->mobile,'leadkeyword'=>$this->leadkeyword,'whatsappnumber'=>$this->whatsappnumber,'leadtype'=>$this->leadtype];
        User::findorFail($id)->update($user);
        $details=['state'=>$this->state,'refrence'=>$this->reference,'growth'=>$this->growth,'edulevel'=>$this->edulevel,'gender'=>$this->gender,'comments'=>$this->comments];
        UserDetail::where('user_id', $id)->update($details);
        $this->emit('flashmessage', 'Lead info updated successfully');
    }

    public function assign($id,$demoIds){
        // dd($id);
        
        $this->assignid = $id;
        $this->demoidforjuniortrainerassign=$demoIds;
        $this->leadidforjuniortrainerassign=LeadStatus::findorFail($id)->leadid;
        $demo = LeadStatus::findorFail($id)->demoStatus;
        $this->slot = $demo->slot;
        $this->date = $demo->date;
        $busytrainers = Demo::where(['date' => $this->date, 'slot' => $this->slot])->whereNotNull('trainerid')->pluck('trainerid')->toArray();
        $this->trainers = User::where(['department' => 4, 'role' => 3])->whereNotIn('id', $busytrainers)->withCount('assignedusers')->get();
        // InappNotificationService::democreatedbysrtraining($createlead->id,$this->slot,$this->date);
       
        $this->emit('showmodal', 1);
    }
    public function reassign($id,$demoIds){
        // dd($id);
        $this->reassignstatus=1;
        $this->assignid = $id;
        $this->demoidforjuniortrainerassign=$demoIds;
        $this->leadidforjuniortrainerassign=LeadStatus::findorFail($id)->leadid;
        $demo = LeadStatus::findorFail($id)->demoStatus;
        $this->slot = $demo->slot;
        $this->date = $demo->date;
        $busytrainers = Demo::where(['date' => $this->date, 'slot' => $this->slot])->whereNotNull('trainerid')->pluck('trainerid')->toArray();
        $this->trainers = User::where(['department' => 4, 'role' => 3])->whereNotIn('id', $busytrainers)->withCount('assignedusers')->get();
        // InappNotificationService::democreatedbysrtraining($createlead->id,$this->slot,$this->date);
       
        $this->emit('showmodal', 1);
    }

    

    public function update(){
        LeadStatus::findorFail($this->assignid)->update(['is_transferred' => 1]);
        $createlead= LeadStatus::create(['leadid'=>$this->leadidforjuniortrainerassign, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto, 'level'=>3, 'department'=>4, 'comments'=>'Lead assigned from senior trainer to junior trainer','demoid'=>$this->demoidforjuniortrainerassign]);
        Demo::findorFail($this->demoidforjuniortrainerassign)->update(['trainerid' => $this->assignto,'leadstatus'=>$createlead->id,'slot'=>$this->slot,'date'=>$this->date]);
        leadHistorySeniorTrainertoJuniorTrainerAssignment(auth()->user()->id,$this->assignto,$this->leadidforjuniortrainerassign);
        
        $userdetails=User::find($this->leadidforjuniortrainerassign);
        $trainerdetails=User::find($this->assignto);
        $slot=Slot::find($this->slot);
        $demotime="{$slot->from}";
        $demodate=$this->date;
        $seniortrainer=auth()->user()->id;
        $juniortrainer=$this->assignto;
        WhatsappService::trainerassign($this->leadidforjuniortrainerassign,$demodate,$demotime,$juniortrainer,$this->demoidforjuniortrainerassign);
        $leadstatusforbelowvar=LeadStatus::where(['leadid'=>$this->leadidforjuniortrainerassign,'level'=>3,'department'=>3])->first();
        $seniormarketing=$leadstatusforbelowvar->assignedby;
        $juniormarketing=$leadstatusforbelowvar->assignedto;
        InappNotificationService::trainerassignbysrtrainertojuniortrainer($userdetails->name,$trainerdetails->name,$demotime,$demodate,$seniortrainer,$juniortrainer,$seniormarketing,$juniormarketing);
        $formatteddate=dateformater($demodate);
        SmsService::demoassigntojrtrainer($userdetails->name,$formatteddate,$demotime,$trainerdetails->mobile);
        SmsService::clientassignedtrainer($userdetails->name,$trainerdetails->name,$trainerdetails->mobile,$userdetails->mobile,$formatteddate,$demotime);
        $this->emit('flashmessage', 'Assigned successfully');
    }

    public function reupdate(){
        // dd('dd');
        LeadStatus::findorFail($this->assignid)->update(['is_transferred' => 1]);
        $createlead= LeadStatus::where(['leadid'=>$this->leadidforjuniortrainerassign, 'assignedby'=>auth()->user()->id])->update(['assignedto'=>$this->assignto,]);
        Demo::findorFail($this->demoidforjuniortrainerassign)->update(['trainerid' => $this->assignto,'slot'=>$this->slot,'date'=>$this->date]);
        leadHistorySeniorTrainertoJuniorTrainerAssignment(auth()->user()->id,$this->assignto,$this->leadidforjuniortrainerassign);
        
        $userdetails=User::find($this->leadidforjuniortrainerassign);
        $trainerdetails=User::find($this->assignto);
        $slot=Slot::find($this->slot);
        $demotime="{$slot->from}";
        $demodate=$this->date;
        $seniortrainer=auth()->user()->id;
        $juniortrainer=$this->assignto;
        WhatsappService::trainerassign($this->leadidforjuniortrainerassign,$demodate,$demotime,$juniortrainer,$this->demoidforjuniortrainerassign);
        $leadstatusforbelowvar=LeadStatus::where(['leadid'=>$this->leadidforjuniortrainerassign,'level'=>3,'department'=>3])->first();
        $seniormarketing=$leadstatusforbelowvar->assignedby;
        $juniormarketing=$leadstatusforbelowvar->assignedto;
        InappNotificationService::trainerassignbysrtrainertojuniortrainer($userdetails->name,$trainerdetails->name,$demotime,$demodate,$seniortrainer,$juniortrainer,$seniormarketing,$juniormarketing);
        $formatteddate=dateformater($demodate);
        SmsService::demoassigntojrtrainer($userdetails->name,$formatteddate,$demotime,$trainerdetails->mobile);
        SmsService::clientassignedtrainer($userdetails->name,$trainerdetails->name,$trainerdetails->mobile,$userdetails->mobile,$formatteddate,$demotime);
        $this->emit('flashmessage', 'Assigned successfully');
    }

    public function render()
    {

        switch ($this->statsstatusswitch) {
            case 0:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0]);
                break;
            case 1:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1,'is_paid'=>0]);
                break;
            case 2:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' =>1 ]);
                break;
            default:
                # code...
                break;
        }
        // dd($leadids);
        if ($this->search) {
            $searchTerm=$this->search;
            $data = $leadids->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               });
        } else {
            $data = $leadids;
        }
        $data=$data->orderBy('id','desc')->paginate(10);
        $slots = Slot::all();
        $content = Content::all();
        return view('livewire.training.senior-dashboard', ['data' => $data, 'slots' => $slots, 'content' => $content]);
    }
}
