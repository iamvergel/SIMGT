<?php

namespace Database\Seeders;

use App\Models\RegistrationButton;
use Illuminate\Database\Seeder;

class RegistrationButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegistrationButton::create([
            'status' => 'Active',
        ]);

        RegistrationButton::create([
            'status' => 'Inactive',
        ]);
    }
}
