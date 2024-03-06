<?php

namespace App\Http\Livewire\Common;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Classes;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\ProvideSlot;
use App\Models\TrainerSlots;
use Livewire\WithPagination;
use App\Models\ClassFeedback;
use App\Http\Traits\ClassFeedbackTrait;
use App\Models\Classes as ScheduledClasses;

class ClassSchedule extends Component
{
    use WithPagination, ClassFeedbackTrait;
    
    // render varaibles 
    public $trainers=[],$interval=[], $trainerid=0, $trainername, $startDate, $endDate, $errormessage, $userrole;

    // search and pagination of table
    public $search, $paginate=10;


    public function updatedTrainerId()
    {
        $this->trainername = User::findorFail($this->trainerid)->name;
    }

    public function updatedStartDate()
    {
        if ($this->endDate) {
            $this->errormessage = $this->startDate > $this->endDate ? 'Please select valid interval' : '';
        }
    }

    public function updatedEndDate()
    {
        if ($this->startDate) {
            $this->errormessage = $this->startDate > $this->endDate ? 'Please select valid interval' : '';
            $this->errormessage = Carbon::parse($this->endDate)->diffInDays(Carbon::parse($this->startDate)) > 7 ? 'Interval valid only 7 days' : '';
        }
    }
    
    /**
     * if user is QA then show all employees slots
     * if user is Trainer then show his own slots 
     * or if user is student then show its class schedule
     * 
     */
    public function mount()
    {
        $this->userrole = auth()->user()->user_type;
        $this->trainers = User::where('parent_id',auth()->user()->id)->get();
        if(auth()->user()->role == 2){
            $employees = User::where('parent_id',auth()->user()->id)->first();
            if ($employees) {
                $this->trainerid =  $employees->id;
                $this->trainername =  $employees->name;
            }
        }else if(auth()->user()->role == 3) {
            $this->trainerid =  auth()->user()->id;
            $this->trainername =  auth()->user()->name;
        
        }else if(auth()->user()->user_type == 2){
            $this->trainerid =  auth()->user()->parent_id ?? '';
            $this->trainername =  ucwords(auth()->user()->name) ?? '';
        }
        $this->startDate = Carbon::now()->format('Y-m-d');
        $this->endDate = Carbon::now()->addDays(5)->format('Y-m-d');
    }
 
    public function render()
    {
        
        $this->interval = CarbonPeriod::create($this->startDate,$this->endDate)->toArray();
        $alloted_slots = ProvideSlot::query();
        if (auth()->user()->role == 2) {
            $alloted_slots = $alloted_slots->where(['manager_id'=> auth()->user()->id, 'trainer_id'=>$this->trainerid]);
        }elseif (auth()->user()->role == 3) {
            $alloted_slots = $alloted_slots->where(['trainer_id'=>$this->trainerid]);
        }elseif (auth()->user()->user_type == 2) {
            $alloted_slots = ScheduledClasses::where(['leadid'=>auth()->user()->id])->select('slot')->distinct('slot');
        }
        $alloted_slots = $alloted_slots->get();

        $data = [];
        if ($this->errormessage == '') {
            $schedule = ScheduledClasses::query();
            if (auth()->user()->role == 2) {
                $schedule = $schedule->where(['seniortrainer_id'=> auth()->user()->id, 'trainerid'=>$this->trainerid]);
            }elseif (auth()->user()->role == 3) {
                $schedule = $schedule->where(['trainerid'=>$this->trainerid]);
            }elseif (auth()->user()->user_type == 2) {
                $schedule = $schedule->where(['leadid'=>auth()->user()->id]);
            }

            $groupByClass = $schedule->whereBetween('class_date',[$this->startDate, $this->endDate])->get();

            $dates = [];
            foreach ($groupByClass as $date => $value) {
                if(!in_array($value->class_date, $dates)){
                    array_push($dates, $value->class_date);
                    $data[$value->class_date] = [
                        $value->slot => $value
                    ];
                }else{
                    
                    if (!array_key_exists($value->slot,$data[$value->class_date])) {
                        $data[$value->class_date][$value->slot] = $value;
                    }
                }
            }
            
        }
        
        return view('includes.class_schedule', ['data' => $data, 'alloted_slots'=>$alloted_slots])->layout('layouts.new-app');
    }
}
