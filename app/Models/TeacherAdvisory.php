<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAdvisory extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'teacher_advisory';

    // Define the fillable columns for mass assignment
    protected $fillable = [
        'teacher_number',
        'grade',
        'section',
        'school_year',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherUser::class, 'teacher_number', 'teacher_number');
    }

    // Define any relationships if needed
    // Example: public function students() { return $this->hasMany(Student::class); }
}
