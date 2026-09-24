@extends('admin.app')
@section('title')
    Financial Reports &amp; Audit Statement
@endsection

@section('content')
    <div class="container-fluid my-3">
        {{-- Top Header Action Card --}}
        <div class="row">
            <div class="col-12">
                <div class="card table-card mb-4 shadow-sm border-0" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header table-header d-flex justify-content-between align-items-center flex-wrap gap-3 py-3" style="background: #ffffff; border-bottom: 1px solid #f1f5f9;">
                        <div class="title-with-breadcrumb">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(246, 80, 36, 0.1); color: #f65024;">
                                    <i class="ri-file-chart-line" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h4 class="table-title mb-0" style="font-weight: 700; font-size: 18px; color: #0f172a;">Financial Reports &amp; Audit Statement</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0" style="font-size: 12px;">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                                            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Financial Reports</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.reports.export', request()->query()) }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 py-2"
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; font-size: 13px; transition: all 0.2s ease;">
                                <i class="ri-download-2-line" style="font-size: 15px;"></i> Export CSV Ledger
                            </a>
                            <a href="{{ route('admin.reports.statement', request()->query()) }}" target="_blank" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 py-2 text-white"
                                style="background: linear-gradient(135deg, #f65024 0%, #ea580c 100%); border-radius: 8px; font-weight: 600; font-size: 13px; box-shadow: 0 4px 12px rgba(246, 80, 36, 0.25); border: none; transition: all 0.2s ease;">
                                <i class="ri-printer-line" style="font-size: 15px;"></i> Print Audit Statement
                            </a>
                        </div>
                    </div>

                    {{-- Filter Controls Bar --}}
                    <div class="card-body" style="background-color: #fafbfc; padding: 16px 20px; border-bottom: 1px solid #eef2f6;">
                        <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-2 align-items-end">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <label class="form-label mb-1 text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                                    <i class="ri-calendar-line me-1 text-secondary"></i> Start Date
                                </label>
                                <input type="date" name="start_date" class="form-control form-control-sm bg-white"
                                    value="{{ request('start_date') }}" onclick="this.showPicker()" style="height: 36px; font-size: 13px; border-color: #d1d5db; border-radius: 6px;">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <label class="form-label mb-1 text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                                    <i class="ri-calendar-check-line me-1 text-secondary"></i> End Date
                                </label>
                                <input type="date" name="end_date" class="form-control form-control-sm bg-white"
                                    value="{{ request('end_date') }}" onclick="this.showPicker()" style="height: 36px; font-size: 13px; border-color: #d1d5db; border-radius: 6px;">
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <label class="form-label mb-1 text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                                    <i class="ri-folder-shared-line me-1 text-secondary"></i> Project Allocation
                                </label>
                                <select name="project_id" class="form-select form-select-sm bg-white" style="height: 36px; font-size: 13px; border-color: #d1d5db; border-radius: 6px;">
                                    <option value="">All Projects &amp; General Fund</option>
                                    @foreach($projects as $prj)
                                        <option value="{{ $prj->id }}" {{ request('project_id') == $prj->id ? 'selected' : '' }}>
                                            {{ $prj->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-4">
                                <label class="form-label mb-1 text-muted" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                                    <i class="ri-calendar-2-line me-1 text-secondary"></i> Fiscal Year
                                </label>
                                <select name="year" class="form-select form-select-sm bg-white" style="height: 36px; font-size: 13px; border-color: #d1d5db; border-radius: 6px;">
                                    @for($y = date('Y'); $y >= 2024; $y--)
                                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-2 col-sm-2 d-flex align-items-end gap-1 pb-1">
                                <button type="submit" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Apply Filter"
                                    style="background-color: #f65024; color: #fff; width: 36px; height: 36px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 16px; border: none; box-shadow: 0 2px 6px rgba(246, 80, 36, 0.25);">
                                    <i class="ri-filter-3-line"></i>
                                </button>
                                <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Filters"
                                    style="width: 36px; height: 36px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; font-size: 16px; border-color: #cbd5e1;">
                                    <i class="ri-refresh-line"></i>
                                </a>
                            </div>
                        </form>

                        @if(request('start_date') || request('end_date') || request('project_id'))
                            <div class="d-flex align-items-center gap-2 mt-2 pt-2 border-top flex-wrap" style="font-size: 12px;">
                                <span class="text-muted fw-semibold"><i class="ri-sound-module-line me-1"></i>Active Filters:</span>
                                @if(request('start_date'))
                                    <span class="badge bg-white text-dark border px-2 py-1">From: {{ request('start_date') }}</span>
                                @endif
                                @if(request('end_date'))
                                    <span class="badge bg-white text-dark border px-2 py-1">To: {{ request('end_date') }}</span>
                                @endif
                                @if(request('project_id'))
                                    @php $activeProject = $projects->firstWhere('id', request('project_id')); @endphp
                                    <span class="badge bg-white text-dark border px-2 py-1">Project: {{ $activeProject ? $activeProject->name : 'ID #'.request('project_id') }}</span>
                                @endif
                                <a href="{{ route('admin.reports.index') }}" class="text-danger text-decoration-none fw-semibold ms-1" style="font-size: 11.5px;">
                                    Clear all <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- 4 Primary KPI Summary Cards --}}
        <div class="row g-3 mb-4">
            {{-- Card 1: Total Inflow --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card border-0 shadow-sm p-3 h-100 report-kpi-card position-relative overflow-hidden"
                    style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #047857 !important;">
                            Total Inflow (Donations)
                        </span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(16, 185, 129, 0.12);">
                            <i class="ri-hand-coin-line text-success" style="font-size: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="font-size: 24px; color: #059669; letter-spacing: -0.02em;">৳ {{ number_format($summary['total_inflow'], 2) }}</h3>
                    <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top" style="font-size: 12px;">
                        <span class="text-muted"><i class="ri-user-heart-line me-1 text-success"></i><strong>{{ $summary['donation_count'] }}</strong> Donations</span>
                        <span class="badge" style="background-color: #ecfdf5; color: #065f46; font-size: 11px; font-weight: 600;">Verified Receipts</span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Direct Expenditures --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card border-0 shadow-sm p-3 h-100 report-kpi-card position-relative overflow-hidden"
                    style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #b91c1c !important;">
                            Direct Expenditures
                        </span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(239, 68, 68, 0.12);">
                            <i class="ri-shopping-bag-3-line text-danger" style="font-size: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="font-size: 24px; color: #dc2626; letter-spacing: -0.02em;">৳ {{ number_format($summary['total_expenses'], 2) }}</h3>
                    <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top" style="font-size: 12px;">
                        <span class="text-muted"><i class="ri-file-list-3-line me-1 text-danger"></i><strong>{{ $summary['expense_count'] }}</strong> Vouchers</span>
                        <span class="badge" style="background-color: #fef2f2; color: #991b1b; font-size: 11px; font-weight: 600;">Project Debits</span>
                    </div>
                </div>
            </div>

            {{-- Card 3: Staff Salaries & HR --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card border-0 shadow-sm p-3 h-100 report-kpi-card position-relative overflow-hidden"
                    style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #b45309 !important;">
                            Staff Salaries &amp; HR
                        </span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(245, 158, 11, 0.12);">
                            <i class="ri-wallet-3-line text-warning" style="font-size: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="font-size: 24px; color: #d97706; letter-spacing: -0.02em;">৳ {{ number_format($summary['total_salaries'], 2) }}</h3>
                    <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top" style="font-size: 12px;">
                        <span class="text-muted"><i class="ri-team-line me-1 text-warning"></i><strong>{{ $summary['salary_count'] }}</strong> Paid Slips</span>
                        <span class="badge" style="background-color: #fffbeb; color: #92400e; font-size: 11px; font-weight: 600;">Payroll Outflow</span>
                    </div>
                </div>
            </div>

            {{-- Card 4: Net Fund Reserve --}}
            <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-12">
                @php
                    $isSurplus = $summary['net_balance'] >= 0;
                    $topAccent = $isSurplus ? '#3b82f6' : '#ef4444';
                    $textColor = $isSurplus ? '#2563eb' : '#dc2626';
                    $badgeBg = $isSurplus ? '#eff6ff' : '#fef2f2';
                    $badgeColor = $isSurplus ? '#1e40af' : '#991b1b';
                @endphp
                <div class="card border-0 shadow-sm p-3 h-100 report-kpi-card position-relative overflow-hidden"
                    style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0 !important;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: {{ $badgeColor }} !important;">
                            Net Fund Reserve
                        </span>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(59, 130, 246, 0.12);">
                            <i class="ri-scales-3-line text-primary" style="font-size: 20px;"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-1" style="font-size: 24px; color: {{ $textColor }}; letter-spacing: -0.02em;">৳ {{ number_format($summary['net_balance'], 2) }}</h3>
                    <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top" style="font-size: 12px;">
                        <span class="text-muted"><i class="ri-bank-line me-1 text-primary"></i>Treasury Balance</span>
                        <span class="badge" style="background-color: {{ $badgeBg }}; color: {{ $badgeColor }}; font-size: 11px; font-weight: 600;">
                            {{ $isSurplus ? '● Net Surplus Reserve' : '● Net Deficit' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Interactive Tabbed Analytics Hub --}}
        <div class="row">
            <div class="col-12">
                <div class="card table-card shadow-sm border-0 mb-4" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header table-header p-3" style="background-color: #ffffff; border-bottom: 1px solid #e2e8f0;">
                        <ul class="nav nav-pills report-nav-pills gap-2" id="reportTabs" role="tablist" style="background-color: #f1f5f9; padding: 6px; border-radius: 10px;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active px-3 py-2 fw-semibold" id="ledger-tab" data-bs-toggle="pill" data-bs-target="#ledger-pane" type="button" role="tab" style="font-size: 13px; border-radius: 8px;">
                                    <i class="ri-file-list-3-line me-1"></i> Transaction Audit Ledger
                                    <span class="badge bg-light text-dark ms-1 font-monospace" style="font-size: 11px;">{{ $transactions->count() }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-3 py-2 fw-semibold" id="projects-tab" data-bs-toggle="pill" data-bs-target="#projects-pane" type="button" role="tab" style="font-size: 13px; border-radius: 8px;">
                                    <i class="ri-folder-chart-line me-1"></i> Project-Wise Financial Balance Sheet
                                    <span class="badge bg-light text-dark ms-1 font-monospace" style="font-size: 11px;">{{ $projectBalances->count() }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-3 py-2 fw-semibold" id="monthly-tab" data-bs-toggle="pill" data-bs-target="#monthly-pane" type="button" role="tab" style="font-size: 13px; border-radius: 8px;">
                                    <i class="ri-bar-chart-box-line me-1"></i> Monthly Annual Flow &amp; Chart ({{ $year }})
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-3 py-2 fw-semibold" id="categories-tab" data-bs-toggle="pill" data-bs-target="#categories-pane" type="button" role="tab" style="font-size: 13px; border-radius: 8px;">
                                    <i class="ri-pie-chart-line me-1"></i> Expense Distribution
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-3">
                        <div class="tab-content" id="reportTabsContent">
                            {{-- TAB 1: Transactions Audit Ledger --}}
                            <div class="tab-pane fade show active" id="ledger-pane" role="tabpanel" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table dataTable table-hover align-middle w-100" id="transactions-table" style="font-size: 13px; min-width: 950px;">
                                        <thead style="background-color: #f8fafc;">
                                            <tr>
                                                <th style="width: 45px;">SL</th>
                                                <th style="width: 100px;">Date</th>
                                                <th style="width: 110px;">Type</th>
                                                <th style="width: 140px;">Ref / Slip #</th>
                                                <th style="min-width: 220px;">Title &amp; Particulars</th>
                                                <th style="width: 180px;">Project Allocation</th>
                                                <th style="width: 110px;">Method</th>
                                                <th style="width: 130px; text-align: right;">Inflow (৳)</th>
                                                <th style="width: 130px; text-align: right;">Outflow (৳)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $idx => $txn)
                                                <tr>
                                                    <td class="text-muted">{{ $idx + 1 }}</td>
                                                    <td style="font-size: 12.5px;" class="text-dark">
                                                        {{ $txn['date'] ? $txn['date']->format('M d, Y') : '-' }}
                                                    </td>
                                                    <td>
                                                        <span class="badge" style="{{ $txn['type_badge'] }} font-size: 11px; padding: 5px 9px; border-radius: 6px; font-weight: 600;">
                                                            {{ $txn['type'] }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ $txn['view_url'] }}" class="fw-bold text-dark text-decoration-none font-monospace table-title-link" style="font-size: 12.5px;">
                                                            {{ $txn['reference'] }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="text-dark fw-semibold" style="font-size: 13px;">{{ $txn['title'] }}</span>
                                                    </td>
                                                    <td style="font-size: 12px;" class="text-muted">
                                                        <i class="ri-folder-line me-1 text-secondary"></i>{{ $txn['project_name'] }}
                                                    </td>
                                                    <td style="font-size: 11.5px;">
                                                        <span class="badge bg-light text-dark border px-2 py-1">
                                                            {{ strtoupper(str_replace('_', ' ', $txn['payment_method'])) }}
                                                        </span>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        @if($txn['inflow'] > 0)
                                                            <span class="fw-bold text-success" style="font-size: 13.5px;">
                                                                + ৳ {{ number_format($txn['inflow'], 2) }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: right;">
                                                        @if($txn['outflow'] > 0)
                                                            <span class="fw-bold text-danger" style="font-size: 13.5px;">
                                                                - ৳ {{ number_format($txn['outflow'], 2) }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- TAB 2: Project Balance Sheets --}}
                            <div class="tab-pane fade" id="projects-pane" role="tabpanel" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table dataTable table-hover align-middle w-100" id="project-balances-table" style="font-size: 13px; min-width: 900px;">
                                        <thead style="background-color: #f8fafc;">
                                            <tr>
                                                <th style="min-width: 220px;">Project Cause</th>
                                                <th style="text-align: right; width: 140px;">Target Budget</th>
                                                <th style="text-align: right; width: 140px;">Donations Raised</th>
                                                <th style="text-align: right; width: 140px;">Total Spent</th>
                                                <th style="text-align: right; width: 140px;">Net Surplus / Balance</th>
                                                <th style="width: 160px;">Funding Progress</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($projectBalances as $pb)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.projects.show', $pb['id']) }}" class="fw-bold text-dark text-decoration-none table-title-link d-block">
                                                            {{ $pb['name'] }}
                                                        </a>
                                                        <span class="badge bg-light text-muted border mt-1" style="font-size: 11px;">
                                                            {{ $pb['category'] }}
                                                        </span>
                                                    </td>
                                                    <td style="text-align: right;" class="text-muted">
                                                        ৳ {{ number_format($pb['target_amount'], 2) }}
                                                    </td>
                                                    <td style="text-align: right;" class="text-success fw-bold">
                                                        ৳ {{ number_format($pb['total_raised'], 2) }}
                                                    </td>
                                                    <td style="text-align: right;" class="text-danger fw-bold">
                                                        ৳ {{ number_format($pb['total_spent'], 2) }}
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <strong class="{{ $pb['net_balance'] >= 0 ? 'text-primary' : 'text-danger' }}" style="font-size: 14px;">
                                                            ৳ {{ number_format($pb['net_balance'], 2) }}
                                                        </strong>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="progress flex-grow-1" style="height: 8px; border-radius: 6px; background-color: #e2e8f0;">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ min(100, $pb['raised_percent']) }}%; background: linear-gradient(90deg, #f65024 0%, #ea580c 100%); border-radius: 6px;"
                                                                    aria-valuenow="{{ $pb['raised_percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="text-dark fw-bold font-monospace" style="font-size: 11.5px; min-width: 40px; text-align: right;">{{ $pb['raised_percent'] }}%</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- TAB 3: Monthly Breakdown & Interactive Chart --}}
                            <div class="tab-pane fade" id="monthly-pane" role="tabpanel" tabindex="0">
                                {{-- Visual Analytics Chart Container --}}
                                <div class="card border-0 mb-4 p-3 shadow-none" style="background-color: #fafbfc; border: 1px solid #e2e8f0 !important; border-radius: 10px;">
                                    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                                <i class="ri-line-chart-line text-primary"></i> Monthly Inflow vs Outflow Overview (Fiscal Year {{ $year }})
                                            </h6>
                                            <span class="text-muted" style="font-size: 12px;">Visual cash-flow performance across all 12 calendar months</span>
                                        </div>
                                        <div class="d-flex align-items-center gap-3" style="font-size: 12px;">
                                            <span class="d-inline-flex align-items-center gap-1"><span style="width: 12px; height: 12px; background: #10b981; border-radius: 3px; display: inline-block;"></span> Donations Inflow</span>
                                            <span class="d-inline-flex align-items-center gap-1"><span style="width: 12px; height: 12px; background: #ef4444; border-radius: 3px; display: inline-block;"></span> Total Outflow</span>
                                        </div>
                                    </div>
                                    <div style="position: relative; height: 280px; width: 100%;">
                                        <canvas id="monthlyFlowChart"></canvas>
                                    </div>
                                </div>

                                {{-- Monthly Detailed Table --}}
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                        <thead style="background-color: #f8fafc;">
                                            <tr>
                                                <th style="padding: 12px 16px; width: 60px;">#</th>
                                                <th style="padding: 12px 16px; min-width: 140px;">Month</th>
                                                <th style="padding: 12px 16px; text-align: right; width: 180px;">Donations Inflow (৳)</th>
                                                <th style="padding: 12px 16px; text-align: right; width: 170px;">Project Expenses (৳)</th>
                                                <th style="padding: 12px 16px; text-align: right; width: 170px;">Staff Salaries (৳)</th>
                                                <th style="padding: 12px 16px; text-align: right; width: 180px;">Total Outflow (৳)</th>
                                                <th style="padding: 12px 16px; text-align: right; width: 180px;">Net Surplus / (Deficit)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totYearInflow = 0;
                                                $totYearExp = 0;
                                                $totYearSal = 0;
                                                $totYearOutflow = 0;
                                                $totYearSurplus = 0;
                                            @endphp
                                            @foreach($monthlyBreakdown as $m)
                                                @php
                                                    $totYearInflow += $m['inflow'];
                                                    $totYearExp += $m['expenses'];
                                                    $totYearSal += $m['salaries'];
                                                    $totYearOutflow += $m['outflow'];
                                                    $totYearSurplus += $m['surplus'];
                                                @endphp
                                                <tr>
                                                    <td style="padding: 10px 16px;" class="text-muted font-monospace">{{ sprintf('%02d', $m['month_number']) }}</td>
                                                    <td style="padding: 10px 16px;" class="fw-bold text-dark">{{ $m['month_name'] }}</td>
                                                    <td style="padding: 10px 16px; text-align: right;" class="text-success fw-semibold">
                                                        ৳ {{ number_format($m['inflow'], 2) }}
                                                    </td>
                                                    <td style="padding: 10px 16px; text-align: right;" class="text-muted">
                                                        ৳ {{ number_format($m['expenses'], 2) }}
                                                    </td>
                                                    <td style="padding: 10px 16px; text-align: right;" class="text-muted">
                                                        ৳ {{ number_format($m['salaries'], 2) }}
                                                    </td>
                                                    <td style="padding: 10px 16px; text-align: right;" class="text-danger fw-semibold">
                                                        ৳ {{ number_format($m['outflow'], 2) }}
                                                    </td>
                                                    <td style="padding: 10px 16px; text-align: right;">
                                                        <span class="badge" style="{{ $m['surplus'] >= 0 ? 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;' : 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;' }} font-size: 12px; padding: 4px 8px; border-radius: 6px;">
                                                            {{ $m['surplus'] >= 0 ? '+' : '' }}৳ {{ number_format($m['surplus'], 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="background-color: #f1f5f9; font-weight: 700;">
                                                <td colspan="2" style="padding: 12px 16px;" class="text-dark">Annual Total ({{ $year }}):</td>
                                                <td style="padding: 12px 16px; text-align: right;" class="text-success">৳ {{ number_format($totYearInflow, 2) }}</td>
                                                <td style="padding: 12px 16px; text-align: right;" class="text-dark">৳ {{ number_format($totYearExp, 2) }}</td>
                                                <td style="padding: 12px 16px; text-align: right;" class="text-dark">৳ {{ number_format($totYearSal, 2) }}</td>
                                                <td style="padding: 12px 16px; text-align: right;" class="text-danger">৳ {{ number_format($totYearOutflow, 2) }}</td>
                                                <td style="padding: 12px 16px; text-align: right;">
                                                    <strong class="{{ $totYearSurplus >= 0 ? 'text-success' : 'text-danger' }}" style="font-size: 14px;">
                                                        ৳ {{ number_format($totYearSurplus, 2) }}
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            {{-- TAB 4: Expense Categories & Distribution --}}
                            <div class="tab-pane fade" id="categories-pane" role="tabpanel" tabindex="0">
                                <div class="row g-4 align-items-center">
                                    {{-- Left: Donut Chart --}}
                                    <div class="col-lg-5 col-md-12 text-center">
                                        <div class="p-3 border rounded-3 bg-light d-flex flex-column align-items-center justify-content-center" style="min-height: 320px;">
                                            <h6 class="fw-bold text-dark mb-3">Category Allocation Share</h6>
                                            @if($categoryBreakdown->count() > 0)
                                                <div style="position: relative; width: 230px; height: 230px;">
                                                    <canvas id="expenseDonutChart"></canvas>
                                                </div>
                                            @else
                                                <div class="text-muted py-5">
                                                    <i class="ri-pie-chart-line" style="font-size: 40px;"></i>
                                                    <p class="mt-2 mb-0">No expense records to visualize.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Right: Categories Table --}}
                                    <div class="col-lg-7 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                                <thead style="background-color: #f8fafc;">
                                                    <tr>
                                                        <th style="padding: 12px 16px;">Expenditure Category</th>
                                                        <th style="padding: 12px 12px; text-align: center; width: 120px;">Vouchers</th>
                                                        <th style="padding: 12px 16px; text-align: right; width: 170px;">Total Spent (৳)</th>
                                                        <th style="padding: 12px 16px; text-align: right; width: 110px;">Share (%)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalCatAmount = $categoryBreakdown->sum('total_amount');
                                                        $categoryColors = ['#f65024', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#64748b'];
                                                    @endphp
                                                    @forelse($categoryBreakdown as $cIdx => $cat)
                                                        @php
                                                            $color = $categoryColors[$cIdx % count($categoryColors)];
                                                            $sharePct = $totalCatAmount > 0 ? round(($cat->total_amount / $totalCatAmount) * 100, 1) : 0;
                                                        @endphp
                                                        <tr>
                                                            <td style="padding: 12px 16px;">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div class="rounded-circle" style="width: 10px; height: 10px; background-color: {{ $color }};"></div>
                                                                    <strong class="text-dark" style="font-size: 13.5px;">{{ $cat->expense_category }}</strong>
                                                                </div>
                                                            </td>
                                                            <td style="padding: 12px 12px; text-align: center;">
                                                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace" style="font-size: 12px;">{{ $cat->total_count }}</span>
                                                            </td>
                                                            <td style="padding: 12px 16px; text-align: right;" class="fw-bold text-danger" style="font-size: 14px;">
                                                                ৳ {{ number_format((float) $cat->total_amount, 2) }}
                                                            </td>
                                                            <td style="padding: 12px 16px; text-align: right;">
                                                                <span class="badge bg-light text-dark border font-monospace">{{ $sharePct }}%</span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center py-5 text-muted">No expenditure records found for this period.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                                @if($categoryBreakdown->count() > 0)
                                                    <tfoot>
                                                        <tr style="background-color: #f1f5f9; font-weight: 700;">
                                                            <td style="padding: 12px 16px;" class="text-dark">Total Direct Expenses:</td>
                                                            <td style="padding: 12px 12px; text-align: center;" class="font-monospace">{{ $categoryBreakdown->sum('total_count') }}</td>
                                                            <td style="padding: 12px 16px; text-align: right;" class="text-danger">৳ {{ number_format($totalCatAmount, 2) }}</td>
                                                            <td style="padding: 12px 16px; text-align: right;" class="font-monospace">100%</td>
                                                        </tr>
                                                    </tfoot>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <style>
        .report-kpi-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .report-kpi-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -6px rgba(0, 0, 0, 0.08) !important;
        }
        .report-nav-pills .nav-link {
            color: #475569;
            background-color: transparent;
            transition: all 0.2s ease;
        }
        .report-nav-pills .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #f65024 0%, #ea580c 100%) !important;
            box-shadow: 0 4px 10px rgba(246, 80, 36, 0.35);
        }
        .report-nav-pills .nav-link:hover:not(.active) {
            color: #0f172a;
            background-color: rgba(255, 255, 255, 0.9);
        }
        .table-title-link:hover {
            color: #f65024 !important;
            text-decoration: underline !important;
        }
    </style>
@endpush

@push('custom-script')
    {{-- Include Chart.js CDN for Interactive Visualizations --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Tooltips initialization
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // 1. Transactions Ledger DataTable
            if ($('#transactions-table').length) {
                $('#transactions-table').DataTable({
                    pageLength: 15,
                    lengthMenu: [10, 15, 25, 50, 100],
                    order: [[1, 'desc']],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search transaction ref, title, project...",
                        paginate: {
                            next: '<i class="ri-arrow-right-s-line"></i>',
                            previous: '<i class="ri-arrow-left-s-line"></i>'
                        }
                    }
                });
            }

            // 2. Project Balances DataTable
            if ($('#project-balances-table').length) {
                $('#project-balances-table').DataTable({
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    order: [[2, 'desc']],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search project cause, category...",
                        paginate: {
                            next: '<i class="ri-arrow-right-s-line"></i>',
                            previous: '<i class="ri-arrow-left-s-line"></i>'
                        }
                    }
                });
            }

            // 3. Monthly Inflow vs Outflow Bar Chart
            var monthlyData = @json($monthlyBreakdown);
            var monthLabels = monthlyData.map(function(item) { return item.month_name.substring(0, 3); });
            var inflowData = monthlyData.map(function(item) { return item.inflow; });
            var outflowData = monthlyData.map(function(item) { return item.outflow; });

            var flowChartCanvas = document.getElementById('monthlyFlowChart');
            var monthlyChart = null;

            if (flowChartCanvas) {
                monthlyChart = new Chart(flowChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: [
                            {
                                label: 'Donations Inflow (৳)',
                                data: inflowData,
                                backgroundColor: 'rgba(16, 185, 129, 0.85)',
                                borderColor: '#10b981',
                                borderWidth: 1,
                                borderRadius: 4,
                                maxBarThickness: 24,
                            },
                            {
                                label: 'Total Outflow (৳)',
                                data: outflowData,
                                backgroundColor: 'rgba(239, 68, 68, 0.85)',
                                borderColor: '#ef4444',
                                borderWidth: 1,
                                borderRadius: 4,
                                maxBarThickness: 24,
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ৳ ' + Number(context.raw).toLocaleString('en-US', { minimumFractionDigits: 2 });
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: { display: false }
                            },
                            y: {
                                beginAtZero: true,
                                grid: { color: '#f1f5f9' },
                                ticks: {
                                    callback: function(value) {
                                        return '৳ ' + (value >= 1000 ? (value/1000) + 'k' : value);
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // 4. Expense Categories Donut Chart
            var catData = @json($categoryBreakdown);
            var donutCanvas = document.getElementById('expenseDonutChart');
            var donutChart = null;

            if (donutCanvas && catData.length > 0) {
                var catLabels = catData.map(function(item) { return item.expense_category; });
                var catAmounts = catData.map(function(item) { return parseFloat(item.total_amount); });
                var colors = ['#f65024', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899', '#64748b'];

                donutChart = new Chart(donutCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: catLabels,
                        datasets: [{
                            data: catAmounts,
                            backgroundColor: colors.slice(0, catLabels.length),
                            borderWidth: 2,
                            borderColor: '#ffffff',
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return ' ' + context.label + ': ৳ ' + Number(context.raw).toLocaleString('en-US', { minimumFractionDigits: 2 });
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Fix DataTables column adjustment & Chart resize when switching tabs
            $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
                $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                if (monthlyChart) {
                    monthlyChart.resize();
                }
                if (donutChart) {
                    donutChart.resize();
                }
            });
        });
    </script>
@endpush
