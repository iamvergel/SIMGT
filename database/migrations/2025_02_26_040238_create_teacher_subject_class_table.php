<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_teacher_subject_class_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSubjectClassTable extends Migration
{
    public function up()
    {
        Schema::create('teacher_subject_class', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_number');
            $table->string('grade');
            $table->string('section');
            $table->string('subject');
            $table->timestamps();

            // Adding a unique index to ensure a teacher is assigned to a specific subject in a specific grade-section combination
            $table->unique(['teacher_number', 'grade', 'section', 'subject']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_subject_class');
    }
}

