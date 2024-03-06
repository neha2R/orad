<?php

namespace App\Http\Livewire\Student;

use App\Models\Exam;
use Livewire\Component;
use App\Models\ExamResult;
use App\Models\ExamAttempt;
use App\Models\ExamInstruction;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class QuestionPaper extends Component
{       
    // mount vairables 
    public $question_paper, $question, $sr_no=1, $duration, $last_question, $examination_id, $is_exam_running;

    // session variables 
    public $answer;

    // rerender variables 
    public $answered_questions = [];

    /**
     * save current question and show next question
     * 
     * @param int question_id(current)
     * @param int question_number(current)
     * @return response (next question)
     */
    public function saveNext($question_id, $question_number)
    {
        // store answers in session
        if ($this->answer) {
            
            // session('answers',[$question_id => $this->answer]);
            $items = \Session::get('answers');
            $items["$question_id"] = $this->answer;
            \Session::put('answers', $items);
            $this->resetInput();
        }

        // change question 
        $this->sr_no = $question_number;
        $this->question = Exam::where('is_active','1')->where('id','>',"$question_id")->first();
        
    }

    /**
     * Change question on clicking on numbers
     * 
     * @param int question_id(next)
     * @param int question_number(next)
     * @return response (specific question)
     */
    public function changeQuestion($question_id, $question_number)
    {
        $this->sr_no = $question_number;
        $this->question = Exam::where('is_active','1')->where('id',"$question_id")->first();
        $items = \Session::get('answers');
        $this->answer = $items["$question_id"] ?? '';
    }

    /**
     * Clear current quesstion from session
     * 
     * @param int question_id
     * @return response (clear question key value from session)
     */
    public function clearResponse($question_id)
    {
        $items = \Session::get('answers');
        if ($items && isset($items["$question_id"])) {
            session()->forget('answers.'.$question_id);
        }
        
    }
    
    public function resetInput()
    {
        $this->answer = '';
    }

    public function mount($instruction_id){

        // \Session::forget('answers');
        $current_time = date('H:i:s');
        $this->examination_id = Crypt::Decrypt($instruction_id);
        $this->is_exam_running = ExamInstruction::where('id',$this->examination_id )->where('start_time','<=', $current_time)->where('end_time','>=',$current_time)->count();
        
        if (!$this->is_exam_running) {
            session()->flash('error','Please wait for the examination time...');
            return redirect()->route('scholarship.dashboard');
        }

        $this->question_paper = Exam::where('exam_instruction_id',$this->examination_id)->get();

        // default question 
        $this->question = Exam::where('exam_instruction_id',$this->examination_id)->where('is_active','1')->first();

        $this->duration = $this->question && $this->question->instruction != null ? durationHelper($this->question->instruction->end_time) : '00:00:00';
        
        
        $this->last_question = Exam::where('exam_instruction_id',$this->examination_id)->where('is_active','1')->orderBy('id','desc')->first();
        
    }
    
    /**
     * store exam in database
     */
    public function store()
    {
        $already_submitted = ExamResult::where(['user_id'=>auth()->user()->id, 'exam_id'=>$this->examination_id])->exists();
        if ($this->question_paper !=null && !$already_submitted) {
            $total_questions = $this->question_paper->count();
            // if user submit empty paper 
            if ($this->answered_questions == null) {
                ExamResult::create([
                    'user_id'=>auth()->user()->id, 
                    'exam_id'=>$this->examination_id,
                    'submit_time'=>date('H:i:s'),
                    'total_questions'=>$total_questions,
                    'right_answers'=>0,
                    'result'=>'0',
                    'percentage'=>0,
                ]);
            }else {
                $total_right_answers = 0;
                foreach ($this->answered_questions as $key => $value) {
                    // get question paper right answers from exam table 
                    $paper = Exam::find($key);
                    $total_right_answers += $value == $paper->answer ? 1 : 0 ;
                    ExamAttempt::create([
                        'exam_id'=>$key,
                        'user_id'=>auth()->user()->id,
                        'answer'=>$value,
                        'right_answer'=>$paper->answer,
                    ]);
                }
                $percentage = (float)round((($total_right_answers / $total_questions) * 100),2); 
                
                ExamResult::create([
                    'user_id'=>auth()->user()->id, 
                    'exam_id'=>$this->examination_id,
                    'submit_time'=>date('H:i:s'),
                    'total_questions'=>$total_questions,
                    'right_answers'=>$total_right_answers,
                    'result'=>$total_right_answers ? '1' : '0',
                    'percentage'=>"$percentage"
                ]);
            }
        }
        session()->flash('success','Exam submitted successfully...');
        return redirect()->route('scholarship.dashboard');
    }

    public function render()
    {
        if (!$this->is_exam_running) {
            $this->store();
        }
        $this->answered_questions = \Session::get('answers') ?? [];
        
        return view('livewire.school.exam.question')->layout('layouts.exam-layout');
    }
}
