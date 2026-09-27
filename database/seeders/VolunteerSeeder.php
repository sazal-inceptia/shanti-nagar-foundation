<?php

namespace Database\Seeders;

use App\Models\Volunteer;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds with authentic Bangladeshi volunteers.
     */
    public function run(): void
    {
        $volunteers = [
            [
                'name' => 'Tanvir Hossain Chowdhury',
                'email' => 'tanvir.chowdhury@gmail.com',
                'phone' => '+880 1711-889900',
                'gender' => 'Male',
                'age_group' => '20+',
                'address' => 'House 22, Road 4, Shanti Nagar, Dhaka-1217',
                'status' => 'approved',
                'notes' => 'Event/Initiative: Emergency Winter Warmth Relief Drive | Experience: Field coordination, relief kit packaging and dispatch logistics for 3+ years in northern districts.',
            ],
            [
                'name' => 'Nusrat Jahan Mim',
                'email' => 'nusrat.mim@gmail.com',
                'phone' => '+880 1819-334455',
                'gender' => 'Female',
                'age_group' => '20+',
                'address' => 'Kakrail Officers Colony, Dhaka-1000',
                'status' => 'approved',
                'notes' => 'Event/Initiative: Free Eye Camp & Cataract Surgeries | Experience: Certified paramedic assistant and medical triage volunteer with Red Crescent society.',
            ],
            [
                'name' => 'Mahmudul Hasan Shuvo',
                'email' => 'mahmud.shuvo@gmail.com',
                'phone' => '+880 1912-667788',
                'gender' => 'Male',
                'age_group' => '30+',
                'address' => 'Shahbagh, Dhaka-1000',
                'status' => 'approved',
                'notes' => 'Event/Initiative: Arsenic-Free Deep Tube-Well Installation | Experience: Mechanical diploma holder with water pump maintenance and ground drilling supervision skills.',
            ],
            [
                'name' => 'Tahmina Akhter Rupa',
                'email' => 'tahmina.rupa@gmail.com',
                'phone' => '+880 1714-223344',
                'gender' => 'Female',
                'age_group' => '20+',
                'address' => 'Mirpur-10, Dhaka-1216',
                'status' => 'pending',
                'notes' => 'Event/Initiative: Orphan Educational Kits & School Bag Distribution | Experience: Primary school teacher interested in child counseling and educational kit distribution.',
            ],
            [
                'name' => 'Rabiul Islam Sohel',
                'email' => 'rabiul.sohel@gmail.com',
                'phone' => '+880 1611-998877',
                'gender' => 'Male',
                'age_group' => '40+',
                'address' => 'Chawkbazar, Old Dhaka-1211',
                'status' => 'approved',
                'notes' => 'Event/Initiative: Ramadan & Seasonal Food Basket Distribution | Experience: Community youth organizer with extensive warehouse storage and supply chain network.',
            ],
            [
                'name' => 'Sadia Afrin',
                'email' => 'sadia.afrin@gmail.com',
                'phone' => '+880 1515-332211',
                'gender' => 'Female',
                'age_group' => '20+',
                'address' => 'Dhanmondi 8/A, Dhaka-1209',
                'status' => 'pending',
                'notes' => 'Event/Initiative: Hospital Wheelchairs & ICU Equipment Aid | Experience: University social work graduate passionate about hospital ward volunteerism.',
            ],
        ];

        foreach ($volunteers as $vol) {
            Volunteer::updateOrCreate(
                ['email' => $vol['email']],
                $vol
            );
        }
    }
}
