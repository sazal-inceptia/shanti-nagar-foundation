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

    $response = $this->get(route('project.details', $project->slug));

    $response->assertStatus(200);
    $response->assertSee('Winter Relief Drive in Kurigram');
    $response->assertSee('Kurigram, Bangladesh');
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
    $aboutResponse->assertSee('Executive Leadership');
    $aboutResponse->assertSee('Board of Directors');
    $aboutResponse->assertSee('Our Mission');
    $aboutResponse->assertSee('Rotary 4-Way Test');
    $aboutResponse->assertSee('Roll of Honour');
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

    $projectsResponse = $this->get(route('projects'));
    $projectsResponse->assertStatus(200);
    $projectsResponse->assertSee('Safe Drinking Water Tube-Wells in Sunamganj');
    $projectsResponse->assertSee('৳');

    $activitiesResponse = $this->get(route('activities'));
    $activitiesResponse->assertStatus(200);

    $galleryResponse = $this->get(route('gallery'));
    $galleryResponse->assertStatus(200);
    $galleryResponse->assertSee('Activity & Field Photo Albums');
});

test('public projects page filters projects dynamically by project type', function () {
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

    $response = $this->get(route('projects', ['type' => 'continuous-project-test']));
    $response->assertStatus(200);
    $response->assertSee('Free Community Dialysis Support Test');
    $response->assertSee('Continuous Project');
});

test('public projects page renders sponsored projects carousel and gallery-style filter buttons', function () {
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

    $response = $this->get(route('projects'));
    $response->assertStatus(200);
    $response->assertSee('Sponsored');
    $response->assertSee('Flagship Orphanage Facility Sponsorship');
    $response->assertSee('Signature Project');
});

test('public users can filter projects by rotary year', function () {
    $response = $this->get(route('projects', ['year' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('Rotary Year:');
    $response->assertSee('RY 2026–2027 (Current Term)');
});

test('public users can filter projects by category type and status', function () {
    $response = $this->get(route('projects', ['type' => 'signature-project', 'status' => 'completed']));

    $response->assertStatus(200);
    $response->assertSee('Active filters:');
    $response->assertSee('Clear All');
});

test('public users can search projects by keyword', function () {
    $response = $this->get(route('projects', ['search' => 'orphan']));

    $response->assertStatus(200);
    $response->assertSee('Active filters:');
    $response->assertSee('orphan');
});

test('public project details page renders structured report sections and donor recognition', function () {
    $project = Project::create([
        'name' => 'Wudu Facility Test Project',
        'slug' => 'wudu-facility-test-project',
        'short_description' => 'Test wudu facility ablution.',
        'description' => 'Test project detailed description.',
        'background' => 'Remote madrasa students previously had to use mud ponds.',
        'objectives' => [
            'Construct modern tiled wudu ablution stations.',
            'Establish clean piped groundwater flow.',
        ],
        'impact_outcomes' => [
            'Alhamdulillah! The project has been successfully completed.',
            '300+ students and worshippers benefit daily.',
        ],
        'challenges' => [
            'Procuring construction materials in remote coastal areas.',
        ],
        'conclusion' => 'Sadaqah Jariyah continuous charity benefiting generations.',
        'project_report_meta' => [
            'status_statement' => 'Alhamdulillah Tk.50,000 hoye gechhe, pray.',
            'donors' => [
                ['name' => 'Nabegah Dordana', 'amount' => 10000, 'note' => '10,000 Tk.'],
                ['name' => 'Fayeem Bhai', 'amount' => 20000, 'note' => '20,000 Tk.'],
            ],
        ],
        'estimated_cost' => 50000.00,
        'status' => 'completed',
        'location' => 'Cox\'s Bazar',
        'is_published' => true,
    ]);

    $response = $this->get(route('project.details', $project->slug));

    $response->assertStatus(200);
    $response->assertSee('Background &amp; Problem Context', false);
    $response->assertSee('Remote madrasa students previously had to use mud ponds.');
    $response->assertSee('Key Objectives');
    $response->assertSee('Construct modern tiled wudu ablution stations.');
    $response->assertSee('Expected Impact &amp; Outcomes', false);
    $response->assertSee('Alhamdulillah! The project has been successfully completed.');
    $response->assertSee('Implementation Challenges &amp; Problem Solving', false);
    $response->assertSee('Procuring construction materials in remote coastal areas.');
    $response->assertSee('Project Conclusion &amp; Rotary Commitment', false);
    $response->assertSee('Sadaqah Jariyah continuous charity benefiting generations.');
    $response->assertSee('Recognized Donors &amp; Contributions', false);
    $response->assertSee('Nabegah Dordana');
    $response->assertSee('Fayeem Bhai');
    $response->assertSee('Alhamdulillah Tk.50,000 hoye gechhe, pray.');
});

test('project cards across home, projects, and details pages render unified dynamic donate-inner structure', function () {
    $project = Project::create([
        'name' => 'Tube-well Clean Water Project',
        'slug' => 'tubewell-clean-water-project-test',
        'short_description' => 'Providing clean arsenic-free drinking water.',
        'description' => 'Full project description for test.',
        'estimated_cost' => 100000.00,
        'status' => 'in_progress',
        'is_featured' => true,
        'is_published' => true,
    ]);

    $donor = Donor::create([
        'name' => 'Sultana Ahmed',
        'email' => 'sultana@test.com',
    ]);

    Donation::create([
        'receipt_number' => 'REC-CARD-TEST-01',
        'donor_id' => $donor->id,
        'project_id' => $project->id,
        'amount' => 30000.00,
        'donation_date' => now(),
        'payment_method' => 'bkash',
        'status' => 'completed',
    ]);

    // Test Home Page
    $homeResponse = $this->get(route('home'));
    $homeResponse->assertStatus(200);
    $homeResponse->assertSee('donate-inner clearfix', false);
    $homeResponse->assertSee('icon-donation-1', false);
    $homeResponse->assertSee('count-bar counted', false);
    $homeResponse->assertSee("select[name=\\'project_id\\']').value = '{$project->id}'", false);

    // Test Projects Listing Page
    $projectsResponse = $this->get(route('projects'));
    $projectsResponse->assertStatus(200);
    $projectsResponse->assertSee('donate-inner clearfix', false);
    $projectsResponse->assertSee('icon-donation-1', false);
    $projectsResponse->assertSee('count-bar counted', false);
    $projectsResponse->assertSee("select[name=\\'project_id\\']').value = '{$project->id}'", false);

    // Test Project Details Page
    $detailsResponse = $this->get(route('project.details', $project->slug));
    $detailsResponse->assertStatus(200);
    $detailsResponse->assertSee('donate-inner clearfix', false);
    $detailsResponse->assertSee('icon-donation-1', false);
    $detailsResponse->assertSee('count-bar counted', false);
    $detailsResponse->assertSee("select[name=\\'project_id\\']').value = '{$project->id}'", false);
});
