<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeTwoClassRecord extends Model
{
    protected $table = 'grade_two_class_record';

    protected $fillable = [
        'student_number',
        'lrn',
        'school_year',
        'gender',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'quarter',
        'grade',
        'section',
        'teacher_number',
        'teacher',
        'subject',
        'written_one',
        'written_two',
        'written_three',
        'written_four',
        'written_five',
        'written_six',
        'written_seven',
        'written_eight',
        'written_nine',
        'written_ten',
        'written_total',
        'written_ps',
        'written_ws',
        'written_one_score',
        'written_two_score',
        'written_three_score',
        'written_four_score',
        'written_five_score',
        'written_six_score',
        'written_seven_score',
        'written_eight_score',
        'written_nine_score',
        'written_ten_score',
        'written_total_score',
        'written_ps_score',
        'written_ws_score',
        'performance_one',
        'performance_two',
        'performance_three',
        'performance_four',
        'performance_five',
        'performance_six',
        'performance_seven',
        'performance_eight',
        'performance_nine',
        'performance_ten',
        'performance_total',
        'performance_ps',
        'performance_ws',
        'q_assessment_one',
        'q_assessment_ps',
        'q_assessment_ws',
        'initial_grade',
        'quarterly_grade',
    ];

    // Casts for certain columns
    protected $casts = [
        'written_ps' => 'decimal:2',
        'written_ws' => 'decimal:2',
        'performance_ps' => 'decimal:2',
        'performance_ws' => 'decimal:2',
        'q_assessment_ps' => 'decimal:2',
        'q_assessment_ws' => 'decimal:2',
        'initial_grade' => 'decimal:2',
        'quarterly_grade' => 'integer',
    ];

    // You don't need to define virtual columns directly in the model, as those are handled by the database.
    // However, you should define them as attributes in case you need to access them in Eloquent operations.

    // Add accessors for virtual columns, if necessary:
    public function getWrittenPsScoreAttribute()
    {
        return $this->attributes['written_ps_score'] ?? 0;
    }

    public function getPerformancePsScoreAttribute()
    {
        return $this->attributes['performance_ps_score'] ?? 0;
    }

    public function getQAssessmentPsScoreAttribute()
    {
        return $this->attributes['q_assessment_ps_score'] ?? 0;
    }

    public function getWrittenWsScoreAttribute()
    {
        return $this->attributes['written_ws_score'] ?? 0;
    }

    public function getPerformanceWsScoreAttribute()
    {
        return $this->attributes['performance_ws_score'] ?? 0;
    }

    public function getQAssessmentWsScoreAttribute()
    {
        return $this->attributes['q_assessment_ws_score'] ?? 0;
    }

    public function getInitialGradeAttribute()
    {
        return $this->attributes['initial_grade'] ?? 0;
    }

    public function getQuarterlyGradeAttribute()
    {
        return $this->attributes['quarterly_grade'] ?? 0;
    }
}
