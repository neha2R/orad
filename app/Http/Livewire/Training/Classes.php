<?php

namespace App\Http\Livewire\Training;

use Livewire\Component;
use App\Models\Classes as ModelClass;
use App\Models\User;

class Classes extends Component
{


    public function render()
    {
        
        $user=ModelClass::where('trainerid',auth()->user()->id)->pluck('leadid')->unique();
        // dd($data);
        $data=User::whereIn('id',$user)->get();
        return view('livewire.training.classes',compact('data'));
    }
}
