<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvideSlot extends Model
{
    use HasFactory;
    protected $guarded=[];

        
    public function slotRelation()
    {
        return $this->hasOne(Slot::class, 'id','slot_id');
    }
    
    public function trainer()
    {
        return $this->hasOne(User::class, 'id','trainer_id');
    }
    
    public function manager()
    {
        return $this->hasOne(User::class, 'id','manager_id');
    }

    public function demoExists()
    {
        return $this->hasOne(Demo::class, 'slot','slot');
    }
}
