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
        Schema::create('student_user_account', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('student_number')->unique();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->string('avatar')->nullable(); // Add avatar column
            $table->timestamp('last_avatar_change')->nullable();
            $table->timestamp('last_password_change')->nullable();
            $table->timestamps();
        });

        // Array of default data to insert with hashed passwords
        $defaultUsers = [
            ['username' => 'sample', 'password' => 'sample'],
        ];

        // Insert each user with hashed password if it doesn't already exist
        foreach ($defaultUsers as $user) {
            if (!DB::table('student_user_account')->where('username', $user['username'])->exists()) {
                DB::table('student_user_account')->insert([
                    'student_number' => '2020-2020',
                    'username' => $user['username'],
                    'password' => bcrypt($user['password']), // Hash the password here
                    'avatar' => null, // Set default avatar to null
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_user_account');
    }
};
