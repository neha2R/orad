<?php

namespace App\Http\Livewire\Sales\BdeIntern;

use App\Models\Demo;
use App\Models\Slot;
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

    public $assignedleads=0,$unassignedleads=0,$leadhistorydata=[],$leadstatusfordemo=0;
    
    // comment variables 
    public $convertedleads=0,$followupleadstats=0;
    
    // assignement variables leadid, assign date, demo slot
    public $assignDate, $demo_slots;

    // search and pagination of table
    public $search, $paginate=5;

    // dashboard cards variables 
    public $assignedtable=1, $activeuser='Not Called Yet Leads', $newleads, $notresponding, $askforporposal, $demoforwarded, $followuplead, $todaysfollowup;

    // followup lead variables 
    public $followup, $leadid;

    protected $listeners = [ 'reset' => 'resetInputsLead'];


    public function mount(){
        $this->demo_slots = Slot::where('is_active','1')->get();
       $this->statsRefresh();
    }

    public function setleadid($leadid)
    {
        $this->leadid = $leadid;
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
                $this->activeuser='Not Called Yet Leads';
                break;
            
            case 2:
                $this->activeuser='Cold Leads';
                break;
            
            
            case 3:
                $this->activeuser='Warm Leads';
                break;
            
            
            case 4:
                $this->activeuser='Hot Leads';
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
        $this->statsRefresh();
    }

    public function statsRefresh(){

        // get not assigned leads 
        $leadIds = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '0'])->whereNull('follow_up')->select('leadid')->pluck('leadid')->toArray();
        
        $this->newleads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '0', 'is_transferred' => '0'])->whereNull('follow_up')->count();
        
        // cold lead 
        $this->notresponding = User::whereIn('id',$leadIds)->where('leadtype','2')->count();

        // warm lead 
        $this->askforporposal = User::whereIn('id',$leadIds)->where('leadtype','3')->count();

        // hot lead 
        $this->demoforwarded = User::whereIn('id',$leadIds)->where('leadtype','4')->count();

        $this->followuplead =  LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0','is_paid' => '0'])->whereNotNull('follow_up')->count();

        $this->todaysfollowup = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => '0','is_paid' => '0','follow_up'=>date('Y-m-d')])->count();
    }


    /**
     * User assignement part
     */
    public function assignLead(){
        $validatedData = $this->validate([
            'leadid' => 'required',
            'slot' => 'required',
            'assignDate' => 'required',
        ]);
        
        $assignDate=  date('Y-m-d',strtotime($this->assignDate));

        // get all demo manager 
        $demomanager=User::where(['department'=>'4','sub_department'=>'3','role'=>'2','user_type'=>'1'])->pluck('id')->toArray();

        $assignedto=0;

        // transfer lead to bde intern to bde demo 
        $status = LeadStatus::findorFail($this->leadid)->update(['is_transferred' => "1"]);
        

        // get last assigned lead to demo manager
        $lastassignment=LeadStatus::where(['department'=>'4','sub_department'=>'3','level'=>'3'])->latest()->first();

        if ($lastassignment) {

            $lastleadassignedto=LeadStatus::where(['department'=>'4','sub_department'=>'3','level'=>'3'])->latest()->first()->assignedto;
            $key = array_search($lastleadassignedto, $demomanager);
            $lastindex=count($demomanager)-1;

            // if senior sale is last from rows then assign to first senior sales
            if ($lastindex == $key) {
                $assignedto=$demomanager[0];
            }else{
                $assignedto=$demomanager[$key+1];
            }
            
        }else{
            
            // if last created lead is null then assign lead to first senior sales 
            $sesiorsales=User::where(['department'=>'4','sub_department'=>'3','role'=>'2'])->first();
            if ($sesiorsales) {
                $assignedto=$sesiorsales->id;
            }
        }
        $leadid = LeadStatus::findorFail($this->leadid)->leadid;
        
        LeadStatus::create(['leadid'=>$leadid,'assignedby'=>'0','assignedto'=>$assignedto, 'assign_date'=>$assignDate, 'level'=>'3','leadtype'=>'1','department'=>'3', 'sub_department'=>'2','comments'=>'Lead assigned from BDE Intern to Demo Manager']);

        // store Schedule demo in demo table 
        Demo::create(['leadid'=>$leadid, 'seniortrainer_id'=>$assignedto, 'date'=>$assignDate, 'slot'=>$this->slot]);
            
        $client=User::findorFail($leadid);
        $message="Please Assign a trainer to ".$client->name."";
        leadTransfer($client->mobile,$assignedto,$client->id);
        // leadHistoryJuniorMarketingAssignment(auth()->user()->id,$assignedto,$leadid);
        // InappNotificationService::srmarketingassignleadtojrmarketing($assignedto,1,auth()->user()->name);
        
        $this->statsRefresh();
        $this->resetInputsLead();
        $this->emit('flashmessage', 'Assigned successfully');
    }


    public function render()
    {
        
        $leadData = LeadStatus::query();
        $leadData = $leadData->has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_paid' => '0']);
        if ($this->assignedtable != '4' && $this->assignedtable != '3' ) {
            $leadData = $leadData->where(['is_transferred' => '0']);
        }
        
        if ($this->assignedtable == '6') {
            $leadData = $leadData->where('follow_up',date('Y-m-d'));
        }elseif ($this->assignedtable == '5') {
            $leadData = $leadData->whereNotNull('follow_up');
        }elseif ($this->assignedtable == '1'){
            $leadData = $leadData->whereNull('follow_up');

        }else {
            $usertype= $this->assignedtable;
            $leadData = $leadData->whereHas('userRelation', function($query) use($usertype) {
                $query->where('leadtype',$usertype);
                
            });
        }
        // dd($leadData->count(),$this->askforporposal);
        if ($this->search) {
            $searchTerm=$this->search;
            $leadData = $leadData->whereHas('userRelation', function($query) use($searchTerm){
                $query->where('name', 'LIKE', "%{$searchTerm}%") 
                ->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$this->search}%");
            });
        }
        $data = $leadData->orderBy('id','desc')->paginate($this->paginate);


        // Leads assign to demo manager
        $assigntousers = User::where(['department'=>'4','sub_department'=>'3','role'=>'2'])->orderBy('id','desc')->withCount('assignedusers')->get();
        
        // unassigned leads
        $unAssignedLeadsData = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id, 'is_transferred' => "0", 'is_paid' => '0'])->whereNull('follow_up')->get();
        return view('livewire.sales.bde-intern.dashboard',[
            'data' => $data,
            'assigntousers' => $assigntousers,
            'unAssignedLead'=>$unAssignedLeadsData
        ])->layout('layouts.new-app');
    }
}