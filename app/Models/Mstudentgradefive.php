<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mstudentgradefive extends Model
{
    use HasFactory;

    protected $table = 'student_grade_five'; // Make sure this matches your table name

    protected $fillable = [
        'student_number',
        'grade',
        'quarter',
        'subject_one',
        'subject_two',
        'subject_three',
        'subject_four',
        'subject_five',
        'subject_six',
        'subject_seven',
        'subject_eight',
        'subject_nine',
    ];
}
