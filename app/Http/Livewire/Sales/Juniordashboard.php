<?php

namespace App\Http\Livewire\Sales;

use App\Models\CoursePayments;
use App\Models\Courses;
use App\Models\CoursesType;
use App\Models\Demo;
use App\Models\DiscountManagment;
use App\Models\LeadStatus;
use App\Models\Slot;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LeadHistory;
use App\Services\InappNotificationService;
use App\Services\WhatsappService;
use App\Services\SmsService;

class Juniordashboard extends Component
{
    use WithPagination;

    public $editID, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $langaugesknown, $gender, $comments, $assignto, $date, $slot, $search;

    public $whatsappnumber, $leadkeyword, $leadtype = 1,$lang;

    public $assigned, $unassigned, $assignedtable = 0, $convertedleads,$leadstatusfordemo;

    public $followupleadstoday = [];
    public $leadhistorydata=[];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['taginputevent' => 'taginput', 'reset' => 'resetInputs'];

    public $courses = [], $priceoffered, $selectedcourse, $selectedleadforpayment, $priceofferedorignal, $previouspaymentattempts = [];
    public $validamountsendlink = 0, $followupleadhandeldata, $followupselectedleadid = 0;
    public $followupleadstats, $validamounttosendlink, $mobilerforpaytmlink, $emailforpaytmlink, $courseselectedforpayment;
    public $leadhistorycomment='',$leadtypemessage='';
    public function taginput()
    {
        $this->emit('taginput', 1);
    }

    public function resetInputsLead()
    {

    }
    public function updatedMobile($value){
        $this->whatsappnumber=$value;
    }

    public function leadhistorycommentstore(){
        $leadstatus=LeadStatus::findorFail($this->leadstatusfordemo);
        $leadid=$leadstatus->leadid;
        leadHistorycomment($this->leadhistorycomment,$leadid);
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadhistorycomment='';
    }

    public function resetInputsPayment()
    {
        $this->priceoffered = '';
        $this->selectedcourse = '';
        $this->selectedleadforpayment = '';
        $this->priceofferedorignal = '';
        $this->emailforpaytmlink = '';
        $this->mobilerforpaytmlink = '';
    }

