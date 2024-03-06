<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\ForgotPassword as ForgotPasswordMail;

class ResetPassword extends Component
{
    public $newpassword, $confirmpassword, $userid;

    public function mount($encryptedUserid)
    {
        $userid = Crypt::Decrypt($encryptedUserid);
        $user = User::find($userid);
        if ($user == null) {
            session()->flash('error','invalid user....');
            return redirect()->route('login');
        }else {
            $this->userid = $userid;
        }
    }

    public function store(){
        $this->validate([
            'newpassword' => ['required'],
            'confirmpassword' => ['required','same:newpassword'],
        ]);
        $newpassword=$this->newpassword;
        $changedpassword=Hash::make($newpassword);
        User::findorFail($this->userid)->update(['password'=>$changedpassword]);
        $this->resetInputs();
        session()->flash('success','Password has been updated....');
        return redirect()->route('login');
    }

    public function resetInputs(){
        $this->newpassword='';
        $this->confirmpassword='';
    }

    public function render()
    {
        return view('website.auth.reset-password')
        ->layout('website.layouts.app');
    }
}
