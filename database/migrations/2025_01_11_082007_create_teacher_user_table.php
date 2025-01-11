<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create teacher_user table
        Schema::create('teacher_user', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('teacher_number')->unique(); // Unique teacher number
            $table->string('username')->unique(); // Unique username
            $table->string('password')->nullable(); // Password
            $table->rememberToken(); // Remember token for sessions
            $table->string('avatar')->nullable(); // Avatar column, nullable
            $table->timestamp('last_avatar_change')->nullable(); // Timestamp for when avatar was last changed
            $table->timestamp('last_password_change')->nullable(); // Timestamp for when password was last changed
            $table->timestamps(); // Created and updated timestamps
        });

        // Insert default teacher user with hashed password
        $defaultUser = [
            'teacher_number' => '1000-0000', // Default teacher number (starting from 1)
            'username' => 'teacher@stemilie.edu.ph', // Default username
            'password' => 'TeacherSELC', // Default password
        ];

        // Insert user with hashed password if it doesn't already exist
        if (!DB::table('teacher_user')->where('username', $defaultUser['username'])->exists()) {
            // Insert the first user and get the inserted ID (teacher_number starts at 1)
            $userId = DB::table('teacher_user')->insertGetId([
                'teacher_number' => $defaultUser['teacher_number'],
                'username' => $defaultUser['username'],
                'password' => bcrypt($defaultUser['password']), // Hash the password
                'avatar' => null, // Set default avatar to null
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_user');
    }
};
