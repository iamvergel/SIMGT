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
        Schema::create('grade_three_class_record', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('student_number')->unique(); // Unique student number
            $table->string('lrn')->unique(); // Learning Reference Number (LRN)
            $table->string('gender'); // Gender
            $table->string('first_name'); // First name of the student
            $table->string('middle_name')->nullable(); // Middle name of the student
            $table->string('last_name'); // Last name of the student
            $table->string('quarter'); // Academic quarter
            $table->string('grade'); // Grade level (e.g., Grade 1)
            $table->string('section'); // Section of the class
            $table->string('teacher_number'); // Teacher name
            $table->string('teacher'); // Teacher name
            $table->string('subject'); // Subject of the class

            // Written assessments (whole numbers now)
            $table->integer('written_one')->nullable(); // Written assessment 1 score
            $table->integer('written_two')->nullable(); // Written assessment 2 score
            $table->integer('written_three')->nullable(); // Written assessment 3 score
            $table->integer('written_four')->nullable();
            $table->integer('written_five')->nullable();
            $table->integer('written_six')->nullable();
            $table->integer('written_seven')->nullable();
            $table->integer('written_eight')->nullable();
            $table->integer('written_nine')->nullable();
            $table->integer('written_ten')->nullable();
            $table->integer('written_total')->nullable(); // Total score from written assessments
            $table->decimal('written_ps', 5 ,2)->nullable(); // Performance score for written assessments
            $table->decimal('written_ws', 5 ,2)->nullable(); // Weighted score (20% of total written score)

            $table->integer('performance_one')->nullable(); // Written assessment 1 score
            $table->integer('performance_two')->nullable(); // Written assessment 2 score
            $table->integer('performance_three')->nullable(); // Written assessment 3 score
            $table->integer('performance_four')->nullable();
            $table->integer('performance_five')->nullable();
            $table->integer('performance_six')->nullable();
            $table->integer('performance_seven')->nullable();
            $table->integer('performance_eight')->nullable();
            $table->integer('performance_nine')->nullable();
            $table->integer('performance_ten')->nullable();
            $table->integer('performance_total')->nullable(); // Total score from written assessments
            $table->decimal('performance_ps', 5 ,2)->nullable(); // Performance score for written assessments
            $table->decimal('performance_ws', 5 ,2)->nullable(); // Weighted score (20% of total written score)
            $table->integer('q_assessment_1')->nullable(); // Quarter 1 assessment score
            $table->decimal('q_assessment_ps', 5 ,2)->nullable(); // Performance score for written assessments
            $table->decimal('q_assessment_ws', 5 ,2)->nullable();
            $table->decimal('initial_grade', 5 ,2)->nullable(); // Quarter 2 assessment score
            $table->integer('quarterly_grade')->nullable();

            $table->timestamps(); // Created at and updated at timestamps
        });
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
