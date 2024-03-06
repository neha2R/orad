<?php

namespace App\Http\Livewire\Sales\BdeJunior;

use App\Models\Slot;
use App\Models\User;
use Livewire\Component;
use App\Models\LeadStatus;
use App\Models\UserDetail;
use App\Models\CoursesType;
use App\Models\LeadHistory;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CoursePayments;
use App\Models\DiscountManagment;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\LeadHistoryTrait;
use App\Http\Traits\PaymentLinkTrait;
use App\Http\Traits\LeadRegistrationTrait;
use App\Services\InappNotificationService;

class Dashboard extends Component
{
    use WithPagination,WithFileUploads, LeadRegistrationTrait, LeadHistoryTrait, PaymentLinkTrait;

    public $assignedleads=0,$unassignedleads=0,$leadhistorydata=[],$leadstatusfordemo=0;
    
    // comment variables 
    public $convertedleads=0,$followupleadstats=0;


    // search and pagination of table
    public $search, $paginate=5;

    // dashboard cards variables 
    public $assignedtable=1, $activeuser='New Leads', $newleads, $notresponding, $paymentlinksend, $converted, $followuplead, $todaysfollowup;

    // followup lead variables 
    public $followup, $leadid;

    public function mount(){
        // type of courses 
        $this->courses = CoursesType::where('isactive','1')->get();
        
        // converted leads
        $this->unconvertedLead = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '0'])->where('demoid','!=','0')->get();
        $this->statsRefresh();
    }


    public function setleadid($leadid){
        $this->leadid = $leadid;
        $this->followup = LeadStatus::findorFail($leadid)->follow_up;
    }

    public function storeFollowup(){
        LeadStatus::findorFail($this->leadid)->update(['follow_up'=>$this->followup]);
        $this->resetInputsLead();
        $this->statsRefresh();
        $this->emit('flashmessage', 'store followup successfully');
    }

    public function leadstatusstatsactive($id){
        $this->assignedtable=$id;
        switch ($this->assignedtable) {
            case 1:
                $this->activeuser='New Leads';
                break;
            
            case 2:
                $this->activeuser='Not Responding Leads';
                break;
            
            
            case 3:
                $this->activeuser='Payment Link Send';
                break;
            
            
            case 4:
                $this->activeuser='Converted Leads';
                break;
            
            case 5:
                $this->activeuser='Follow Up Leads';
                break;
            
            case 6:
                $this->activeuser='Today\'s Follow Up';
                break;
            
            default:
                # code...
                break;
        }
    }

    public function statsRefresh(){
        
        $this->newleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '0', 'is_transferred' => '0'])->whereNull('follow_up')->count();
        
        // cold lead 
        $this->notresponding = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'leadtype'=>'2'])->count();
        
        // payment link send leads 
        $this->paymentlinksend = LeadStatus::has('paymentDetails')->where(['assignedto' => auth()->user()->id,])->count();
        
        // converted lead
        $this->converted = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '1'])->count();

        // followup lead 
        $this->followuplead =  LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0','is_paid' => '0'])->whereNotNull('follow_up')->count();

        // today's follow up leads 
        $this->todaysfollowup = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0','is_paid' => '0','follow_up'=>date('Y-m-d')])->count();
    }

    public function render()
    {
        
        $leadData = LeadStatus::query();
        $leadData = $leadData->has('userRelation')->where(['assignedto' => auth()->user()->id]);
        if ($this->assignedtable != '4' && $this->assignedtable != '3' ) {
            $leadData = $leadData->where(['is_transferred' => '0', 'is_paid'=> '0']);
        }else{
            $leadData = $leadData->has('paymentDetails');
        }

        if ($this->assignedtable == '6') {
            $leadData = $leadData->where('follow_up',date('Y-m-d'));
        }elseif ($this->assignedtable == '5') {
            $leadData = $leadData->whereNotNull('follow_up');
        }elseif ($this->assignedtable == '1'){
            $leadData = $leadData->whereNull('follow_up');

        }elseif ($this->assignedtable == '4'){
            $leadData = $leadData->where('is_paid','1');
        }elseif ($this->assignedtable == '2') {
            $leadData = $leadData->where('leadtype','2');
        }
        
        if ($this->search) {
            $searchTerm=$this->search;
            $leadData = $leadData->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
            });
        }
        $data = $leadData->orderBy('id','desc')->paginate($this->paginate);


        // Leads assign to QA manager
        $assigntousers = User::where(['department'=>'4','sub_department'=>'4','role'=>'2'])->orderBy('id','desc')->get();
        

        // converted leads
        $convertedLead = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '1'])->whereNull('follow_up')->get();
        
        return view('livewire.sales.bde-junior.dashboard',[
            'data' => $data,
            'convertedLead' => $convertedLead,
            'assigntousers' => $assigntousers,
        ])->layout('layouts.new-app');
    }
}