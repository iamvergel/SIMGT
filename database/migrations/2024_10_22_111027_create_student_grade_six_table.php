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
        Schema::create('student_grade_six', function (Blueprint $table) {
            $table->id();
            $table->string('student_number'); // Student number
            $table->string('grade');
            $table->string('quarter'); // Quarter (e.g., '1st Quarter', '2nd Quarter', etc.)
            $table->decimal('subject_one', 5, 2)->nullable();
            $table->decimal('subject_two', 5, 2)->nullable();
            $table->decimal('subject_three', 5, 2)->nullable();
            $table->decimal('subject_four', 5, 2)->nullable();
            $table->decimal('subject_five', 5, 2)->nullable();
            $table->decimal('subject_six', 5, 2)->nullable();
            $table->decimal('subject_seven', 5, 2)->nullable();
            $table->decimal('subject_eight', 5, 2)->nullable();
            $table->decimal('subject_nine', 5, 2)->nullable();
            $table->timestamps();

            // Unique constraint on student_number and quarter
            $table->unique(['student_number', 'quarter']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_grade_six');
    }
};
