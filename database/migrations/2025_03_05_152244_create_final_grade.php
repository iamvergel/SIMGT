<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students_final_grade', function (Blueprint $table) {
            $table->id();
            $table->string('lrn');
            $table->string('student_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('gender');
            $table->string('school_year');
            $table->string('subject');
            $table->string('grade');
            $table->string('section');
            $table->string('teacher_number');
            $table->integer('first_quarter_grade')->nullable();
            $table->integer('second_quarter_grade')->nullable();
            $table->integer('third_quarter_grade')->nullable();
            $table->integer('fourth_quarter_grade')->nullable();
            $table->decimal('initial_final_grade', 5, 2)->nullable()->virtualAs(
                '(first_quarter_grade + second_quarter_grade + third_quarter_grade + fourth_quarter_grade) / 4'
            ); 

            $table->integer('final_grade')->nullable()->virtualAs(
                'IF(COALESCE(initial_final_grade, 0) = 0, NULL, 
                    CASE
                        WHEN COALESCE(initial_final_grade, 0) >= 100 THEN 100
                        WHEN COALESCE(initial_final_grade, 0) >= 98.40 THEN 99
                        WHEN COALESCE(initial_final_grade, 0) >= 96.80 THEN 98
                        WHEN COALESCE(initial_final_grade, 0) >= 95.20 THEN 97
                        WHEN COALESCE(initial_final_grade, 0) >= 93.60 THEN 96
                        WHEN COALESCE(initial_final_grade, 0) >= 92.00 THEN 95
                        WHEN COALESCE(initial_final_grade, 0) >= 90.40 THEN 94
                        WHEN COALESCE(initial_final_grade, 0) >= 88.80 THEN 93
                        WHEN COALESCE(initial_final_grade, 0) >= 87.20 THEN 92
                        WHEN COALESCE(initial_final_grade, 0) >= 85.60 THEN 91
                        WHEN COALESCE(initial_final_grade, 0) >= 84.00 THEN 90
                        WHEN COALESCE(initial_final_grade, 0) >= 82.40 THEN 89
                        WHEN COALESCE(initial_final_grade, 0) >= 80.80 THEN 88
                        WHEN COALESCE(initial_final_grade, 0) >= 79.20 THEN 87
                        WHEN COALESCE(initial_final_grade, 0) >= 77.60 THEN 86
                        WHEN COALESCE(initial_final_grade, 0) >= 76.00 THEN 85
                        WHEN COALESCE(initial_final_grade, 0) >= 74.40 THEN 84
                        WHEN COALESCE(initial_final_grade, 0) >= 72.80 THEN 83
                        WHEN COALESCE(initial_final_grade, 0) >= 71.20 THEN 82
                        WHEN COALESCE(initial_final_grade, 0) >= 69.60 THEN 81
                        WHEN COALESCE(initial_final_grade, 0) >= 68.00 THEN 80
                        WHEN COALESCE(initial_final_grade, 0) >= 66.40 THEN 79
                        WHEN COALESCE(initial_final_grade, 0) >= 64.80 THEN 78
                        WHEN COALESCE(initial_final_grade, 0) >= 63.20 THEN 77
                        WHEN COALESCE(initial_final_grade, 0) >= 61.60 THEN 76
                        WHEN COALESCE(initial_final_grade, 0) >= 60.00 THEN 75
                        WHEN COALESCE(initial_final_grade, 0) >= 56.00 THEN 74
                        WHEN COALESCE(initial_final_grade, 0) >= 52.00 THEN 73
                        WHEN COALESCE(initial_final_grade, 0) >= 48.00 THEN 72
                        WHEN COALESCE(initial_final_grade, 0) >= 44.00 THEN 71
                        WHEN COALESCE(initial_final_grade, 0) >= 40.00 THEN 70
                        WHEN COALESCE(initial_final_grade, 0) >= 36.00 THEN 69
                        WHEN COALESCE(initial_final_grade, 0) >= 32.00 THEN 68
                        WHEN COALESCE(initial_final_grade, 0) >= 28.00 THEN 67
                        WHEN COALESCE(initial_final_grade, 0) >= 24.00 THEN 66
                        WHEN COALESCE(initial_final_grade, 0) >= 20.00 THEN 65
                        WHEN COALESCE(initial_final_grade, 0) >= 16.00 THEN 64
                        WHEN COALESCE(initial_final_grade, 0) >= 12.00 THEN 63
                        WHEN COALESCE(initial_final_grade, 0) >= 8.00 THEN 62
                        WHEN COALESCE(initial_final_grade, 0) >= 4.00 THEN 61
                        ELSE 60
                    END
                )'
            );
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};

