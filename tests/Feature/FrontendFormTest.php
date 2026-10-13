<?php

use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\User;
use App\Models\Volunteer;

test('guest can submit contact message', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Tanvir Hossain',
        'email' => 'tanvir@gmail.com',
        'phone' => '+880 1711-223344',
        'subject' => 'Emergency Relief Enquiry',
        'message' => 'Hello, I want to know more about the flood relief activities in Sylhet.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('contact_messages', [
        'email' => 'tanvir@gmail.com',
        'subject' => 'Emergency Relief Enquiry',
        'status' => 'unread',
    ]);
});

test('guest cannot submit invalid contact message', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => '',
        'email' => 'invalid-email',
        'message' => '',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'message']);
});

test('guest can submit volunteer registration', function () {
    $response = $this->post(route('volunteer.submit'), [
        'name' => 'Nusrat Jahan',
        'email' => 'nusrat@gmail.com',
        'phone' => '+880 1819-445566',
        'gender' => 'Female',
        'age_group' => '20+',
        'address' => 'Kakrail, Dhaka',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('volunteers', [
        'email' => 'nusrat@gmail.com',
        'phone' => '+880 1819-445566',
        'gender' => 'Female',
        'status' => 'pending',
    ]);
});

test('guest can submit volunteer registration from event details page', function () {
    $response = $this->post(route('volunteer.submit'), [
        'name' => 'Mahmudul Hasan',
        'email' => 'mahmud@gmail.com',
        'phone' => '+880 1712-334455',
        'address' => 'Shanti Nagar, Dhaka',
        'event_name' => 'Winter Blanket Distribution',
        'experience' => 'Experienced with relief kit packaging and dispatch logistics.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('volunteers', [
        'name' => 'Mahmudul Hasan',
        'email' => 'mahmud@gmail.com',
        'phone' => '+880 1712-334455',
        'status' => 'pending',
    ]);

    $saved = Volunteer::where('email', 'mahmud@gmail.com')->first();
    expect($saved->notes)->toContain('Event/Initiative: Winter Blanket Distribution');
    expect($saved->notes)->toContain('Experience: Experienced with relief kit packaging');
});

test('guest can submit public donation pledge', function () {
    $project = Project::first() ?? Project::create([
        'name' => 'Winter Relief Campaign',
        'slug' => 'winter-relief-campaign',
        'estimated_cost' => 500000,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $response = $this->post(route('donate.submit'), [
        'name' => 'Kazi Farhan',
        'email' => 'farhan@gmail.com',
        'phone' => '+880 1912-889900',
        'address' => 'Shanti Nagar, Dhaka',
        'amount' => 5000,
        'project_id' => $project->id,
        'payment_method' => 'bkash',
        'transaction_id' => 'TRX-BKASH-7788',
        'notes' => 'Zakat contribution',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('donors', [
        'email' => 'farhan@gmail.com',
    ]);

    $this->assertDatabaseHas('donations', [
        'amount' => 5000,
        'payment_method' => 'bkash',
        'status' => 'pending',
    ]);
});

test('guest can view printable official donation receipt', function () {
    $donor = Donor::firstOrCreate(
        ['email' => 'receipt.donor@gmail.com'],
        ['name' => 'Receipt Donor', 'phone' => '+880 1711-223344']
    );

    $donation = Donation::create([
        'receipt_number' => 'REC-2026-9999',
        'donor_id' => $donor->id,
        'amount' => 7500,
        'donation_date' => now(),
        'payment_method' => 'bkash',
        'transaction_id' => 'TRX9999',
        'status' => 'completed',
    ]);

    $response = $this->get(route('donation.receipt', $donation->receipt_number));
    $response->assertStatus(200);
    $response->assertSee('REC-2026-9999');
    $response->assertSee('Receipt Donor');
    $response->assertSee('Official Donation Money Receipt');
});

test('authenticated admin can view contact messages index', function () {
    $admin = User::first() ?? User::factory()->create();
    ContactMessage::create([
        'name' => 'Test User',
        'email' => 'test@gmail.com',
        'message' => 'Test inquiry message',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.contacts.index'));

    $response->assertStatus(200);
    $response->assertSee('Contact Inquiries &amp; Messages', false);
});

test('authenticated admin viewing contact message automatically marks it as read', function () {
    $admin = User::first() ?? User::factory()->create();
    $msg = ContactMessage::create([
        'name' => 'Status Test User',
        'email' => 'status@gmail.com',
        'message' => 'Status test message',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.contacts.show', $msg->id));

    $response->assertStatus(200);
    $response->assertJsonPath('success', true);
    $response->assertJsonPath('data.name', 'Status Test User');
    expect($msg->fresh()->status)->toBe('read');
});

test('authenticated admin can view volunteer applications index', function () {
    $admin = User::first() ?? User::factory()->create();
    Volunteer::create([
        'name' => 'Volunteer Tester',
        'email' => 'vol@gmail.com',
        'phone' => '+880 1700-112233',
        'address' => 'Dhaka',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.volunteers.index'));

    $response->assertStatus(200);
    $response->assertSee('Volunteer Registrations');
});

test('authenticated admin can view volunteer application details', function () {
    $admin = User::first() ?? User::factory()->create();
    $vol = Volunteer::create([
        'name' => 'Approval Test',
        'email' => 'approval@gmail.com',
        'phone' => '+880 1700-998877',
        'address' => 'Dhaka',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.volunteers.show', $vol->id));

    $response->assertStatus(200);
    $response->assertJsonPath('success', true);
    $response->assertJsonPath('data.name', 'Approval Test');
});

test('authenticated admin can toggle volunteer status via AJAX', function () {
    $admin = User::first() ?? User::factory()->create();
    $vol = Volunteer::create([
        'name' => 'Toggle Status Test',
        'email' => 'toggle.status@gmail.com',
        'phone' => '+880 1700-445566',
        'address' => 'Dhaka',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->postJson(route('admin.volunteers.toggle-status', $vol->id), [
        'status' => 'approved',
    ]);

    $response->assertStatus(200);
    $response->assertJsonPath('success', true);
    $response->assertJsonPath('status', 'approved');
    expect($vol->fresh()->status)->toBe('approved');
});

test('guest can access public transparency portal and view stats', function () {
    $response = $this->get(route('verify.receipt'));

    $response->assertStatus(200);
    $response->assertSee('Receipt Verification &amp; Transparency Portal', false);
    $response->assertSee('Verify Donation Receipt');
    $response->assertSee('Public Accountability &amp; Verification', false);
});

test('guest can verify donation receipt by receipt number', function () {
    $project = Project::first() ?? Project::create([
        'name' => 'Transparency Test Project',
        'slug' => 'transparency-test-project-'.uniqid(),
        'short_description' => 'Test project for receipt verification',
        'description' => 'Detailed test description',
        'estimated_cost' => 50000.00,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $donor = Donor::create([
        'name' => 'Transparency Test Donor',
        'email' => 'transparency_'.uniqid().'@test.com',
        'phone' => '+880 1711-889900',
    ]);

    $donation = Donation::create([
        'receipt_number' => 'REC-2026-9999',
        'donor_id' => $donor->id,
        'project_id' => $project->id,
        'amount' => 5000,
        'donation_date' => now(),
        'payment_method' => 'bkash',
        'transaction_id' => 'TRX998877TEST',
        'status' => 'completed',
    ]);

    $response = $this->get(route('verify.receipt', ['query' => 'REC-2026-9999']));

    $response->assertStatus(200);
    $response->assertSee('REC-2026-9999');
    $response->assertSee('Transparency Test Donor');
    $response->assertSee('Verified &amp; Credited', false);
    $response->assertSee('TRX998877TEST');
});

test('guest can verify donation receipt by donor phone number', function () {
    $project = Project::first() ?? Project::create([
        'name' => 'Phone Search Test Project',
        'slug' => 'phone-search-test-project-'.uniqid(),
        'short_description' => 'Test project for phone search',
        'description' => 'Detailed test description',
        'estimated_cost' => 50000.00,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $donor = Donor::create([
        'name' => 'Phone Search Donor',
        'email' => 'phone_search_'.uniqid().'@test.com',
        'phone' => '01811-992233',
    ]);

    $donation = Donation::create([
        'receipt_number' => 'REC-2026-8888',
        'donor_id' => $donor->id,
        'project_id' => $project->id,
        'amount' => 3500,
        'donation_date' => now(),
        'payment_method' => 'bkash',
        'status' => 'completed',
    ]);

    $response = $this->get(route('verify.receipt', ['query' => '01811-992233']));

    $response->assertStatus(200);
    $response->assertSee('REC-2026-8888');
    $response->assertSee('Phone Search Donor');
});

test('verification portal shows helpful not found message for unknown query', function () {
    $response = $this->get(route('verify.receipt', ['query' => 'UNKNOWN-999999']));

    $response->assertStatus(200);
    $response->assertSee('No Donation Receipt Found');
    $response->assertSee('Helpful Tips &amp; Troubleshooting', false);
});
