<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeOneClassRecord extends Model
{
    protected $table = 'grade_one_class_record';

   
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
        'performance_one_score',
        'performance_two_score',
        'performance_three_score',
        'performance_four_score',
        'performance_five_score',
        'performance_six_score',
        'performance_seven_score',
        'performance_eight_score',
        'performance_nine_score',
        'performance_ten_score',
        'performance_total_score',
        'performance_ps_score',
        'performance_ws_score',
        'hps_q_assessment_one',
        'hps_q_assessment_ps',
        'hps_q_assessment_ws',
        'q_assessment_one_score',
        'q_assessment_ps_score',
        'q_assessment_ws_score',
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
