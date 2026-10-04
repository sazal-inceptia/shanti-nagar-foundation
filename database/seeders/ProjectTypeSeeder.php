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
                'slug' => 'signature-project',
                'description' => 'Flagship landmark initiatives and major sustainable community infrastructures with high strategic priority.',
                'badge_color' => '#f59e0b',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Continuous Project',
                'slug' => 'continuous-project',
                'description' => 'Always-active relief programs requiring ongoing budget and sustained operational funding (e.g., Free Emergency Medical Aid, Tube-well Maintenance, Orphan Sponsorship).',
                'badge_color' => '#10b981',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Monthly Project',
                'slug' => 'monthly-project',
                'description' => 'Recurring monthly relief drives (e.g., Monthly Grocery Ration Packs, Monthly Widow & Disability Allowances).',
                'badge_color' => '#0284c7',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'General Campaign',
                'slug' => 'general-campaign',
                'description' => 'Standard humanitarian campaigns, emergency seasonal relief distributions, and disaster response drives.',
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
