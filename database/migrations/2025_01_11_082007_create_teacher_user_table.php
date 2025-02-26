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
            $table->string('first_name')->nullable(); // Password
            $table->string('middle_name')->nullable(); // Password
            $table->string('last_name')->nullable(); // Password
            $table->string('suffix')->nullable();
            $table->string('address')->nullable(); // Password
            $table->string('email')->nullable(); // Email column, nullable
            $table->string('contact_number')->nullable(); // Contact number column, nullable
            $table->string('department')->nullable(); // Department column, nullable
            $table->string('position')->nullable(); // Position column, nullable
            $table->string('status')->default('Active'); // Status column, nullable
            $table->string('gender')->nullable(); // Gender column, nullable
            $table->date('birthdate')->nullable(); // Birthdate column, nullable
            $table->string('religion')->nullable(); // Religion column, nullable
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
            'first_name' => 'Teacher', // Default first name
            'middle_name' => 'Teacher', // Default middle name
            'last_name' => 'Teacher', // Default last name
            'address' => 'Teacher', // Default address
            'email' => null, // Set email to null
            'contact_number' => null, // Set contact number to null
            'department' => null, // Set department to null
            'position' => null, // Set position to null
            'gender' => null, // Set gender to null
            'birthdate' => null, // Set birthdate to null
            'religion' => null, // Set religion to null
            
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
                'first_name' => $defaultUser['first_name'],
                'middle_name' => $defaultUser['middle_name'],
                'last_name' => $defaultUser['last_name'],
                'address' => $defaultUser['address'],
                'email' => $defaultUser['email'],
                'contact_number' => $defaultUser['contact_number'],
                'department' => $defaultUser['department'],
                'position' => $defaultUser['position'],
                'gender' => $defaultUser['gender'],
                'birthdate' => $defaultUser['birthdate'],
                'religion' => $defaultUser['religion']
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
