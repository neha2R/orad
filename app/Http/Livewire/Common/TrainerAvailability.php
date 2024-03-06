<?php

namespace App\Http\Livewire\Common;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\ProvideSlot;
use App\Models\TrainerSlots;
use Livewire\WithPagination;

class TrainerAvailability extends Component
{
    use WithPagination;
    
    // render varaibles 
    public $trainers=[],$interval=[], $trainerid=0, $trainername, $startDate, $endDate, $errormessage;

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
        }
    }
    
    /**
     * if user is trainer the show it's own scheduling other wise show his employess
     */
    public function mount()
    {
        $this->trainers = User::where('parent_id',auth()->user()->id)->get();
        if(auth()->user()->role != 3){
            $employees = User::where('parent_id',auth()->user()->id)->first();
            if ($employees) {
                $this->trainerid =  $employees->id;
                $this->trainername =  $employees->name;
            }
        }else {
            $this->trainerid =  auth()->user()->id;
            $this->trainername =  auth()->user()->name;
        }
        $this->startDate = Carbon::now()->subDays(5)->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
    }
    
    public function render()
    {
        $this->interval = CarbonPeriod::create($this->startDate,$this->endDate)->toArray();
        $alloted_slots = ProvideSlot::query();
        if (auth()->user()->role != 3) {
            $alloted_slots = $alloted_slots->where(['manager_id'=> auth()->user()->id, 'trainer_id'=>$this->trainerid]);
        }else{
            $alloted_slots = $alloted_slots->where(['trainer_id'=>$this->trainerid]);
        }
        $alloted_slots = $alloted_slots->get();
        
        
        if (!$this->errormessage) {
            $data = TrainerSlots::query();
            if (auth()->user()->role != 3) {
                $data = $data->where(['manager_id'=> auth()->user()->id, 'trainer_id'=>$this->trainerid]);
            }else {
                $data = $data->where(['trainer_id'=>$this->trainerid]);
            }
            $data = $data->whereBetween('date',[$this->startDate, $this->endDate])->select('date','slot_id','lead_id')->get()->groupBy('date')
            ->map(function ($query)
            {
                return $query->pluck('lead_id','slot_id');
            })
            ->toArray();
            
        }else {
            $data = collect();
        }
        return view('includes.trainer_availability', ['data' => $data, 'alloted_slots'=>$alloted_slots])->layout('layouts.new-app');
    }
}
