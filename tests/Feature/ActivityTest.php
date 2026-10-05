<?php

use App\Models\Activity;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('public activities page displays published activities', function () {
    $activity = Activity::create([
        'title' => 'Winter Relief Distribution Camp',
        'title_bn' => 'শীতবস্ত্র বিতরণ ক্যাম্প',
        'event_date' => now()->addDays(5)->toDateString(),
        'event_time' => '10:00 AM - 02:00 PM',
        'location' => 'Sirajganj, Bangladesh',
        'location_bn' => 'সিরাজগঞ্জ, বাংলাদেশ',
        'short_description' => 'Direct winter relief for cold-affected families.',
        'short_description_bn' => 'শীতবস্ত্র বিতরণ কর্মসূচি।',
        'status' => 'upcoming',
        'is_published' => true,
    ]);

    $response = $this->get(route('activities'));

    $response->assertStatus(200);
    $response->assertSee('Winter Relief Distribution Camp');
    $response->assertSee('Sirajganj, Bangladesh');
    expect($activity->slug)->toBe('winter-relief-distribution-camp');
});

test('public activity details page displays details and handles slug lookup', function () {
    $activity = Activity::create([
        'title' => 'Free Cataract Eye Surgery Camp',
        'title_bn' => 'বিনামূল্যে চক্ষু ছানি অপারেশন ক্যাম্প',
        'event_date' => now()->addDays(10)->toDateString(),
        'location' => 'Shantinagar, Dhaka',
        'short_description' => 'Free ophthalmologist consultations.',
        'description' => 'Detailed full description of eye surgery camp.',
        'status' => 'upcoming',
        'is_published' => true,
    ]);

    $response = $this->get(route('activity.details', $activity->slug));

    $response->assertStatus(200);
    $response->assertSee('Free Cataract Eye Surgery Camp');
    $response->assertSee('Shantinagar, Dhaka');
    $response->assertSee('Detailed full description of eye surgery camp.');
});

test('activity model automatically generates unique slug without manual input', function () {
    $activity1 = Activity::create([
        'title' => 'Blood Donation Drive',
        'status' => 'upcoming',
    ]);

    $activity2 = Activity::create([
        'title' => 'Blood Donation Drive',
        'status' => 'upcoming',
    ]);

    expect($activity1->slug)->toBe('blood-donation-drive');
    expect($activity2->slug)->toBe('blood-donation-drive-1');
});

test('project model automatically generates unique slug without manual input', function () {
    $type = ProjectType::create([
        'name' => 'Signature Project',
        'slug' => 'signature-project',
        'is_active' => true,
    ]);

    $project1 = Project::create([
        'name' => 'Safe Drinking Water Tube-Wells',
        'project_type_id' => $type->id,
        'estimated_cost' => 500000,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $project2 = Project::create([
        'name' => 'Safe Drinking Water Tube-Wells',
        'project_type_id' => $type->id,
        'estimated_cost' => 300000,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    expect($project1->slug)->toBe('safe-drinking-water-tube-wells');
    expect($project2->slug)->toBe('safe-drinking-water-tube-wells-1');
});

test('admin can access activities index and manage activity crud', function () {
    $admin = User::factory()->create([
        'email' => 'admin@gmail.com',
    ]);

    $this->actingAs($admin);

    // 1. Access Index
    $indexResponse = $this->get(route('admin.activities.index'));
    $indexResponse->assertStatus(200);

    // 2. Access Create
    $createResponse = $this->get(route('admin.activities.create'));
    $createResponse->assertStatus(200);

    // 3. Store New Activity
    $storeResponse = $this->post(route('admin.activities.store'), [
        'title' => 'Orphan Winter Kit Distribution 2026',
        'title_bn' => 'এতিম শিশুদের শীতবস্ত্র বিতরণ ২০২৬',
        'event_date' => now()->addDays(7)->toDateString(),
        'event_time' => '11:00 AM',
        'location' => 'Mirpur, Dhaka',
        'location_bn' => 'মিরপুর, ঢাকা',
        'short_description' => 'Warm clothing packs for orphans.',
        'status' => 'upcoming',
        'is_published' => '1',
        'is_featured' => '1',
    ]);

    $storeResponse->assertRedirect(route('admin.activities.index'));
    $this->assertDatabaseHas('activities', [
        'title' => 'Orphan Winter Kit Distribution 2026',
        'slug' => 'orphan-winter-kit-distribution-2026',
        'is_featured' => true,
        'is_published' => true,
    ]);

    $activity = Activity::where('slug', 'orphan-winter-kit-distribution-2026')->first();

    // 4. Update Activity
    $updateResponse = $this->put(route('admin.activities.update', $activity->id), [
        'title' => 'Orphan Winter Kit Distribution 2026 Updated',
        'title_bn' => 'এতিম শিশুদের শীতবস্ত্র বিতরণ ২০২৬ সংশোধিত',
        'status' => 'ongoing',
        'is_published' => '1',
    ]);

    $updateResponse->assertRedirect(route('admin.activities.index'));
    $this->assertDatabaseHas('activities', [
        'id' => $activity->id,
        'title' => 'Orphan Winter Kit Distribution 2026 Updated',
        'status' => 'ongoing',
    ]);

    // 5. Toggle published status
    $toggleResponse = $this->post(route('admin.activities.toggle-status', $activity->id), [
        'field' => 'is_published',
        'value' => 0,
    ]);
    $toggleResponse->assertStatus(200);
    $toggleResponse->assertJson(['success' => true]);

    // 6. Delete Activity
    $deleteResponse = $this->delete(route('admin.activities.destroy', $activity->id));
    $deleteResponse->assertRedirect(route('admin.activities.index'));
    $this->assertSoftDeleted('activities', [
        'id' => $activity->id,
    ]);
});

test('activities render properly in bengali locale', function () {
    $activity = Activity::create([
        'title' => 'Health Awareness Seminar',
        'title_bn' => 'স্বাস্থ্য সচেতনতা সেমিনার',
        'location' => 'Dhaka',
        'location_bn' => 'ঢাকা',
        'short_description' => 'Seminar on preventive healthcare.',
        'short_description_bn' => 'প্রতিরোধমূলক স্বাস্থ্যসেবা বিষয়ক সেমিনার।',
        'status' => 'upcoming',
        'is_published' => true,
    ]);

    $this->get(route('switch.lang', 'bn'));

    $response = $this->get(route('activities'));
    $response->assertStatus(200);
    $response->assertSee('স্বাস্থ্য সচেতনতা সেমিনার');
    $response->assertSee('ঢাকা');
});
