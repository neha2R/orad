<?php

namespace App\Http\Livewire\Sales\BdeTeamLead;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use App\Models\LeadHistory;
use Livewire\WithPagination;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\LeadHistoryTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\LeadRegistrationTrait;

class Performance extends Component
{
    use WithPagination, LeadRegistrationTrait, LeadHistoryTrait;

    // render variables 
    public $overallConversion, $targetedConversionRate, $conversionRate, $totalLeads, $totalDemoAssigned, $totalDemoDone;
    
    public $interval=[], $currentMonth;

    // performer row variables 
    public $employees, $username="My", $performerid='', $leadstatusfordemo;

    // daily work popup variables 
    public $assignedtable=0, $currentDate; 

    // followup variables 
    public $leadhistorydata=[];

    // search and pagination of table
    public $search, $paginate=5;


    public function leadstatus($status){
        $this->assignedtable=$status;
    }


    public function mount(){
        $this->targetedConversionRate = config('app.conversion_rate');
        
        $this->currentDate = date('Y-m-d');
        $data = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->first();
        if ($data) {
            $this->interval = CarbonPeriod::create($data->created_at,'1 month',now())->toArray();
        }
        $this->currentMonth = now()->format('Y-m');
        $this->performerid = auth()->user()->id;
        $this->employees = User::where('parent_id',auth()->user()->id)->get();
    }
    
    public function resetInputs()
    {
        $this->assignedtable=0;
        // $this->performerid = auth()->user()->id;
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
    }

    public function render(){    
       
        $query = LeadStatus::query();
        if(auth()->user()->id == $this->performerid && $this->employees->isNotEmpty()){
            
            $query = $query->whereIn('assignedto', $this->employees->pluck('id')->toArray())->where([ 'is_transferred'=>"1"]);
        }else {
            $query = $query->where(['assignedto' => $this->performerid, 'is_transferred'=>"1"]);
        }
        $overallDemoDone = $query->where('demoid','!=','0')->count();
        // dd($overallDemoDone);
        $overallTotalLeads = LeadStatus::has('userRelation')->where(['assignedto' => $this->performerid])->count();
        
        if ($overallTotalLeads) {
            $result = ceil(($overallDemoDone / $overallTotalLeads) * 100);
            $this->overallConversion = $result;
        } else {
            $this->overallConversion = 0;
        }
        

        $this->totalLeads = LeadStatus::has('userRelation')->where(['assignedto' => $this->performerid])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->totalDemoAssigned = LeadStatus::where(['assignedto' => $this->performerid, 'is_transferred'=>"1"])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->totalDemoDone = LeadStatus::where(['assignedto' => $this->performerid, 'is_transferred'=>"1"])->where('demoid','!=','0')->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        
        
        $this->conversionRate = $this->totalLeads ? round(((($this->totalDemoDone ?? 1) / ($this->totalLeads)) * 100),2) : 0;

        $data = LeadStatus::query();
        $data = $data->has('userRelation')->where('assignedto',$this->performerid);
        $data = $data->where('created_at', 'LIKE', "{$this->currentMonth}%");
        // $data = $data->where('assign_date',$this->currentDate);
        if ($this->assignedtable) {
            $data = $data->where('follow_up',date('Y-m-d'));
        }
        // dd($data->get(), $this->performerid, $this->currentMonth, $this->paginate);
        $leadData = $data->paginate($this->paginate);
        $this->username= $this->performerid == auth()->user()->id ? "My" : User::findorFail($this->performerid)->name;
        
        return view('livewire.sales.bde-team-lead.performance',['leadData'=>$leadData])->layout('layouts.new-app');        
    }
}
