<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\GalleryImage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds with verified existing asset files.
     */
    public function run(): void
    {
        $albumsData = [
            [
                'title' => 'Winter Blanket & Warm Clothes Distribution 2026',
                'title_bn' => 'শীতার্তদের মাঝে শীতবস্ত্র ও কম্বল বিতরণ ২০২৬',
                'slug' => 'winter-blanket-warm-clothes-distribution-2026',
                'description' => 'Rotary Club of Shantinagar Dhaka distributed heavy thermal blankets and children warm winter clothing packages to disadvantaged families.',
                'description_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার উদ্যোগে দরিদ্র ও ছিন্নমূল শীতার্ত পরিবারের মাঝে উন্নত মানের কম্বল এবং শিশুদের মাঝে শীতের পোশাক বিতরণ কার্যক্রম।',
                'cover_image' => 'assets/images/case/case-8.jpg',
                'event_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'is_active' => true,
                'sort_order' => 1,
                'photos' => [
                    [
                        'title' => 'Blanket Handover to Senior Beneficiaries',
                        'title_bn' => 'বয়োজ্যেষ্ঠদের মাঝে কম্বল হস্তান্তর',
                        'caption' => 'Direct distribution conducted by club executive officers and youth volunteers.',
                        'caption_bn' => 'ক্লাব নির্বাহী কর্মকর্তা ও তরুণ স্বেচ্ছাসেবকদের প্রত্যক্ষ তত্ত্বাবধানে বিতরণ।',
                        'image_path' => 'assets/images/case/case-8.jpg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Volunteer Verification Desk',
                        'title_bn' => 'উপকারভোগী নিবন্ধন ও তথ্য যাচাই ডেস্ক',
                        'caption' => 'Ensuring aid reaches the genuine needy through pre-issued token verification.',
                        'caption_bn' => 'টোকেন যাচাইয়ের মাধ্যমে প্রকৃত অসচ্ছল পরিবারগুলোর কাছে সহায়তা নিশ্চিতকরণ।',
                        'image_path' => 'assets/images/gallery/portfolio-7.jpg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Warm Winter Kits for Orphan Students',
                        'title_bn' => 'এতিম শিক্ষার্থীদের শীতের পোশাক বিতরণ',
                        'caption' => 'Warm jackets and socks handed over to underprivileged madrasa students.',
                        'caption_bn' => 'সুবিধাবঞ্চিত মাদরাসা শিক্ষার্থীদের মাঝে উষ্ণ জ্যাকেট ও মোজা উপহার।',
                        'image_path' => 'assets/images/gallery/portfolio-8.jpg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Field Coordination Team',
                        'title_bn' => 'মাঠপর্যায়ের সমন্বয় টিম',
                        'caption' => 'Rotary volunteers packing relief parcels for door-to-door night distribution.',
                        'caption_bn' => 'রাতে বাড়ি বাড়ি পৌঁছানোর জন্য পার্সেল প্যাকেট প্রস্তুতকরণ।',
                        'image_path' => 'assets/images/gallery/portfolio-9.jpg',
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'title' => 'Free Medical Diagnostic & Medicine Camp',
                'title_bn' => 'বিনামূল্যে স্বাস্থ্যসেবা ও ওষুধ বিতরণ ক্যাম্প',
                'slug' => 'free-medical-diagnostic-medicine-camp',
                'description' => 'Comprehensive community health camp offering specialist consultations, ECG, blood sugar tests, and free essential medicines.',
                'description_bn' => 'অভিজ্ঞ বিশেষজ্ঞ চিকিৎসকদের পরামর্শ, ইসিজি, ডায়াবেটিস পরীক্ষা এবং বিনামূল্যে প্রয়োজনীয় ওষুধ বিতরণ কর্মসূচি।',
                'cover_image' => 'assets/images/case/case-1.jpg',
                'event_date' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'is_active' => true,
                'sort_order' => 2,
                'photos' => [
                    [
                        'title' => 'Pediatric & Maternal Health Consultation',
                        'title_bn' => 'শিশু ও মাতৃস্বাস্থ্য বিশেষজ্ঞ পরামর্শ',
                        'caption' => 'Free doctor checkups for mothers and infants with dietary advice.',
                        'caption_bn' => 'মা ও শিশুদের জন্য চিকিৎসকের ফ্রি প্রেসক্রিপশন ও পুষ্টি পরামর্শ প্রদান।',
                        'image_path' => 'assets/images/case/case-1.jpg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Free Medicine Dispensing Corner',
                        'title_bn' => 'বিনামূল্যে ওষুধ বিতরণ বুথ',
                        'caption' => 'Essential antibiotics, vitamins, and chronic medicine supply.',
                        'caption_bn' => 'প্রেসক্রিপশন অনুযায়ী জরুরি জীবনরক্ষাকারী ওষুধ বিনামূল্যে হস্তান্তর।',
                        'image_path' => 'assets/images/gallery/portfolio-10.jpg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Blood Grouping & Glucose Screening',
                        'title_bn' => 'রক্তের গ্রুপ ও সুগার নির্ণয় কেন্দ্র',
                        'caption' => 'On-spot diagnostic tests conducted by volunteer lab technicians.',
                        'caption_bn' => 'স্বেচ্ছাসেবী ল্যাব টেকনিশিয়ানদের দ্বারা তাৎক্ষণিক পরীক্ষা।',
                        'image_path' => 'assets/images/gallery/portfolio-11.jpg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Specialist Doctor Prescription Session',
                        'title_bn' => 'বিশেষজ্ঞ চিকিৎসকের পরামর্শ সেশন',
                        'caption' => 'Senior physicians listening to patient histories and prescribing treatments.',
                        'caption_bn' => 'রোগীদের শারীরিক অবস্থা পর্যবেক্ষণ ও চিকিৎসাপত্র প্রদান।',
                        'image_path' => 'assets/images/events/events-1.jpg',
                        'is_featured' => true,
                    ],
                ],
            ],
            [
                'title' => 'Safe Drinking Water Deep Tube-well Inauguration',
                'title_bn' => 'আর্সেনিকমুক্ত গভীর নলকূপ স্থাপন ও উদ্বোধন',
                'slug' => 'safe-drinking-water-deep-tube-well-inauguration',
                'description' => 'Installation of 850-feet deep arsenic-free tube-wells providing round-the-clock clean potable water to over 1,200 villagers.',
                'description_bn' => '৮৫০ ফুট গভীর আর্সেনিকমুক্ত টিউবওয়েল স্থাপন যা প্রতিদিন ১,২০০+ গ্রামীণ মানুষকে নিরাপদ সুপেয় পানি সরবরাহ করছে।',
                'cover_image' => 'assets/images/case/case-2.jpg',
                'event_date' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'is_active' => true,
                'sort_order' => 3,
                'photos' => [
                    [
                        'title' => 'Tube-well Dedication Ceremony',
                        'title_bn' => 'নলকূপ উৎসর্গ ও উদ্বোধন অনুষ্ঠান',
                        'caption' => 'Community elders and Rotary officials inaugurating the water station.',
                        'caption_bn' => 'এলাকার গণ্যমান্য ব্যক্তিবর্গ ও রোটারি নেতৃবৃন্দের উপস্থিতিতে পানির স্টেশন চালু।',
                        'image_path' => 'assets/images/case/case-2.jpg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Water Quality Testing & Purification',
                        'title_bn' => 'পানির গুণমান পরীক্ষা ও পিউরিফিকেশন',
                        'caption' => 'Laboratory certified 0% arsenic and iron-free water flow.',
                        'caption_bn' => 'ল্যাব টেস্টের মাধ্যমে শতভাগ আর্সেনিক ও আয়রনমুক্ত পানির প্রবাহ নিশ্চিতকরণ।',
                        'image_path' => 'assets/images/gallery/portfolio-12.jpg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Happy Village Children Drinking Clean Water',
                        'title_bn' => 'নিরাপদ পানি পানে আনন্দিত শিশুরা',
                        'caption' => 'Ensuring a healthy childhood free from waterborne diseases.',
                        'caption_bn' => 'পানিবাহিত রোগ থেকে মুক্ত সুস্থ শৈশবের আনন্দময় মুহূর্ত।',
                        'image_path' => 'assets/images/gallery/portfolio-13.jpg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Community Water Station Facility',
                        'title_bn' => 'কমিউনিটি ওয়াটার স্টেশন সুবিধা',
                        'caption' => 'Clean concrete platform built around the tube-well.',
                        'caption_bn' => 'নলকূপের চারপাশের পরিষ্কার কংক্রিট প্ল্যাটফর্ম।',
                        'image_path' => 'assets/images/events/events-2.jpg',
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'title' => 'Orphan Education Support & Gift Distribution',
                'title_bn' => 'এতিম শিশু শিক্ষা সহায়তা ও উপহার সামগ্রী বিতরণ',
                'slug' => 'orphan-education-support-gift-distribution',
                'description' => 'Distribution of school bags, notebooks, stationery sets, and tuition sponsorships to orphaned children in Dhaka.',
                'description_bn' => 'সুবিধাবঞ্চিত ও এতিম শিশুদের মাঝে স্কুল ব্যাগ, খাতা, জ্যামিতি বক্স এবং শিক্ষাবৃত্তির আর্থিক চেক হস্তান্তর।',
                'cover_image' => 'assets/images/case/case-3.jpg',
                'event_date' => Carbon::now()->subMonths(1)->format('Y-m-d'),
                'is_active' => true,
                'sort_order' => 4,
                'photos' => [
                    [
                        'title' => 'School Bags & Stationery Kits',
                        'title_bn' => 'স্কুল ব্যাগ ও শিক্ষাসামগ্রী কিট বিতরণ',
                        'caption' => 'Educational backpacks and notebooks presented to bright students.',
                        'caption_bn' => 'মেধাবী শিক্ষার্থীদের হাতে সম্পূর্ণ শিক্ষাসামগ্রী ব্যাগ তুলে দেয়া হচ্ছে।',
                        'image_path' => 'assets/images/case/case-3.jpg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Classroom Art & Learning Session',
                        'title_bn' => 'শ্রেণিকক্ষে চিত্রাঙ্কন ও সৃজনশীল পাঠদান',
                        'caption' => 'Volunteers conducting interactive learning and motivational sessions.',
                        'caption_bn' => 'রোটারি যুব স্বেচ্ছাসেবীদের আনন্দঘন মোটিভেশনাল ক্লাস।',
                        'image_path' => 'assets/images/gallery/portfolio-14.jpg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Nutritious Meal Feast for Students',
                        'title_bn' => 'শিক্ষার্থীদের মাঝে পুষ্টিকর খাবার পরিবেশন',
                        'caption' => 'Special warm lunch served to all children attending the ceremony.',
                        'caption_bn' => 'অনুষ্ঠানে উপস্থিত সকল শিশুর মাঝে বিশেষ পুষ্টিকর দুপুরের খাবার পরিবেশন।',
                        'image_path' => 'assets/images/gallery/portfolio-15.jpg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Scholarship Certificate Presentation',
                        'title_bn' => 'শিক্ষাবৃত্তি সনদ ও পুরস্কার প্রদান',
                        'caption' => 'Recognizing meritorious academic performance among underprivileged students.',
                        'caption_bn' => 'মেধাবী শিক্ষার্থীদের মেধা পুরস্কার ও বৃত্তি সনদ বিতরণ।',
                        'image_path' => 'assets/images/events/events-3.jpg',
                        'is_featured' => true,
                    ],
                ],
            ],
        ];

        // Clean existing to prevent duplicates
        GalleryImage::query()->delete();
        Album::query()->delete();

        foreach ($albumsData as $data) {
            $photos = $data['photos'];
            unset($data['photos']);

            $album = Album::create($data);

            foreach ($photos as $idx => $photo) {
                GalleryImage::create([
                    'album_id' => $album->id,
                    'title' => $photo['title'],
                    'title_bn' => $photo['title_bn'],
                    'caption' => $photo['caption'],
                    'caption_bn' => $photo['caption_bn'],
                    'image_path' => $photo['image_path'],
                    'is_featured' => $photo['is_featured'],
                    'is_active' => true,
                    'sort_order' => $idx + 1,
                ]);
            }
        }

        // Standalone Images without Album (100% verified asset paths)
        $standaloneData = [
            [
                'title' => 'Rotary Youth Leadership Assembly',
                'title_bn' => 'রোটারি যুব নেতৃত্ব ও স্বেচ্ছাসেবক সম্মেলন',
                'caption' => 'Young community builders brainstorming social welfare initiatives in Dhaka.',
                'caption_bn' => 'ঢাকার শান্তিনগরে সমাজসেবামূলক ভবিষ্যৎ পরিকল্পনা তৈরিতে তরুণ স্বেচ্ছাসেবী দলের মিলনমেলা।',
                'image_path' => 'assets/images/news/news-1.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Emergency Disaster Relief Coordination Meeting',
                'title_bn' => 'জরুরি দুর্যোগ ব্যবস্থাপনা সমন্বয় সভা',
                'caption' => 'Executive committee assessing flood vulnerability and logistics readiness.',
                'caption_bn' => 'কার্যনির্বাহী কমিটির জরুরি বন্যা প্রস্তুতি ও লজিস্টিক সমন্বয় সভা।',
                'image_path' => 'assets/images/news/news-2.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Tree Plantation & Environmental Awareness Drive',
                'title_bn' => 'বৃক্ষরোপণ ও পরিবেশ সুরক্ষা অভিযান',
                'caption' => 'Planting fruit and timber saplings in community school compounds.',
                'caption_bn' => 'বিদ্যালয় প্রাঙ্গণে ফলজ ও বনজ বৃক্ষের চারা রোপণ ও পরিবেশ সচেতনতা তৈরি।',
                'image_path' => 'assets/images/news/news-3.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Annual Club Fellowship & Partner Recognition',
                'title_bn' => 'বার্ষিক ক্লাব ফেলোশিপ ও সহযোগী সম্মাননা',
                'caption' => 'Honoring donors, humanitarian doctors, and ground coordinators.',
                'caption_bn' => 'সম্মানিত দাতা, নিবেদিতপ্রাণ চিকিৎসক ও মাঠ সমন্বয়কারীদের সম্মাননা প্রদান।',
                'image_path' => 'assets/images/news/news-6.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Community Hygiene & Cleanliness Campaign',
                'title_bn' => 'পরিচ্ছন্নতা ও স্বাস্থ্যবিধি সচেতনতা র‍্যালি',
                'caption' => 'Spreading hygiene kits and awareness flyers in densely populated areas.',
                'caption_bn' => 'জনবহুল এলাকায় সাবান, মাস্ক ও স্বাস্থ্যসচেতনতামূলক লিফলেট বিতরণ।',
                'image_path' => 'assets/images/news/news-7.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Volunteer First-Aid Readiness Training',
                'title_bn' => 'স্বেচ্ছাসেবক প্রাথমিক চিকিৎসা প্রশিক্ষণ কর্মশালা',
                'caption' => 'Hands-on emergency medical response drills with certified paramedics.',
                'caption_bn' => 'সার্টিফাইড প্যারামেডিকদের নির্দেশনায় জরুরি প্রাথমিক চিকিৎসা প্রশিক্ষণ।',
                'image_path' => 'assets/images/news/news-8.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Flood Relief Supply Packing Drive',
                'title_bn' => 'বন্যা ত্রাণ সামগ্রী প্যাকেজিং কার্যক্রম',
                'caption' => 'Volunteers preparing dry food rations for flood-affected districts.',
                'caption_bn' => 'বন্যাদুর্গত এলাকার জন্য শুকনা খাদ্য সামগ্রীর প্যাকেট প্রস্তুতি।',
                'image_path' => 'assets/images/events/events-4.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Community Eye Care & Cataract Camp',
                'title_bn' => 'বিনামূল্যে চক্ষু সেবা ও ছানি অপারেশন ক্যাম্প',
                'caption' => 'Free optical screenings and distribution of corrective eyeglasses.',
                'caption_bn' => 'বিনামূল্যে চোখের দৃষ্টি পরীক্ষা ও চশমা বিতরণ কর্মসূচি।',
                'image_path' => 'assets/images/events/events-5.jpg',
                'is_featured' => true,
            ],
        ];

        foreach ($standaloneData as $idx => $item) {
            GalleryImage::create([
                'album_id' => null,
                'title' => $item['title'],
                'title_bn' => $item['title_bn'],
                'caption' => $item['caption'],
                'caption_bn' => $item['caption_bn'],
                'image_path' => $item['image_path'],
                'is_featured' => $item['is_featured'],
                'is_active' => true,
                'sort_order' => $idx + 1,
            ]);
        }
    }
}
