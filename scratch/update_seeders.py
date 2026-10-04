import re

# 1. ProjectTypeSeeder
project_type_seeder = '''<?php

namespace Database\Seeders;

use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Signature Project',
                'name_bn' => 'বিশেষ প্রকল্প',
                'slug' => 'signature-project',
                'description' => 'Flagship landmark initiatives and major sustainable community infrastructures with high strategic priority.',
                'description_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার দীর্ঘমেয়াদী, টেকসই এবং প্রধান উন্নয়ন ও মানবকল্যাণমূলক প্রকল্পসমূহ।',
                'badge_color' => '#f59e0b',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Continuous Project',
                'name_bn' => 'চলমান প্রকল্প',
                'slug' => 'continuous-project',
                'description' => 'Always-active relief programs requiring ongoing budget and sustained operational funding (e.g., Free Emergency Medical Aid, Tube-well Maintenance, Orphan Sponsorship).',
                'description_bn' => 'সারাবছর চলমান মানবিক কার্যক্রম (যেমন- বিনামূল্যে জরুরি চিকিৎসাসেবা, নলকূপ রক্ষণাবেক্ষণ, এতিম সহায়তা)।',
                'badge_color' => '#10b981',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Monthly Project',
                'name_bn' => 'মাসিক প্রকল্প',
                'slug' => 'monthly-project',
                'description' => 'Recurring monthly relief drives (e.g., Monthly Grocery Ration Packs, Monthly Widow & Disability Allowances).',
                'description_bn' => 'প্রতি মাসের নিয়মিত ত্রাণ কর্মসূচি (যেমন- খাদ্য সহায়তা ও অসচ্ছল পরিবারের মাঝে মাসিক অনুদান বিতরণ)।',
                'badge_color' => '#0284c7',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'General Campaign',
                'name_bn' => 'সাধারণ কর্মসূচি',
                'slug' => 'general-campaign',
                'description' => 'Standard humanitarian campaigns, emergency seasonal relief distributions, and disaster response drives.',
                'description_bn' => 'মৌসুমি ত্রাণ ও শীতবস্ত্র বিতরণ, বন্যা ও দুর্যোগ পরবর্তী জরুরি পুনর্বাসন উদ্যোগ।',
                'badge_color' => '#64748b',
                'order_index' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($types as $type) {
            ProjectType::updateOrCreate(
                ['slug' => $type['slug']],
                $type
            );
        }
    }
}
'''

# 2. DesignationSeeder
designation_seeder = '''<?php

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
'''

# 3. SettingSeeder
setting_seeder = '''<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'org_name' => 'Rotary Club of Shantinagar Dhaka',
            'org_name_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকা',
            'tagline' => 'Dedicated to grassroots humanitarian relief, healthcare aid, and community empowerment in Bangladesh.',
            'tagline_bn' => 'চিকিৎসা সহায়তা, বিশুদ্ধ খাবার পানি, এতিম সেবা ও তৃণমূল মানবিক পুনর্বাসনে নিবেদিত।',
            'hotline' => '+880 1711-000000',
            'email' => 'contact@rotaryshantinagardhaka.org',
            'address' => 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh',
            'address_bn' => 'বাড়ি ১২, রোড ৫, শান্তিনগর, ঢাকা-১২১৭, বাংলাদেশ',
            'mission' => 'To bring compassionate, transparent, and direct humanitarian support to underprivileged families across Bangladesh with 100% itemized audit vouchers.',
            'mission_bn' => 'শতভাগ স্বচ্ছতা ও সরাসরি মাঠপর্যায়ের কাজের মাধ্যমে বাংলাদেশের অসহায় মানুষের পাশে মানবিক সাহায্য নিয়ে দাঁড়ানো।',
            'vision' => 'An enlightened society where every individual has access to clean drinking water, dignity, essential healthcare, and education.',
            'vision_bn' => 'এমন একটি সমাজ বিনির্মাণ যেখানে প্রতিটি মানুষের জন্য বিশুদ্ধ পানি, মানবিক মর্যাদা, চিকিৎসাসেবা ও শিক্ষা নিশ্চিত হবে।',
            'bkash_number' => '+880 1711-223344 (Merchant)',
            'nagad_number' => '+880 1811-556677 (Merchant)',
            'bank_name' => 'Islami Bank Bangladesh Ltd / City Bank',
            'bank_account_name' => 'Rotary Club of Shantinagar Dhaka',
            'bank_account_number' => '2050 3820 1000 8941',
            'bank_branch' => 'Shanti Nagar Branch, Dhaka',
            'currency' => 'BDT (৳)',
        ];

        foreach ($defaults as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => str_contains($key, 'bank') || str_contains($key, 'bkash') || str_contains($key, 'nagad') || $key === 'currency' ? 'payment' : 'general']
            );
        }
    }
}
'''

with open('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/database/seeders/ProjectTypeSeeder.php', 'w', encoding='utf-8') as f:
    f.write(project_type_seeder)

with open('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/database/seeders/DesignationSeeder.php', 'w', encoding='utf-8') as f:
    f.write(designation_seeder)

with open('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/database/seeders/SettingSeeder.php', 'w', encoding='utf-8') as f:
    f.write(setting_seeder)

print("Updated ProjectTypeSeeder, DesignationSeeder, SettingSeeder.")
