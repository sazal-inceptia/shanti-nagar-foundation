<?php

use App\Models\Expense;
use App\Models\User;

test('authenticated admin can view financial reports dashboard', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.index'));

    $response->assertStatus(200);
    $response->assertSee('Financial Reports &amp; Audit Statement', false);
    $response->assertSee('Total Inflow (Donations)');
    $response->assertSee('Direct Expenditures');
    $response->assertSee('Project-Wise Financial Balance Sheet');
});

test('authenticated admin can view printable financial audit statement', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.statement'));

    $response->assertStatus(200);
    $response->assertSee('FINANCIAL AUDIT STATEMENT', false);
    $response->assertSee('ROTARY CLUB OF SHANTINAGAR DHAKA');
    $response->assertSee('Project &amp; Relief Causes Financial Balance Sheet', false);
});

test('authenticated admin can export financial ledger to csv', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.export'));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
});

test('admin can filter reports by rotary year', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.reports.index', ['year' => '2026', 'rotary_year' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('Rotary Year');
    $response->assertSee('RY 2026–2027 (Current)');
});

test('admin dashboard supports filtering by rotary year', function () {
    $admin = User::first() ?? User::factory()->create();

    $response = $this->actingAs($admin)->get(route('admin.dashboard', ['year' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('RY 2026–2027 (Current)');
});

test('admin report ledger displays voucher attachment links and statement shows audited vouchers trail', function () {
    $admin = User::first() ?? User::factory()->create();

    $expense = Expense::create([
        'voucher_number' => 'TEST-VCH-2026-999',
        'title' => 'Water Purifier Filter Bill',
        'expense_category' => 'Water & Sanitation',
        'amount' => 15000.00,
        'expense_date' => '2026-08-15',
        'payment_method' => 'Cash',
        'recipient_or_vendor' => 'Pure Tech Ltd',
        'receipt_voucher_file' => 'assets/documents/source-docs/RY-2026-2027/Bill for Supply of 6mm Tube Pipe for Water Purifier.pdf',
    ]);

    // Reports Index View shows Voucher link
    $resIndex = $this->actingAs($admin)->get(route('admin.reports.index', ['year' => '2026']));
    $resIndex->assertStatus(200);
    $resIndex->assertSee('TEST-VCH-2026-999');
    $resIndex->assertSee('Voucher');

    // Statement View shows section 3 with audited vouchers
    $resStatement = $this->actingAs($admin)->get(route('admin.reports.statement', ['year' => '2026']));
    $resStatement->assertStatus(200);
    $resStatement->assertSee('Verified Source Vouchers &amp; Proof of Expenditure Audit Trail', false);
    $resStatement->assertSee('TEST-VCH-2026-999');
    $resStatement->assertSee('Verified on File');
});
