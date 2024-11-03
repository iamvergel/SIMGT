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
            $table->rememberToken(); // Adds a column for the remember token, which is used for login sessions
            $table->timestamps();
        });

        // Array of default data to insert with hashed passwords
        $defaultUsers = [
            ['username' => 'admin001', 'password' => 'password001'],
            ['username' => 'admin002', 'password' => 'password002'],
            ['username' => 'admin003', 'password' => 'password003'],
            ['username' => 'admin004', 'password' => 'password004'],
            ['username' => 'admin005', 'password' => 'password005'],
        ];

        // Insert each user with hashed password if it doesn't already exist
        foreach ($defaultUsers as $user) {
            if (!DB::table('admin_user_account')->where('username', $user['username'])->exists()) {
                DB::table('admin_user_account')->insert([
                    'username' => $user['username'],
                    'password' => bcrypt($user['password']), // Hash the password here
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
