<?php

use App\Models\ContactMessage;
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

test('guest can submit public donation pledge', function () {
    $project = Project::first() ?? Project::create([
        'name' => 'Winter Relief Campaign',
        'slug' => 'winter-relief-campaign',
        'category' => 'Disaster & Relief',
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

test('authenticated admin can toggle contact message status', function () {
    $admin = User::first() ?? User::factory()->create();
    $msg = ContactMessage::create([
        'name' => 'Status Test User',
        'email' => 'status@gmail.com',
        'message' => 'Status test message',
        'status' => 'unread',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.contacts.toggle-status', $msg->id), [
        'status' => 'read',
    ]);

    $response->assertRedirect();
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

test('authenticated admin can toggle volunteer status', function () {
    $admin = User::first() ?? User::factory()->create();
    $vol = Volunteer::create([
        'name' => 'Approval Test',
        'email' => 'approval@gmail.com',
        'phone' => '+880 1700-998877',
        'address' => 'Dhaka',
        'status' => 'pending',
    ]);

    $response = $this->actingAs($admin)->post(route('admin.volunteers.toggle-status', $vol->id), [
        'status' => 'approved',
    ]);

    $response->assertRedirect();
    expect($vol->fresh()->status)->toBe('approved');
});
