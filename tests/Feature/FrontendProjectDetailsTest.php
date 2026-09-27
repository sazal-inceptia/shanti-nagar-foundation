<?php

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\ProjectImage;

test('public users can view dynamic project details by slug', function () {
    $project = Project::create([
        'name' => 'Winter Relief Drive in Kurigram',
        'slug' => 'winter-relief-drive-in-kurigram-test',
        'category' => 'Winter Relief',
        'short_description' => 'Distributing 2000 heavy blankets to families.',
        'description' => 'Comprehensive relief drive for cold affected northern region.',
        'estimated_cost' => 150000.00,
        'status' => 'in_progress',
        'location' => 'Kurigram, Bangladesh',
        'is_published' => true,
    ]);

    $donor = Donor::create([
        'name' => 'Rafiqul Islam',
        'email' => 'rafiq@test.com',
        'phone' => '+880 1711-223344',
    ]);

    Donation::create([
        'receipt_number' => 'REC-2026-TEST-01',
        'donor_id' => $donor->id,
        'project_id' => $project->id,
        'amount' => 5000.00,
        'donation_date' => now(),
        'payment_method' => 'bkash',
        'status' => 'completed',
    ]);

    $response = $this->get(route('donation.details', $project->slug));

    $response->assertStatus(200);
    $response->assertSee('Winter Relief Drive in Kurigram');
    $response->assertSee('Kurigram, Bangladesh');
    $response->assertSee('Rafiqul Islam');
});

test('public users can view dynamic event details by slug', function () {
    $activity = Project::create([
        'name' => 'Free Eye Camp at Shanti Nagar',
        'slug' => 'free-eye-camp-shanti-nagar-test',
        'category' => 'Healthcare',
        'short_description' => 'Free cataract screening and eyeglasses.',
        'description' => 'Community medical camp organized with specialist doctors.',
        'estimated_cost' => 50000.00,
        'status' => 'planned',
        'location' => 'Shanti Nagar, Dhaka',
        'is_published' => true,
    ]);

    $response = $this->get(route('event.details', $activity->slug));

    $response->assertStatus(200);
    $response->assertSee('Free Eye Camp at Shanti Nagar');
    $response->assertSee('Shanti Nagar, Dhaka');
});

test('homepage and about page render with dynamic live impact stats', function () {
    $homeResponse = $this->get(route('home'));
    $homeResponse->assertStatus(200);
    $homeResponse->assertSee('Volunteers');
    $homeResponse->assertSee('Beneficiaries');

    $aboutResponse = $this->get(route('about'));
    $aboutResponse->assertStatus(200);
    $aboutResponse->assertSee('Total Donations Raised');
    $aboutResponse->assertSee('Total Funds Utilized');
});

test('public donations, events, and gallery pages render dynamically', function () {
    $project = Project::create([
        'name' => 'Safe Drinking Water Tube-Wells in Sunamganj',
        'slug' => 'safe-drinking-water-tube-wells-sunamganj-test',
        'category' => 'Safe Water',
        'short_description' => 'Installing 15 deep tube-wells in flood-prone villages.',
        'description' => 'Providing clean drinking water to over 3,000 villagers.',
        'estimated_cost' => 300000.00,
        'status' => 'in_progress',
        'location' => 'Sunamganj, Sylhet',
        'is_published' => true,
    ]);

    ProjectImage::create([
        'project_id' => $project->id,
        'image_path' => 'assets/images/gallery/gallery-1.jpg',
        'caption' => 'Tube-well construction site Sunamganj',
        'sort_order' => 1,
    ]);

    $donationsResponse = $this->get(route('donations'));
    $donationsResponse->assertStatus(200);
    $donationsResponse->assertSee('Safe Drinking Water Tube-Wells in Sunamganj');
    $donationsResponse->assertSee('৳');

    $eventsResponse = $this->get(route('events'));
    $eventsResponse->assertStatus(200);
    $eventsResponse->assertSee('Safe Drinking Water Tube-Wells in Sunamganj');

    $galleryResponse = $this->get(route('gallery'));
    $galleryResponse->assertStatus(200);
    $galleryResponse->assertSee('Safe Water');
    $galleryResponse->assertSee('Tube-well construction site Sunamganj');
});
