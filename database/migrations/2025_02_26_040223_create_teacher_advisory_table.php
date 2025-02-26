<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_teacher_advisory_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherAdvisoryTable extends Migration
{
    public function up()
    {
        Schema::create('teacher_advisory', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_number');
            $table->string('grade');
            $table->string('section');
            $table->timestamps();

            // Adding a unique index to ensure one teacher is assigned to one grade-section combination
            $table->unique(['teacher_number', 'grade', 'section']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_advisory');
    }
}


