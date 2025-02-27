<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPrimaryInfo extends Model
{
    use HasFactory;

    // Specify the table name if it is different from the default
    protected $table = 'student_primary_info';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'lrn',
        'studentnumber',
        'status',
        'grade',
        'section',
        'adviser',
        'school_year',
    ];

}
