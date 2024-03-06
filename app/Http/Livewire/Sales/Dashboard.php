<?php

namespace App\Http\Livewire\Sales;

use App\Models\LeadStatus;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LeadHistory;
use App\Services\InappNotificationService;
use App\Services\WhatsappService;
class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $users = [];
    public $assignto, $search;
    public $editID, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $langaugesknown, $gender, $comments, $date, $slot;
    public $whatsappnumber,$leadkeyword,$leadtype=0,$lang=0;
    public $assignedtable=0,$assignedleads=0,$unassignedleads=0,$leadhistorydata=[],$leadstatusfordemo=0;
    public $leadhistorycomment='',$convertedleads=0,$followupleadstats=0;


    protected $listeners = ['taginputevent' => 'taginput', 'reset' => 'resetInputsLead'];

    protected $statsswitch=0;

    public function taginput(){
        $this->emit('taginput', 1);
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

    public function statsRefresh(){
        $this->assignedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 1,'is_paid' => 0])->count();
        $this->unassignedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred' => 0,'is_paid' => 0])->count();
        $this->convertedleads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' => 1])->whereNull('follow_up')->count();
        $this->followupleadstats = LeadStatus::where(['assignedto' => auth()->user()->id])->whereNotNull('follow_up')->count();

    }

    

    public function resetInputs(){
        $this->users = [];
        $this->assignto = '';
    }
    public function leadstatusstatsactive($id){
        $this->assignedtable=$id;
    }

    public function getleadHistory($leadid,$leadstatusfordemo){
        
        
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadstatusfordemo=$leadstatusfordemo;
    }   
    public function mount(){
       $this->statsRefresh();
    }



    public function resetInputsLead(){
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

    public function store(){
        $validatedData = $this->validate(
            [
                'assignto' => 'required',
                'users' => 'required',
            ],
            [
                'assignto.required' => 'Select user to assign leads',
                'users.required' => 'Select leads',
            ]
        );
        foreach ($this->users as $key => $value) {
            LeadStatus::where('leadid', $value)->update(['is_transferred' => 1]);
            LeadStatus::create(['leadid'=>$value, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto, 'level'=>3, 'leadtype'=>1,'department'=>3, 'comments'=>'Lead assigned from senior sales executive to marketing intern']);
            $clientname=User::findorFail($value)->name;
            $message="Please Assign a trainer to ".$clientname."";
            leadHistoryJuniorMarketingAssignment(auth()->user()->id,$this->assignto,$value);
            // User::findorFail($this->assignto)->notify(new InappNotificationCommon($message));
        }
        InappNotificationService::srmarketingassignleadtojrmarketing($this->assignto,count($this->users),auth()->user()->name);
        // assignleadseniorsalestoseniormarketing(count($this->users),auth()->user()->id,$this->assignto);
        $this->statsRefresh();
        $this->resetInputs();
        $this->emit('flashmessage', 'Assigned successfully');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,',
            'mobile' => 'required|unique:users,mobile,',
            'countrycode' => 'required',
            'state' => 'required',
            'reference' => 'required',
        ]);
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
        $this->lang = $editdata->lang;
        // dd($this->lang);
        $this->state = optional($editdata->userDetails)->state;
        $this->growth = optional($editdata->userDetails)->growth;
        $this->edulevel = optional($editdata->userDetails)->edulevel;
        $this->gender = optional($editdata->userDetails)->gender;
        $this->comments = optional($editdata->userDetails)->comments;
        $this->reference = optional($editdata->userDetails)->refrence;
    }

    public function update(){
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
        $user=['name'=>$this->name,'email'=>$this->email,'mobilecode'=>$this->mobilecode,'mobile'=>$this->mobile,'leadkeyword'=>$this->leadkeyword,'whatsappnumber'=>$this->whatsappnumber,'leadtype'=>$this->leadtype,'lang'=>$this->lang];
        // dd($user);
        // dd($id);
        $update= User::findorFail($id)->update($user);
        $details=['state'=>$this->state,'refrence'=>$this->reference,'growth'=>$this->growth,'edulevel'=>$this->edulevel,'gender'=>$this->gender,'comments'=>$this->comments];
        UserDetail::where('user_id', $id)->update($details);
        $this->emit('flashmessage', 'Lead info updated successfully');
    }

    public function changediscountStatus($leadid,$status){
        
        $status = 1-$status;
        $query=User::findorFail($leadid)->update(['add_extra_discount'=>$status]);
        $this->emit('flashmessage', 'Status Changed successfully');
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
            $searchTerm=$this->search;
            $data = $leadids->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->orderBy('id','desc')->paginate(10);
        } else {
            $data = $leadids->orderBy('id','desc')->paginate(10);
        }

        // junior sales 
        $assigntousers = User::where('parent_id', auth()->user()->id)->orderBy('id','desc')->withCount('assignedusers')->get();
        return view('livewire.sales.dashboard',[
            'data' => $data,
            'assigntousers' => $assigntousers
        ]);
    }
}
