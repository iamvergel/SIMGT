<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePictureAnnouncementsTable extends Migration
{
    public function up()
    {
        Schema::create('picture_announcements', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->binary('image'); // Binary data type to store image
            $table->date('date'); // Announcement date
            $table->timestamp('update')->useCurrent()->useCurrentOnUpdate(); // Auto-updated timestamp
            $table->timestamps(); // Laravel's default created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('picture_announcements');
    }
}
