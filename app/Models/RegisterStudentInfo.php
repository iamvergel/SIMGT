<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterStudentInfo extends Model
{
    use HasFactory;

    protected $table = 'register_student_info'; // Specify the table if it differs from the pluralized model name

    protected $fillable = [
        'lrn',
        'grade',
        'school_year',
        'status',
        'student_last_name',
        'student_first_name',
        'student_middle_name',
        'student_suffix_name',
        'place_of_birth',
        'birth_date',
        'sex',
        'age',
        'email_address_send',
        'contact_number',
        'religion',
        'house_number',
        'street',
        'barangay',
        'province',
        'city',
        // Add any other fillable fields
    ];
}
