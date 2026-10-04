import re

# Update ProjectSeeder
project_seeder_content = r'''<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ProjectTypeSeeder::class);

        $typeMap = ProjectType::pluck('id', 'slug')->toArray();

        $projects = [
            [
                'name' => 'Hospital Equipment & Ceiling Fan Donation Drive',
                'name_bn' => 'হাসপাতাল চিকিৎসা সরঞ্জাম ও সিলিং ফ্যান অনুদান কর্মসূচি',
                'slug' => 'hospital-equipment-fan-donation-drive',
                'project_type_id' => $typeMap['signature-project'] ?? null,
                'short_description' => 'Providing high-speed ceiling fans and emergency patient monitors to government rural healthcare complexes.',
                'short_description_bn' => 'সরকারি ও দাতব্য স্বাস্থ্য কমপ্লেক্সের সাধারণ ওয়ার্ডে হাই-স্পিড সিলিং ফ্যান ও প্রয়োজনীয় চিকিৎসা সামগ্রী স্থাপন।',
                'description' => 'Rotary Club of Shantinagar Dhaka identified severe lack of cooling and basic patient support in local hospital wards. Under this project, 50 heavy-duty ceiling fans and basic patient monitoring equipment were supplied and installed in general wards to ensure patient comfort.',
                'description_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার উদ্যোগে দরিদ্র রোগীদের চিকিৎসা সেবার মানোন্নয়নে ৫০টি শক্তিশালী সিলিং ফ্যান ও রোগীবান্ধব জরুরি মনিটরিং সরঞ্জাম সরবরাহ করা হয়েছে।',
                'estimated_cost' => 150000.00,
                'total_expense' => 142000.00,
                'start_date' => now()->addDays(15),
                'completion_date' => null,
                'status' => 'planned',
                'location' => 'Dhaka Medical College & Hospital',
                'location_bn' => 'ঢাকা মেডিকেল কলেজ ও হাসপাতাল',
                'featured_image' => 'assets/images/events/events-4.jpg',
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-7.jpg',
                    'assets/images/gallery/portfolio-11.jpg',
                    'assets/images/gallery/portfolio-14.jpg',
                ],
            ],
            [
                'name' => 'Nutritious Food & Education Kit for Orphan Children',
                'name_bn' => 'এতিম শিশুদের জন্য পুষ্টিকর খাদ্য ও শিক্ষা উপকরণ বিতরণ',
                'slug' => 'nutritious-food-education-kit-orphans',
                'project_type_id' => $typeMap['monthly-project'] ?? null,
                'short_description' => 'Comprehensive food supplies, school bags, notebooks, and stationery for 120+ underprivileged orphan children.',
                'short_description_bn' => 'শান্তিনগরের ১২০+ জন অসহায় ও এতিম শিশুদের মাঝে পুষ্টিকর খাদ্য, স্কুলব্যাগ, খাতা ও শিক্ষা সামগ্রী বিতরণ।',
                'description' => 'Ensuring proper nutrition and quality basic education tools for orphaned children across local shelter homes and madrasas in Shanti Nagar area to secure their future.',
                'description_bn' => 'এতিম শিশুদের সুন্দর ভবিষ্যত গড়ে তোলার লক্ষ্যে নিয়মিত পুষ্টিকর খাদ্যসামগ্রী এবং পড়াশোনার যাবতীয় সরঞ্জাম সরবরাহ কর্মসূচি।',
                'estimated_cost' => 85000.00,
                'total_expense' => 85000.00,
                'start_date' => now()->addDays(28),
                'completion_date' => null,
                'status' => 'planned',
                'location' => 'Shanti Nagar Orphanage, Dhaka',
                'location_bn' => 'শান্তিনগর এতিমখানা ও মাদরাসা, ঢাকা',
                'featured_image' => 'assets/images/events/events-5.jpg',
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-8.jpg',
                    'assets/images/gallery/portfolio-13.jpg',
                ],
            ],
            [
                'name' => 'Warm Blankets & Winter Clothes Relief Drive',
                'name_bn' => 'শীতবস্ত্র ও কম্বল বিতরণ মানবিক কর্মসূচি',
                'slug' => 'warm-blankets-winter-clothes-relief',
                'project_type_id' => $typeMap['general-campaign'] ?? null,
                'short_description' => 'Distributing heavy winter blankets and warm garments to destitute families in cold wave-affected northern districts.',
                'short_description_bn' => 'উত্তরাঞ্চলের তীব্র শীতে অসহায় পরিবারের মাঝে উন্নতমানের কম্বল ও শিশুদের শীতের পোশাক বিতরণ।',
                'description' => 'Every winter, extreme cold hits northern Bangladesh. Our volunteers directly distribute high-quality thermal blankets and children warm clothes from door to door.',
                'description_bn' => 'তীব্র শৈত্যপ্রবাহে বিপন্ন মানুষের কষ্ট লাঘবে আমাদের নিজস্ব ভলান্টিয়ার টিম সরাসরি বাড়ি বাড়ি গিয়ে মানসম্মত শীতবস্ত্র উপহার দেয়।',
                'estimated_cost' => 200000.00,
                'total_expense' => 195000.00,
                'start_date' => now()->subMonths(1),
                'completion_date' => now()->subDays(5),
                'status' => 'completed',
                'location' => 'Kurigram & Nilphamari, Rangpur',
                'location_bn' => 'কুড়িগ্রাম ও নীলফামারী, রংপুর',
                'featured_image' => 'assets/images/events/events-6.jpg',
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-9.jpg',
                    'assets/images/gallery/portfolio-12.jpg',
                    'assets/images/gallery/portfolio-15.jpg',
                ],
            ],
            [
                'name' => 'Deep Tube-well & Clean Drinking Water Installation',
                'name_bn' => 'আর্সেনিকমুক্ত গভীর নলকূপ ও বিশুদ্ধ পানি প্রকল্প',
                'slug' => 'deep-tube-well-clean-water-installation',
                'project_type_id' => $typeMap['signature-project'] ?? null,
                'short_description' => 'Installing arsenic-free deep tube-wells to deliver safe drinking water to remote rural villages.',
                'short_description_bn' => 'সুদূর হাওরাঞ্চলের গ্রামবাসীদের জন্য আর্সেনিকমুক্ত গভীর নলকূপ স্থাপন ও বিশুদ্ধ খাবার পানি নিশ্চিতকরণ।',
                'description' => 'Access to uncontaminated drinking water prevents deadly waterborne diseases. We bore 800+ ft deep tube-wells with concrete washing platforms for permanent public use.',
                'description_bn' => 'পানিজনিত রোগ প্রতিরোধে ৮০০+ ফুট গভীর নলকূপ ও পাকা প্ল্যাটফর্ম তৈরি করে স্থায়ী সুপেয় পানির ব্যবস্থা করা হয়েছে।',
                'estimated_cost' => 120000.00,
                'total_expense' => 118000.00,
                'start_date' => now()->subMonths(2),
                'completion_date' => now()->subMonths(1),
                'status' => 'completed',
                'location' => 'Sunamganj Haor Region',
                'location_bn' => 'সুনামগঞ্জ হাওর এলাকা',
                'featured_image' => 'assets/images/events/events-7.jpg',
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-10.jpg',
                ],
            ],
            [
                'name' => 'Free Friday Medical Camp & Essential Medicine Supply',
                'name_bn' => 'বিনামূল্যে শুক্রবারের ফ্রি মেডিকেল ক্যাম্প ও ওষুধ বিতরণ',
                'slug' => 'free-medical-camp-medicine-supply',
                'project_type_id' => $typeMap['continuous-project'] ?? null,
                'short_description' => 'Specialist doctors provide free health consultations, eye checkups, and prescription medicines for poor communities.',
                'short_description_bn' => 'বিশেষজ্ঞ চিকিৎসকের পরামর্শ, ডায়াবেটিস ও চক্ষু পরীক্ষা এবং প্রেসক্রিপশন অনুযায়ী ফ্রি ওষুধ প্রদান।',
                'description' => 'A weekly health clinic serving hundreds of low-income workers, rickshaw pullers, and destitute elders with free medicine, primary diagnostics, and basic health advice.',
                'description_bn' => 'অসচ্ছল ও শ্রমজীবী মানুষদের জন্য প্রতি শুক্রবার নিয়মিত চিকিৎসা পরামর্শ ও বিনামূল্যে জরুরি ওষুধ বিতরণ করা হয়।',
                'estimated_cost' => 50000.00,
                'total_expense' => 47500.00,
                'start_date' => now()->subMonths(3),
                'completion_date' => null,
                'status' => 'in_progress',
                'location' => 'Shanti Nagar Community Center',
                'location_bn' => 'শান্তিনগর কমিউনিটি সেন্টার, ঢাকা',
                'featured_image' => 'assets/images/events/events-8.jpg',
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-11.jpg',
                    'assets/images/gallery/portfolio-13.jpg',
                ],
            ],
            [
                'name' => 'Emergency Ramadan Food Ration Packs for 500 Families',
                'name_bn' => 'রমজান উপহার: ৫০০ অসচ্ছল পরিবারের মাঝে খাদ্য সামগ্রী বিতরণ',
                'slug' => 'ramadan-food-ration-packs-500-families',
                'project_type_id' => $typeMap['monthly-project'] ?? null,
                'short_description' => 'Monthly dry food packages containing rice, lentils, oil, chickpeas, and dates for distressed families.',
                'short_description_bn' => 'চাল, ডাল, তেল, ছোলা, খেজুর ও চিনিসহ পুরো মাসের প্রয়োজনীয় খাদ্য উপহার সামগ্রী বিতরণ।',
                'description' => 'Ensuring every struggling family observes the holy month of Ramadan with adequate nutritious food through comprehensive grocery aid packs distributed directly at their homes.',
                'description_bn' => 'পবিত্র রমজানে অসচ্ছল পরিবারের মুখে হাসি ফোটাতে উপহার প্যাকেট বিতরণ যা পুরো মাসের খাদ্য চাহিদা পূরণ করে।',
                'estimated_cost' => 350000.00,
                'total_expense' => 345000.00,
                'start_date' => now()->subMonths(4),
                'completion_date' => now()->subMonths(3),
                'status' => 'completed',
                'location' => 'Dhaka Slum & Riverbank Areas',
                'location_bn' => 'ঢাকা ও নদীভাঙন কবলিত এলাকা',
                'featured_image' => 'assets/images/events/events-9.jpg',
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-14.jpg',
                    'assets/images/gallery/portfolio-15.jpg',
                ],
            ],
        ];

        foreach ($projects as $pData) {
            $images = $pData['images'] ?? [];
            unset($pData['images']);

            $project = Project::updateOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );

            if (!empty($images)) {
                foreach ($images as $idx => $imgPath) {
                    ProjectImage::updateOrCreate(
                        ['project_id' => $project->id, 'image_path' => $imgPath],
                        [
                            'caption' => $project->name . ' - Field Documentation',
                            'caption_bn' => $project->name_bn . ' - মাঠপর্যায়ের কার্যক্রম',
                            'order_index' => $idx + 1,
                        ]
                    );
                }
            }
        }
    }
}
'''