    public function hydrate()
    {
        $this->leadidsassgined = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1])->count();
        $this->leadidunassigned = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0])->count();
        $this->convertedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' => 1])->count();
    }
   
    public function updatedSelectedcourse($value)
    {   
        try {
        $this->courseselectedforpayment = $value;
        $this->priceoffered = CoursesType::findorFail($value)->price;
        $this->priceofferedorignal = CoursesType::findorFail($value)->price;
        $this->validamountsendlink = 1;
        $id = $this->selectedleadforpayment;
        $leadstatus=LeadStatus::findorFail($id);
        $userdetails = User::findorFail($leadstatus->leadid);
        $this->mobilerforpaytmlink = $userdetails->mobile;
        $this->emailforpaytmlink = $userdetails->email;
        } catch (\Throwable $th) {
            // dd($th);
            //throw $th;
        }

        
        // CoursePayments::create();
    }
    public function mount()
    {
        $this->assigned = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1,'is_paid' => 0])->whereNull('follow_up')->count();
        $this->unassigned = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0])->whereNull('follow_up')->count();
        $this->courses = Courses::where('isactive', 1)->whereHas('coursetype', function ($q) {
            $q->where('isactive', 1);
        })->get();
        $this->convertedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' => 1])->whereNull('follow_up')->count();
        $this->followupleadstats = LeadStatus::where(['assignedto' => auth()->user()->id])->whereNotNull('follow_up')->count();
        $this->followupleadstoday = LeadStatus::where('follow_up', Carbon::today())->count();
    }

    public function refreshStats()
    {
        $this->assigned = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1,'is_paid'=>0])->whereNull('follow_up')->count();
        $this->unassigned = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0,'is_paid'=>0])->whereNull('follow_up')->count();
        $this->convertedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' => 1])->whereNull('follow_up')->count();
        $this->followupleadstats = LeadStatus::where(['assignedto' => auth()->user()->id])->whereNotNull('follow_up')->count();

    }

    public function followupselectedlead($id)
    {
        $this->followupselectedleadid = $id;

    }

    public function makeleadactivefromfollowup($id)
    {
        // dd($id);
        LeadStatus::findorFail($id)->update(['follow_up' => null]);
    }

    public function followupleadhandel()
    {
        $date = Carbon::parse($this->followupleadhandeldata)->format('Y-m-d H:i:s');
        $followupid = $this->followupselectedleadid;
        LeadStatus::findorFail($followupid)->update(['follow_up' => $date]);
        $this->resetInputsFollowup();
        $this->emit('flashmessage', 'Follow Up Registered Successfully');
    }

    public function resetInputsFollowup()
    {
        $this->followupleadhandeldata = '';
        $this->followupselectedleadid = 0;
    }
    public function getleadHistory($leadid,$leadstatusfordemo){
        
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadstatusfordemo=$leadstatusfordemo;
    }   

    public function checkpaytmstatus($paymentid, $leadid)
    {
        CoursePayments::findorFail($paymentid)->update(['payment_success' => 1]);
        LeadStatus::findorFail($leadid)->update(['is_paid' => 1]);
        $this->resetInputsPayment();
        $this->emit('flashmessage', 'Payment Status Changed Successfully');
    }

    public function leadstatusstatsactive($status)
    {
        $this->assignedtable = $status;
    }

    public function showassignedleads()
    {
        $this->assignedtable = 1;
    }

    public function showunassignedleads()
    {
        $this->assignedtable = 0;
    }

    public function paymentselecteduser($id)
    {
        
        $leadid=LeadStatus::findorFail($id)->leadid;
        $this->selectedleadforpayment = $id;
        $this->previouspaymentattempts = CoursePayments::where(['lead_id'=>$leadid,'is_expired'=>0])->get();
    }

    public function updatedpriceoffered($value)
    {
        $leadid=LeadStatus::findorFail($this->selectedleadforpayment)->leadid;
        $leaddetails=User::find($leadid)->add_extra_discount;
        if ($leaddetails) {
            
            $discountpercentage = DiscountManagment::where(['department' => 2, 'role' => 2])->first();

        } else {
            $discountpercentage = DiscountManagment::where(['department' => 2, 'role' => 3])->first();

        }
        
        $validamount = (int) $this->priceofferedorignal * (int) $discountpercentage->amount / 100;
        $validamount = (int) $this->priceofferedorignal - $validamount;
        $this->validamounttosendlink = $validamount;
        if ($validamount <= $value) {
            $this->validamountsendlink = 1;
        } else {
            $this->validamountsendlink = 0;
        }

    }

    public function sendpaymentlink()
    {
        $userid = auth()->user()->id;
        $leadstatusid = $this->selectedleadforpayment;
        $leadstatus = LeadStatus::findorFail($leadstatusid);
        $leadid=$leadstatus->leadid;
        $linkid = Str::random(8);
        if (CoursePayments::where('linkid', $linkid)->exists()) {
            $linkid = Str::random(8) . Str::random(2);
        }
        $check = CoursePayments::where(['user_id' => $userid, 'lead_id' => $leadid])->exists();
        if ($check) {
            $linkid= CoursePayments::where(['lead_id' => $leadid])->orderBy('id','desc')->first()->linkId;
            $data = ['lead_id' => $leadid, 'user_id' => $userid, 'email' => $this->emailforpaytmlink, 'mobile' => $this->mobilerforpaytmlink, 'price' => $this->priceofferedorignal, 'discounted_price' => $this->priceoffered, 'linkId' => $linkid, 'lead_status' => $leadstatus->id, 'course_id' => $this->courseselectedforpayment];
            CoursePayments::where(['lead_id' => $leadid,'is_expired'=>0])->update(['is_expired'=>1]);
            CoursePayments::create($data);
            WhatsappService::sendpaymentlink($leadid,$this->courseselectedforpayment,$this->priceoffered,$linkid,auth()->user()->name,auth()->user()->mobile);
        } else {
            $data = ['lead_id' => $leadid, 'user_id' => $userid, 'email' => $this->emailforpaytmlink, 'mobile' => $this->mobilerforpaytmlink, 'price' => $this->priceofferedorignal, 'discounted_price' => $this->priceoffered, 'linkId' => $linkid, 'lead_status' => $leadstatus->id, 'course_id' => $this->courseselectedforpayment];
            WhatsappService::sendpaymentlink($leadid,$this->courseselectedforpayment,$this->priceoffered,$linkid,auth()->user()->name,auth()->user()->mobile);
            CoursePayments::create($data);
        }

        $this->resetInputsPayment();
        $this->emit('flashmessage', 'Payment Link Sent Successfully');
    }

    public function edit($id)
    {
        // $this->emit('taginput', 1);
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
        $this->leadtypemessage=$editdata->leadMessages()->exists() ? $editdata->leadMessages()->where('message_type',1)->orderBy('id','desc')->first()->message : '';
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
        $getseniortrainer = LeadStatus::where(['demoid'=>$id,'department' => 4, 'level' => 2])->first();
        if ($getseniortrainer) {
            $this->assignto = $getseniortrainer->assignedto;
        } else {
            $this->assignto = '';
        }
    }

    public function assign()
    {
        $id = $this->editID;
        $demo = Demo::create(['leadid' => $id, 'slot' => $this->slot, 'date' => $this->date]);
        LeadStatus::where('leadid', $id)->update(['is_transferred' => 1, 'demoid' => $demo->id]);
        $createlead = LeadStatus::create(['leadid' => $id, 'assignedby' => auth()->user()->id, 'assignedto' => $this->assignto, 'level' => 2, 'department' => 4, 'comments' => 'Lead assigned from marketing intern to senior trainer executive', 'demoid' => $demo->id]);
        Demo::findorFail($demo->id)->update(['leadstatus' => $createlead->id]);
        // leadassignjuniorsalestoseniormarketing(auth()->user()->id, $this->assignto, $id);
        InappNotificationService::democreatedbyjrmarketing($createlead->id,$this->slot,$this->date,$this->assignto);
        $trainer=User::findorFail($this->assignto);
        $user=User::findorFail($id);
        SmsService::demoassigntosrtrainer($user->name,$this->date,$this->slot,$trainer->mobile);
        leadHistoryJuniorMarketingtoSeniorTrainerAssignment(auth()->user()->id,$this->assignto,$id);
        demoschedulelead(auth()->user()->id,$demo->id,$id);
        $this->refreshStats();
        $this->emit('flashmessage', 'Assigned successfully');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->countrycode = '';
        $this->state = '';
        $this->reference = '';
        $this->growth = '';
        $this->edulevel = '';
        $this->gender = '';
        $this->comments = '';
        $this->langaugesknown = '';
    }

    public function update()
    {
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
            ['lang' => 'nullable'],

        );
        $leadty=User::findorFail($id)->leadtype;
        if ($leadty != $this->leadtype) {
           WhatsappService::callmessages($id,$this->leadtype,auth()->user()->name,auth()->user()->mobile,$this->lang);
        }
        $user = ['name' => $this->name, 'email' => $this->email, 'mobilecode' => $this->mobilecode, 'mobile' => $this->mobile, 'leadkeyword' => $this->leadkeyword, 'whatsappnumber' => $this->whatsappnumber, 'leadtype' => $this->leadtype,'lang'=>$this->lang];
        User::findorFail($id)->update($user);
        $details = ['state' => $this->state, 'refrence' => $this->reference, 'growth' => $this->growth, 'edulevel' => $this->edulevel, 'gender' => $this->gender, 'comments' => $this->comments];
        UserDetail::where('user_id', $id)->update($details);
        $this->emit('flashmessage', 'Lead info updated successfully');
    }

    public function store()
    {
        $this->validate();
        $password = Hash::make($this->mobile);
        $lang = $this->langaugesknown;
        $lang = explode(",", $lang);
        $languages = json_encode($lang);
        $create = User::create(['name' => $this->name, 'email' => $this->email, 'mobile' => $this->mobile, 'mobilecode' => $this->countrycode, 'password' => $password, 'user_type' => 2]);
        UserDetail::create(['user_id' => $create->id, 'state' => $this->state, 'refrence' => $this->reference, 'growth' => $this->growth, 'edulevel' => $this->edulevel, 'gender' => $this->gender, 'comments' => $this->comments, 'langaugesknown' => $languages]);
        LeadStatus::create(['leadid' => $create->id, 'assignedby' => 0, 'assignedto' => auth()->user()->parent_id, 'level' => 2, 'leadtype' => 1, 'department' => 3, 'comments' => 'System Assigned!']);
        $this->emit('flashmessage', 'Lead generated successfully');
        $this->resetInputs();
    }

    public function reassign()
    {
        $demo = Demo::findorFail($this->editID);
        Demo::findorFail($this->editID)->update(['slot' => $this->slot, 'date' => $this->date]);
        demoreschedulelead(auth()->user()->id,$this->editID,$demo->leadid);
        $oldslot=Slot::find($demo->slot);
        $oldformateddate=dateformater($demo->date);
        $olddatetime="{$oldformateddate} {$oldslot->from}";
        $newslot=Slot::find($this->slot);
        $newdateformated=dateformater($this->date);
        $newdatetime="{$newdateformated} {$newslot->from}";
        $user=User::find($demo->leadid)->name;
        if($demo->trainerid){
            $stakeholder=User::find($demo->leadid)->stakeholders()->unique()->values()->all();
            if(array_key_exists(2,$stakeholder)){
                $srtrainernumber=User::findorFail($stakeholder[2])->mobile;
                SmsService::demoreassignjrmarketing($user,auth()->user()->name,$olddatetime,$newdatetime,$srtrainernumber);
            }
            if(array_key_exists(3,$stakeholder)){
               $trainernumber=User::findorFail($stakeholder[3])->mobile;
               SmsService::demoreassignjrmarketing($user,auth()->user()->name,$olddatetime,$newdatetime,$trainernumber);
            }
           
            

        }
        InappNotificationService::reschedulingjrmarkeing($user,auth()->user()->name,$olddatetime,$newdatetime,$this->editID);
        // $this->hydrate();
        $this->emit('flashmessage', 'Lead assigned to senior for rescheduling successfully');
    }




    public function render()
    {

        switch ($this->assignedtable) {
            case 0:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0, 'is_paid' => 0])->whereNull('follow_up');
                break;
            case 1:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1, 'is_paid' => 0])->whereNull('follow_up');
                break;
            case 2:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' => 1])->whereNull('follow_up');
                break;
            case 3:
                $leadids = LeadStatus::where(['assignedto' => auth()->user()->id])->whereNotNull('follow_up');
                break;

            default:
                # code...
                break;
        }

        if ($this->search) {
            $searchTerm = $this->search;
            $data = $leadids->whereHas('userRelation', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
            })->orderBy('id', 'desc')->paginate(10);
        } else {
            $data = $leadids->orderBy('id', 'desc')->paginate(10);
        }
        $slots = Slot::all();
        $seniortrainers = User::where(['department' => 4, 'role' => 2])->withCount('assignedusers')->get();
        return view('livewire.sales.juniordashboard', ['data' => $data, 'slots' => $slots, 'seniortrainers' => $seniortrainers]);
    }
}
