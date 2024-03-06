<?php

namespace App\Http\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\ExamInstruction as Instruction;

class ExamInstruction extends Component
{
    use WithPagination;

    public $pageheading= 'Exam Instructions';


    // this variables for date time formate 
    public  $already_exists, $error_message;

    // database variable 
    public  $editId, $class_name, $title, $description, $start_time, $end_time, $start_date, $end_date;

    // pagination & search 
    public $search, $paginate=10;

    protected $listeners = ['reset' => 'resetInputs'];

    public function updatedStartDate(){
        if ($this->end_date) {
            $check = Instruction::query();
            if ($this->editId) {
                $check = $check->where('id','!=',$this->editId);
            }
            $this->already_exists = $check->whereBetween('end_date',[$this->start_date, $this->end_date])->exists();
        }
        if ($this->already_exists) {
            $this->errormessage = 'Instruction already exists...';
        }
    }
    
    public function updatedEndDate(){
        if ($this->start_date) {
            $check = Instruction::query();
            if ($this->editId) {
                $check = $check->where('id','!=',$this->editId);
            }
            $this->already_exists = $check->whereBetween('start_date',[$this->start_date, $this->end_date])->exists();
        }
        if ($this->already_exists) {
            $this->errormessage = 'Instruction already exists...';
        }
    }

    public function resetInputs(){
        $this->class_name = '';
        $this->title = '';
        $this->description = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->editId='';
        $this->already_exists='';
        $this->error_message='';
    }


    public function store(){
        
        $data = $this->validate([
            'class_name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        // |date|after:start_time|date_format:H:i
        $data['start_time'] = date('H:i:s', strtotime($this->start_time));
        $data['end_time'] = date('H:i:s', strtotime($this->end_time));
        if ($data['start_time'] >= $data['end_time']) {
            # code...
            $this->error_message='Please enter valid time';
        }else {
            
            $data['duration'] = calculateDuration($this->start_time, $this->end_time);
            
            if ($this->editId) {
                $instruction = Instruction::findorFail($this->editId)->update($data);
            }else {
                $instruction = Instruction::create($data);
            }
            
            $this->emit('flashmessage', 'Instruction created successfully');
            $this->resetInputs();
        }

    }

    public function changestatus($id, $status){
        $status = 1 - $status;
        Instruction::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }

    public function edit($id){
        $editdata = Instruction::findorFail($id);
        $this->editId = $id;
        $this->title = $editdata->title;
        $this->class_name = $editdata->class_name;
        $this->description = $editdata->description;
        $this->start_date = $editdata->start_date;
        $this->end_date = $editdata->end_date;
        $this->start_time = $editdata->start_time;
        $this->end_time = $editdata->end_time;
    }


    public function render()
    {
        $data = Instruction::query();
        if ($this->search) {
            $data = $data->where('title', 'LIKE', "%{$this->search}%")->orWhere('description', 'LIKE', "%{$this->search}%")
            ->orWhere('start_date', 'LIKE', "%{$this->search}%")
            ->orWhere('end_date', 'LIKE', "%{$this->search}%");
        }
        
        $data = $data->paginate($this->paginate);
        
        return view('livewire.admin.exam.instruction', ['data' => $data])->layout('layouts.new-app');
    }
}
