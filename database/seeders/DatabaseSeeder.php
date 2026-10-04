<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with complete foundational data.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DonorSeeder::class,
            ProjectTypeSeeder::class,
            ProjectSeeder::class,
            DonationSeeder::class,
            ExpenseSeeder::class,
            DesignationSeeder::class,
            EmployeeSeeder::class,
            SalarySeeder::class,
            ContactMessageSeeder::class,
            VolunteerSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
