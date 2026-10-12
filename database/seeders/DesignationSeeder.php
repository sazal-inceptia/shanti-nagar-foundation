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
                'name' => 'Secretary',
                'name_bn' => 'সম্পাদক (Secretary)',
                'slug' => 'secretary',
                'category' => 'Executive Leadership',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Treasurer',
                'name_bn' => 'কোষাধ্যক্ষ (Treasurer)',
                'slug' => 'treasurer',
                'category' => 'Executive Leadership',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Immediate Past President (IPP)',
                'name_bn' => 'সদ্য বিদায়ী সভাপতি (IPP)',
                'slug' => 'immediate-past-president',
                'category' => 'Executive Leadership',
                'order_index' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'President Elect',
                'name_bn' => 'নির্বাচিত সভাপতি (President Elect)',
                'slug' => 'president-elect',
                'category' => 'Executive Leadership',
                'order_index' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'President Nominee',
                'name_bn' => 'মনোনীত সভাপতি (President Nominee)',
                'slug' => 'president-nominee',
                'category' => 'Executive Leadership',
                'order_index' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Vice President',
                'name_bn' => 'সহ-সভাপতি (Vice President)',
                'slug' => 'vice-president',
                'category' => 'Executive Leadership',
                'order_index' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Assistant Secretary',
                'name_bn' => 'সহকারী সম্পাদক (Assistant Secretary)',
                'slug' => 'assistant-secretary',
                'category' => 'Executive Leadership',
                'order_index' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Assistant Treasurer',
                'name_bn' => 'সহকারী কোষাধ্যক্ষ (Assistant Treasurer)',
                'slug' => 'assistant-treasurer',
                'category' => 'Executive Leadership',
                'order_index' => 9,
                'is_active' => true,
            ],

            // Board of Directors (BOD)
            [
                'name' => 'Director (Service Project)',
                'name_bn' => 'পরিচালক (সেবা প্রকল্প ও ত্রাণ)',
                'slug' => 'director-service-projects',
                'category' => 'Board of Directors',
                'order_index' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Club Facilitator',
                'name_bn' => 'ক্লাব ফ্যাসিলেটেটর (Club Facilitator)',
                'slug' => 'club-facilitator',
                'category' => 'Board of Directors',
                'order_index' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Membership)',
                'name_bn' => 'পরিচালক (সদস্য সংগ্রহ ও উন্নয়ন)',
                'slug' => 'director-membership',
                'category' => 'Board of Directors',
                'order_index' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Admin.)',
                'name_bn' => 'পরিচালক (ক্লাব প্রশাসন)',
                'slug' => 'director-admin',
                'category' => 'Board of Directors',
                'order_index' => 13,
                'is_active' => true,
            ],
            [
                'name' => 'Director (TRF)',
                'name_bn' => 'পরিচালক (রোটারি ফাউন্ডেশন - TRF)',
                'slug' => 'director-the-rotary-foundation',
                'category' => 'Board of Directors',
                'order_index' => 14,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Public Image)',
                'name_bn' => 'পরিচালক (পাবলিক ইমেজ ও মিডিয়া)',
                'slug' => 'director-public-image',
                'category' => 'Board of Directors',
                'order_index' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Director (Youth Service)',
                'name_bn' => 'পরিচালক (যুব সেবা ও রোটারেক্ট)',
                'slug' => 'director-youth-service',
                'category' => 'Board of Directors',
                'order_index' => 16,
                'is_active' => true,
            ],
            [
                'name' => 'Bulletin Editor',
                'name_bn' => 'ক্লাব বুলেটিন সম্পাদক (Editor)',
                'slug' => 'bulletin-editor',
                'category' => 'Board of Directors',
                'order_index' => 17,
                'is_active' => true,
            ],
            [
                'name' => 'Sergeant at Arms',
                'name_bn' => 'সার্জেন্ট অ্যাট আর্মস (Sergeant at Arms)',
                'slug' => 'sergeant-at-arms',
                'category' => 'Board of Directors',
                'order_index' => 18,
                'is_active' => true,
            ],

            // Advisory & Past Presidents
            [
                'name' => 'Chief Adviser & Charter President',
                'name_bn' => 'প্রধান উপদেষ্টা ও চার্টার সভাপতি',
                'slug' => 'chief-adviser-charter-president',
                'category' => 'Past Presidents',
                'order_index' => 19,
                'is_active' => true,
            ],
            [
                'name' => 'Past President',
                'name_bn' => 'সাবেক সভাপতি (Past President)',
                'slug' => 'past-president',
                'category' => 'Past Presidents',
                'order_index' => 20,
                'is_active' => true,
            ],

            // General Members
            [
                'name' => 'Club Member',
                'name_bn' => 'ক্লাব সদস্য (Rotarian)',
                'slug' => 'club-member',
                'category' => 'General Members',
                'order_index' => 21,
                'is_active' => true,
            ],

            // Operations & Support Roles (Optional Staff)
            [
                'name' => 'Field Project Coordinator',
                'name_bn' => 'মাঠপর্যায় প্রকল্প সমন্বয়ক',
                'slug' => 'field-project-coordinator',
                'category' => 'Operations & Relief',
                'order_index' => 22,
                'is_active' => true,
            ],
            [
                'name' => 'Accounts & Documentation Officer',
                'name_bn' => 'হিসাব ও নথিপত্র কর্মকর্তা',
                'slug' => 'accounts-documentation-officer',
                'category' => 'Finance & Accounts',
                'order_index' => 23,
                'is_active' => true,
            ],
            [
                'name' => 'Volunteer Supervisor & Logistics Support',
                'name_bn' => 'স্বেচ্ছাসেবক সুপারভাইজার',
                'slug' => 'volunteer-supervisor-logistics-support',
                'category' => 'Volunteer Management',
                'order_index' => 24,
                'is_active' => true,
            ],
            [
                'name' => 'Office Caretaker & Logistics Assistant',
                'name_bn' => 'কার্যালয় সহকারী',
                'slug' => 'office-caretaker-logistics-assistant',
                'category' => 'Administration',
                'order_index' => 25,
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
