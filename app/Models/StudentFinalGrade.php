<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFinalGrade extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'students_final_grade';


    // The attributes that are mass assignable.
    protected $fillable = [
        'lrn',
        'student_number',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'gender',
        'school_year',
        'subject',
        'grade',
        'section',
        'teacher_number',
        'first_quarter_grade',
        'second_quarter_grade',
        'third_quarter_grade',
        'fourth_quarter_grade',
        'initial_final_grade',
        'final_grade',
    ];

    // Set the date format for timestamps (if you prefer a different format).
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // If you want to specify that some fields are casts to specific types (e.g., decimals, integers), you can add a $casts array:
    protected $casts = [
        'initial_final_grade' => 'decimal:2',
        'first_quarter_grade' => 'integer',
        'second_quarter_grade' => 'integer',
        'third_quarter_grade' => 'integer',
        'fourth_quarter_grade' => 'integer',
        'final_grade' => 'integer',
    ];

    // If you want to handle virtual columns (like `initial_final_grade` or `final_grade`), you don't need to include them in `$fillable`
    // because they're calculated by the database and are not directly set in the model.
}
