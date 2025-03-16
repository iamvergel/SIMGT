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
        Schema::create('student_primary_info', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing id
            $table->string( 'studentnumber'); // Unique student number
            $table->string('status'); // Student status (e.g., active, graduated, etc.)
            $table->string('grade'); // Student's grade level
            $table->string('section')->nullable(); // Section or class group
            $table->string('adviser')->nullable(); // Name of the student's adviser
            $table->string('school_year'); // School year
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_primary_info');
    }
};
