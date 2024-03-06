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

use App\Http\Traits\LeadHistoryTrait;
use App\Exports\ScholarshipLeadExport;
use App\Http\Traits\LeadRegistrationTrait;
use App\Services\InappNotificationService;

class Leadcreate extends Component
{
    use WithPagination,WithFileUploads, LeadHistoryTrait, LeadRegistrationTrait;
    
    public $leadhistorydata=[],$leadstatusfordemo=0;
    
    // comment variables 
    public $convertedleads=0,$followupleadstats=0;
    
    
    // assignement variables 
    public $leadStartFrom, $leadEndTo, $assign_date, $assign_to;

    // search and pagination of table
    public $search, $paginate=10;

    // render variables 
    public $assigntousers, $unAssignedLead, $type_of_lead="Unassigned";

    // card variable transferred/untransferred/scholarship users 
    public  $scholarship_user_count, $assigned_leads_count, $unassigned_leads_count;

    // state change variable 
    public  $active_user=0, $scholarship_user=0;

    protected $listeners = [ 'reset' => 'resetInputsLead'];

    /**
     * Change cards data (1=unassigned_lead , 2=transferred_lead, 3=scholarship user)
     */
    public function leadstatusstatsactive($state){
        switch ($state) {
            case 1:
                $this->active_user=0;
                $this->scholarship_user=0;
                $this->type_of_lead='Unassigned';
                break;
                
            case 2:
                $this->active_user=1;
                $this->scholarship_user=0;
                $this->type_of_lead='Assigned';
                break;
                
            case 3:
                $this->active_user=0;
                $this->scholarship_user=1;
                $this->type_of_lead='Scholarship';
                break;
            
            default:
                # code...
                break;
        }
    }

    public function mount(){
       $this->statsRefresh();
    }

    
    public function statsRefresh(){
        $this->scholarship_user_count = User::where(['is_transferred' => '0','is_scholorship_user'=>'1', 'user_type'=>'2'])->count();
        $this->assigned_leads_count = User::where(['is_transferred' => '1', 'user_type'=>'2'])->count();
        $this->unassigned_leads_count = User::where(['is_transferred' => '0','is_scholorship_user'=>'0', 'user_type'=>'2'])->count();
        
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
        
        $assign_date=  date('Y-m-d',strtotime($this->assign_date));
        
        if ($this->leadEndTo == null) {
            // lead transfer from admin to sales 
            $client=User::find($this->leadStartFrom);
            
            $client->update(['is_transferred' => '1']);
            // lead transfer to senior sales{BDE Team Lead} (department=subdepartment) 
            LeadStatus::create(['leadid'=>$this->leadStartFrom,'assignedby'=>auth()->user()->id,'assignedto'=>$this->assign_to,'level'=>'1','leadtype'=>'1','department'=>'3', 'sub_department'=>'2','comments'=>'Lead transfer from admin to BDE Team Lead', 'assign_date'=>$assign_date]);
            
            
            leadTransfer($client->mobile,$this->assign_to,$client->id);
            
        }else {
            $leadIds = User::where(['is_transferred' => '0'])->whereBetween('id', [$this->leadStartFrom, $this->leadEndTo])->pluck('id')->toArray();
            
            foreach ($leadIds as $key => $value) {
                $client=User::findorFail($this->leadStartFrom);
                $client->update(['is_transferred' => '1']);
                
               // lead transfer to senior sales{BDE Team Lead} (department=subdepartment) 
                LeadStatus::create(['leadid'=>$value,'assignedby'=>auth()->user()->id,'assignedto'=>$this->assign_to,'level'=>'1','leadtype'=>'1','department'=>'3', 'sub_department'=>'2','comments'=>'Lead transfer from admin to BDE Team Lead', 'assign_date'=>$assign_date]);
                
                
                leadTransfer($client->mobile,$this->assign_to,$client->id);
            }
        }
        
        $this->statsRefresh();
        $this->resetInputsLead();
        $this->emit('flashmessage', 'Lead Assigned successfully');
    }

    public function render()
    {
        $data = User::query();
        $data = $data->where(['is_transferred' => "$this->active_user",  'user_type'=>'2']);
        if (!$this->active_user) {
            $data = $data->where(['is_scholorship_user'=> "$this->scholarship_user"]);
        }
        if ($this->search) {
            $data = $data->where('name', 'LIKE', "%{$this->search}%") 
                ->orWhere('email', 'LIKE', "%{$this->search}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
        }
        $lead_data = $data->orderBy('id','desc')->paginate($this->paginate);

        // bde team lead
        $this->assigntousers = User::where(['department'=> '3','role'=> '2','sub_department'=>'2'])->get();

        // unassigned leads
        $this->unAssignedLead = User::where(['user_type'=>'2','is_transferred' => '0'])->select('id','mobile','name')->distinct('mobile')->orderBy('id','desc')->get();
        
        return view('livewire.admin.leadcreate',['lead_data'=>$lead_data])->layout('layouts.new-app');
    }
}