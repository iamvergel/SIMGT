<?php

namespace App\Http\Controllers;

use App\Mail\MyTestEmail; // Import the Mailable class
use Illuminate\Support\Facades\Mail; // Import the Mail facade

class MyController extends Controller
{
    public function sendEmail()
    {
        $data = "This is some data to send."; // Data to send in the email
        Mail::to('vergelmacayan7@gmail.com')->send(new MyTestEmail($data)); // Send the email

        return 'Email sent successfully!'; // Return success message
    }

}
