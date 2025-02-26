<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TeacherEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $teacher;

    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }

    public function build()
    {
        return $this->subject('Your Login Credentials for the Student Portal')
                    ->view('email.teachermail'); // Create this view
    }
}
