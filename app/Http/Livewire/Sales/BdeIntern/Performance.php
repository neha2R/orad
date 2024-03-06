<?php

namespace App\Http\Livewire\Sales\BdeIntern;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\LeadStatus;
use Livewire\WithPagination;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Models\Leave as LeaveTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Performance extends Component
{
    use WithPagination;

    // render variables 
    public $overallConversion, $targetedConversionRate, $conversionRate, $totalLeads, $totalDemoAssigned, $totalDemoDone;
    
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
        $overallDemoDone = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred'=>"1"])->where('demoid','!=','0')->count();
        $overallTotalLeads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->count();
        
        $this->overallConversion =  $overallTotalLeads ? ceil((($overallDemoDone ) /( $overallTotalLeads)) * 100) : 0;
    }
    

    public function render(){  
        $this->totalLeads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->totalDemoAssigned = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred'=>"1"])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->totalDemoDone = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_transferred'=>"1"])->where('demoid','!=','0')->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        
        
        $this->conversionRate = $this->totalLeads ? round(((($this->totalDemoDone ?? 1) / ($this->totalLeads)) * 100),2) : 0;
        return view('livewire.sales.bde-intern.performance')->layout('layouts.new-app');
    }
}
