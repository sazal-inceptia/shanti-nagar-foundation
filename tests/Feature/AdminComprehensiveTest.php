<?php

use App\Enums\ExpenseCategory;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Expense;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Setting;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'Super Admin',
        'email' => 'admin@shantinagar.org',
        'password' => Hash::make('password'),
    ]);
});

test('admin dashboard renders successfully with kpi metrics', function () {
    $response = $this->actingAs($this->user)->get(route('admin.dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Dashboard');
});

test('admin can create, update, toggle status, and delete a project', function () {
    $projectType = ProjectType::create([
        'name' => 'Community Service',
        'slug' => 'community-service-test',
        'is_active' => true,
    ]);

    // 1. Create Project
    $storeResponse = $this->actingAs($this->user)->post(route('admin.projects.store'), [
        'name' => 'Clean Water Pipeline',
        'slug' => 'clean-water-pipeline-test',
        'project_type_id' => $projectType->id,
        'estimated_cost' => 500000,
        'location' => 'Sylhet, Bangladesh',
        'short_description' => 'Providing clean drinking water.',
        'description' => 'Full detailed plan for clean water pipeline in Sylhet.',
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $storeResponse->assertRedirect(route('admin.projects.index'));
    $project = Project::where('slug', 'clean-water-pipeline-test')->first();
    expect($project)->not->toBeNull();

    // 2. Toggle Status
    $toggleResponse = $this->actingAs($this->user)->post(route('admin.projects.toggle-status', $project->id), [
        'field' => 'is_published',
        'value' => 0,
    ]);
    $toggleResponse->assertJson(['success' => true]);
    expect((bool) $project->fresh()->is_published)->toBeFalse();

    // 3. Update Project
    $updateResponse = $this->actingAs($this->user)->put(route('admin.projects.update', $project->id), [
        'name' => 'Clean Water Pipeline Updated',
        'project_type_id' => $projectType->id,
        'estimated_cost' => 600000,
        'location' => 'Sylhet Town',
        'short_description' => 'Updated short description.',
        'description' => 'Updated full description.',
        'status' => 'completed',
        'is_published' => true,
    ]);

    $updateResponse->assertRedirect(route('admin.projects.index'));
    expect($project->fresh()->name)->toBe('Clean Water Pipeline Updated');

    // 4. Delete Project
    $deleteResponse = $this->actingAs($this->user)->delete(route('admin.projects.destroy', $project->id));
    $deleteResponse->assertRedirect(route('admin.projects.index'));
    expect(Project::where('id', $project->id)->exists())->toBeFalse();
});

test('admin can manage donors and record donations', function () {
    // 1. Create Donor
    $donorResponse = $this->actingAs($this->user)->post(route('admin.donors.store'), [
        'name' => 'Tareq Aziz',
        'email' => 'tareq@example.com',
        'phone' => '+880 1711 001122',
        'donor_type' => 'individual',
        'address' => 'Dhanmondi, Dhaka',
    ]);

    $donorResponse->assertRedirect(route('admin.donors.index'));
    $donor = Donor::where('email', 'tareq@example.com')->first();
    expect($donor)->not->toBeNull();

    // 2. Record Donation
    $donationResponse = $this->actingAs($this->user)->post(route('admin.donations.store'), [
        'donor_id' => $donor->id,
        'amount' => 15000,
        'currency' => 'BDT',
        'donation_date' => now()->toDateString(),
        'payment_method' => 'bank_transfer',
        'transaction_id' => 'TRX-TEST-9988',
        'status' => 'completed',
        'notes' => 'Donation for winter relief drive.',
    ]);

    $donation = Donation::where('transaction_id', 'TRX-TEST-9988')->first();
    expect($donation)->not->toBeNull();
    $donationResponse->assertRedirect(route('admin.donations.show', $donation->id));
    expect((float) $donation->amount)->toBe(15000.0);

    // 3. View Donation details/receipt in admin
    $showResponse = $this->actingAs($this->user)->get(route('admin.donations.show', $donation->id));
    $showResponse->assertStatus(200);
    $showResponse->assertSee($donation->receipt_number);
});

test('admin can manage expenses and vouchers', function () {
    $expenseResponse = $this->actingAs($this->user)->post(route('admin.expenses.store'), [
        'title' => 'Purchase of Medical Supplies',
        'expense_category' => ExpenseCategory::values()[0] ?? 'Direct Relief',
        'amount' => 25000,
        'expense_date' => now()->toDateString(),
        'payment_method' => 'bank_transfer',
        'recipient_or_vendor' => 'Square Pharmaceuticals Ltd.',
        'description' => 'Emergency medical supplies for relief camp.',
    ]);

    $expense = Expense::where('title', 'Purchase of Medical Supplies')->first();
    expect($expense)->not->toBeNull();
    $expenseResponse->assertRedirect(route('admin.expenses.show', $expense->id));

    $showResponse = $this->actingAs($this->user)->get(route('admin.expenses.show', $expense->id));
    $showResponse->assertStatus(200);
    $showResponse->assertSee('Purchase of Medical Supplies');
});

test('admin can review volunteers and toggle approval status', function () {
    $volunteer = Volunteer::create([
        'name' => 'Sadia Rahman',
        'email' => 'sadia@example.com',
        'phone' => '+880 1819 123456',
        'gender' => 'female',
        'status' => 'pending',
    ]);

    // View index and show
    $indexResponse = $this->actingAs($this->user)->get(route('admin.volunteers.index'));
    $indexResponse->assertStatus(200);

    $showResponse = $this->actingAs($this->user)->getJson(route('admin.volunteers.show', $volunteer->id));
    $showResponse->assertStatus(200);
    $showResponse->assertJsonFragment(['name' => 'Sadia Rahman']);

    // Toggle status to approved
    $toggleResponse = $this->actingAs($this->user)->postJson(route('admin.volunteers.toggle-status', $volunteer->id), [
        'status' => 'approved',
    ]);
    $toggleResponse->assertJson(['success' => true]);
    expect($volunteer->fresh()->status)->toBe('approved');
});

test('admin can manage contact messages and inquiries', function () {
    $message = ContactMessage::create([
        'name' => 'Kamal Hossain',
        'email' => 'kamal@example.com',
        'subject' => 'Partnership Proposal',
        'message' => 'We would like to partner with Rotary Club on healthcare.',
        'status' => 'unread',
    ]);

    $indexResponse = $this->actingAs($this->user)->get(route('admin.contacts.index'));
    $indexResponse->assertStatus(200);

    $showResponse = $this->actingAs($this->user)->getJson(route('admin.contacts.show', $message->id));
    $showResponse->assertStatus(200);
    $showResponse->assertJsonFragment(['subject' => 'Partnership Proposal']);
    expect($message->fresh()->status)->toBe('read');

    // Delete contact message
    $deleteResponse = $this->actingAs($this->user)
        ->from(route('admin.contacts.index'))
        ->delete(route('admin.contacts.destroy', $message->id));
    $deleteResponse->assertRedirect(route('admin.contacts.index'));
    expect(ContactMessage::where('id', $message->id)->exists())->toBeFalse();
});

test('admin can update organization system settings', function () {
    $updateResponse = $this->actingAs($this->user)
        ->from(route('admin.settings.index'))
        ->put(route('admin.settings.update'), [
            'org_name' => 'Rotary Club of Shantinagar Dhaka',
            'email' => 'contact@rotaryshantinagar.org',
            'hotline' => '+880 1711-123456',
            'currency' => 'BDT (৳)',
        ]);

    $updateResponse->assertRedirect(route('admin.settings.index'));
    expect(Setting::get('email'))->toBe('contact@rotaryshantinagar.org');
    expect(Setting::get('org_name'))->toBe('Rotary Club of Shantinagar Dhaka');
});
