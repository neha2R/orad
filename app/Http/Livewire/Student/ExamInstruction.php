<?php

namespace App\Http\Livewire\Student;

use App\Models\Exam;
use Livewire\Component;
use App\Models\ExamInstruction as Instruction;
use Illuminate\Support\Facades\Crypt;

class ExamInstruction extends Component
{       
    public $instruction, $instruction_id;

    public function mount(){

        $student_class = isset($_GET['class_group']) ? $_GET['class_group'] : '12';
        
        $current_date = date('Y-m-d');
        $this->instruction = Instruction::where('class_name',$student_class)->where('is_active','1')->where('start_date','<=',$current_date)->where('end_date','>=',$current_date)->first();
        if ($this->instruction == null) {
            session()->flash('error','no record found...');
            return redirect()->route('scholarship.dashboard');
        }
        $this->instruction_id = $this->instruction ? Crypt::Encrypt($this->instruction->id) : null;
    }

    public function render()
    {
        return view('livewire.school.exam.instructions')->layout('layouts.exam-layout');
    }
}
