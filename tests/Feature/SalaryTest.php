<?php

use App\Models\Employee;
use App\Models\Salary;
use App\Models\User;

test('authenticated admin can view salary payroll list', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.salaries.index'));

    $response->assertStatus(200);
    $response->assertSee('Salary &amp; Payroll Disbursements', false);
});

test('authenticated admin can disburse employee salary and calculate net correctly', function () {
    $admin = User::first() ?? User::factory()->create();
    $employee = Employee::first() ?? Employee::create([
        'employee_id' => 'EMP-TEST-200',
        'name' => 'Payroll Test Staff',
        'designation' => 'Logistics Associate',
        'department' => 'Operations & Relief',
        'joining_date' => now(),
        'base_salary' => 28000.00,
        'employment_status' => 'active',
    ]);

    $postData = [
        'employee_id' => $employee->id,
        'month_year' => 'September 2026',
        'basic_amount' => '28000.00',
        'allowance' => '3000.00',
        'bonus' => '2000.00',
        'deductions' => '1000.00',
        'payment_date' => now()->format('Y-m-d'),
        'payment_method' => 'bank_transfer',
        'transaction_reference' => 'TXN-PAYROLL-9921',
        'status' => 'paid',
        'notes' => 'Disbursed on time',
    ];

    $response = $this->actingAs($admin)->post(route('admin.salaries.store'), $postData);

    $salary = Salary::where('transaction_reference', 'TXN-PAYROLL-9921')->first();
    expect($salary)->not->toBeNull();
    // 28000 + 3000 + 2000 - 1000 = 32000
    expect((float) $salary->net_paid_amount)->toEqual(32000.00);

    $response->assertRedirect(route('admin.salaries.show', $salary->id));
});

test('authenticated admin can view printable salary payslip voucher', function () {
    $admin = User::first() ?? User::factory()->create();
    $employee = Employee::first() ?? Employee::create([
        'employee_id' => 'EMP-TEST-300',
        'name' => 'Voucher Staff',
        'designation' => 'Medical Assistant',
        'department' => 'Healthcare & Medical Support',
        'joining_date' => now(),
        'base_salary' => 30000.00,
        'employment_status' => 'active',
    ]);

    $salary = Salary::create([
        'salary_slip_number' => 'PAY-EMP-TEST-01',
        'employee_id' => $employee->id,
        'month_year' => 'September 2026',
        'basic_amount' => 30000.00,
        'allowance' => 2000.00,
        'bonus' => 0.00,
        'deductions' => 0.00,
        'net_paid_amount' => 32000.00,
        'payment_date' => now(),
        'payment_method' => 'bank_transfer',
        'status' => 'paid',
    ]);

    $response = $this->actingAs($admin)->get(route('admin.salaries.show', $salary->id));

    $response->assertStatus(200);
    $response->assertSee('OFFICIAL SALARY SLIP', false);
    $response->assertSee($salary->salary_slip_number);
    $response->assertSee($employee->name);
});
