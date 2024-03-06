<?php

namespace App\Http\Livewire\Training\QAManager;

use App\Models\User;

use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use App\Models\LeadHistory;
use App\Models\ProvideSlot;
use App\Imports\UsersImport;
use App\Models\TrainerSlots;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CoursePayments;
use App\Services\WhatsappService;
use App\Http\Traits\AssignClassByQA;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\LeadHistoryTrait;
use App\Http\Traits\LeadRegistrationTrait;
use App\Services\InappNotificationService;
use App\Models\Classes as ScheduledClasses;

class Dashboard extends Component
{
    use WithPagination,WithFileUploads, LeadRegistrationTrait, LeadHistoryTrait, AssignClassByQA;
   
    // render variables 
    public $assignedtable=0,$assignedleads=0,$unassignedleads=0,$leadhistorydata=[],$unAssignedLead=[], $leadstatusfordemo=0;

    // comment variables 
    public $convertedleads=0,$followupleadstats=0;
    
    // search and pagination of table
    public $search, $paginate=10;


    public function mount(){
       $this->statsRefresh();
    }


    public function leadstatusstatsactive($id){
        $this->assignedtable=$id;
    }

    public function statsRefresh(){
        $this->assignedleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '1','is_paid' => '1'])->count();
        $this->unassignedleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0','is_paid' => '1'])->count();
    }


    public function render()
    {
        $leadids = LeadStatus::query();
        $data = $leadids->has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => "$this->assignedtable", 'is_paid' => '1']);
         
        
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
        $assigntousers = User::where('parent_id', auth()->user()->id)->orderBy('id','desc')->get();

        // unassigned leads
        $this->unAssignedLead = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0', 'is_paid' => '1'])->get();
        
        return view('livewire.trainer.qa-manager.dashboard',[
            'data' => $data,
            'assigntousers' => $assigntousers,
        ])->layout('layouts.new-app');
    }
}