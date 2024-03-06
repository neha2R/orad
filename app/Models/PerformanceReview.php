<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceReview extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function joineLink()
    {
        return $this->hasOne(PRJoinee::class, 'performance_reviews_id','id');
    }
}
