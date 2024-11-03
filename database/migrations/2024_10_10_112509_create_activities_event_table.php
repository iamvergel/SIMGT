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
        Schema::create('activities_event', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name'); // Changed from 'activities_event' to 'activity_name' for clarity
            $table->date('event_date'); // Added a date column
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
        Schema::dropIfExists('activities_event');
    }
};
