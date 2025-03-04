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
        'quarter',
        'hps_written_one',
        'hps_written_two',
        'hps_written_three',
        'hps_written_four',
        'hps_written_five',
        'hps_written_six',
        'hps_written_seven',
        'hps_written_eight',
        'hps_written_nine',
        'hps_written_ten',
        'hps_written_total',
        'written_ps',
        'written_ws',
        'hps_performance_one',
        'hps_performance_two',
        'hps_performance_three',
        'hps_performance_four',
        'hps_performance_five',
        'hps_performance_six',
        'hps_performance_seven',
        'hps_performance_eight',
        'hps_performance_nine',
        'hps_performance_ten',
        'hps_performance_total',
        'performance_ps',
        'performance_ws',
        'hps_q_assessment_one',
        'hps_q_assessment_ps',
        'hps_q_assessment_ws',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherUser::class, 'teacher_number', 'teacher_number');
    }
}
