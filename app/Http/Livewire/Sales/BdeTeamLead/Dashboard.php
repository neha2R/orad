<?php

namespace App\Http\Livewire\Sales\BdeTeamLead;

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
use App\Http\Traits\LeadHistoryTrait;
use App\Http\Traits\LeadRegistrationTrait;
use App\Services\InappNotificationService;

class Dashboard extends Component
{
    use WithPagination,WithFileUploads, LeadHistoryTrait, LeadRegistrationTrait;
  
    // comment variables 
    public $convertedleads=0,$followupleadstats=0;
    
    // dashboard card variables 
    public $assignedtable=0,$assignedleads=0,$unassignedleads=0,$leadhistorydata=[],$leadstatusfordemo=0;

    
    // assignement variables 
    public $leadStartFrom, $leadEndTo, $assign_date, $assign_to;

    // search and pagination of table
    public $search, $paginate=10;

    protected $listeners = [ 'reset' => 'resetInputsLead'];


    public function mount(){
       $this->statsRefresh();
    }


    public function leadstatusstatsactive($id){
        $this->assignedtable=$id;
        $this->statsRefresh();
    }

    public function statsRefresh(){
        $this->assignedleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '1','is_paid' => '0'])->count();
        $this->unassignedleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0','is_paid' => '0'])->count();
    }


    /**
     * User assignement part
     */
    public function assignLead(){
        $validatedData = $this->validate(
            [
                'leadStartFrom' => 'required|different:leadEndTo',
                'assign_to' => 'required',
                'leadEndTo' => 'sometimes|different:leadStartFrom',
                'assign_date' => 'required',
            ],
            [
                'assign_to.required' => 'Select user to assign leads',
                'leadStartFrom.required' => 'Select leads',
                'leadStartFrom.different' => 'From Column must be different from To Column',
                'leadEndTo.different' => 'To Column must be different from From Column',
            ]
        );
        
        $assignDate=  date('Y-m-d',strtotime($this->assign_date));
        if ($this->leadEndTo == null) {

            // lead update in senior sales 
            LeadStatus::findorFail($this->leadStartFrom)->update(['is_transferred' => '1']);
            
            $leadid = LeadStatus::findorFail($this->leadStartFrom)->leadid;
            
            // lead transfer to junior sales (department=subdepartment) 
            LeadStatus::create(['leadid'=>$leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assign_to, 'assign_date'=>$assignDate,'level'=>'2', 'leadtype'=>'1','department'=>'3', 'sub_department'=>'2','comments'=>'Lead assigned from BDE Team Lead to BDE intern','assign_date'=>$assignDate]);
            
            $client=User::findorFail($leadid);
            $message="Please Assign a trainer to ".$client->name."";
            leadTransfer($client->mobile,$this->assign_to,$client->id);
            // leadHistoryJuniorMarketingAssignment(auth()->user()->id,$this->assign_to,$leadid);
            // InappNotificationService::srmarketingassignleadtojrmarketing($this->assign_to,'1',auth()->user()->name);
            
        }else {
            $leadIds = LeadStatus::where(['assignedto'=> auth()->user()->id, 'is_transferred' => '0'])->whereBetween('id', [$this->leadStartFrom, $this->leadEndTo])->pluck('id')->toArray();
            
            foreach ($leadIds as $key => $value) {
                // lead update in senior sales 
                LeadStatus::findorFail($value)->update(['is_transferred' => '1']);
                $leadid = LeadStatus::findorFail($value)->leadid;
                
                // lead transfer to junior sales (department=subdepartment) 
                LeadStatus::create(['leadid'=>$leadid, 'assignedby'=>auth()->user()->id, 'assignedto'=>$this->assign_to, 'level'=>'2','assign_date'=>$assignDate, 'leadtype'=>'1','department'=>'3', 'sub_department'=>'2', 'comments'=>'Lead assigned from BDE Team Lead to BDE intern','assign_date'=>$assignDate]);
                $client=User::findorFail($leadid);
                $message="Please Assign a trainer to ".$client->name."";
                leadTransfer($client->mobile,$this->assign_to,$client->id);
            }
            // InappNotificationService::srmarketingassignleadtojrmarketing($this->assign_to,count($leadIds),auth()->user()->name);
        }
        
        $this->statsRefresh();
        $this->resetInputsLead();
        $this->emit('flashmessage', 'Assigned successfully');
    }


    public function render()
    {
        $leadids = LeadStatus::query();
        $data = $leadids->has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => "$this->assignedtable", 'is_paid' => '0']);
         
        
        if ($this->search) {
            $searchTerm=$this->search;
            $data = $leadids->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
               })->orderBy('id','desc')->paginate($this->paginate);
        } else {
            $data = $leadids->orderBy('id','desc')->paginate($this->paginate);
        }

        // BDE intern's lists
        $assigntousers = User::where('parent_id', auth()->user()->id)->orderBy('id','desc')->withCount('assignedusers')->get();

        // unassigned leads
        $unAssignedLeadsData = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0', 'is_paid' => '0'])->whereNull('follow_up')->get();
        return view('livewire.sales.bde-team-lead.dashboard',[
            'data' => $data,
            'assigntousers' => $assigntousers,
            
            'unAssignedLead'=>$unAssignedLeadsData
        ])->layout('layouts.new-app');
    }
}