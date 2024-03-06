<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use App\Models\LeadHistory;
use App\Imports\UsersImport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\InappNotificationService;

class Dashboard extends Component
{
    use WithPagination,WithFileUploads;
    public $editID, $name, $email, $mobile, $reference, $state, $countrycode, $mobilecode, $growth, $edulevel, $gender, $comments, $date, $slot;
    public $whatsappnumber,$leadkeyword,$leadtype=0,$lang=0;
    public $assignedtable=0,$assignedleads=0,$unassignedleads=0,$leadhistorydata=[],$leadstatusfordemo=0;
    
    // comment variables 
    public $leadhistorycomment='',$convertedleads=0,$followupleadstats=0;
    
    // file import variables 
    public $fileimport,$errormessage=[],$iteration;
    
    // assignement variables 
    public $leadStartFrom, $leadEndTo, $assignDate, $assignto;

    // search and pagination of table
    public $search, $paginate=10;

    protected $listeners = [ 'reset' => 'resetInputsLead'];


    public function mount(){
       $this->statsRefresh();
    }

    public function getleadHistory($leadid,$leadstatusfordemo){
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadstatusfordemo=$leadstatusfordemo;
    } 

    /**
     * store auth user comment in lead history table
     */
    public function leadhistorycommentstore(){
        $leadstatus=LeadStatus::findorFail($this->leadstatusfordemo);
        $leadid=$leadstatus->leadid;
        leadHistorycomment($this->leadhistorycomment,$leadid);
        $this->leadhistorydata=LeadHistory::where('leadid',$leadid)->orderBy('id','desc')->get();
        $this->leadhistorycomment='';
        
    }
    public function resetInputsLead(){
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->whatsappnumber = '';
        $this->countrycode = '';
        $this->state = '';
        $this->reference = '';
        $this->growth = '';
        $this->edulevel = '';
        $this->gender = '';
        $this->comments = '';
        $this->fileimport = '';
        $this->errormessage = [];
        $this->iteration = '';
        $this->leadStartFrom = '';
        $this->assignto = '';
        $this->leadEndTo = '';
        $this->assignDate = '';
    }

    public function leadstatusstatsactive($id){
        $this->assignedtable=$id;
    }

