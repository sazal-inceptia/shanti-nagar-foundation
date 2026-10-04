<?php

use App\Models\Project;
use App\Models\ProjectType;

test('default locale is en and can be switched to bn via route', function () {
    $response = $this->get(route('home'));
    $response->assertStatus(200);

    // Switch to bn
    $switchResponse = $this->get(route('switch.lang', 'bn'));
    $switchResponse->assertSessionHas('locale', 'bn');

    // Access home in bn
    $bnResponse = $this->withSession(['locale' => 'bn'])->get(route('home'));
    $bnResponse->assertStatus(200);
    $bnResponse->assertSee('হোম');
    $bnResponse->assertSee('দান করুন');

    // Switch back to en
    $switchEn = $this->get(route('switch.lang', 'en'));
    $switchEn->assertSessionHas('locale', 'en');
});

test('models return localized attributes in bn and fallback to en if missing', function () {
    $type = ProjectType::create([
        'name' => 'Signature Healthcare Initiative',
        'name_bn' => 'বিশেষ স্বাস্থ্যসেবা উদ্যোগ',
        'slug' => 'signature-healthcare-test',
    ]);

    $project = Project::create([
        'name' => 'Hospital Oxygen Support',
        'name_bn' => 'হাসপাতাল অক্সিজেন সহায়তা',
        'slug' => 'hospital-oxygen-support-test',
        'short_description' => 'Supplying medical oxygen cylinders.',
        'short_description_bn' => 'মেডিকেল অক্সিজেন সিলিন্ডার সরবরাহ।',
        'description' => 'Ensuring oxygen supply for intensive care wards.',
        'description_bn' => 'জরুরি ওয়ার্ডে অক্সিজেন সরবরাহ নিশ্চিতকরণ।',
        'location' => 'Dhaka Medical',
        'location_bn' => 'ঢাকা মেডিকেল',
        'project_type_id' => $type->id,
        'estimated_cost' => 50000,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    // Test in EN
    app()->setLocale('en');
    expect($project->localized_name)->toBe('Hospital Oxygen Support');
    expect($project->localized_short_description)->toBe('Supplying medical oxygen cylinders.');
    expect($project->localized_location)->toBe('Dhaka Medical');
    expect($type->localized_name)->toBe('Signature Healthcare Initiative');

    // Test in BN
    app()->setLocale('bn');
    expect($project->localized_name)->toBe('হাসপাতাল অক্সিজেন সহায়তা');
    expect($project->localized_short_description)->toBe('মেডিকেল অক্সিজেন সিলিন্ডার সরবরাহ।');
    expect($project->localized_location)->toBe('ঢাকা মেডিকেল');
    expect($type->localized_name)->toBe('বিশেষ স্বাস্থ্যসেবা উদ্যোগ');

    // Fallback when bn column is null/empty
    $fallbackProject = new Project([
        'name' => 'Only English Title',
        'name_bn' => null,
    ]);
    expect($fallbackProject->localized_name)->toBe('Only English Title');
});

test('localized helper functions work accurately', function () {
    app()->setLocale('en');
    expect(localized_number(1234))->toBe('1,234');
    expect(is_bengali())->toBeFalse();

    app()->setLocale('bn');
    expect(is_bengali())->toBeTrue();
    expect(localized_number(1234))->toBe('১,২৩৪');
    expect(bengali_number(500))->toBe('৫০০');
});

test('frontend views render localized strings when in bn session', function () {
    $response = $this->withSession(['locale' => 'bn'])->get(route('donations'));
    $response->assertStatus(200);
    $response->assertSee('প্রকল্প ও উদ্যোগ');
    $response->assertSee('হোম');
    $response->assertSee('দান করুন');

    $contactResponse = $this->withSession(['locale' => 'bn'])->get(route('contact'));
    $contactResponse->assertStatus(200);
    $contactResponse->assertSee('যোগাযোগ করুন');
    $contactResponse->assertSee('বার্তা পাঠান');
    $contactResponse->assertSee('সরাসরি সহায়তা');
    $contactResponse->assertSee('স্বেচ্ছাসেবক হোন');

    $galleryResponse = $this->withSession(['locale' => 'bn'])->get(route('gallery'));
    $galleryResponse->assertStatus(200);
    $galleryResponse->assertSee('ফটো গ্যালারি ও কার্যক্রম অ্যালবাম');
    $galleryResponse->assertSee('কার্যক্রম ও মাঠপর্যায়ের ফটো অ্যালবামসমূহ');

    $volunteerResponse = $this->withSession(['locale' => 'bn'])->get(route('volunteer'));
    $volunteerResponse->assertStatus(200);
    $volunteerResponse->assertSee('স্বেচ্ছাসেবক হোন');
    $volunteerResponse->assertSee('আপনার পূর্ণ নাম');

    $faqResponse = $this->withSession(['locale' => 'bn'])->get(route('faq'));
    $faqResponse->assertStatus(200);
    $faqResponse->assertSee('সাধারণ জিজ্ঞাসা (FAQ)');
    $faqResponse->assertSee('কীভাবে অনুদান প্রদান করব');

    $donateResponse = $this->withSession(['locale' => 'bn'])->get(route('donate'));
    $donateResponse->assertStatus(200);
    $donateResponse->assertSee('আমাদের মানবিক কার্যক্রমে অংশ নিন');
    $donateResponse->assertSee('অনুদান সম্পন্ন করুন');
});
