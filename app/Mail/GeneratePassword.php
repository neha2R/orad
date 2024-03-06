<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneratePassword extends Mailable
{
    use Queueable, SerializesModels;
    public $email,$password,$url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$password,$url)
    {
        $this->email=$email;
        $this->password=$password;
        $this->url=$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.register',[
            'email'=>$this->email,
            'password'=>$this->password,
            'url'=>$this->url
        ]); 
    }
}
