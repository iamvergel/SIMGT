<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterAdditionalInfo extends Model
{
    use HasFactory;

    protected $table = 'register_student_additional_info';

    protected $fillable = [
        'lrn',
        'father_last_name',
        'father_first_name',
        'father_middle_name',
        'father_suffix_name',
        'father_occupation',
        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'mother_occupation',
        'guardian_last_name',
        'guardian_first_name',
        'guardian_middle_name',
        'guardian_suffix_name',
        'guardian_relationship',
        'guardian_contact_number',
        'guardian_religion',
        'emergency_contact_person',
        'emergency_contact_number',
        'email_address',
        'messenger_account',
    ];
}
