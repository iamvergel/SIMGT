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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_subject_class');
    }
};

