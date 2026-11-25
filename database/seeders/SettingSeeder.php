<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'org_name' => 'Rotary Club of Shantinagar Dhaka',
            'org_name_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকা',
            'tagline' => 'Dedicated to grassroots humanitarian relief, healthcare aid, and community empowerment in Bangladesh.',
            'tagline_bn' => 'চিকিৎসা সহায়তা, বিশুদ্ধ খাবার পানি, এতিম সেবা ও তৃণমূল মানবিক পুনর্বাসনে নিবেদিত।',
            'hotline' => '+880 1674-888898',
            'contact_person' => 'Shamim Rahman Abir',
            'email' => 'contact@rotaryshantinagardhaka.org',
            'address' => 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh',
            'address_bn' => 'বাড়ি ১২, রোড ৫, শান্তিনগর, ঢাকা-১২১৭, বাংলাদেশ',
            'mission' => 'To bring compassionate, transparent, and direct humanitarian support to underprivileged families across Bangladesh with 100% itemized audit vouchers.',
            'mission_bn' => 'শতভাগ স্বচ্ছতা ও সরাসরি মাঠপর্যায়ের কাজের মাধ্যমে বাংলাদেশের অসহায় মানুষের পাশে মানবিক সাহায্য নিয়ে দাঁড়ানো।',
            'vision' => 'An enlightened society where every individual has access to clean drinking water, dignity, essential healthcare, and education.',
            'vision_bn' => 'এমন একটি সমাজ বিনির্মাণ যেখানে প্রতিটি মানুষের জন্য বিশুদ্ধ পানি, মানবিক মর্যাদা, চিকিৎসাসেবা ও শিক্ষা নিশ্চিত হবে।',
            'bkash_number' => '+880 1915-398213',
            'bkash_account_type' => 'Personal',
            'bkash_merchant_name' => 'Mr. Nasir',
            'bkash_reference_note' => 'Use Donor Mobile No or Project Name as Reference',
            'bkash_instructions_en' => "1. Open bKash App or dial *247#\n2. Select 'Send Money' to Personal bKash Account\n3. Enter bKash Number: 01915-398213 (Mr. Nasir)\n4. Enter Donation Amount (৳)\n5. Enter Reference: Your Mobile Number or Project Name\n6. Enter your PIN to confirm payment\n7. Save Transaction ID (TrxID) and submit below.",
            'bkash_instructions_bn' => "১. আপনার বিকাশ অ্যাপ ওপেন করুন অথবা *২৪৭# ডায়াল করুন।\n২. 'সেন্ড মানি' (পার্সোনাল একাউন্ট) অপশন সিলেক্ট করুন।\n৩. বিকাশ নম্বর দিন: ০১৯১৫-৩৯৮২১৩ (Mr. Nasir)\n৪. অনুদানের টাকার পরিমাণ (৳) লিখুন।\n৫. রেফারেন্সে আপনার মোবাইল নম্বর অথবা প্রজেক্টের নাম লিখুন।\n৬. আপনার বিকাশ পিন (PIN) দিয়ে লেনদেন নিশ্চিত করুন।\n৭. প্রাপ্ত ট্রানজেকশন আইডি (TrxID) সংরক্ষণ করে নিচের ফরমে সাবমিট করুন।",
            'bank_name' => 'Bank Asia PLC',
            'bank_account_name' => 'Rotary Club of Shantinagar Dhaka',
            'bank_account_number' => '03536000022',
            'bank_routing_number' => '070276343',
            'bank_branch' => 'Shantinagar Branch',
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
