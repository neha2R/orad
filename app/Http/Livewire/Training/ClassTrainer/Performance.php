<?php

namespace App\Http\Livewire\Training\ClassTrainer;
use Carbon\Carbon;
use App\Models\Demo;
use App\Models\User;
use App\Models\Classes;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use App\Models\ClassFeedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Performance extends Component
{
    use WithPagination;

    // render variables 
    public $overallConversion, $targetedConversionRate, $conversionRate, $feedback, $totalClasses, $demoConverted;
    
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
    }
    

    public function render(){  
        $this->totalClasses = Classes::where(['trainerid' => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->feedback = ceil(ClassFeedback::where(['feedback_to' => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->avg('feedback_type'));
        return view('livewire.trainer.class-trainer.performance')->layout('layouts.new-app');
    }
}
