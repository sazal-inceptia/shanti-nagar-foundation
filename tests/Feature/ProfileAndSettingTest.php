<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('authenticated admin can view profile edit page', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.profile.edit'));

    $response->assertStatus(200);
    $response->assertSee('My Profile &amp; Security', false);
    $response->assertSee($admin->email);
});

test('authenticated admin can update profile details', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->put(route('admin.profile.update'), [
        'name' => 'Updated Admin Name',
        'email' => 'updated_admin@gmail.com',
        'phone' => '+880 1711-998877',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $admin->refresh();
    expect($admin->name)->toBe('Updated Admin Name')
        ->and($admin->email)->toBe('updated_admin@gmail.com')
        ->and($admin->phone)->toBe('+880 1711-998877');
});

test('authenticated admin can update password', function () {
    $admin = User::factory()->create([
        'password' => Hash::make('oldpassword123'),
    ]);

    $response = $this->actingAs($admin)->put(route('admin.profile.password'), [
        'current_password' => 'oldpassword123',
        'password' => 'newpassword456',
        'password_confirmation' => 'newpassword456',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $admin->refresh();
    expect(Hash::check('newpassword456', $admin->password))->toBeTrue();
});

test('authenticated admin can view system settings page', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.settings.index'));

    $response->assertStatus(200);
    $response->assertSee('System &amp; Organization Settings', false);
    $response->assertSee('Rotary Club of Shantinagar Dhaka');
});

test('authenticated admin can update system settings and see changes on public pages', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->put(route('admin.settings.update'), [
        'org_name' => 'Shanti Nagar Relief Foundation',
        'hotline' => '+880 1999-888777',
        'email' => 'help@rotaryshantinagardhaka.org',
        'address' => 'House 99, Shanti Nagar, Dhaka',
        'bkash_number' => '+880 1999-112233',
        'nagad_number' => '+880 1999-445566',
        'bank_name' => 'Islami Bank Limited',
        'bank_account_name' => 'Rotary Club of Shantinagar Dhaka',
        'bank_account_number' => '9999 8888 7777 6666',
        'bank_branch' => 'Kakrail Branch, Dhaka',
        'currency' => 'BDT (৳)',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Verify changes on public home page & contact page
    $publicResponse = $this->get(route('contact'));
    $publicResponse->assertStatus(200);
    $publicResponse->assertSee('+880 1999-888777');
    $publicResponse->assertSee('help@rotaryshantinagardhaka.org');
});
