<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display general system and organization settings.
     */
    public function index(): View
    {
        $dbSettings = Setting::getAll();

        $defaults = [
            'org_name' => 'Rotary Club of Shantinagar Dhaka',
            'org_name_bn' => 'রোটারি ক্লাব অব শান্তিনগর ঢাকা',
            'tagline' => 'Dedicated to grassroots humanitarian relief, healthcare aid, and community empowerment in Bangladesh.',
            'tagline_bn' => 'তৃণমূল পর্যায়ে মানবিক ত্রাণ, স্বাস্থ্যসেবা ও সমাজের ক্ষমতায়নে নিবেদিত রোটারি ক্লাব অব শান্তিনগর ঢাকা।',
            'hotline' => '+880 1711-000000',
            'email' => 'contact@rotaryshantinagardhaka.org',
            'address' => 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh',
            'address_bn' => 'বাড়ি ১২, রোড ৫, শান্তি নগর, ঢাকা-১২১৭, বাংলাদেশ',
            'mission' => 'To provide service to others, promote integrity, and advance world understanding, goodwill, and peace through fellowship of business, professional, and community leaders.',
            'mission_bn' => 'মানবসেবা প্রদান, সততা প্রসার এবং নেতৃত্ব ও সমাজসেবকদের সহযোগিতার মাধ্যমে সার্বিক শান্তি ও টেকসই উন্নয়ন প্রতিষ্ঠা করা।',
            'vision' => 'Together, we see a world where people unite and take action to create lasting change across our communities and across the globe.',
            'vision_bn' => 'একটি বৈষম্যহীন সুন্দর সমাজ বিনির্মাণ যেখানে ঐক্যবদ্ধ প্রচেষ্টায় মানবিক স্থায়ী উন্নয়ন বাস্তবায়িত হবে।',
            'bkash_number' => '+880 1711-223344 (Merchant)',
            'nagad_number' => '+880 1811-556677 (Merchant)',
            'bank_name' => 'Islami Bank Bangladesh Ltd / City Bank',
            'bank_account_name' => 'Rotary Club of Shantinagar Dhaka',
            'bank_account_number' => '2050 3820 1000 8941',
            'bank_branch' => 'Shanti Nagar Branch, Dhaka',
            'currency' => 'BDT (৳)',
        ];

        $settings = array_merge($defaults, $dbSettings);

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update system and foundation settings in the database.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'org_name' => ['required', 'string', 'max:255'],
            'org_name_bn' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:500'],
            'tagline_bn' => ['nullable', 'string', 'max:500'],
            'hotline' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_bn' => ['nullable', 'string', 'max:255'],
            'mission' => ['nullable', 'string'],
            'mission_bn' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'vision_bn' => ['nullable', 'string'],
            'bkash_number' => ['nullable', 'string', 'max:100'],
            'nagad_number' => ['nullable', 'string', 'max:100'],
            'bank_name' => ['nullable', 'string', 'max:150'],
            'bank_account_name' => ['nullable', 'string', 'max:150'],
            'bank_account_number' => ['nullable', 'string', 'max:100'],
            'bank_branch' => ['nullable', 'string', 'max:150'],
            'currency' => ['nullable', 'string', 'max:20'],
        ]);

        foreach ($validated as $key => $value) {
            $group = str_contains($key, 'bank') || str_contains($key, 'bkash') || str_contains($key, 'nagad') || $key === 'currency' ? 'payment' : 'general';
            Setting::set($key, $value, $group);
        }

        return redirect()->back()->with('success', 'Organization and system settings updated successfully.');
    }
}
