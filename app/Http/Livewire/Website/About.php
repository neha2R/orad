<?php

namespace App\Http\Livewire\Website;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class About extends Component
{
   
    public function render()
    {

        return view('website.about')
        ->layout('website.layouts.app');
    }
}