    public function statsRefresh(){
        $this->assignedleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => 1,'is_paid' => 0])->count();
        $this->unassignedleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => 0,'is_paid' => 0])->count();
    }


    /**
     * User assignement part
     */
    public function assignLead(){
        $validatedData = $this->validate(
            [
                'leadStartFrom' => 'required|different:leadEndTo',
                'assignto' => 'required',
                'leadEndTo' => 'sometimes|different:leadStartFrom',
                'assignDate' => 'required',
            ],
            [
                'assignto.required' => 'Select user to assign leads',
                'leadStartFrom.required' => 'Select leads',
                'leadStartFrom.different' => 'From Column must be different from To Column',
                'leadEndTo.different' => 'To Column must be different from From Column',
            ]
        );
        
        $assignDate=  date('Y-m-d',strtotime($this->assignDate));
        if ($this->leadEndTo == null) {

            // lead status update that lead is transferred 
            LeadStatus::findorFail($this->leadStartFrom)->update(['is_transferred' => '1']);
            
            $leadid = LeadStatus::findorFail($this->leadStartFrom)->leadid;
            
            // lead transfer to junior sales (department=subdepartment) 
            LeadStatus::create(['leadid'=>$leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto, 'level'=>'1', 'leadtype'=>'1','department'=>'3', 'sub_department'=>'2', 'comments'=>'Lead assigned from administrative to BDE Team Lead','assign_date'=>$assignDate]);
            
            $clientname=User::findorFail($leadid)->name;
            $message="Please Assign a trainer to $clientname";
            // leadHistoryJuniorMarketingAssignment(auth()->user()->id,$this->assignto,$this->leadEndTo);
            // InappNotificationService::srmarketingassignleadtojrmarketing($this->assignto,count($this->leadEndTo),auth()->user()->name);
            
        }else {
            $leadIds = LeadStatus::where(['assignedto'=> auth()->user()->id, 'is_transferred' => '0'])->whereBetween('id', [$this->leadStartFrom, $this->leadEndTo])->pluck('leadid')->toArray();
            
            foreach ($leadIds as $key => $value) {
                // lead update in senior sales 
                LeadStatus::findorFail($value)->update(['is_transferred' => '1']);
                $leadid = LeadStatus::findorFail($value)->leadid;
                
                // lead transfer to junior sales (department=subdepartment) 
                LeadStatus::create(['leadid'=>$leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assignto, 'level'=>'1', 'leadtype'=>'1','department'=>'3', 'sub_department'=>'2', 'comments'=>'Lead assigned from administrative to BDE Team Lead','assign_date'=>$assignDate]);
                $clientname=User::findorFail($leadid)->name;
                $message="Please Assign a trainer to ".$clientname."";
                // leadHistoryJuniorMarketingAssignment(auth()->user()->id,$this->assignto,$value);
            }
            // InappNotificationService::srmarketingassignleadtojrmarketing($this->assignto,count($leadIds),auth()->user()->name);
        }
        // assignleadseniorsalestoseniormarketing(count($this->users),auth()->user()->id,$this->assignto);
        $this->statsRefresh();
        $this->resetInputsLead();
        $this->emit('flashmessage', 'Assigned successfully');
    }

    public function edit($id){
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
        $this->lang = $editdata->lang;
        // dd($this->lang);
        $this->state = optional($editdata->userDetails)->state;
        $this->growth = optional($editdata->userDetails)->growth;
        $this->edulevel = optional($editdata->userDetails)->edulevel;
        $this->gender = optional($editdata->userDetails)->gender;
        $this->comments = optional($editdata->userDetails)->comments;
        $this->reference = optional($editdata->userDetails)->refrence;
    }

    /**
     * Create or update lead 
     */
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
        
        $leadty=User::find($id);
        if ($leadty != null && $leadty->leadtype != $this->leadtype) {
           WhatsappService::callmessages($id,$this->leadtype,auth()->user()->name,auth()->user()->mobile,$this->lang);
        }
        $user=['name'=>$this->name,'email'=>$this->email,'mobilecode'=>$this->mobilecode,'mobile'=>$this->mobile,'leadkeyword'=>$this->leadkeyword,'whatsappnumber'=>$this->whatsappnumber,'leadtype'=>$this->leadtype,'lang'=>$this->lang];
        
        $details=['state'=>$this->state,'refrence'=>$this->reference,'growth'=>$this->growth,'edulevel'=>$this->edulevel,'gender'=>$this->gender,'comments'=>$this->comments];
        if ($id == null) {
        
            $user['user_type']= '2';
            $user['password']= Hash::make($this->mobile);
            
            $registeruser= User::create($user);
            $details['user_id']=$registeruser->id;
            
            UserDetail::create($details);

            $assignedto=auth()->user()->id;

            //department id get from sub_department table
            // LeadStatus::create(['leadid'=>$registeruser->id,'assignedby'=>0,'assignedto'=>$assignedto,'level'=>2,'leadtype'=>1,'department'=>1,'comments'=>"System Assigned!"]);
            // leadassignedtoseniorsales($assignedto,$registeruser->id);
            // leadHistoryMessageSeniorMarketingAssignment($this->mobile,$assignedto,$registeruser->id);
            WhatsappService::optin($this->mobile);
            WhatsappService::optin($this->whatsappnumber);
        } else {
            $update= User::findorFail($id)->update($user);
            UserDetail::where('user_id', $id)->update($details);
            
        }
        
        $this->resetInputsLead();
        $this->statsRefresh();
        $this->emit('flashmessage', 'Lead info updated successfully');
    }

    /**
     * Import bulk lead in excel formate
     */
    public function importSheet(){
        
        $errors=collect();
        if ($this->fileimport == null) {
            $errors->push('Excel file is empty. Please enter valid excel file');
            $this->errormessage=$errors;
        }else {
            $this->errormessage=[];
            $errors=collect();

            try {
                Excel::import(new UsersImport(1),$this->fileimport);
                 $this->fileimport=null;
                 $this->iteration++;
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    $message="You can't import lead on line ". $failure->row() ." ".implode(" ",$failure->errors())."";
                    $errors->push($message);
                }
                $this->errormessage=$errors;
                $this->fileimport=null;
                $this->iteration++;
                //  return redirect()->back('')
            }
        }
        
        if ($errors->isEmpty()) {
            # code...
            $this->resetInputsLead();
            $this->statsRefresh();
            $this->emit('flashmessage', 'Lead info updated successfully');
        }
    }

    public function render()
    {
        $leadids = LeadStatus::query();
        $data = $leadids->has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => "$this->assignedtable", 'is_paid' => 0])->whereNull('follow_up');
        
        if ($this->search) {
            $searchTerm=$this->search;
            $data = $leadids->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->orderBy('id','desc')->paginate($this->paginate);
        } else {
            $data = $leadids->orderBy('id','desc')->paginate($this->paginate);
        }

        // junior sales 
        $assigntousers = User::where('parent_id', auth()->user()->id)->orderBy('id','desc')->withCount('assignedusers')->get();

        // unassigned leads
        $unAssignedLeadsData = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => "$this->assignedtable", 'is_paid' => 0])->whereNull('follow_up')->get();
        
        return view('livewire.admin.dashboard',[
            'data' => $data,
            'assigntousers' => $assigntousers,
            'editId'=>$this->editID,
            'unAssignedLead'=>$unAssignedLeadsData
        ])->layout('layouts.new-app');
    }
}