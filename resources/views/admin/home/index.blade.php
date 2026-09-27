@extends('admin.app')

@section('title')
    Dashboard
@endsection

@push('custom-style')
    <style>
        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px 18px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
            border-color: #cbd5e1;
        }

        .stat-icon-wrapper {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
            margin: 4px 0 2px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
        }

        .stat-link {
            font-size: 11.5px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: color 0.15s ease;
        }

        .stat-link:hover {
            text-decoration: underline;
        }

        .dashboard-section-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .dashboard-section-header {
            padding: 14px 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .dashboard-section-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dashboard-section-title::before {
            content: '';
            display: inline-block;
            width: 3px;
            height: 16px;
            background-color: #f65024;
            border-radius: 2px;
        }

        .dashboard-table th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 11px 16px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .dashboard-table td {
            padding: 12px 16px;
            vertical-align: middle;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .dashboard-table tbody tr:hover {
            background-color: #fafbfc;
        }

        .dashboard-table tbody tr:last-child td {
            border-bottom: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        {{-- 8 Real-Time Dynamic NGO KPI Statistics Cards --}}
        <div class="row g-3 mb-4">
            {{-- 1. Total Donations Received --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Total Donations</div>
                            <div class="stat-value" style="color: #059669;">৳ {{ number_format($kpi['total_donations'], 2) }}</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #ecfdf5; color: #059669;">
                            <i class="ri-hand-coin-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.donations.index') }}" class="stat-link" style="color: #059669;">
                            View Receipts <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge" style="background-color: #ecfdf5; color: #065f46; font-size: 11px; font-weight: 600;">{{ $kpi['donations_count'] }} Records</span>
                    </div>
                </div>
            </div>

            {{-- 2. Total Expenditure --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Total Expenditure</div>
                            <div class="stat-value" style="color: #dc2626;">৳ {{ number_format($kpi['total_expenses'], 2) }}</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #fff1f2; color: #dc2626;">
                            <i class="ri-money-dollar-circle-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.expenses.index') }}" class="stat-link" style="color: #dc2626;">
                            View Vouchers <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge" style="background-color: #fee2e2; color: #dc2626; font-size: 11px; font-weight: 600;">Expenses &amp; Salary</span>
                    </div>
                </div>
            </div>

            {{-- 3. Net Fund Balance --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Net Fund Balance</div>
                            <div class="stat-value" style="color: {{ $kpi['net_fund_balance'] >= 0 ? '#2563eb' : '#dc2626' }};">
                                ৳ {{ number_format($kpi['net_fund_balance'], 2) }}
                            </div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #eff6ff; color: #2563eb;">
                            <i class="ri-wallet-3-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.reports.index') }}" class="stat-link" style="color: #2563eb;">
                            Financial Audit <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge bg-light text-muted" style="font-size: 11px;">Available Reserve</span>
                    </div>
                </div>
            </div>

            {{-- 4. Active Donors --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Registered Donors</div>
                            <div class="stat-value" style="color: #f65024;">{{ number_format($kpi['total_donors']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #fff3ee; color: #f65024;">
                            <i class="ri-user-heart-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.donors.index') }}" class="stat-link" style="color: #f65024;">
                            Donor Directory <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge" style="background-color: #fff3ee; color: #f65024; font-size: 11px; font-weight: 600;">Supporters</span>
                    </div>
                </div>
            </div>

            {{-- 5. Active Relief Projects --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Active Projects</div>
                            <div class="stat-value" style="color: #4f46e5;">{{ $kpi['active_projects'] }} / {{ $kpi['total_projects'] }}</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #eef2ff; color: #4f46e5;">
                            <i class="ri-heart-pulse-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.projects.index') }}" class="stat-link" style="color: #4f46e5;">
                            Ongoing Campaigns <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge" style="background-color: #eff6ff; color: #1e40af; font-size: 11px; font-weight: 600;">Relief &amp; Welfare</span>
                    </div>
                </div>
            </div>

            {{-- 6. Total Staff Members --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Staff &amp; Field Workers</div>
                            <div class="stat-value" style="color: #7c3aed;">{{ number_format($kpi['total_employees']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #f5f3ff; color: #7c3aed;">
                            <i class="ri-team-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.employees.index') }}" class="stat-link" style="color: #7c3aed;">
                            Staff Roster <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge bg-light text-muted" style="font-size: 11px;">Active Payroll</span>
                    </div>
                </div>
            </div>

            {{-- 7. Monthly Payroll Link --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Salary &amp; Payroll</div>
                            <div class="stat-value" style="color: #0284c7;">Active</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #f0f9ff; color: #0284c7;">
                            <i class="ri-bank-card-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.salaries.index') }}" class="stat-link" style="color: #0284c7;">
                            Manage Payroll <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge bg-light text-muted" style="font-size: 11px;">Disbursements</span>
                    </div>
                </div>
            </div>

            {{-- 8. Organization Status --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Organization HQ</div>
                            <div class="stat-value" style="font-size: 18px; color: #d97706; padding-top: 5px;">Shanti Nagar</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #fef3c7; color: #d97706;">
                            <i class="ri-map-pin-user-line"></i>
                        </div>
                    </div>
                    <div class="pt-2 mt-2 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('about') }}" target="_blank" class="stat-link" style="color: #d97706;">
                            About Foundation <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <span class="badge bg-light text-dark border" style="font-size: 11px; font-weight: 600;">Dhaka, BD</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Dashboard Dynamic Data Tables Row --}}
        <div class="row g-3">
            {{-- Left Column: Recent Completed Donations --}}
            <div class="col-xl-7 col-lg-12">
                <div class="dashboard-section-card h-100">
                    <div class="dashboard-section-header">
                        <h5 class="dashboard-section-title">Recent Donations</h5>
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary px-3" style="font-size: 12px; height: 32px; border-radius: 6px; font-weight: 600;">
                            View All <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table dashboard-table w-100 mb-0">
                                <thead>
                                    <tr>
                                        <th>Receipt #</th>
                                        <th>Donor Name</th>
                                        <th>Project Cause</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentDonations as $donation)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="fw-bold text-dark font-monospace text-decoration-none" style="font-size: 12.5px;">
                                                    {{ $donation->receipt_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark" style="font-size: 13px;">{{ $donation->donor ? $donation->donor->name : 'Anonymous Donor' }}</div>
                                                <span class="text-muted" style="font-size: 11px;">{{ $donation->donor?->phone ?: 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-semibold text-dark d-block text-truncate" style="max-width: 170px; font-size: 12.5px;">
                                                    {{ $donation->project ? $donation->project->name : 'General Humanitarian Fund' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="fw-bold" style="color: #059669; font-size: 13.5px;">
                                                    ৳ {{ number_format((float) $donation->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">
                                                    {{ strtoupper($donation->payment_method) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-muted" style="font-size: 12px;">{{ $donation->donation_date?->format('M d, Y') }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">No completed donations recorded yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Recent Expenses --}}
            <div class="col-xl-5 col-lg-12">
                <div class="dashboard-section-card h-100">
                    <div class="dashboard-section-header">
                        <h5 class="dashboard-section-title">Recent Expenses &amp; Vouchers</h5>
                        <a href="{{ route('admin.expenses.index') }}" class="btn btn-sm btn-outline-secondary px-3" style="font-size: 12px; height: 32px; border-radius: 6px; font-weight: 600;">
                            View All <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table dashboard-table w-100 mb-0">
                                <thead>
                                    <tr>
                                        <th>Voucher #</th>
                                        <th>Category / Project</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentExpenses as $expense)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.expenses.show', $expense->id) }}" class="fw-bold text-dark font-monospace text-decoration-none" style="font-size: 12.5px;">
                                                    {{ $expense->voucher_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark text-truncate" style="font-size: 12.5px; max-width: 170px;">
                                                    {{ $expense->category instanceof \App\Enums\ExpenseCategory ? $expense->category->label() : ucfirst($expense->category) }}
                                                </div>
                                                <span class="text-muted text-truncate d-block" style="font-size: 11px; max-width: 160px;">
                                                    {{ $expense->project ? $expense->project->name : ($expense->vendor_name ?: 'General Operating Expense') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="fw-bold" style="color: #dc2626; font-size: 13px;">
                                                    ৳ {{ number_format((float) $expense->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-muted" style="font-size: 11.5px;">{{ $expense->expense_date?->format('M d, Y') }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">No expense vouchers recorded yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
