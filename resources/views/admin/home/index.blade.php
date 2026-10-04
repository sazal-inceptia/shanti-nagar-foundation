@extends('admin.app')

@section('title')
    Dashboard
@endsection

@push('custom-style')
    <style>
        /* Premium Clean NGO Dashboard Styles */
        .dashboard-hero-bar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .dashboard-hero-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dashboard-hero-sub {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px 18px;
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.05);
            border-color: #cbd5e1;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: transparent;
        }
        .stat-label {
            font-size: 11.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #64748b;
            margin-bottom: 3px;
        }

        .stat-value {
            font-size: 19px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.25;
            letter-spacing: -0.01em;
            margin: 2px 0 2px;
            font-variant-numeric: tabular-nums;
        }

        .stat-currency {
            font-size: 14px;
            font-weight: 500;
            opacity: 0.75;
            margin-right: 2px;
        }

        .stat-subtext {
            font-size: 11px;
            color: #94a3b8;
            margin-bottom: 0;
        }

        .stat-icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-footer {
            padding-top: 10px;
            margin-top: 10px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-link {
            font-size: 11.5px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            transition: all 0.15s ease;
        }

        .stat-link:hover {
            opacity: 0.85;
            text-decoration: underline;
        }

        .stat-badge {
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 5px;
        }

        /* Section Cards */
        .dashboard-section-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .dashboard-section-header {
            padding: 13px 18px;
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .dashboard-section-title {
            font-size: 13.5px;
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
            height: 14px;
            background-color: #005daa;
            border-radius: 2px;
        }

        /* Tables */
        .dashboard-table {
            margin-bottom: 0;
        }

        .dashboard-table th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 10px 16px;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }

        .dashboard-table td {
            padding: 11px 16px;
            vertical-align: middle;
            font-size: 12.5px;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
        }

        .dashboard-table tbody tr:hover {
            background-color: #fafbfc;
        }

        .dashboard-table tbody tr:last-child td {
            border-bottom: none;
        }

        .table-amount-inflow {
            font-size: 12.5px;
            font-weight: 600;
            color: #059669;
            font-variant-numeric: tabular-nums;
        }

        .table-amount-outflow {
            font-size: 12.5px;
            font-weight: 600;
            color: #dc2626;
            font-variant-numeric: tabular-nums;
        }

        .table-badge-method {
            background-color: #f1f5f9;
            color: #334155;
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 4px;
            letter-spacing: 0.02em;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        {{-- Top Greeting & Quick Actions Bar --}}
        <div class="dashboard-hero-bar">
            <div>
                <h4 class="dashboard-hero-title">
                    <span>Rotary Club of Shantinagar Dhaka</span>
                    <span class="badge" style="background-color: #e8f1f8; color: #005daa; font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 6px;">
                        District 3281
                    </span>
                </h4>
                <p class="dashboard-hero-sub">Financial Overview, Humanitarian Relief Inflow &amp; Expenditure Ledger</p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted d-none d-sm-inline" style="font-size: 12px;">
                    <i class="ri-calendar-line me-1"></i> {{ date('l, F d, Y') }}
                </span>
                <a href="{{ route('admin.donations.create') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1" style="font-size: 12px; height: 32px; padding: 0 12px; border-radius: 6px;">
                    <i class="ri-add-line"></i> Record Donation
                </a>
            </div>
        </div>

        {{-- 4 Primary Real-Time KPI Statistics Cards --}}
        <div class="row g-3 mb-4">
            {{-- 1. Total Donations (Inflow) --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card stat-card-green">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Total Donations</div>
                            <div class="stat-value" style="color: #059669;">
                                <span class="stat-currency">৳</span>{{ number_format($kpi['total_donations'], 2) }}
                            </div>
                            <div class="stat-subtext">Total verified collections</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #ecfdf5; color: #059669;">
                            <i class="ri-hand-coin-line"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.donations.index') }}" class="stat-link" style="color: #059669;">
                            View Receipts <i class="ri-arrow-right-line"></i>
                        </a>
                        <span class="stat-badge" style="background-color: #ecfdf5; color: #065f46;">
                            {{ $kpi['donations_count'] }} Records
                        </span>
                    </div>
                </div>
            </div>

            {{-- 2. Total Expenditure (Outflow) --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card stat-card-red">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Total Expenditure</div>
                            <div class="stat-value" style="color: #dc2626;">
                                <span class="stat-currency">৳</span>{{ number_format($kpi['total_expenses'], 2) }}
                            </div>
                            <div class="stat-subtext">Project relief &amp; staff salary</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #fff1f2; color: #dc2626;">
                            <i class="ri-money-dollar-circle-line"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.expenses.index') }}" class="stat-link" style="color: #dc2626;">
                            View Vouchers <i class="ri-arrow-right-line"></i>
                        </a>
                        <span class="stat-badge" style="background-color: #fee2e2; color: #dc2626;">
                            Disbursements
                        </span>
                    </div>
                </div>
            </div>

            {{-- 3. Net Fund Balance (Available Reserve) --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card stat-card-blue">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Net Available Reserve</div>
                            <div class="stat-value" style="color: {{ $kpi['net_fund_balance'] >= 0 ? '#005daa' : '#dc2626' }};">
                                <span class="stat-currency">৳</span>{{ number_format($kpi['net_fund_balance'], 2) }}
                            </div>
                            <div class="stat-subtext">Current treasury reserve</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #e8f1f8; color: #005daa;">
                            <i class="ri-wallet-3-line"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.reports.index') }}" class="stat-link" style="color: #005daa;">
                            Audit Statement <i class="ri-arrow-right-line"></i>
                        </a>
                        <span class="stat-badge" style="background-color: #e8f1f8; color: #005daa;">
                            {{ $kpi['net_fund_balance'] >= 0 ? 'Surplus Reserve' : 'Deficit' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- 4. Registered Donors & Supporters --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="stat-card stat-card-indigo">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-label">Registered Donors</div>
                            <div class="stat-value" style="color: #4f46e5;">
                                {{ number_format($kpi['total_donors']) }}
                            </div>
                            <div class="stat-subtext">{{ $kpi['active_projects'] }} Active Relief Causes</div>
                        </div>
                        <div class="stat-icon-wrapper" style="background-color: #eef2ff; color: #4f46e5;">
                            <i class="ri-user-heart-line"></i>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <a href="{{ route('admin.donors.index') }}" class="stat-link" style="color: #4f46e5;">
                            Donor Directory <i class="ri-arrow-right-line"></i>
                        </a>
                        <span class="stat-badge" style="background-color: #eef2ff; color: #4338ca;">
                            Supporters
                        </span>
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
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary px-3" style="font-size: 11.5px; height: 30px; border-radius: 6px; font-weight: 600;">
                            View All <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table dashboard-table w-100 mb-0">
                                <thead>
                                    <tr>
                                        <th>Receipt #</th>
                                        <th>Donor</th>
                                        <th>Project Cause</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentDonations as $donation)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="fw-bold font-monospace text-decoration-none" style="color: #005daa; font-size: 12px;">
                                                    {{ $donation->receipt_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark" style="font-size: 12.5px;">{{ $donation->donor ? $donation->donor->name : 'Anonymous Donor' }}</div>
                                                <span class="text-muted" style="font-size: 11px;">{{ $donation->donor?->phone ?: 'N/A' }}</span>
                                            </td>
                                            <td>
                                                <span class="text-dark d-block text-truncate" style="max-width: 170px; font-size: 12px; font-weight: 500;">
                                                    {{ $donation->project ? $donation->project->name : 'General Humanitarian Fund' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="table-amount-inflow">
                                                    ৳ {{ number_format((float) $donation->amount, 2) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="table-badge-method">
                                                    {{ strtoupper($donation->payment_method) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-muted" style="font-size: 11.5px;">{{ $donation->donation_date?->format('M d, Y') }}</span>
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
                        <a href="{{ route('admin.expenses.index') }}" class="btn btn-sm btn-outline-secondary px-3" style="font-size: 11.5px; height: 30px; border-radius: 6px; font-weight: 600;">
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
                                                <a href="{{ route('admin.expenses.show', $expense->id) }}" class="fw-bold font-monospace text-decoration-none" style="color: #dc2626; font-size: 12px;">
                                                    {{ $expense->voucher_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark text-truncate" style="font-size: 12.5px; max-width: 160px;">
                                                    {{ $expense->category instanceof \App\Enums\ExpenseCategory ? $expense->category->label() : ucfirst($expense->category) }}
                                                </div>
                                                <span class="text-muted text-truncate d-block" style="font-size: 11px; max-width: 150px;">
                                                    {{ $expense->project ? $expense->project->name : ($expense->vendor_name ?: 'General Operating Expense') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="table-amount-outflow">
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
