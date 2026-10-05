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
            // Executive Leadership
            [
                'name' => 'President',
                'name_bn' => 'সভাপতি (President)',
                'slug' => 'president',
                'category' => 'Executive Leadership',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'President Elect',
                'name_bn' => 'নির্বাচিত সভাপতি (President Elect)',
                'slug' => 'president-elect',
                'category' => 'Executive Leadership',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Immediate Past President (IPP)',
                'name_bn' => 'সদ্য বিদায়ী সভাপতি (IPP)',
                'slug' => 'immediate-past-president',
                'category' => 'Executive Leadership',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Vice President',
                'name_bn' => 'সহ-সভাপতি (Vice President)',
                'slug' => 'vice-president',
                'category' => 'Executive Leadership',
                'order_index' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'General Secretary',
                'name_bn' => 'সাধারণ সম্পাদক (Secretary)',
                'slug' => 'general-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Joint Secretary',
                'name_bn' => 'যুগ্ম সম্পাদক (Joint Secretary)',
                'slug' => 'joint-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Treasurer & Finance Secretary',
                'name_bn' => 'কোষাধ্যক্ষ ও অর্থ সম্পাদক (Treasurer)',
                'slug' => 'treasurer-finance-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Joint Treasurer',
                'name_bn' => 'যুগ্ম কোষাধ্যক্ষ (Joint Treasurer)',
                'slug' => 'joint-treasurer',
                'category' => 'Executive Leadership',
                'order_index' => 8,
                'is_active' => true,
            ],

            // Board of Directors (BOD)
            [
                'name' => 'Club Trainer',
                'name_bn' => 'ক্লাব ট্রেইনার (Club Trainer)',
                'slug' => 'club-trainer',
                'category' => 'Board of Directors',
                'order_index' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Club Administration)',
                'name_bn' => 'পরিচালক (ক্লাব প্রশাসন)',
                'slug' => 'director-club-administration',
                'category' => 'Board of Directors',
                'order_index' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Membership Development)',
                'name_bn' => 'পরিচালক (সদস্য সংগ্রহ ও উন্নয়ন)',
                'slug' => 'director-membership-development',
                'category' => 'Board of Directors',
                'order_index' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Public Relations & Media)',
                'name_bn' => 'পরিচালক (জনসংযোগ ও প্রচার)',
                'slug' => 'director-public-relations',
                'category' => 'Board of Directors',
                'order_index' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Service Projects & Relief)',
                'name_bn' => 'পরিচালক (সেবা প্রকল্প ও ত্রাণ)',
                'slug' => 'director-service-projects',
                'category' => 'Board of Directors',
                'order_index' => 13,
                'is_active' => true,
            ],
            [
                'name' => 'Director (The Rotary Foundation - TRF)',
                'name_bn' => 'পরিচালক (রোটারি ফাউন্ডেশন - TRF)',
                'slug' => 'director-the-rotary-foundation',
                'category' => 'Board of Directors',
                'order_index' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Sergeant at Arms',
                'name_bn' => 'সার্জেন্ট অ্যাট আর্মস (Sergeant at Arms)',
                'slug' => 'sergeant-at-arms',
                'category' => 'Board of Directors',
                'order_index' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Joint Sergeant at Arms',
                'name_bn' => 'যুগ্ম সার্জেন্ট অ্যাট আর্মস (Joint Sergeant at Arms)',
                'slug' => 'joint-sergeant-at-arms',
                'category' => 'Board of Directors',
                'order_index' => 16,
                'is_active' => true,
            ],
            [
                'name' => 'Club Bulletin Editor',
                'name_bn' => 'ক্লাব বুলেটিন সম্পাদক (Editor)',
                'slug' => 'club-bulletin-editor',
                'category' => 'Board of Directors',
                'order_index' => 17,
                'is_active' => true,
            ],

            // Advisory & Foundation Staff
            [
                'name' => 'Chief Adviser & Charter President',
                'name_bn' => 'প্রধান উপদেষ্টা ও চার্টার সভাপতি',
                'slug' => 'chief-adviser-charter-president',
                'category' => 'Advisory Council',
                'order_index' => 18,
                'is_active' => true,
            ],
            [
                'name' => 'Field Project Coordinator',
                'name_bn' => 'মাঠপর্যায় প্রকল্প সমন্বয়ক',
                'slug' => 'field-project-coordinator',
                'category' => 'Operations & Relief',
                'order_index' => 19,
                'is_active' => true,
            ],
            [
                'name' => 'Accounts & Documentation Officer',
                'name_bn' => 'হিসাব ও নথিপত্র কর্মকর্তা',
                'slug' => 'accounts-documentation-officer',
                'category' => 'Finance & Accounts',
                'order_index' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Volunteer Supervisor & Logistics Support',
                'name_bn' => 'স্বেচ্ছাসেবক সুপারভাইজার',
                'slug' => 'volunteer-supervisor-logistics-support',
                'category' => 'Volunteer Management',
                'order_index' => 21,
                'is_active' => true,
            ],
            [
                'name' => 'Office Caretaker & Logistics Assistant',
                'name_bn' => 'কার্যালয় সহকারী',
                'slug' => 'office-caretaker-logistics-assistant',
                'category' => 'Administration',
                'order_index' => 22,
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
