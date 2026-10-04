<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds with authentic Bangladeshi NGO contact inquiries.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Dr. Mohammad Shamsul Huda',
                'email' => 'dr.shamsul@dhakamed.edu.bd',
                'phone' => '+880 1711-445566',
                'subject' => 'Emergency Dialysis Kit Donation for General Hospital',
                'message' => 'Assalamu Alaikum. We would like to coordinate a joint healthcare initiative with Rotary Club of Shantinagar Dhaka to supply 50 emergency dialysis kits and nebulizers to the charity ward of Dhaka Medical College. Please let us know the procurement and handover procedure.',
                'status' => 'unread',
            ],
            [
                'name' => 'Engineer Tanvir Ahmed',
                'email' => 'tanvir.engr@beximco.net',
                'phone' => '+880 1819-223344',
                'subject' => 'Corporate Zakat Contribution & Tube-well Installation',
                'message' => 'Our engineering association wants to fund 5 deep arsenic-free tube-wells in drought-prone areas of Kurigram and Gaibandha. We request a detailed cost estimation and volunteer installation plan.',
                'status' => 'read',
            ],
            [
                'name' => 'Fatema Sultana',
                'email' => 'fatema.sultana.dhk@gmail.com',
                'phone' => '+880 1912-778899',
                'subject' => 'Orphan Winter Blanket & Educational Supplies Distribution',
                'message' => 'Hello. I want to donate 100 warm blankets and 50 school stationery bags for orphan children in the Shanti Nagar and Kakrail area. How can I deliver them to your central office?',
                'status' => 'read',
            ],
            [
                'name' => 'Kazi Farhanur Rahman',
                'email' => 'kazi.farhan@northsouth.edu',
                'phone' => '+880 1713-998877',
                'subject' => 'Student Community Engagement & Flood Relief Drive',
                'message' => 'We are a group of 30 university students interested in volunteering with your upcoming flood relief kit packaging and dispatch wing. Please guide us through the team onboarding process.',
                'status' => 'unread',
            ],
            [
                'name' => 'Mrs. Nazmun Nahar',
                'email' => 'nazmun.nahar@uttara.com',
                'phone' => '+880 1611-332211',
                'subject' => 'Direct Bank Wire Donation Confirmation Receipt',
                'message' => 'I have transferred BDT 30,000 via City Bank online banking for the Cataract Surgery & Eye Camp program. Transaction reference is CTB-789214. Kindly issue the official serial money receipt.',
                'status' => 'read',
            ],
        ];

        foreach ($messages as $msg) {
            ContactMessage::updateOrCreate(
                ['email' => $msg['email'], 'subject' => $msg['subject']],
                $msg
            );
        }
    }
}
