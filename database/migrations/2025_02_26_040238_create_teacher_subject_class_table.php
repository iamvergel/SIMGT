<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_teacher_subject_class_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teacher_subject_class', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_number');
            $table->string('grade');
            $table->string('section');
            $table->string('subject');
            $table->string('school_year');
            $table->string('quarter')->nullable();

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
            $table->integer('written_ws')->nullable(); 

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
                    'IFNULL(hps_performance_one, 0) +
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
            $table->integer('performance_ws')->nullable();

            $table->integer('hps_q_assessment_one')->nullable(); // Quarter 1 assessment score
            $table->decimal('hps_q_assessment_ps', 5, 2)->default(100.00)->nullable(); // Performance score for written assessments
            $table->integer('hps_q_assessment_ws', )->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_subject_class');
    }
};

