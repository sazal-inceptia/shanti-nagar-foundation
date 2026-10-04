<?php

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
