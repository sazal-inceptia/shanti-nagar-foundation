<?php

namespace Database\Seeders;

use App\Models\Donor;
use Illuminate\Database\Seeder;

class DonorSeeder extends Seeder
{
    public function run(): void
    {
        $donors = [
            [
                'name' => 'Alhaj Noor Mohammad',
                'email' => 'noor.mohammad@gmail.com',
                'phone' => '+8801711223344',
                'address' => 'House 22, Road 5, Shanti Nagar',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'donor_type' => 'individual',
                'is_anonymous' => false,
                'notes' => 'Regular monthly donor for hospital and orphan welfare projects.',
            ],
            [
                'name' => 'Engr. Mahbubur Rahman',
                'email' => 'mahbub.engr@yahoo.com',
                'phone' => '+8801819887766',
                'address' => 'Flat 4B, Shanti Nagar Officers Quarter',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'donor_type' => 'individual',
                'is_anonymous' => false,
                'notes' => 'Contributes annually for winter relief & tube-well installations.',
            ],
            [
                'name' => 'Dr. Farhana Yasmin',
                'email' => 'dr.farhana@medicare.com.bd',
                'phone' => '+8801912345678',
                'address' => 'Kakrail VIP Road',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'donor_type' => 'individual',
                'is_anonymous' => false,
                'notes' => 'Medical camp coordinator and medical aid donor.',
            ],
            [
                'name' => 'Santi Nagar Business Welfare Trust',
                'email' => 'trust@shantinagarbusiness.org',
                'phone' => '+88029345678',
                'address' => 'Shanti Nagar Plaza, Level 3',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'donor_type' => 'organization',
                'is_anonymous' => false,
                'notes' => 'Institutional sponsor for emergency flood relief drives.',
            ],
            [
                'name' => 'Tariqul Islam (Expatriate, UK)',
                'email' => 'tariqul.london@gmail.com',
                'phone' => '+447911123456',
                'address' => 'London, UK (Origin: Shanti Nagar)',
                'city' => 'London',
                'country' => 'United Kingdom',
                'donor_type' => 'individual',
                'is_anonymous' => false,
                'notes' => 'Remits Zakat for education scholarships.',
            ],
            [
                'name' => 'Well-wisher (Anonymous)',
                'email' => null,
                'phone' => null,
                'address' => 'Dhaka, Bangladesh',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'donor_type' => 'individual',
                'is_anonymous' => true,
                'notes' => 'Cash contribution to the general relief fund.',
            ],
        ];

        foreach ($donors as $donorData) {
            Donor::updateOrCreate(
                ['name' => $donorData['name']],
                $donorData
            );
        }
    }
}
