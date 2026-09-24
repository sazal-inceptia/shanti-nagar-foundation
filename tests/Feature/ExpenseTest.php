<?php

use App\Models\Expense;
use App\Models\Project;
use App\Models\User;

test('authenticated admin can view expenses list', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.expenses.index'));

    $response->assertStatus(200);
    $response->assertSee('Expenses &amp; Vouchers', false);
});

test('authenticated admin can record an expense voucher', function () {
    $admin = User::first() ?? User::factory()->create();
    $project = Project::first();

    $postData = [
        'voucher_number' => 'VCH-TEST-999',
        'project_id' => $project ? $project->id : null,
        'expense_category' => 'Project Procurement',
        'title' => 'Test Procurement for General Ward',
        'description' => 'Test remarks for relief goods',
        'amount' => '15000.00',
        'expense_date' => now()->format('Y-m-d'),
        'payment_method' => 'Bank Transfer',
        'recipient_or_vendor' => 'Test Vendor Dhaka',
    ];

    $response = $this->actingAs($admin)->post(route('admin.expenses.store'), $postData);

    $expense = Expense::where('voucher_number', 'VCH-TEST-999')->first();
    expect($expense)->not->toBeNull();
    expect((float) $expense->amount)->toEqual(15000.00);

    $response->assertRedirect(route('admin.expenses.show', $expense->id));
});

test('authenticated admin can view printable debit voucher', function () {
    $admin = User::first() ?? User::factory()->create();
    $expense = Expense::first();

    if (! $expense) {
        $expense = Expense::create([
            'voucher_number' => 'VCH-TEST-001',
            'expense_category' => 'Project Procurement',
            'title' => 'Sample Procurement Item',
            'amount' => 5000.00,
            'expense_date' => now(),
            'payment_method' => 'Cash',
            'created_by' => $admin->id,
        ]);
    }

    $response = $this->actingAs($admin)->get(route('admin.expenses.show', $expense->id));

    $response->assertStatus(200);
    $response->assertSee('OFFICIAL DEBIT VOUCHER', false);
    $response->assertSee($expense->voucher_number);
});
