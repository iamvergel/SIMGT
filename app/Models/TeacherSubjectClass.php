<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSubjectClass extends Model
{
    use HasFactory;

    // Specify the table name if it is different from the default
    protected $table = 'teacher_subject_class';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'teacher_number',
        'grade',
        'section',
        'subject',
        'school_year',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherUser::class, 'teacher_number', 'teacher_number');
    }
}
