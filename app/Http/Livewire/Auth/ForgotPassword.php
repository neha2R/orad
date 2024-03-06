<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\ForgotPassword as ForgotPasswordMail;

class ForgotPassword extends Component
{
    public $email;

    public function store(){
        $email = $this->email;
        $exists=User::where('email',$email)->first();
        if ($exists) {
            $url = route('resetpassword',Crypt::Encrypt($exists->id));
            $username = ucwords($exists->name);
            Mail::to($email)->send(new ForgotPasswordMail($url, $username));
            return back()->with('success','Mail send to your registerd email !!!');
        }else {
            return back()->with('error','No record found!!!');
        }
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->email='';
    }

    public function render()
    {
        return view('website.auth.forgot-password')
        ->layout('website.layouts.app');
    }
}
