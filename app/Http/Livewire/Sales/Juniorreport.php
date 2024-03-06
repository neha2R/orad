<?php

namespace App\Http\Livewire\Sales;

use App\Models\PerformanceMilestones;
use App\Models\CoursePayments;
use Carbon\Carbon;
use Livewire\Component;

class Juniorreport extends Component
{
    public $currentMonth=0;
    public $currentYear=0;
    public $datetimefilter='';
    public $selectedusers=0;

    public function mount($id=null){
        // dd($id);
        $this->currentYear=now()->year;
        $this->currentMonth=now()->month;

        $this->selectedusers=auth()->user()->id;
        if ($id) {
            $this->selectedusers=decrypt($id);
        }
    }

    public function filter(){
       
        $dateyear=explode("-",$this->datetimefilter);
        $this->currentYear=$dateyear[1];
        $this->currentMonth=$dateyear[0];
        
    }

    public function render()
    {
        $data = PerformanceMilestones::where(['department' => 3, 'role' => 3])->get();
        $currentearning=CoursePayments::where('user_id',$this->selectedusers)->where('payment_success',1)->whereYear('created_at','=',$this->currentYear)->whereMonth('created_at','=',$this->currentMonth)->sum('discounted_price');
        // dd($currentearning);
        $currentincentive = PerformanceMilestones::where('department' , 3)->where('role',3)->where('from', '<=', $currentearning)->where('to', '>=', $currentearning)->first();
        // dd($currentincentive);
        $currentincentive = $currentearning / 100 * $currentincentive->incentivepercentage;

        $startdate = Carbon::now()->startOfMonth()->toDateString();
        $enddate = Carbon::now()->endOfMonth()->toDateString();
        
        $currentdate=Carbon::now()->toDateString();
        $period = \Carbon\CarbonPeriod::create('2018-06-01', '1 month', $currentdate);

        

        return view('livewire.sales.juniorreport', compact('data', 'currentearning', 'currentincentive', 'startdate', 'enddate','period'));
    }
}
