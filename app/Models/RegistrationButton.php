<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationButton extends Model
{
    use HasFactory;

    // Define the table if it's not following Laravel's convention
    protected $table = 'registrationbutton';

    // Define the fillable fields
    protected $fillable = [
        'status',
    ];
}
