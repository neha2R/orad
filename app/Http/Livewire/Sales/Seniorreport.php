<?php

namespace App\Http\Livewire\Sales;

use Livewire\Component;
use App\Models\User;
use App\Models\LeadStatus;
use App\Models\CoursePayments;
use App\Models\PerformanceMilestones;
use Carbon\Carbon;

class Seniorreport extends Component
{
    public $selectedjunior=0;
    public $leadsforselectedjunior=[];
    public $currentMonth=0;
    public $currentYear=0;
    public $currentdatemonth= '';
    public $dateforthedailywork='';
    public $selectjuniorfor=0;
    public $leadsforselectedfollowup=[];
    public function mount(){
        $this->currentdatemonth = now()->format('m-Y');
        $this->currentMonth=now()->format('n');
        $this->currentYear=now()->format('Y');
        $this->dateforthedailywork=now()->toDateString();
    }

    public function selectjuniorfor($id){
        $this->selectjuniorfor=$id;
        $this->leadsforselectedjunior=LeadStatus::where('assignedto',$this->selectjuniorfor)->whereNull('follow_up')->get();
        $this->leadsforselectedfollowup=LeadStatus::where('assignedto',$this->selectjuniorfor)->where('follow_up',$this->dateforthedailywork)->get();
    }

    public function datefilterleads(){
        $this->leadsforselectedjunior=LeadStatus::whereNull('follow_up')->where('assignedto',$this->selectjuniorfor)->get();
        $this->leadsforselectedfollowup=LeadStatus::where('assignedto',$this->selectjuniorfor)->where('follow_up',$this->dateforthedailywork)->get();

    }

    public function filterdata(){
        
        $monthyear= explode("-",$this->currentdatemonth);
        $this->currentMonth= $monthyear[0];
        $this->currentYear= $monthyear[1];
        
    }
    public function render()
    {
        $userdata=User::where('parent_id',auth()->user()->id)->get();
        $data=PerformanceMilestones::where(['department'=>3,'role'=>2])->get();
        $allinterns = User::where('parent_id',auth()->user()->id)->pluck('id');
        $currentearning=CoursePayments::whereIn('user_id',$allinterns)->where('payment_success',1)->whereYear('created_at','=',$this->currentYear)->whereMonth('created_at','=',$this->currentMonth)->sum('discounted_price');
        
        $currentincentive=PerformanceMilestones::where(['department'=>3,'role'=>2])->where('from','<=',$currentearning)->where('to','>=',$currentearning)->first();
        
        $currentincentive=$currentearning/100 * $currentincentive->incentivepercentage;
        $currentdate=Carbon::now()->toDateString();
        $period = \Carbon\CarbonPeriod::create('2018-06-01', '1 month', $currentdate);
        
        return view('livewire.sales.seniorreport',compact('data','currentearning','currentincentive','userdata','period'));
    }
}
