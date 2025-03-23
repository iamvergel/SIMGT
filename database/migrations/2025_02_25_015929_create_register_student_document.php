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
        Schema::create('register_student_document', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->unique();
            $table->string('birth_certificate')->nullable();
            $table->string('sf10')->nullable();
            $table->string('sf9')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_student_document');
    }
};
