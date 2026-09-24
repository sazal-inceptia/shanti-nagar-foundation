<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'name' => 'Hospital Equipment & Ceiling Fan Donation Drive',
                'slug' => 'hospital-equipment-fan-donation-drive',
                'category' => 'Healthcare & Hospital',
                'short_description' => 'Providing high-speed ceiling fans and emergency patient monitors to government rural healthcare complexes.',
                'description' => 'Shanti Nagar Foundation identified severe lack of cooling and basic patient support in local hospital wards. Under this project, 50 heavy-duty ceiling fans and basic patient monitoring equipment were supplied and installed in general wards to ensure patient comfort.',
                'estimated_cost' => 150000.00,
                'total_expense' => 142000.00,
                'start_date' => now()->addDays(15),
                'completion_date' => null,
                'status' => 'planned',
                'location' => 'Dhaka Medical College & Hospital',
                'featured_image' => 'assets/images/events/events-4.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-7.jpg',
                    'assets/images/gallery/portfolio-11.jpg',
                    'assets/images/gallery/portfolio-14.jpg',
                ]
            ],
            [
                'name' => 'Nutritious Food & Education Kit for Orphan Children',
                'slug' => 'nutritious-food-education-kit-orphans',
                'category' => 'Orphan Support',
                'short_description' => 'Comprehensive food supplies, school bags, notebooks, and stationery for 120+ underprivileged orphan children.',
                'description' => 'Ensuring proper nutrition and quality basic education tools for orphaned children across local shelter homes and madrasas in Shanti Nagar area to secure their future.',
                'estimated_cost' => 85000.00,
                'total_expense' => 85000.00,
                'start_date' => now()->addDays(28),
                'completion_date' => null,
                'status' => 'planned',
                'location' => 'Shanti Nagar Orphanage, Dhaka',
                'featured_image' => 'assets/images/events/events-5.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-8.jpg',
                    'assets/images/gallery/portfolio-13.jpg',
                ]
            ],
            [
                'name' => 'Warm Blankets & Winter Clothes Relief Drive',
                'slug' => 'warm-blankets-winter-clothes-relief',
                'category' => 'Winter & Flood Relief',
                'short_description' => 'Distributing heavy winter blankets and warm garments to destitute families in cold wave-affected northern districts.',
                'description' => 'Every winter, extreme cold hits northern Bangladesh. Our volunteers directly distribute high-quality thermal blankets and children warm clothes from door to door.',
                'estimated_cost' => 200000.00,
                'total_expense' => 195000.00,
                'start_date' => now()->subMonths(1),
                'completion_date' => now()->subDays(5),
                'status' => 'completed',
                'location' => 'Kurigram & Nilphamari, Rangpur',
                'featured_image' => 'assets/images/events/events-6.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-9.jpg',
                    'assets/images/gallery/portfolio-12.jpg',
                    'assets/images/gallery/portfolio-15.jpg',
                ]
            ],
            [
                'name' => 'Deep Tube-well & Clean Drinking Water Installation',
                'slug' => 'deep-tube-well-clean-water-installation',
                'category' => 'Safe Water',
                'short_description' => 'Installing arsenic-free deep tube-wells to deliver safe drinking water to remote rural villages.',
                'description' => 'Access to uncontaminated drinking water prevents deadly waterborne diseases. We bore 800+ ft deep tube-wells with concrete washing platforms for permanent public use.',
                'estimated_cost' => 120000.00,
                'total_expense' => 118000.00,
                'start_date' => now()->subMonths(2),
                'completion_date' => now()->subMonths(1),
                'status' => 'completed',
                'location' => 'Sunamganj Haor Region',
                'featured_image' => 'assets/images/events/events-7.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-10.jpg',
                ]
            ],
            [
                'name' => 'Free Friday Medical Camp & Essential Medicine Supply',
                'slug' => 'free-medical-camp-medicine-supply',
                'category' => 'Healthcare & Hospital',
                'short_description' => 'Specialist doctors provide free health consultations, eye checkups, and prescription medicines for poor communities.',
                'description' => 'Over 450 underprivileged patients receive doctor consultations, diabetes tests, and complete 1-month prescription medicines free of cost.',
                'estimated_cost' => 95000.00,
                'total_expense' => 90000.00,
                'start_date' => now()->addDays(40),
                'completion_date' => null,
                'status' => 'planned',
                'location' => 'Dhaka Slum Areas, Bangladesh',
                'featured_image' => 'assets/images/events/events-8.jpg',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-11.jpg',
                    'assets/images/gallery/portfolio-14.jpg',
                ]
            ],
            [
                'name' => 'Emergency Food Packages for Flood-Affected Families',
                'slug' => 'emergency-flood-food-packages',
                'category' => 'Winter & Flood Relief',
                'short_description' => 'Emergency dry food rations, water purification tablets, and hygiene kits for marooned families.',
                'description' => 'During flash floods, dry rations (rice, lentils, oil, biscuits, oral saline) are hand-delivered via boats to stranded villagers in remote floodplains.',
                'estimated_cost' => 300000.00,
                'total_expense' => 292000.00,
                'start_date' => now()->subMonths(3),
                'completion_date' => now()->subMonths(2),
                'status' => 'completed',
                'location' => 'Feni, Noakhali & Cumilla',
                'featured_image' => 'assets/images/events/events-9.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-12.jpg',
                    'assets/images/gallery/portfolio-15.jpg',
                ]
            ],
            [
                'name' => 'Feed Nutritious Meals to Poor Rural Children',
                'slug' => 'feed-nutritious-meals-poor-children',
                'category' => 'Orphan Support',
                'short_description' => 'Providing warm, balanced lunch meals and protein supplements to children in village schools.',
                'description' => 'Combating severe childhood malnutrition by providing cooked hot meals, eggs, bananas, and clean drinking water to over 250 school students every week.',
                'estimated_cost' => 80000.00,
                'total_expense' => 42000.00,
                'start_date' => now()->subDays(10),
                'completion_date' => null,
                'status' => 'in_progress',
                'location' => 'Gazipur Rural Area',
                'featured_image' => 'assets/images/case/case-7.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-8.jpg',
                    'assets/images/gallery/portfolio-13.jpg',
                ]
            ],
            [
                'name' => 'Wheelchairs & Assistive Devices for Disabled Individuals',
                'slug' => 'wheelchairs-assistive-devices-disabled',
                'category' => 'Healthcare & Hospital',
                'short_description' => 'Empowering physically challenged individuals with customized wheelchairs, walking aids, and medical devices.',
                'description' => 'Restoring mobility and dignity to low-income disabled citizens by distributing durable wheelchairs and crutches along with basic physiotherapy guidelines.',
                'estimated_cost' => 50000.00,
                'total_expense' => 38000.00,
                'start_date' => now()->subDays(20),
                'completion_date' => null,
                'status' => 'in_progress',
                'location' => 'Mirpur & Shanti Nagar, Dhaka',
                'featured_image' => 'assets/images/case/case-8.jpg',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-14.jpg',
                    'assets/images/gallery/portfolio-7.jpg',
                ]
            ],
            [
                'name' => 'Primary Education Support & Scholarships for Underprivileged Girls',
                'slug' => 'primary-education-scholarships-girls',
                'category' => 'Orphan Support',
                'short_description' => 'Tuition fees, textbooks, uniforms, and stationery stipends to keep rural girls in school.',
                'description' => 'Preventing early child dropout and child marriage by providing full annual educational stipends and uniforms for 80 young female students in poverty-stricken regions.',
                'estimated_cost' => 90000.00,
                'total_expense' => 52000.00,
                'start_date' => now()->subDays(15),
                'completion_date' => null,
                'status' => 'in_progress',
                'location' => 'Mymensingh Rural Sub-district',
                'featured_image' => 'assets/images/case/case-9.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-8.jpg',
                    'assets/images/gallery/portfolio-9.jpg',
                ]
            ],
            [
                'name' => 'Medical Assistance & Surgery Fund for Poor Patients',
                'slug' => 'medical-assistance-surgery-fund',
                'category' => 'Healthcare & Hospital',
                'short_description' => 'Emergency cash assistance and hospital bill grants for life-saving surgeries and specialized treatments.',
                'description' => 'Direct financial grants to government hospital patients unable to afford emergency operations, cardiac medication, chemotherapy cycles, or dialysis treatments.',
                'estimated_cost' => 150000.00,
                'total_expense' => 95000.00,
                'start_date' => now()->subMonths(1),
                'completion_date' => null,
                'status' => 'in_progress',
                'location' => 'National Institute of Diseases, Dhaka',
                'featured_image' => 'assets/images/case/case-10.jpg',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-11.jpg',
                    'assets/images/gallery/portfolio-14.jpg',
                ]
            ],
            [
                'name' => 'Tree Plantation & Environmental Green Campaign',
                'slug' => 'tree-plantation-environmental-campaign',
                'category' => 'Safe Water',
                'short_description' => 'Planting 5,000+ fruit-bearing and timber saplings across schools and village embankments.',
                'description' => 'Protecting against river erosion and climate change while promoting rural economic sustenance through large-scale fruit and medicinal tree sapling distribution.',
                'estimated_cost' => 60000.00,
                'total_expense' => 48000.00,
                'start_date' => now()->subMonths(2),
                'completion_date' => now()->subMonths(1),
                'status' => 'completed',
                'location' => 'Sarisabari, Jamalpur',
                'featured_image' => 'assets/images/case/case-11.jpg',
                'is_featured' => false,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-10.jpg',
                ]
            ],
            [
                'name' => 'Daily Iftar & Ramadan Food Rations for Destitute Families',
                'slug' => 'ramadan-iftar-food-rations',
                'category' => 'Winter & Flood Relief',
                'short_description' => 'Nutritious grocery rations for 300+ fasting low-income families during Holy Ramadan.',
                'description' => 'Distributing essential Ramadan grocery packs (fine dates, chickpeas, oil, puffed rice, sugar, tang) directly to daily-wage workers and widow-led households.',
                'estimated_cost' => 180000.00,
                'total_expense' => 175000.00,
                'start_date' => now()->subMonths(5),
                'completion_date' => now()->subMonths(4),
                'status' => 'completed',
                'location' => 'Shanti Nagar & Malibagh, Dhaka',
                'featured_image' => 'assets/images/case/case-12.jpg',
                'is_featured' => true,
                'is_published' => true,
                'images' => [
                    'assets/images/gallery/portfolio-15.jpg',
                    'assets/images/gallery/portfolio-12.jpg',
                ]
            ],
        ];

        foreach ($projects as $item) {
            $images = $item['images'] ?? [];
            unset($item['images']);

            $project = Project::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );

            // Seed associated project gallery documentation images
            foreach ($images as $index => $imgPath) {
                ProjectImage::updateOrCreate(
                    [
                        'project_id' => $project->id,
                        'image_path' => $imgPath,
                    ],
                    [
                        'caption' => $project->name . ' - Documentation Photo ' . ($index + 1),
                        'sort_order' => $index,
                    ]
                );
            }
        }
    }
}
