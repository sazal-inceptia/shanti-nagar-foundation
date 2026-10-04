<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            [
                'name' => 'President',
                'slug' => 'president',
                'category' => 'Executive Leadership',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'General Secretary',
                'slug' => 'general-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Treasurer & Finance Secretary',
                'slug' => 'treasurer-finance-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Relief Operations)',
                'slug' => 'director-relief-operations',
                'category' => 'Board of Directors',
                'order_index' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Social Welfare & Orphan Care)',
                'slug' => 'director-social-welfare-orphan-care',
                'category' => 'Board of Directors',
                'order_index' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Medical Aid & Healthcare)',
                'slug' => 'director-medical-aid-healthcare',
                'category' => 'Board of Directors',
                'order_index' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Women Empowerment & Education)',
                'slug' => 'director-women-empowerment-education',
                'category' => 'Board of Directors',
                'order_index' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Field Project Coordinator',
                'slug' => 'field-project-coordinator',
                'category' => 'Operations & Relief',
                'order_index' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Accounts & Documentation Officer',
                'slug' => 'accounts-documentation-officer',
                'category' => 'Finance & Accounts',
                'order_index' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Volunteer Supervisor & Logistics Support',
                'slug' => 'volunteer-supervisor-logistics-support',
                'category' => 'Volunteer Management',
                'order_index' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Office Caretaker & Logistics Assistant',
                'slug' => 'office-caretaker-logistics-assistant',
                'category' => 'Administration',
                'order_index' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($designations as $data) {
            Designation::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
