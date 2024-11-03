<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MLsendemail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('Your Login Credentials for the Student Portal')
                    ->view('email.email'); // Create this view
    }
}
