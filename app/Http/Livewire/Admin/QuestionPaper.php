<?php

namespace App\Http\Livewire\Admin;

use App\Models\Exam;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Imports\PaperImport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ExamInstruction;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class QuestionPaper extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $pageheading= 'Question Papers';

    // fileimport variables
    public $instruction_data, $file_import, $error_message=[], $iteration;

    // database variable 
    public $exam_instruction_id, $question, $option_a, $option_b, $option_c, $option_d, $answer, $edit_id;

    // pagination & search 
    public $search, $paginate=10;

    protected $listeners = ['reset' => 'resetInputs'];

    public function mount()
    {
        $this->instruction_data = ExamInstruction::where('is_active','1')->get();
    }


    /**
     * Import bulk question in excel formate
     */
    public function importSheet(){
        $data = $this->validate([
            'exam_instruction_id'=>'required',
        ]);
        $errors=collect();
        if ($this->file_import == null) {
            $errors->push('Excel file is empty. Please enter valid excel file');
            $this->error_message=$errors;
        }else {
            $this->error_message=[];
            $errors=collect();

            try {
                Excel::import(new PaperImport($this->exam_instruction_id),$this->file_import);
                $this->file_import=null;
                $this->iteration++;
            } catch (ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    $message="You can't import lead on line ". $failure->row() ." ".implode(" ",$failure->errors())."";
                    $errors->push($message);
                }
                $this->error_message=$errors;
                $this->file_import=null;
                $this->iteration++;
                
            }
        }
        
        if ($errors->isEmpty()) {
            
            $this->resetInputs();
            $this->emit('flashmessage', 'Paper import successfully');
        }
    }


    public function resetInputs(){
        $this->exam_instruction_id = '';
        $this->question = '';
        $this->option_a = '';
        $this->option_b = '';
        $this->option_c = '';
        $this->option_d = '';
        $this->answer = '';
        $this->edit_id = '';
        $this->file_import = '';
        $this->error_message = [];
        $this->iteration = '';

    }


    public function store(){
        
        $data = $this->validate([
            'exam_instruction_id'=>'required',
            'question'=>'required',
            'option_a'=>'required',
            'option_b'=>'required',
            'option_c'=>'required',
            'option_d'=>'required',
            'answer'=>'required',
        ]);
        
        if ($this->edit_id) {
            $instruction = Exam::findorFail($this->edit_id)->update($data);
        }else {
            $instruction = Exam::create($data);
        }
        $result = $this->edit_id ? 'created' : 'updated';
        $this->emit('flashmessage', "Exam $result successfully");
        $this->resetInputs();
    }

    public function changestatus($id, $status){
        $status = 1 - $status;
        Exam::findorFail($id)->update(['is_active' => "$status"]);
        $this->emit('flashmessage', 'Status changed successfully');
    }

    public function edit($id){
        $editdata = Exam::findorFail($id);
        $this->exam_instruction_id = '';
        $this->question = $editdata->question;
        $this->option_a = $editdata->option_a;
        $this->option_b = $editdata->option_b;
        $this->option_c = $editdata->option_c;
        $this->option_d = $editdata->option_d;
        $this->answer = $editdata->answer;
        $this->edit_id = $id;
    }


    public function render()
    {
        $data = Exam::query();
        if ($this->search) {
            $data = $data->where('question', 'LIKE', "%{$this->search}%");
        }
        $data = $data->paginate($this->paginate);
        
        return view('livewire.admin.exam.question_paper', ['data' => $data])->layout('layouts.new-app');
    }
}
