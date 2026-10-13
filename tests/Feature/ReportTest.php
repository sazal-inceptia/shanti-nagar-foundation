<?php

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Salary;
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

test('dashboard and report page calculations match identically and respect filtering', function () {
    $admin = User::first() ?? User::factory()->create();

    $projectA = Project::create([
        'name' => 'Solar Water Pump Project',
        'slug' => 'solar-water-pump-project-calc-test',
        'short_description' => 'Solar pump test',
        'description' => 'Full description',
        'estimated_cost' => 500000.00,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $projectB = Project::create([
        'name' => 'Eye Care Camp 2026',
        'slug' => 'eye-care-camp-2026-calc-test',
        'short_description' => 'Eye care test',
        'description' => 'Full description',
        'estimated_cost' => 200000.00,
        'status' => 'in_progress',
        'is_published' => true,
    ]);

    $donor = Donor::create([
        'name' => 'Dr. Shamsul Alam',
        'email' => 'shamsul@test.com',
    ]);

    $employee = Employee::create([
        'employee_id' => 'EMP-TEST-001',
        'name' => 'Khadiza Begum',
        'joining_date' => '2024-01-01',
        'phone' => '01711111111',
        'base_salary' => 25000.00,
        'is_active' => true,
    ]);

    // 1. RY 2026 Donation for Project A
    Donation::create([
        'receipt_number' => 'REC-CALC-001',
        'donor_id' => $donor->id,
        'project_id' => $projectA->id,
        'amount' => 80000.00,
        'donation_date' => '2026-08-10',
        'payment_method' => 'Bank Transfer',
        'status' => 'completed',
    ]);

    // 2. RY 2026 Donation for Project B
    Donation::create([
        'receipt_number' => 'REC-CALC-002',
        'donor_id' => $donor->id,
        'project_id' => $projectB->id,
        'amount' => 40000.00,
        'donation_date' => '2026-09-15',
        'payment_method' => 'Cash',
        'status' => 'completed',
    ]);

    // 3. RY 2026 Direct Expense for Project A
    Expense::create([
        'voucher_number' => 'EXP-CALC-001',
        'title' => 'Pump Inverter Purchase',
        'expense_category' => 'Water & Sanitation',
        'amount' => 30000.00,
        'expense_date' => '2026-08-20',
        'payment_method' => 'Cash',
        'project_id' => $projectA->id,
    ]);

    // 4. RY 2026 Staff Salary
    Salary::create([
        'salary_slip_number' => 'PAY-CALC-001',
        'employee_id' => $employee->id,
        'month_year' => 'August 2026',
        'basic_amount' => 25000.00,
        'net_paid_amount' => 25000.00,
        'payment_date' => '2026-08-31',
        'payment_method' => 'Bank Transfer',
        'status' => 'paid',
    ]);

    // 5. Past Year (RY 2025) Expense to verify year isolation
    Expense::create([
        'voucher_number' => 'EXP-CALC-PAST',
        'title' => 'Past Year Supplies',
        'expense_category' => 'Office Administration',
        'amount' => 10000.00,
        'expense_date' => '2025-10-10',
        'payment_method' => 'Cash',
    ]);

    // Test Dashboard for RY 2026
    $dashRes = $this->actingAs($admin)->get(route('admin.dashboard', ['year' => '2026']));
    $dashRes->assertStatus(200);
    $dashKpi = $dashRes->viewData('kpi');

    // Test Report for RY 2026
    $reportRes = $this->actingAs($admin)->get(route('admin.reports.index', ['year' => '2026', 'rotary_year' => '2026']));
    $reportRes->assertStatus(200);
    $reportSummary = $reportRes->viewData('summary');

    // Assert Dashboard and Report parity:
    // Total Inflow: 80,000 + 40,000 = 120,000
    expect($dashKpi['total_donations'])->toEqual(120000.00);
    expect($reportSummary['total_inflow'])->toEqual(120000.00);

    // Direct Expenses: 30,000
    expect($reportSummary['total_expenses'])->toEqual(30000.00);
    expect($dashKpi['total_direct_expenses'])->toEqual(30000.00);

    // Staff Salaries: 25,000
    expect($reportSummary['total_salaries'])->toEqual(25000.00);
    expect($dashKpi['total_salaries'])->toEqual(25000.00);

    // Total Outflow: 30,000 + 25,000 = 55,000
    expect($dashKpi['total_expenses'])->toEqual(55000.00);
    expect($reportSummary['total_outflow'])->toEqual(55000.00);

    // Net Balance: 120,000 - 55,000 = 65,000
    expect($dashKpi['net_fund_balance'])->toEqual(65000.00);
    expect($reportSummary['net_balance'])->toEqual(65000.00);

    // Test Filtering by Project A
    $projectFilterRes = $this->actingAs($admin)->get(route('admin.reports.index', [
        'year' => '2026',
        'rotary_year' => '2026',
        'project_id' => $projectA->id,
    ]));
    $pSummary = $projectFilterRes->viewData('summary');
    expect($pSummary['total_inflow'])->toEqual(80000.00);
    expect($pSummary['total_expenses'])->toEqual(30000.00);
    expect($pSummary['total_salaries'])->toEqual(0.0); // Salaries excluded when project filtered
    expect($pSummary['total_outflow'])->toEqual(30000.00);
    expect($pSummary['net_balance'])->toEqual(50000.00);

    // Test Custom Date Range Filter (Only August 2026: covers Donation A, Expense A, Salary A; excludes September Donation B)
    $dateFilterRes = $this->actingAs($admin)->get(route('admin.reports.index', [
        'start_date' => '2026-08-01',
        'end_date' => '2026-08-31',
    ]));
    $dSummary = $dateFilterRes->viewData('summary');
    expect($dSummary['total_inflow'])->toEqual(80000.00);
    expect($dSummary['total_expenses'])->toEqual(30000.00);
    expect($dSummary['total_salaries'])->toEqual(25000.00);
    expect($dSummary['total_outflow'])->toEqual(55000.00);
    expect($dSummary['net_balance'])->toEqual(25000.00);
});
