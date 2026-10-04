<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Primary Administrator Account
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin - Rotary Club of Shantinagar Dhaka',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Backup / Secondary Administrator Account
        User::updateOrCreate(
            ['email' => 'admin2@gmail.com'],
            [
                'name' => 'Secondary Admin - Rotary Club of Shantinagar Dhaka',
                'email' => 'admin2@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
