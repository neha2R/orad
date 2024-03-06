<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFeedback extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function classDetails(){
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function student()
    {
        return $this->hasOne(User::class, 'id', 'feedback_from');
    }

    public function trainer()
    {
        return $this->hasOne(User::class, 'id', 'feedback_to');
    }
}
