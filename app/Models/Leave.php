<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }
}
