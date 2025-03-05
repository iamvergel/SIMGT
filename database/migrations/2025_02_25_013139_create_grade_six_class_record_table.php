<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_six_class_record', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('student_number'); // Unique student number
            $table->string('lrn'); // Learning Reference Number (LRN)
            $table->string('school_year');
            $table->string('gender'); // Gender
            $table->string('first_name'); // First name of the student
            $table->string('middle_name')->nullable(); // Middle name of the student
            $table->string('last_name'); // Last name of the student
            $table->string('suffix')->nullable();// Date of birth
            $table->string('quarter')->nullable(); // Academic quarter
            $table->string('grade'); // Grade level (e.g., Grade 1)
            $table->string('section'); // Section of the class
            $table->string('teacher_number')->nullable(); // Teacher name
            $table->string('teacher')->nullable(); // Teacher name
            $table->string('subject'); // Subject of the class

            // Written assessments (whole numbers now)
            $table->integer('hps_written_one')->nullable(); // Written assessment 1 score
            $table->integer('hps_written_two')->nullable(); // Written assessment 2 score
            $table->integer('hps_written_three')->nullable(); // Written assessment 3 score
            $table->integer('hps_written_four')->nullable();
            $table->integer('hps_written_five')->nullable();
            $table->integer('hps_written_six')->nullable();
            $table->integer('hps_written_seven')->nullable();
            $table->integer('hps_written_eight')->nullable();
            $table->integer('hps_written_nine')->nullable();
            $table->integer('hps_written_ten')->nullable();
            $table->integer('hps_written_total')
                ->nullable()
                ->virtualAs(
                    'IFNULL(hps_written_one, 0) +
                    IFNULL(hps_written_two, 0) +
                    IFNULL(hps_written_three, 0) +
                    IFNULL(hps_written_four, 0) +
                    IFNULL(hps_written_five, 0) +
                    IFNULL(hps_written_six, 0) +
                    IFNULL(hps_written_seven, 0) +
                    IFNULL(hps_written_eight, 0) +
                    IFNULL(hps_written_nine, 0) +
                    IFNULL(hps_written_ten, 0)'
                );
            $table->decimal('written_ps', 5, 2)->default(100.00)->nullable(); // Performance score for written assessments
            $table->integer('written_ws')->default(30)->nullable(); // Weighted score (30% of total written score)

            $table->integer('written_one_score')->nullable(); // Written assessment 1 score
            $table->integer('written_two_score')->nullable(); // Written assessment 2 score
            $table->integer('written_three_score')->nullable(); // Written assessment 3 score
            $table->integer('written_four_score')->nullable();
            $table->integer('written_five_score')->nullable();
            $table->integer('written_six_score')->nullable();
            $table->integer('written_seven_score')->nullable();
            $table->integer('written_eight_score')->nullable();
            $table->integer('written_nine_score')->nullable();
            $table->integer('written_ten_score')->nullable();
            $table->integer('written_total_score')
                ->nullable()
                ->virtualAs(
                    'IFNULL(written_one_score, 0) +
                    IFNULL(written_two_score, 0) +
                    IFNULL(written_three_score, 0) +
                    IFNULL(written_four_score, 0) +
                    IFNULL(written_five_score, 0) +
                    IFNULL(written_six_score, 0) +
                    IFNULL(written_seven_score, 0) +
                    IFNULL(written_eight_score, 0) +
                    IFNULL(written_nine_score, 0) +
                    IFNULL(written_ten_score, 0)'
                ); // Total score from written assessments
            $table->decimal('written_ps_score', 5, 2)
                ->nullable()
                ->virtualAs(
                    'IFNULL(written_total_score, 0) / NULLIF(IFNULL(hps_written_total, 0), 0) * written_ps'
                ); // Performance score for written assessments
            $table->decimal('written_ws_score', 5, 2)
                ->nullable()
                ->virtualAs(
                    'written_ps_score * 0.30'
                ); // Weighted score (30% of total written score)

            $table->integer('hps_performance_one')->nullable(); // Written assessment 1 score
            $table->integer('hps_performance_two')->nullable(); // Written assessment 2 score
            $table->integer('hps_performance_three')->nullable(); // Written assessment 3 score
            $table->integer('hps_performance_four')->nullable();
            $table->integer('hps_performance_five')->nullable();
            $table->integer('hps_performance_six')->nullable();
            $table->integer('hps_performance_seven')->nullable();
            $table->integer('hps_performance_eight')->nullable();
            $table->integer('hps_performance_nine')->nullable();
            $table->integer('hps_performance_ten')->nullable();
            $table->integer('hps_performance_total')
                ->nullable()
                ->virtualAs(
                    'IFNULL(hps_written_one, 0) +
                        IFNULL(hps_performance_two, 0) +
                        IFNULL(hps_performance_three, 0) +
                        IFNULL(hps_performance_four, 0) +
                        IFNULL(hps_performance_five, 0) +
                        IFNULL(hps_performance_six, 0) +
                        IFNULL(hps_performance_seven, 0) +
                        IFNULL(hps_performance_eight, 0) +
                        IFNULL(hps_performance_nine, 0) +
                        IFNULL(hps_performance_ten, 0)'
                );
            $table->decimal('performance_ps', 5, 2)->default(100.00)->nullable(); // Performance score for written assessments
            $table->integer('performance_ws')->default(50)->nullable();

            $table->integer('performance_one_score')->nullable(); // Written assessment 1 score
            $table->integer('performance_two_score')->nullable(); // Written assessment 2 score
            $table->integer('performance_three_score')->nullable(); // Written assessment 3 score
            $table->integer('performance_four_score')->nullable();
            $table->integer('performance_five_score')->nullable();
            $table->integer('performance_six_score')->nullable();
            $table->integer('performance_seven_score')->nullable();
            $table->integer('performance_eight_score')->nullable();
            $table->integer('performance_nine_score')->nullable();
            $table->integer('performance_ten_score')->nullable();
            $table->integer('performance_total_score')
                ->nullable()
                ->virtualAs(
                    'IFNULL(performance_one_score, 0) +
                IFNULL(performance_two_score, 0) +
                IFNULL(performance_three_score, 0) +
                IFNULL(performance_four_score, 0) +
                IFNULL(performance_five_score, 0) +
                IFNULL(performance_six_score, 0) +
                IFNULL(performance_seven_score, 0) +
                IFNULL(performance_eight_score, 0) +
                IFNULL(performance_nine_score, 0) +
                IFNULL(performance_ten_score, 0)'
                ); // Total score from written assessments
            $table->decimal('performance_ps_score', 5, 2)
                ->nullable()
                ->virtualAs(
                    'IFNULL(performance_total_score, 0) / NULLIF(IFNULL(hps_performance_total, 0), 0) * performance_ps'
                ); // Performance score for performance assessments
            $table->decimal('performance_ws_score', 5, 2)
                ->nullable()
                ->virtualAs(
                    'performance_ps_score * 0.50'
                ); // Weighted score (30% of total written score)

            $table->integer('hps_q_assessment_one')->nullable(); // Quarter 1 assessment score
            $table->decimal('hps_q_assessment_ps', 5, 2)->default(100.00)->nullable(); // Performance score for written assessments
            $table->integer('hps_q_assessment_ws', )->default(20)->nullable();

            $table->integer('q_assessment_one_score')->nullable(); // Quarter 1 assessment score
            $table->decimal('q_assessment_ps_score', 5, 2)
                ->nullable()
                ->virtualAs(
                    'IFNULL(q_assessment_one_score, 0) / NULLIF(IFNULL(hps_q_assessment_one, 0), 0) * hps_q_assessment_ps'
                ); // Performance score for quarter assessment
            $table->decimal('q_assessment_ws_score', 5, 2)
                ->nullable()
                ->virtualAs(
                    'q_assessment_ps_score * 0.20'
                );

            $table->decimal('initial_grade', 5, 2)->nullable()->virtualAs(
                'written_ws_score + performance_ws_score + q_assessment_ws_score'
            ); // Quarter 2 assessment score

            $table->integer('quarterly_grade')->nullable();

            $table->timestamps(); // Created at and updated at timestamps
        });

        DB::unprepared('
        CREATE TRIGGER update_quarterly_grade6 
        BEFORE INSERT ON grade_six_class_record
        FOR EACH ROW
        BEGIN
            DECLARE transmuted_grade INT;
        
            -- Ensure that initial_grade is always a numeric value
            SET @initial_grade = COALESCE(NEW.initial_grade, 0);
        
            -- Calculate transmuted grade based on initial grade
            SET transmuted_grade = 
                CASE
                    WHEN @initial_grade >= 100 THEN 100
                    WHEN @initial_grade >= 98.40 THEN 99
                    WHEN @initial_grade >= 96.80 THEN 98
                    WHEN @initial_grade >= 95.20 THEN 97
                    WHEN @initial_grade >= 93.60 THEN 96
                    WHEN @initial_grade >= 92.00 THEN 95
                    WHEN @initial_grade >= 90.40 THEN 94
                    WHEN @initial_grade >= 88.80 THEN 93
                    WHEN @initial_grade >= 87.20 THEN 92
                    WHEN @initial_grade >= 85.60 THEN 91
                    WHEN @initial_grade >= 84.00 THEN 90
                    WHEN @initial_grade >= 82.40 THEN 89
                    WHEN @initial_grade >= 80.80 THEN 88
                    WHEN @initial_grade >= 79.20 THEN 87
                    WHEN @initial_grade >= 77.60 THEN 86
                    WHEN @initial_grade >= 76.00 THEN 85
                    WHEN @initial_grade >= 74.40 THEN 84
                    WHEN @initial_grade >= 72.80 THEN 83
                    WHEN @initial_grade >= 71.20 THEN 82
                    WHEN @initial_grade >= 69.60 THEN 81
                    WHEN @initial_grade >= 68.00 THEN 80
                    WHEN @initial_grade >= 66.40 THEN 79
                    WHEN @initial_grade >= 64.80 THEN 78
                    WHEN @initial_grade >= 63.20 THEN 77
                    WHEN @initial_grade >= 61.60 THEN 76
                    WHEN @initial_grade >= 60.00 THEN 75
                    WHEN @initial_grade >= 56.00 THEN 74
                    WHEN @initial_grade >= 52.00 THEN 73
                    WHEN @initial_grade >= 48.00 THEN 72
                    WHEN @initial_grade >= 44.00 THEN 71
                    WHEN @initial_grade >= 40.00 THEN 70
                    WHEN @initial_grade >= 36.00 THEN 69
                    WHEN @initial_grade >= 32.00 THEN 68
                    WHEN @initial_grade >= 28.00 THEN 67
                    WHEN @initial_grade >= 24.00 THEN 66
                    WHEN @initial_grade >= 20.00 THEN 65
                    WHEN @initial_grade >= 16.00 THEN 64
                    WHEN @initial_grade >= 12.00 THEN 63
                    WHEN @initial_grade >= 8.00 THEN 62
                    WHEN @initial_grade >= 4.00 THEN 61
                    ELSE 60
                END;
        
            -- Set the quarterly_grade
            SET NEW.quarterly_grade = transmuted_grade;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_one_class_record');
    }
};
