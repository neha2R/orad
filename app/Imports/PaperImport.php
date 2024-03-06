<?php

namespace App\Imports;

use App\Models\Exam;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PaperImport implements ToCollection, WithHeadingRow,WithValidation
{

    public $exam_instruction_id = 0;

    public function __construct($exam_instruction_id)
    {
        $this->exam_instruction_id = $exam_instruction_id;
    }

    public function rules(): array
    {
        return [
            // 'exam_instruction_id' => 'required',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'answer' => 'required',
        ];
    }


    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
                
            $data['exam_instruction_id']=$this->exam_instruction_id;
            $data['question']=$row['question'] ? $row['question'] : 'N/A';
            $data['option_a']=$row['option_a'] ?  $row['option_a'] :'N/A' ;
            $data['option_b']=$row['option_b'] ? $row['option_b'] : 'N/A';
            $data['option_c']=$row['option_c'] ? $row['option_c'] : 'N/A';
            $data['option_d']=$row['option_d'] ? $row['option_d'] : 'N/A';
            $data['answer'] =$row['answer'] ? $row['answer'] : 'A';
            
            Exam::create($data);
        }
       
    }
}
