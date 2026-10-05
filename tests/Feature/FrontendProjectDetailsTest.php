<?php

use App\Models\Activity;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;

test('public users can view dynamic project details by slug', function () {
    $project = Project::create([
        'name' => 'Winter Relief Drive in Kurigram',
        'slug' => 'winter-relief-drive-in-kurigram-test',
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

test('public users can view dynamic activity details by slug', function () {
    $activity = Activity::create([
        'title' => 'Free Eye Camp at Shanti Nagar',
        'slug' => 'free-eye-camp-shanti-nagar-test',
        'short_description' => 'Free cataract screening and eyeglasses.',
        'description' => 'Community medical camp organized with specialist doctors.',
        'location' => 'Shanti Nagar, Dhaka',
        'status' => 'upcoming',
        'is_published' => true,
    ]);

    $response = $this->get(route('activity.details', $activity->slug));

    $response->assertStatus(200);
    $response->assertSee('Free Eye Camp at Shanti Nagar');
    $response->assertSee('Shanti Nagar, Dhaka');
});

test('homepage and about page render with dynamic live impact stats and leadership hierarchy', function () {
    $homeResponse = $this->get(route('home'));
    $homeResponse->assertStatus(200);
    $homeResponse->assertSee('Volunteers');
    $homeResponse->assertSee('Beneficiaries');

    $aboutResponse = $this->get(route('about'));
    $aboutResponse->assertStatus(200);
    $aboutResponse->assertSee('Fund Deployment Ratio');
    $aboutResponse->assertSee('Direct Procurement Ratio');
    $aboutResponse->assertSee('Honorary Tribute');
    $aboutResponse->assertSee('Executive Leadership');
    $aboutResponse->assertSee('Board of Directors');
    $aboutResponse->assertSee('Our Mission');
    $aboutResponse->assertSee('Core Relief Pillars');
});

test('public donations, events, and gallery pages render dynamically', function () {
    $type = ProjectType::firstOrCreate(
        ['slug' => 'safe-water-initiative'],
        [
            'name' => 'Safe Water Initiative',
            'badge_color' => '#0284c7',
            'is_active' => true,
        ]
    );

    $project = Project::create([
        'name' => 'Safe Drinking Water Tube-Wells in Sunamganj',
        'slug' => 'safe-drinking-water-tube-wells-sunamganj-test',
        'project_type_id' => $type->id,
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

    $activitiesResponse = $this->get(route('activities'));
    $activitiesResponse->assertStatus(200);

    $galleryResponse = $this->get(route('gallery'));
    $galleryResponse->assertStatus(200);
    $galleryResponse->assertSee('Activity & Field Photo Albums');
});

test('public donations page filters projects dynamically by project type', function () {
    $type = ProjectType::create([
        'name' => 'Continuous Project',
        'slug' => 'continuous-project-test',
        'description' => 'Projects requiring continuous ongoing funding',
        'badge_color' => '#005daa',
        'order_index' => 1,
        'is_active' => true,
    ]);

    $project = Project::create([
        'name' => 'Free Community Dialysis Support Test',
        'slug' => 'free-community-dialysis-support-test',
        'project_type_id' => $type->id,
        'short_description' => 'Ongoing dialysis support for underprivileged patients.',
        'description' => 'Continuous recurring medical funding.',
        'estimated_cost' => 500000.00,
        'status' => 'in_progress',
        'location' => 'Dhaka, Bangladesh',
        'is_published' => true,
    ]);

    $response = $this->get(route('donations', ['type' => 'continuous-project-test']));
    $response->assertStatus(200);
    $response->assertSee('Free Community Dialysis Support Test');
    $response->assertSee('Continuous Project');
});

test('public donations page renders sponsored projects carousel and gallery-style filter buttons', function () {
    $sigType = ProjectType::firstOrCreate(
        ['slug' => 'signature-project'],
        [
            'name' => 'Signature Project',
            'badge_color' => '#dc2626',
            'is_active' => true,
        ]
    );

    $sigProject = Project::create([
        'name' => 'Flagship Orphanage Facility Sponsorship',
        'slug' => 'flagship-orphanage-facility-sponsorship',
        'project_type_id' => $sigType->id,
        'short_description' => 'Flagship patron sponsorship initiative.',
        'description' => 'Providing full shelter support.',
        'estimated_cost' => 600000.00,
        'status' => 'in_progress',
        'location' => 'Shanti Nagar, Dhaka',
        'is_published' => true,
    ]);

    $response = $this->get(route('donations'));
    $response->assertStatus(200);
    $response->assertSee('Sponsored');
    $response->assertSee('Flagship Orphanage Facility Sponsorship');
    $response->assertSee('Signature Project');
});
