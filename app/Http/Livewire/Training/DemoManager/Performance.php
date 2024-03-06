<?php

namespace App\Http\Livewire\Training\DemoManager;
use Carbon\Carbon;
use App\Models\Demo;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\LeadHistoryTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\LeadRegistrationTrait;

class Performance extends Component
{
    use WithPagination, LeadRegistrationTrait, LeadHistoryTrait;

    // render variables 
    public $overallConversion, $targetedConversionRate, $conversionRate, $totalClasses, $feedback, $totalDemo, $demoConverted;
    
    public $interval=[], $currentMonth;

     // performer row variables 
    public $employees, $username="My", $performerid='', $leadstatusfordemo;

    // daily work popup variables 
    public $assignedtable=0, $currentDate; 

    // followup variables 
    public $leadhistorydata=[];

    // search and pagination of table
    public $search, $paginate=5;

    public function mount(){
        $this->targetedConversionRate = config('app.conversion_rate');
        $data = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->first();
        if ($data) {
            $this->interval = CarbonPeriod::create($data->created_at,'1 month',now())->toArray();
        }
        $this->currentMonth = now()->format('Y-m');
        $this->performerid = auth()->user()->id;
        $this->employees = User::where('parent_id',auth()->user()->id)->get();
    }

    public function resetInputs(){
        $this->assignedtable=0;
        // $this->performerid = auth()->user()->id;
    }

    
    public function render(){  

        $query = LeadStatus::query();
        if(auth()->user()->id == $this->performerid && $this->employees->isNotEmpty()){
            
            $query = $query->whereIn('assignedto', $this->employees->pluck('id')->toArray());
        }else {
            $query = $query->where(['assignedto' => $this->performerid]);
        }
        $overallDemoConverted = $query->where(['is_paid'=>"1"])->count();
        
        // all over conversion rate
        $overallTotalLeads = LeadStatus::has('userRelation')->where(['assignedto' => $this->performerid])->count();
        
        $this->overallConversion =  $overallTotalLeads ? ceil((($overallDemoConverted ) /( $overallTotalLeads)) * 100) : 0;

        // month wise conversion rate 
        $this->totalDemo = LeadStatus::has('userRelation')->where(['assignedto' => $this->performerid])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $feedbackQuery = Demo::query();
        
        if(auth()->user()->id == $this->performerid){
            $feedbackQuery = $feedbackQuery->where(['seniortrainer_id' => $this->performerid]);
        }else {
            $feedbackQuery = $feedbackQuery->where(['trainerid' => $this->performerid]);
        }
        $feedbackQuery = $feedbackQuery->where('created_at', 'LIKE', "%{$this->currentMonth}%")->where('student_feedback','!=','0')->avg('student_feedback');

        $this->feedback = ceil($feedbackQuery);
        $this->demoConverted = LeadStatus::where(['assignedto' => $this->performerid, 'is_paid'=>"1"])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
       
        
        $this->conversionRate = $this->totalDemo ? round(((($this->demoConverted ?? 1) / ($this->totalDemo)) * 100),2) : 0;

        $data = LeadStatus::query();
        $data = $data->has('userRelation')->where('assignedto',$this->performerid);
        $data = $data->where('created_at', 'LIKE', "{$this->currentMonth}%");
        // $data = $data->where('assign_date',$this->currentDate);
        if ($this->assignedtable) {
            $data = $data->where('follow_up',date('Y-m-d'));
        }
        
        $leadData = $data->paginate($this->paginate);
        $this->username= $this->performerid == auth()->user()->id ? "My" : User::findorFail($this->performerid)->name;
        
        return view('livewire.trainer.demo-manager.performance',['leadData'=>$leadData])->layout('layouts.new-app');
    }
}
