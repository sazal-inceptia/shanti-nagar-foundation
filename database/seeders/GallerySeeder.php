<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds with authentic curated asset files.
     */
    public function run(): void
    {
        $albumsData = [
            [
                'title' => 'Hospital Medical Aid & Health Outreach',
                'title_bn' => 'হাসপাতাল চিকিৎসা সামগ্রী ও স্বাস্থ্য সেবা',
                'slug' => 'health-and-medical-aid',
                'description' => 'Multi-club healthcare partnerships providing diagnostic monitors and clinical equipment to public maternity hospitals.',
                'description_bn' => 'আজিমপুর মাতৃসদন হাসপাতালে অত্যাধুনিক চিকিৎসা সরঞ্জাম প্রদান ও মা-শিশুর স্বাস্থ্য সুরক্ষা কর্মসূচি।',
                'cover_image' => 'assets/images/gallery-albums/health-and-medical-aid/medical-delegation-angled-group.jpeg',
                'event_date' => '2026-03-20',
                'is_active' => true,
                'sort_order' => 1,
                'photos' => [
                    [
                        'title' => 'Hospital Medical Aid & Health Outreach - Moment 1',
                        'title_bn' => 'হাসপাতাল চিকিৎসা সামগ্রী ও স্বাস্থ্য সেবা - মুহূর্ত 1',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/health-and-medical-aid/medical-delegation-angled-group.jpeg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Hospital Medical Aid & Health Outreach - Moment 2',
                        'title_bn' => 'হাসপাতাল চিকিৎসা সামগ্রী ও স্বাস্থ্য সেবা - মুহূর্ত 2',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/health-and-medical-aid/medical-devices-inspection-unboxing.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Hospital Medical Aid & Health Outreach - Moment 3',
                        'title_bn' => 'হাসপাতাল চিকিৎসা সামগ্রী ও স্বাস্থ্য সেবা - মুহূর্ত 3',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/health-and-medical-aid/medical-equipment-banner-details.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Hospital Medical Aid & Health Outreach - Moment 4',
                        'title_bn' => 'হাসপাতাল চিকিৎসা সামগ্রী ও স্বাস্থ্য সেবা - মুহূর্ত 4',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/health-and-medical-aid/medical-equipment-hospital-handover.jpeg',
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'title' => 'Pushti Nutrition Box & Maternal Welfare',
                'title_bn' => 'গর্ভবতী মায়েদের পুষ্টি বক্স ও মানবিক ত্রাণ',
                'slug' => 'community-service-and-relief',
                'description' => 'Direct distribution of vital nutritional support kits to expectant and new mothers across Dhaka.',
                'description_bn' => 'সুবিধাবঞ্চিত গর্ভবতী ও দুগ্ধদানকারী মায়েদের মাঝে প্রোটিন ও পুষ্টিকর খাদ্য বিতরণ কর্মসূচি।',
                'cover_image' => 'assets/images/gallery-albums/community-service-and-relief/mother-cradling-newborn.jpeg',
                'event_date' => '2026-02-15',
                'is_active' => true,
                'sort_order' => 2,
                'photos' => [
                    [
                        'title' => 'Pushti Nutrition Box & Maternal Welfare - Moment 1',
                        'title_bn' => 'গর্ভবতী মায়েদের পুষ্টি বক্স ও মানবিক ত্রাণ - মুহূর্ত 1',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/community-service-and-relief/mother-cradling-newborn.jpeg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Pushti Nutrition Box & Maternal Welfare - Moment 2',
                        'title_bn' => 'গর্ভবতী মায়েদের পুষ্টি বক্স ও মানবিক ত্রাণ - মুহূর্ত 2',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/community-service-and-relief/pushti-boxes-stack.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Pushti Nutrition Box & Maternal Welfare - Moment 3',
                        'title_bn' => 'গর্ভবতী মায়েদের পুষ্টি বক্স ও মানবিক ত্রাণ - মুহূর্ত 3',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/community-service-and-relief/pushti-nutrition-handover-mother.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Pushti Nutrition Box & Maternal Welfare - Moment 4',
                        'title_bn' => 'গর্ভবতী মায়েদের পুষ্টি বক্স ও মানবিক ত্রাণ - মুহূর্ত 4',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/community-service-and-relief/water-filter-technical-setup.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Pushti Nutrition Box & Maternal Welfare - Moment 5',
                        'title_bn' => 'গর্ভবতী মায়েদের পুষ্টি বক্স ও মানবিক ত্রাণ - মুহূর্ত 5',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/community-service-and-relief/water-purifier-installation-children.jpeg',
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'title' => 'Official Club Visit (OCV) & Leadership Assembly',
                'title_bn' => 'অফিসিয়াল ক্লাব ভিজিট (OCV) ও বার্ষিক অভিষেক',
                'slug' => 'club-governance-and-meetings',
                'description' => 'Flagship governance sessions, secretarial reporting, and strategic service planning with District Governors.',
                'description_bn' => 'জেলা গভর্নরের উপস্থিতিতে ক্লাবের বার্ষিক পরিদর্শন, সুশাসন সম্মেলন ও ভবিষ্যৎ কর্মপরিকল্পনা অধিবেশন।',
                'cover_image' => 'assets/images/gallery-albums/club-governance-and-meetings/ocv-board-officers-lineup.jpeg',
                'event_date' => '2026-07-31',
                'is_active' => true,
                'sort_order' => 3,
                'photos' => [
                    [
                        'title' => 'Official Club Visit (OCV) & Leadership Assembly - Moment 1',
                        'title_bn' => 'অফিসিয়াল ক্লাব ভিজিট (OCV) ও বার্ষিক অভিষেক - মুহূর্ত 1',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/club-governance-and-meetings/ocv-board-officers-lineup.jpeg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Official Club Visit (OCV) & Leadership Assembly - Moment 2',
                        'title_bn' => 'অফিসিয়াল ক্লাব ভিজিট (OCV) ও বার্ষিক অভিষেক - মুহূর্ত 2',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/club-governance-and-meetings/ocv-general-assembly-portrait.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Official Club Visit (OCV) & Leadership Assembly - Moment 3',
                        'title_bn' => 'অফিসিয়াল ক্লাব ভিজিট (OCV) ও বার্ষিক অভিষেক - মুহূর্ত 3',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/club-governance-and-meetings/ocv-honorary-crest-exchange.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Official Club Visit (OCV) & Leadership Assembly - Moment 4',
                        'title_bn' => 'অফিসিয়াল ক্লাব ভিজিট (OCV) ও বার্ষিক অভিষেক - মুহূর্ত 4',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/club-governance-and-meetings/ocv-keynote-address-projector-logo.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Official Club Visit (OCV) & Leadership Assembly - Moment 5',
                        'title_bn' => 'অফিসিয়াল ক্লাব ভিজিট (OCV) ও বার্ষিক অভিষেক - মুহূর্ত 5',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/club-governance-and-meetings/ocv-meeting-hall-panorama.jpeg',
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'title' => 'Rotary Honors, Awards & District Recognition',
                'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি',
                'slug' => 'awards-and-recognition',
                'description' => 'Celebration of club milestones, Paul Harris Fellows (PHF), and outstanding humanitarian contributions.',
                'description_bn' => 'ক্লাবের গৌরবময় সেবা কাজের স্বীকৃতি, সম্মাননা ক্রেস্ট গ্রহণ ও ফেলোশিপ উদযাপন।',
                'cover_image' => 'assets/images/gallery-albums/awards-and-recognition/bod-dinner-certificates-row.jpeg',
                'event_date' => '2026-08-04',
                'is_active' => true,
                'sort_order' => 4,
                'photos' => [
                    [
                        'title' => 'Rotary Honors, Awards & District Recognition - Moment 1',
                        'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি - মুহূর্ত 1',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/awards-and-recognition/bod-dinner-certificates-row.jpeg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Rotary Honors, Awards & District Recognition - Moment 2',
                        'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি - মুহূর্ত 2',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/awards-and-recognition/conference-trophy-celebration-wide.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Honors, Awards & District Recognition - Moment 3',
                        'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি - মুহূর্ত 3',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/awards-and-recognition/district-conference-stage-lineup.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Honors, Awards & District Recognition - Moment 4',
                        'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি - মুহূর্ত 4',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/awards-and-recognition/district-stage-award-ceremony.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Honors, Awards & District Recognition - Moment 5',
                        'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি - মুহূর্ত 5',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/awards-and-recognition/gold-assistant-coordinator-trophy.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Honors, Awards & District Recognition - Moment 6',
                        'title_bn' => 'রোটারি সম্মাননা, ক্রেস্ট ও জেলা স্বীকৃতি - মুহূর্ত 6',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/awards-and-recognition/rotary-pinning-induction-ceremony.jpeg',
                        'is_featured' => false,
                    ],
                ],
            ],
            [
                'title' => 'Rotary Fellowship & Leadership Conventions',
                'title_bn' => 'রোটারি ফেলোশিপ ও সম্মেলন ২০২৬',
                'slug' => 'fellowship-and-conventions',
                'description' => 'Bringing Rotarians, youths, and community leaders together in the spirit of service and brotherhood.',
                'description_bn' => 'সদস্যদের পারস্পরিক সৌহার্দ্য, রোটারিয়ান মিলনমেলা ও নেতৃত্ব সম্মেলন।',
                'cover_image' => 'assets/images/gallery-albums/fellowship-and-conventions/balloon-arch-festive-fellowship.jpeg',
                'event_date' => '2026-01-23',
                'is_active' => true,
                'sort_order' => 5,
                'photos' => [
                    [
                        'title' => 'Rotary Fellowship & Leadership Conventions - Moment 1',
                        'title_bn' => 'রোটারি ফেলোশিপ ও সম্মেলন ২০২৬ - মুহূর্ত 1',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/fellowship-and-conventions/balloon-arch-festive-fellowship.jpeg',
                        'is_featured' => true,
                    ],
                    [
                        'title' => 'Rotary Fellowship & Leadership Conventions - Moment 2',
                        'title_bn' => 'রোটারি ফেলোশিপ ও সম্মেলন ২০২৬ - মুহূর্ত 2',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/fellowship-and-conventions/club-dinner-fellowship-portrait.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Fellowship & Leadership Conventions - Moment 3',
                        'title_bn' => 'রোটারি ফেলোশিপ ও সম্মেলন ২০২৬ - মুহূর্ত 3',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/fellowship-and-conventions/conference-banquet-dining-hall.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Fellowship & Leadership Conventions - Moment 4',
                        'title_bn' => 'রোটারি ফেলোশিপ ও সম্মেলন ২০২৬ - মুহূর্ত 4',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/fellowship-and-conventions/membership-seminar-auditorium-crowd.jpeg',
                        'is_featured' => false,
                    ],
                    [
                        'title' => 'Rotary Fellowship & Leadership Conventions - Moment 5',
                        'title_bn' => 'রোটারি ফেলোশিপ ও সম্মেলন ২০২৬ - মুহূর্ত 5',
                        'caption' => 'Rotary humanitarian field moment in Dhaka.',
                        'caption_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকার মানবিক কার্যক্রম।',
                        'image_path' => 'assets/images/gallery-albums/fellowship-and-conventions/membership-seminar-stage-finale.jpeg',
                        'is_featured' => false,
                    ],
                ],
            ],
        ];

        foreach ($albumsData as $data) {
            $photos = $data['photos'];
            unset($data['photos']);

            $album = Album::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );

            foreach ($photos as $index => $photo) {
                GalleryImage::updateOrCreate(
                    [
                        'album_id' => $album->id,
                        'image_path' => $photo['image_path'],
                    ],
                    [
                        'title' => $photo['title'],
                        'title_bn' => $photo['title_bn'],
                        'caption' => $photo['caption'],
                        'caption_bn' => $photo['caption_bn'],
                        'is_featured' => $photo['is_featured'],
                        'is_active' => true,
                        'sort_order' => $index + 1,
                    ]
                );
            }
        }

        // Standalone Curated Moments
        $standaloneImages = [
            [
                'title' => 'Rotary International Environmental Tree Legacy',
                'title_bn' => 'পরিবেশ সুরক্ষা ও সবুজায়ন বৃক্ষ কর্মসূচি',
                'caption' => 'Green Bangladesh initiative championing environmental sustainability and tree plantation.',
                'caption_bn' => 'সবুজ বাংলাদেশ ও জলবায়ু সুরক্ষায় বৃক্ষরোপণ কর্মসূচি।',
                'image_path' => 'assets/images/standalone/branding-rotary-international-tree.jpeg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'BAM Auditorium Grand Convention & Assembly',
                'title_bn' => 'বিশ্ব সাহিত্য কেন্দ্র অডিটোরিয়াম মহাসম্মেলন',
                'caption' => 'District leadership, Rotarians, and youth fellows gathering for community empowerment.',
                'caption_bn' => 'রোটারি সদস্য ও যুব প্রতিনিধিদের অংশগ্রহণে মহাসম্মেলন।',
                'image_path' => 'assets/images/standalone/hero-auditorium-grand-convention.jpeg',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Rotary Fellowship & Brotherhood Assembly',
                'title_bn' => 'রোটারি সৌহার্দ্য ও ভ্রাতৃত্ব সম্মিলন',
                'caption' => 'Rotary leaders uniting in service above self for community development.',
                'caption_bn' => 'সেবার ব্রতে ঐক্যবদ্ধ শান্তিনগর রোটারি পরিবার।',
                'image_path' => 'assets/images/standalone/hero-club-fellowship-portrait.jpeg',
                'is_featured' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Maternal & Neonatal Healthcare Equipment Handover',
                'title_bn' => 'মাতৃ ও নবজাতক চিকিৎসা যন্ত্রপাতি প্রদান',
                'caption' => 'Supplying life-saving medical devices to public hospital maternity wards.',
                'caption_bn' => 'আজিমপুর মাতৃসদন হাসপাতালে আধুনিক চিকিৎসা সামগ্রী হস্তান্তর।',
                'image_path' => 'assets/images/standalone/impact-healthcare-medical-aid.jpeg',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Safe Drinking Water Installation for Children',
                'title_bn' => 'মাদরাসা শিশুদের জন্য সুপেয় বিশুদ্ধ পানি প্ল্যান্ট',
                'caption' => 'Providing mineral-balanced clean drinking water to over 200 madrasa students.',
                'caption_bn' => '২০০+ এতিম ও মাদরাসা শিক্ষার্থীর জন্য নিরাপদ পানির সুব্যবস্থা।',
                'image_path' => 'assets/images/standalone/impact-safe-water-for-children.jpeg',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Women in Rotary & Grassroots Humanitarian Leadership',
                'title_bn' => 'রোটারিতে নারী নেতৃত্ব ও সামাজিক ক্ষমতায়ন',
                'caption' => 'Championing female leadership and mother-child welfare initiatives across Dhaka.',
                'caption_bn' => 'মা ও শিশুর পুষ্টি নিশ্চিতকরণে নারী নেতৃত্বের অগ্রণী ভূমিকা।',
                'image_path' => 'assets/images/standalone/impact-women-leadership-rotary.jpeg',
                'is_featured' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($standaloneImages as $item) {
            GalleryImage::updateOrCreate(
                [
                    'album_id' => null,
                    'image_path' => $item['image_path'],
                ],
                $item
            );
        }
    }
}
