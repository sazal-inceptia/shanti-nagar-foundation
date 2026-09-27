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
            'tagline' => ['nullable', 'string', 'max:500'],
            'hotline' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
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
