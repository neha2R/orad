<?php

namespace App\Http\Livewire\Training\DemoTrainer;
use Carbon\Carbon;
use App\Models\Demo;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Performance extends Component
{
    use WithPagination;

    // render variables 
    public $overallConversion, $targetedConversionRate, $conversionRate, $totalClasses, $feedback, $totalDemo, $demoConverted;
    
    public $interval=[], $currentMonth;

    // search and pagination of table
    public $search, $paginate=10;

    public function mount(){
        $this->targetedConversionRate = config('app.conversion_rate');
        $data = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->first();
        if ($data) {
            $this->interval = CarbonPeriod::create($data->created_at,'1 month',now())->toArray();
        }
        $this->currentMonth = now()->format('Y-m');
        $demoConverted = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid'=>"1"])->count();
        $overallTotalLeads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->count();
        
        $this->overallConversion =  $overallTotalLeads ? ceil((($demoConverted ) /( $overallTotalLeads)) * 100) : 0;
    }
    

    public function render(){  
        $this->totalDemo = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->feedback = ceil(Demo::where(['trainerid' => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->where('student_feedback','!=','0')->avg('student_feedback'));
        
        $this->demoConverted = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid'=>"1"])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        
        
        $this->conversionRate = $this->totalDemo ? round(((($this->demoConverted ?? 1) / ($this->totalDemo)) * 100),2) : 0;
        return view('livewire.trainer.demo-trainer.performance')->layout('layouts.new-app');
    }
}
