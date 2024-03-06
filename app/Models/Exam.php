<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    
    protected $guarded=[];

    public function instruction()
    {
        return $this->hasOne(ExamInstruction::class,'id','exam_instruction_id');
    }
}
