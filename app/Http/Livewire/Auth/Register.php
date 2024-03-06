<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class Register extends Component
{
   
    public function render()
    {

        return view('website.auth.register')
        ->layout('website.layouts.app');
    }
}
