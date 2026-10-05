<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'title' => 'Winter Warmth & Blanket Distribution Campaign',
                'title_bn' => 'শীতবস্ত্র ও কম্বল বিতরণ কর্মসূচি',
                'slug' => 'winter-warmth-blanket-distribution-campaign',
                'event_date' => now()->addDays(12)->toDateString(),
                'event_time' => '09:00 AM - 03:00 PM',
                'location' => 'Kurigram & Sirajganj Flood-Affected Char Areas',
                'location_bn' => 'কুড়িগ্রাম ও সিরাজগঞ্জের বন্যা দুর্গত চরাঞ্চল',
                'short_description' => 'Direct field distribution of heavy winter blankets and thermal jackets to vulnerable elderly and children.',
                'short_description_bn' => 'শীতকবলিত অসহায় শিশু ও বয়োবৃদ্ধদের মাঝে সরাসরি কম্বল ও শীতবস্ত্র বিতরণ কর্মসূচি।',
                'description' => 'Every winter, cold waves severely impact the marginalized char communities in northern Bangladesh. Rotary Club of Shantinagar Dhaka is organizing a dedicated field drive providing 1,500 heavy-duty thermal blankets, baby sweaters, and warm shawls.',
                'description_bn' => 'প্রতি বছর শীত মৌসুমে উত্তরবঙ্গের চরাঞ্চলের দরিদ্র পরিবারগুলো চরম দুর্ভোগে পড়ে। রোটারি ক্লাব অব শান্তিনগর ঢাকা ১৫০০টি উষ্ণ কম্বল এবং শিশুতোষ সোয়েটার সরাসরি বাড়ি বাড়ি গিয়ে পৌঁছে দিচ্ছে।',
                'featured_image' => 'assets/images/resource/cause-1.jpg',
                'status' => 'upcoming',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Free Eye Screening & Cataract Surgery Camp',
                'title_bn' => 'বিনামূল্যে চক্ষু পরীক্ষা ও ছানি অপারেশন ক্যাম্প',
                'slug' => 'free-eye-screening-cataract-surgery-camp',
                'event_date' => now()->addDays(24)->toDateString(),
                'event_time' => '08:30 AM - 04:30 PM',
                'location' => 'Rotary Community Clinic, Shantinagar, Dhaka',
                'location_bn' => 'রোটারি কমিউনিটি ক্লিনিক, শান্তিনগর, ঢাকা',
                'short_description' => 'Comprehensive eye checkup, free prescription glasses, and fully sponsored IOL cataract surgeries for underprivileged patients.',
                'short_description_bn' => 'বিনামূল্যে চক্ষু পরীক্ষা, চশমা বিতরণ এবং দরিদ্র রোগীদের সম্পূর্ণ বিনামূল্যে লেন্স প্রতিস্থাপন সার্জারি।',
                'description' => 'Preventable blindness remains a critical barrier to livelihoods among low-income community members. Experienced ophthalmologists and optometrists will provide free consultations, distribute vision glasses, and shortlist 60 patients for sponsored cataract surgery.',
                'description_bn' => 'অসচ্ছল মানুষদের দৃষ্টিহীনতা প্রতিরোধে অভিজ্ঞ চক্ষু বিশেষজ্ঞদের দ্বারা বিনামূল্যে পরামর্শ, পাওয়ার চশমা বিতরণ এবং ৬০ জন রোগীর ছানি অপারেশনের ব্যবস্থা করা হয়েছে।',
                'featured_image' => 'assets/images/resource/cause-2.jpg',
                'status' => 'upcoming',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Tree Plantation & Environmental Awareness Drive',
                'title_bn' => 'বৃক্ষরোপণ ও পরিবেশ সচেতনতা অভিযান',
                'slug' => 'tree-plantation-environmental-awareness-drive',
                'event_date' => now()->addDays(40)->toDateString(),
                'event_time' => '07:00 AM - 11:30 AM',
                'location' => 'Ramna & Segunbagicha Community Green Zones, Dhaka',
                'location_bn' => 'রমনা ও সেগুনবাগিচা কমিউনিটি গ্রিন জোন, ঢাকা',
                'short_description' => 'Planting 2,000 indigenous fruit, timber, and medicinal saplings to combat urban heat islands in Dhaka.',
                'short_description_bn' => 'ঢাকার নগর পরিবেশের ভারসাম্য রক্ষায় ২০০০ ফলজ, বনজ ও ওষধি গাছের চারা রোপণ ও বিতরণ।',
                'description' => 'Collaborative environmental campaign engaging Rotaract youth and student volunteers to plant indigenous trees across public schools, park boundaries, and residential walkways.',
                'description_bn' => 'রোটার‌্যাক্ট এবং তরুণ ভলান্টিয়ারদের সাথে নিয়ে রাজধানীর বিভিন্ন শিক্ষা প্রতিষ্ঠান ও পার্ক সংলগ্ন এলাকায় বৃক্ষরোপণ কর্মসূচি।',
                'featured_image' => 'assets/images/resource/cause-3.jpg',
                'status' => 'upcoming',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Voluntary Blood Donation & Thalassemia Screening Drive',
                'title_bn' => 'স্বেচ্ছায় রক্তদান ও থ্যালাসেমিয়া স্ক্রিনিং কর্মসূচি',
                'slug' => 'voluntary-blood-donation-thalassemia-screening-drive',
                'event_date' => now()->subDays(15)->toDateString(),
                'event_time' => '10:00 AM - 05:00 PM',
                'location' => 'Central Blood Bank & Rotary Center, Dhaka',
                'location_bn' => 'সেন্ট্রাল ব্লাড ব্যাংক ও রোটারি সেন্টার, ঢাকা',
                'short_description' => 'Collected 120+ safe blood units for child thalassemia patients and registered 200 regular emergency donors.',
                'short_description_bn' => 'থ্যালাসেমিয়া আক্রান্ত শিশুদের জরুরি চিকিৎসায় ১২০ ব্যাগ নিরাপদ রক্ত সংগ্রহ এবং ২০০ জন ডোনারের ডাটাবেজ তৈরি।',
                'description' => 'In partnership with specialized transfusion services, our club hosted a successful voluntary blood donation camp to ensure vital blood supplies for critical thalassemia treatments.',
                'description_bn' => 'থ্যালাসেমিয়া আক্রান্ত শিশুদের জীবন বাঁচাতে রোটারি ক্লাবের উদ্যোগে দিনব্যাপী সফল স্বেচ্ছায় রক্তদান ক্যাম্প অনুষ্ঠিত হয়েছে।',
                'featured_image' => 'assets/images/resource/cause-4.jpg',
                'status' => 'completed',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($activities as $data) {
            Activity::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
