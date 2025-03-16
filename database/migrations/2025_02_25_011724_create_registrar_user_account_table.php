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
        Schema::create('registrar_user_account', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('registrar_number')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('first_name')->nullable(); // First Name
            $table->string('middle_name')->nullable(); // Middle Name
            $table->string('last_name')->nullable(); // Last Name
            $table->string('avatar')->nullable(); // Avatar column, nullable
            $table->timestamp('last_avatar_change')->nullable(); // Timestamp for when avatar was last changed
            $table->timestamp('last_password_change')->nullable(); // Timestamp for when password was last changed
            $table->rememberToken(); // Adds a column for the remember token, which is used for login sessions
            $table->timestamps(); 
        });

        // Array of default data to insert with hashed passwords
        $defaultUsers = [
            ['registrar_number' => '1000-0000', 'username' => 'registrar@stemilie.edu.ph', 'password' => 'Registrar2024', 'role' => 'Registrar', 'first_name' => 'Registrar', 'last_name' => 'Registrar', 'middle_name' => 'Registrar'],
        ];

        // Insert each user with hashed password if it doesn't already exist
        foreach ($defaultUsers as $user) {
            if (!DB::table('registrar_user_account')->where('username', $user['username'])->exists()) {
                DB::table('registrar_user_account')->insert([
                    'registrar_number' => $user['registrar_number'],
                    'username' => $user['username'],
                    'password' => bcrypt($user['password']), // Hash the password here
                    'role' => $user['role'], 
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'middle_name' => $user['middle_name'],
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
        Schema::dropIfExists('registrar_user_account');
    }
};
