<?php

use App\Models\Employee;
use App\Models\User;

test('authenticated admin can view employees list', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.employees.index'));

    $response->assertStatus(200);
    $response->assertSee('Staff &amp; Employees Directory', false);
});

test('authenticated admin can create a new staff employee', function () {
    $admin = User::first() ?? User::factory()->create();

    $postData = [
        'employee_id' => 'EMP-TEST-901',
        'name' => 'Md. Faruk Ahmed',
        'designation' => 'Senior Field Officer',
        'department' => 'Operations & Relief',
        'phone' => '+880 1711 000111',
        'email' => 'faruk.relief@shantinagar.org',
        'nid_number' => '19902692518000999',
        'joining_date' => now()->format('Y-m-d'),
        'base_salary' => '32000.00',
        'employment_status' => 'active',
        'present_address' => 'Flat 3A, Shanti Nagar, Dhaka',
        'permanent_address' => 'Comilla Sadar, Comilla',
    ];

    $response = $this->actingAs($admin)->post(route('admin.employees.store'), $postData);

    $employee = Employee::where('employee_id', 'EMP-TEST-901')->first();
    expect($employee)->not->toBeNull();
    expect($employee->name)->toBe('Md. Faruk Ahmed');
    expect((float) $employee->base_salary)->toEqual(32000.00);

    $response->assertRedirect(route('admin.employees.show', $employee->id));
});

test('authenticated admin can view employee profile and salary ledger', function () {
    $admin = User::first() ?? User::factory()->create();
    $employee = Employee::first() ?? Employee::create([
        'employee_id' => 'EMP-TEST-100',
        'name' => 'Test Employee',
        'designation' => 'Staff Officer',
        'department' => 'Finance & Accounts',
        'joining_date' => now(),
        'base_salary' => 25000.00,
        'employment_status' => 'active',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.employees.show', $employee->id));

    $response->assertStatus(200);
    $response->assertSee($employee->name);
    $response->assertSee($employee->employee_id);
    $response->assertSee('Salary Disbursement Ledger');
});
