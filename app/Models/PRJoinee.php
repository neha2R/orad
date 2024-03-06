<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PRJoinee extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function prmeeting()
    {
        return $this->hasOne(PerformanceReview::class, 'id', 'performance_reviews_id');
    }
    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'employee_id');
    }
}
