<?php

namespace App\Http\Livewire\Sales\BdeJunior;
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
    public $overallConversion, $targetedConversionRate, $conversionRate, $totalLeads, $convertedLeads;
    
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
        $overallConverted = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid' => '1'])->count();
        $overallTotalLeads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->count();
        
        $this->overallConversion =  $overallTotalLeads ? ceil((($overallConverted ) /( $overallTotalLeads)) * 100) : 0;
    }
    

    public function render(){  
        $this->totalLeads = LeadStatus::has('userRelation')->where(['assignedto' => auth()->user()->id])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        $this->convertedLeads = LeadStatus::where(['assignedto' => auth()->user()->id, 'is_paid'=>"1"])->where('created_at', 'LIKE', "%{$this->currentMonth}%")->count();
        
        
        $this->conversionRate = $this->totalLeads ? round(((($this->convertedLeads ?? 1) / ($this->totalLeads)) * 100),2) : 0;
        return view('livewire.sales.bde-junior.performance')->layout('layouts.new-app');
    }
}
