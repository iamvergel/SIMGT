<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if there are already users in the teacher_user table
        if (DB::table('teacher_user')->count() == 0) {
            // Insert the first teacher user with teacher_number = 1
            DB::table('teacher_user')->insert([
                'teacher_number' => 1, // Start teacher_number from 1
                'username' => 'teacher@stemilie.edu.ph', // Default username
                'password' => Hash::make('TeacherSELC'), // Hash the password
                'avatar' => null, // Set default avatar to null
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
