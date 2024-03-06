<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentsDetail extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function stateDetails()
    {
        return $this->hasOne(State::class, 'id','state');
    }

    public function cityDetails()
    {
        return $this->hasOne(City::class, 'id','city');
    }

    public function schoolDetails()
    {
        return $this->hasOne(School::class, 'id','city');
    }
}