# Update EmployeeSeeder
employee_seeder_content = r'''<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DesignationSeeder::class);
        $employees = [
            // 0) Highlight for Best President Ever
            [
                'employee_id' => 'EMP-001',
                'name' => 'Alhaj Mohammad Nurul Islam',
                'name_bn' => 'আলহাজ্ব মোহাম্মদ নুরুল ইসলাম',
                'designation' => 'President',
                'phone' => '+8801711001122',
                'email' => 'patron@shantinagarfoundation.org',
                'nid_number' => '19602692550000001',
                'present_address' => 'House 14, Road 3, Shanti Nagar, Dhaka',
                'permanent_address' => 'Shanti Nagar, Dhaka-1217',
                'joining_date' => '2015-01-01',
                'base_salary' => 0.00,
                'is_active' => true,
                'photo' => 'assets/images/team/team-9.jpg',
                'speech' => '“A true humanitarian mission is not measured by the size of donations, but by the purity of transparency and the dignity restored to every vulnerable life we touch.”',
                'speech_tag' => 'Lifetime Humanitarian Philosophy',
                'bio' => 'Recognized as the foundational cornerstone and most beloved leader of Rotary Club of Shantinagar Dhaka. Under his visionary stewardship, our grassroots relief initiatives reached over 50,000 underprivileged families with 100% itemized audit transparency and direct field procurement.',
                'bio_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার স্বপ্নদ্রষ্টা ও আজীবন পৃষ্ঠপোষক। তাঁর দূরদর্শী নেতৃত্বে আমাদের মানবিক সেবামূলক কাজ ৫০,০০০-এরও বেশি পরিবারের কাছে সরাসরি পৌঁছেছে।',
                'signature_text' => 'Alhaj Mohammad Nurul Islam',
                'signature_title' => 'Founding Pillar • Lifetime Patron',
                'badge_title' => 'Honorary Tribute • Lifetime Patron',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => 'https://twitter.com',
                'linkedin_url' => 'https://linkedin.com',
                'order_index' => 1,
                'is_highlight' => true,
            ],

            // 1) President
            [
                'employee_id' => 'EMP-002',
                'name' => 'Advocate Mahfuzur Rahman',
                'name_bn' => 'এডভোকেট মাহফুজুর রহমান',
                'designation' => 'President',
                'phone' => '+8801711223344',
                'email' => 'president@shantinagarfoundation.org',
                'nid_number' => '19722692550000002',
                'present_address' => 'Kakrail, Dhaka-1000',
                'permanent_address' => 'Kakrail, Dhaka',
                'joining_date' => '2018-03-01',
                'base_salary' => 0.00,
                'is_active' => true,
                'photo' => 'assets/images/team/team-5.jpg',
                'speech' => 'Our sacred mission is ensuring no underprivileged family in our community is left without healthcare, clean water, or emergency shelter. At Rotary Club of Shantinagar Dhaka, we believe true leadership is rooted in selfless service. By uniting generous benefactors with verified grassroots programs, we turn empathy into permanent, dignity-restoring action across Bangladesh.',
                'speech_tag' => "President's Address & Vision",
                'bio' => 'Serving as President with a focus on institutional governance, legal compliance, and strategic grassroots outreach across Bangladesh.',
                'bio_bn' => 'সভাপতি হিসেবে তিনি প্রশাসনিক স্বচ্ছতা, প্রাতিষ্ঠানিক সুশাসন ও তৃণমূল সেবামূলক কার্যক্রমে নেতৃত্ব দিয়ে আসছেন।',
                'signature_text' => 'Advocate Mahfuzur Rahman',
                'signature_title' => 'President • Rotary Club of Shantinagar Dhaka',
                'badge_title' => 'President',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => 'https://twitter.com',
                'linkedin_url' => 'https://linkedin.com',
                'order_index' => 2,
                'is_highlight' => false,
            ],

            // 2) General Secretary
            [
                'employee_id' => 'EMP-003',
                'name' => 'Dr. Tariqul Islam',
                'name_bn' => 'ডা: তরিকুল ইসলাম',
                'designation' => 'General Secretary',
                'phone' => '+8801811334455',
                'email' => 'secretary@shantinagarfoundation.org',
                'nid_number' => '19782692550000003',
                'present_address' => 'Shanti Nagar, Dhaka-1217',
                'permanent_address' => 'Shanti Nagar, Dhaka',
                'joining_date' => '2019-01-15',
                'base_salary' => 0.00,
                'is_active' => true,
                'photo' => 'assets/images/team/team-6.jpg',
                'speech' => 'Every single project is managed with 100% internal audit transparency and direct field verification. We leave zero room for intermediaries.',
                'speech_tag' => "General Secretary's Report",
                'bio' => 'Coordinating day-to-day relief administration, volunteer brigades, medical drives, and transparent field operations.',
                'bio_bn' => 'প্রতিদিনের ত্রাণ বিতরণ, স্বেচ্ছাসেবী টিম ও স্বাস্থ্য ক্যাম্পের সফল সমন্বয় সাধন করেন।',
                'signature_text' => 'Dr. Tariqul Islam',
                'signature_title' => 'General Secretary • Rotary Club of Shantinagar Dhaka',
                'badge_title' => 'General Secretary',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => 'https://twitter.com',
                'linkedin_url' => 'https://linkedin.com',
                'order_index' => 3,
                'is_highlight' => false,
            ],

            // 3) Treasurer & Finance Secretary
            [
                'employee_id' => 'EMP-004',
                'name' => 'Engr. Shahabuddin Ahmed',
                'name_bn' => 'প্রকৌশলী শাহাবুদ্দিন আহমেদ',
                'designation' => 'Treasurer & Finance Secretary',
                'phone' => '+8801911445566',
                'email' => 'treasurer@shantinagarfoundation.org',
                'nid_number' => '19752692550000004',
                'present_address' => 'Bijoy Nagar, Dhaka-1000',
                'permanent_address' => 'Bijoy Nagar, Dhaka',
                'joining_date' => '2019-06-01',
                'base_salary' => 0.00,
                'is_active' => true,
                'photo' => 'assets/images/team/team-7.jpg',
                'speech' => 'Every Taka donated to Rotary Club of Shantinagar Dhaka is fully audited and mapped directly to concrete relief deliverables with itemized vouchers.',
                'speech_tag' => 'Financial Transparency Commitment',
                'bio' => 'Managing accounting systems, financial integrity, donation voucher audits, and regulatory reporting.',
                'bio_bn' => 'আর্থিক স্বচ্ছতা ও প্রতিটি ব্যয়ের পুঙ্খানুপুঙ্খ হিসাব সংরক্ষণের দায়িত্ব পালন করেন।',
                'signature_text' => 'Engr. Shahabuddin Ahmed',
                'signature_title' => 'Treasurer • Rotary Club of Shantinagar Dhaka',
                'badge_title' => 'Treasurer & Finance Secretary',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => 'https://twitter.com',
                'linkedin_url' => 'https://linkedin.com',
                'order_index' => 4,
                'is_highlight' => false,
            ],
        ];

        foreach ($employees as $data) {
            $designationName = $data['designation'];
            unset($data['designation']);

            $desig = Designation::where('name', $designationName)->first();
            $data['designation_id'] = $desig?->id;

            Employee::updateOrCreate(
                ['employee_id' => $data['employee_id']],
                $data
            );
        }
    }
}
'''

with open('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/database/seeders/ProjectSeeder.php', 'w', encoding='utf-8') as f:
    f.write(project_seeder_content)

with open('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/database/seeders/EmployeeSeeder.php', 'w', encoding='utf-8') as f:
    f.write(employee_seeder_content)

print("Updated ProjectSeeder and EmployeeSeeder successfully.")
