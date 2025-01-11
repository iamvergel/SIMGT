<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('admin_user_account', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->rememberToken(); // Adds a column for the remember token, which is used for login sessions
            $table->timestamps();
        });

        // Array of default data to insert with hashed passwords
        $defaultUsers = [
            ['username' => 'SELC@stemilie.edu.ph', 'password' => 'SELC2024', 'role' => 'Admin'],
            ['username' => 'Admission@stemilie.edu.ph', 'password' => 'Admission2024', 'role' => 'Admission'],
            ['username' => 'Registrar@stemilie.edu.ph', 'password' => 'password2024', 'role' => 'Registrar'],
        ];

        // Insert each user with hashed password if it doesn't already exist
        foreach ($defaultUsers as $user) {
            if (!DB::table('admin_user_account')->where('username', $user['username'])->exists()) {
                DB::table('admin_user_account')->insert([
                    'username' => $user['username'],
                    'password' => bcrypt($user['password']), // Hash the password here
                    'role' => $user['role'], 
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
        Schema::dropIfExists('admin_user_account');
    }
};
