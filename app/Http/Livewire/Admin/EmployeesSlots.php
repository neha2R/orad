<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slot;
use App\Models\User;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\ProvideSlot;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class EmployeesSlots extends Component
{
    use WithPagination;

    public $pageheading = 'Slots Management';

    // render variables 
    public $edit_id, $employee_id=[], $slots_id=[], $class_type;

    // search and pagination of table
    public $search, $paginate=10;
    
    // mount vairables 
    public $trainers=[], $slots=[];

    public function mount()
    {
        $this->trainers = User::where(['user_type'=>'1','role'=>'3'])->where('parent_id','!=','0')->where(function ($query)
        {
            // demo trainer or class trainer 
            $query->where('sub_department','3')->orWhere('sub_department','4');
        })->select(['id','name','sub_department'])->get();
        
        $this->slots = Slot::where('is_active','1')->get();
    }


    public function store(){
        $validateddata=  $this->validate(
            [
                'employee_id' => 'required',
                'slots_id' => 'required',
                // 'start_date' => 'required|date|before_or_equal:end_date',
                // 'end_date' => 'required|date|after_or_equal:start_date',
                'class_type' => 'required',
            ],
            [
                'employee_id.required' => 'Please select employee!',
                'slots_id.required' => 'Please select specific slot!'
            ]
        );

        // $period = CarbonPeriod::create($this->start_date, $this->end_date);
        
        $available_seats = $this->class_type == '3' ? '4' : '1';
        foreach ($this->slots_id as $key => $value) {
            foreach ($this->employee_id as $key => $trainerid) {
                $manager_id = User::find($trainerid)->parent_id;
                $alreadyExists = ProvideSlot::where(['trainer_id'=>$trainerid, 'slot_id'=>$value])->exists();
                if (!$alreadyExists) {
                    $data=['manager_id'=> $manager_id, 'trainer_id'=>$trainerid, 'slot_id'=>$value, 'type'=> $this->class_type, 'available_seats'=>$available_seats];
                    ProvideSlot::create($data);
                }
            }
        }
        $this->emit('flashmessage', "Slot create successfully");
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->edit_id = '';
        $this->employee_id = '';
        $this->slots_id = '';
        $this->class_type = '';
        $this->manager_id = '';

    }

    public function changestatus($id, $status){
        $status = 1- $status;
        ProvideSlot::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }

    public function render()
    {
        
        $data = ProvideSlot::query();

        if ($this->search) {
            $data = $data->whereHas('trainer',function ($query)
            {
                $query->where('name', 'LIKE', "%{$this->search}%");
            });
        } 
        $data = $data->paginate($this->paginate);
        
        return view('livewire.admin.slots_management', ['data' => $data])->layout('layouts.new-app');
    }
}
