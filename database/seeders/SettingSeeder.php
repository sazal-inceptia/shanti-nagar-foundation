<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'org_name' => 'Shanti Nagar Foundation',
            'tagline' => 'Dedicated to grassroots humanitarian relief, healthcare aid, and community empowerment in Bangladesh.',
            'hotline' => '+880 1711-000000',
            'email' => 'contact@shantinagar.org',
            'address' => 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh',
            'bkash_number' => '+880 1711-223344 (Merchant)',
            'nagad_number' => '+880 1811-556677 (Merchant)',
            'bank_name' => 'Islami Bank Bangladesh Ltd / City Bank',
            'bank_account_name' => 'Shanti Nagar Foundation Bangladesh',
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
