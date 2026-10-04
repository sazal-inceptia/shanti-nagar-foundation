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
                'name_bn' => 'সভাপতি',
                'slug' => 'president',
                'category' => 'Executive Leadership',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'General Secretary',
                'name_bn' => 'সাধারণ সম্পাদক',
                'slug' => 'general-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Treasurer & Finance Secretary',
                'name_bn' => 'কোষাধ্যক্ষ ও অর্থ সম্পাদক',
                'slug' => 'treasurer-finance-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Relief Operations)',
                'name_bn' => 'পরিচালক (ত্রাণ কার্যক্রম)',
                'slug' => 'director-relief-operations',
                'category' => 'Board of Directors',
                'order_index' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Social Welfare & Orphan Care)',
                'name_bn' => 'পরিচালক (সমাজকল্যাণ ও এতিম সেবা)',
                'slug' => 'director-social-welfare-orphan-care',
                'category' => 'Board of Directors',
                'order_index' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Medical Aid & Healthcare)',
                'name_bn' => 'পরিচালক (চিকিৎসা ও স্বাস্থ্যসেবা)',
                'slug' => 'director-medical-aid-healthcare',
                'category' => 'Board of Directors',
                'order_index' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Women Empowerment & Education)',
                'name_bn' => 'পরিচালক (নারী উন্নয়ন ও শিক্ষা)',
                'slug' => 'director-women-empowerment-education',
                'category' => 'Board of Directors',
                'order_index' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Field Project Coordinator',
                'name_bn' => 'মাঠপর্যায় প্রকল্প সমন্বয়ক',
                'slug' => 'field-project-coordinator',
                'category' => 'Operations & Relief',
                'order_index' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Accounts & Documentation Officer',
                'name_bn' => 'হিসাব ও নথিপত্র কর্মকর্তা',
                'slug' => 'accounts-documentation-officer',
                'category' => 'Finance & Accounts',
                'order_index' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Volunteer Supervisor & Logistics Support',
                'name_bn' => 'স্বেচ্ছাসেবক সুপারভাইজার',
                'slug' => 'volunteer-supervisor-logistics-support',
                'category' => 'Volunteer Management',
                'order_index' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Office Caretaker & Logistics Assistant',
                'name_bn' => 'কার্যালয় সহকারী',
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
