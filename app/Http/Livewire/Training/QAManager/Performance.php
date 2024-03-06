<?php

namespace App\Http\Livewire\Training\QAManager;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use App\Models\ClassFeedback;

class Performance extends Component
{
    use WithPagination;

    // render variables 
    public $overallConversion, $targetedConversionRate, $conversionRate, $totalClasses, $feedback, $demoConverted, $totalLead;
    
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

    public function render(){  
        $performeruser = auth()->user()->id == $this->performerid ? 'seniortrainer_id' : 'trainerid';
        $this->totalClasses = Classes::where([$performeruser => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();

        $this->totalLead = LeadStatus::has('userRelation')->where(['assignedto' => $this->performerid])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $feedbackQuery = ClassFeedback::query();
        
        if(auth()->user()->id == $this->performerid && $this->employees->isNotEmpty()){
            $feedbackQuery = $feedbackQuery->whereIn('feedback_to', $this->employees->pluck('id')->toArray());
        }else {
            $feedbackQuery = $feedbackQuery->where(['feedback_to' => $this->performerid]);
        }
        $feedbackQuery = $feedbackQuery->where('created_at', 'LIKE', "%{$this->currentMonth}%")->where('feedback_type','!=','0')->avg('feedback_type');

        $this->feedback = ceil($feedbackQuery);
      
        $this->username= $this->performerid == auth()->user()->id ? "My" : User::findorFail($this->performerid)->name;
        
        return view('livewire.trainer.qa-manager.performance')->layout('layouts.new-app');
    }
}
