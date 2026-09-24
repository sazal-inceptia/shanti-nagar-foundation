@extends('admin.app')
@section('title')
    Staff Profile &mdash; {{ $employee->name }} ({{ $employee->employee_id }})
@endsection

@section('content')
    <div class="container-fluid my-3">
        {{-- Top Header Action Card --}}
        <div class="row">
            <div class="col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Staff Profile: {{ $employee->name }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Staff</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $employee->employee_id }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.employees.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;">
                                <i class="ri-arrow-left-line me-1"></i> Staff List
                            </a>
                            <a href="{{ route('admin.employees.edit', $employee->id) }}" class="add-new" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;">
                                <i class="ri-edit-line me-1"></i> Edit Profile
                            </a>
                            <a href="{{ route('admin.salaries.create', ['employee_id' => $employee->id]) }}" class="add-new" style="background-color: #f65024; color: #fff;">
                                <i class="ri-money-dollar-circle-line me-1"></i> Disburse Salary
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Staff Profile Card (Left 4 cols) --}}
            <div class="col-lg-4 col-12">
                <div class="card table-card mb-4 shadow-sm border-0">
                    <div class="card-body text-center p-4">
                        {{-- Photo --}}
                        <div class="mb-3 position-relative d-inline-block">
                            @if($employee->photo && file_exists(public_path($employee->photo)))
                                <img src="{{ asset($employee->photo) }}" alt="{{ $employee->name }}"
                                    class="rounded-circle border shadow-sm" style="width: 110px; height: 110px; object-fit: cover; border-width: 3px !important; border-color: #fff !important;">
                            @else
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm mx-auto"
                                    style="width: 110px; height: 110px; background-color: #f65024; font-size: 38px;">
                                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <h4 class="fw-bold text-dark mb-1" style="font-size: 18px;">{{ $employee->name }}</h4>
                        <div class="badge font-monospace mb-2" style="background-color: #e0f2fe; color: #0369a1; font-size: 12px; padding: 4px 10px;">
                            {{ $employee->employee_id }}
                        </div>
                        <div class="text-muted fw-semibold mb-2" style="font-size: 13.5px;">{{ $employee->designation }}</div>
                        <div class="mb-3">
                            <span class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 12px; padding: 4px 10px; border-radius: 4px;">
                                {{ $employee->department }}
                            </span>
                        </div>

                        @php
                            $statusEnum = \App\Enums\EmploymentStatus::tryFrom($employee->employment_status);
                            $badgeStyle = $statusEnum ? $statusEnum->badgeStyle() : 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;';
                            $statusLabel = $statusEnum ? $statusEnum->label() : ucfirst($employee->employment_status);
                        @endphp
                        <div>
                            <span class="badge" style="{{ $badgeStyle }} font-size: 12px; padding: 5px 12px; border-radius: 20px; font-weight: 600;">
                                <i class="ri-checkbox-circle-fill me-1"></i> {{ $statusLabel }}
                            </span>
                        </div>
                    </div>

                    <div class="border-top p-4" style="background-color: #f8fafc;">
                        <h6 class="fw-bold text-dark mb-3" style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #475569 !important;">
                            Employment &amp; Contact Details
                        </h6>

                        <div class="d-flex flex-column gap-2" style="font-size: 13px;">
                            <div class="d-flex justify-content-between py-1 border-bottom border-light">
                                <span class="text-muted"><i class="ri-money-dollar-box-line me-1"></i> Base Salary</span>
                                <strong class="text-dark">৳ {{ number_format((float) $employee->base_salary, 2) }} / mo</strong>
                            </div>

                            <div class="d-flex justify-content-between py-1 border-bottom border-light">
                                <span class="text-muted"><i class="ri-calendar-event-line me-1"></i> Joining Date</span>
                                <span class="text-dark fw-semibold">{{ $employee->joining_date?->format('M d, Y') ?? 'N/A' }}</span>
                            </div>

                            <div class="d-flex justify-content-between py-1 border-bottom border-light">
                                <span class="text-muted"><i class="ri-phone-line me-1"></i> Phone</span>
                                <span class="text-dark">{{ $employee->phone ?: 'Not provided' }}</span>
                            </div>

                            <div class="d-flex justify-content-between py-1 border-bottom border-light">
                                <span class="text-muted"><i class="ri-mail-line me-1"></i> Email</span>
                                <span class="text-dark">{{ $employee->email ?: 'Not provided' }}</span>
                            </div>

                            <div class="d-flex justify-content-between py-1 border-bottom border-light">
                                <span class="text-muted"><i class="ri-id-card-line me-1"></i> NID / Smart Card</span>
                                <span class="text-dark font-monospace">{{ $employee->nid_number ?: 'N/A' }}</span>
                            </div>

                            @if($employee->present_address)
                                <div class="py-1 border-bottom border-light">
                                    <span class="text-muted d-block mb-1"><i class="ri-map-pin-line me-1"></i> Present Address:</span>
                                    <span class="text-dark">{{ $employee->present_address }}</span>
                                </div>
                            @endif

                            @if($employee->permanent_address)
                                <div class="py-1">
                                    <span class="text-muted d-block mb-1"><i class="ri-home-4-line me-1"></i> Permanent Address:</span>
                                    <span class="text-dark">{{ $employee->permanent_address }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Salary History Ledger & Stat Overview (Right 8 cols) --}}
            <div class="col-lg-8 col-12">
                {{-- Quick Stats Row --}}
                @php
                    $totalDisbursed = $employee->salaries->sum('net_paid_amount');
                    $totalSlips = $employee->salaries->count();
                    $lastSalary = $employee->salaries->first();
                @endphp
                <div class="row g-3 mb-4">
                    <div class="col-md-4 col-12">
                        <div class="card border-0 shadow-sm p-3 h-100" style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius: 10px;">
                            <div class="text-muted fw-semibold" style="font-size: 11.5px; text-transform: uppercase;">Lifetime Salary Paid</div>
                            <h4 class="fw-bold text-primary mt-1 mb-0" style="font-size: 20px;">৳ {{ number_format($totalDisbursed, 2) }}</h4>
                            <div class="text-muted mt-1" style="font-size: 11px;">Total payroll disbursed to staff</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="card border-0 shadow-sm p-3 h-100" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border-radius: 10px;">
                            <div class="text-muted fw-semibold" style="font-size: 11.5px; text-transform: uppercase;">Disbursement Slips</div>
                            <h4 class="fw-bold text-success mt-1 mb-0" style="font-size: 20px;">{{ $totalSlips }} Months</h4>
                            <div class="text-muted mt-1" style="font-size: 11px;">Vouchers generated on record</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12">
                        <div class="card border-0 shadow-sm p-3 h-100" style="background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); border-radius: 10px;">
                            <div class="text-muted fw-semibold" style="font-size: 11.5px; text-transform: uppercase;">Last Paid Period</div>
                            <h4 class="fw-bold text-dark mt-1 mb-0" style="font-size: 18px;">
                                {{ $lastSalary ? $lastSalary->month_year : 'No records yet' }}
                            </h4>
                            <div class="text-muted mt-1" style="font-size: 11px;">
                                {{ $lastSalary ? '৳ ' . number_format((float)$lastSalary->net_paid_amount, 2) : 'Awaiting first salary' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Salary Ledger Table Card --}}
                <div class="card table-card shadow-sm border-0">
                    <div class="card-header table-header d-flex justify-content-between align-items-center">
                        <div class="table-title">Salary Disbursement Ledger</div>
                        <a href="{{ route('admin.salaries.create', ['employee_id' => $employee->id]) }}" class="add-new">
                            <i class="ri-add-line me-1"></i> New Payslip
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                <thead style="background-color: #f8fafc;">
                                    <tr>
                                        <th style="padding: 12px 16px; width: 140px;">Slip #</th>
                                        <th style="padding: 12px 12px; width: 110px;">Period</th>
                                        <th style="padding: 12px 12px; width: 130px;">Disbursement</th>
                                        <th style="padding: 12px 12px; width: 120px;">Net Paid</th>
                                        <th style="padding: 12px 12px; width: 100px;">Method</th>
                                        <th style="padding: 12px 16px; width: 90px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employee->salaries as $sal)
                                        <tr>
                                            <td style="padding: 12px 16px;">
                                                <a href="{{ route('admin.salaries.show', $sal->id) }}" class="fw-bold text-dark text-decoration-none font-monospace">
                                                    {{ $sal->salary_slip_number }}
                                                </a>
                                                <div class="text-muted" style="font-size: 11px;">
                                                    <i class="ri-calendar-line me-1"></i> {{ $sal->payment_date?->format('M d, Y') }}
                                                </div>
                                            </td>
                                            <td style="padding: 12px 12px;">
                                                <span class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 11.5px; padding: 4px 8px;">
                                                    {{ $sal->month_year }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 12px; font-size: 11.5px;">
                                                <div>Basic: ৳ {{ number_format((float)$sal->basic_amount, 2) }}</div>
                                                <div class="text-muted">
                                                    + ৳ {{ number_format((float)($sal->allowance + $sal->bonus), 2) }} | - ৳ {{ number_format((float)$sal->deductions, 2) }}
                                                </div>
                                            </td>
                                            <td style="padding: 12px 12px;">
                                                <strong class="text-success" style="font-size: 13.5px;">
                                                    ৳ {{ number_format((float)$sal->net_paid_amount, 2) }}
                                                </strong>
                                                <div>
                                                    <span class="badge" style="{{ $sal->status === 'paid' ? 'background-color: #ecfdf5; color: #065f46;' : 'background-color: #fffbeb; color: #b45309;' }} font-size: 10px;">
                                                        {{ ucfirst($sal->status) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td style="padding: 12px 12px;">
                                                <span class="badge bg-light text-dark border" style="font-size: 10.5px;">
                                                    {{ strtoupper(str_replace('_', ' ', $sal->payment_method)) }}
                                                </span>
                                            </td>
                                            <td style="padding: 12px 16px;" class="text-center">
                                                <div class="d-flex align-items-center justify-content-center gap-1">
                                                    <a href="{{ route('admin.salaries.show', $sal->id) }}" class="btn btn-sm btn-outline-primary" style="padding: 3px 8px; font-size: 12px;" title="View Payslip">
                                                        <i class="ri-printer-line"></i>
                                                    </a>
                                                    <a href="{{ route('admin.salaries.edit', $sal->id) }}" class="btn btn-sm btn-outline-secondary" style="padding: 3px 8px; font-size: 12px;" title="Edit Voucher">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <i class="ri-wallet-3-line d-block mb-2" style="font-size: 32px; color: #94a3b8;"></i>
                                                <p class="mb-2 fw-semibold">No salary records found for this employee yet.</p>
                                                <a href="{{ route('admin.salaries.create', ['employee_id' => $employee->id]) }}" class="btn btn-sm" style="background-color: #f65024; color: #fff;">
                                                    <i class="ri-add-line me-1"></i> Disburse First Salary
                                                </a>
                                            </td>
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
