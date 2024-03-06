<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Scholarship extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $mobile, $url, $dateAndTime, $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userid)
    {
        $user = User::find($userid);
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->url = route('login');
        $this->name = $user->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.scholarship',[
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'name'=>$this->name,
            'url'=>$this->url,
        ]); 
    }
}
