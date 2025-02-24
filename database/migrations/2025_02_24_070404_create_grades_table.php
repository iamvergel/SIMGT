<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_number');
            $table->string('subject')->nullable();
            $table->float('grade')->nullable();
            $table->string('section')->nullable();
            $table->string('excelfile')->nullable();
            $table->timestamps();

            // Foreign key relationship with teacher_user
            $table->foreign('teacher_number')->references('teacher_number')->on('teacher_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
