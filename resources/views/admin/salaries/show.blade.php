@extends('admin.app')
@section('title')
    Salary Payslip &mdash; {{ $salary->salary_slip_number }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        {{-- Top Header Action Card (Hidden on Print) --}}
        <div class="row no-print">
            <div class="col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Salary Slip: {{ $salary->salary_slip_number }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.salaries.index') }}">Salaries &amp; Payroll</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $salary->salary_slip_number }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.salaries.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;">
                                <i class="ri-arrow-left-line me-1"></i> Salary List
                            </a>
                            <a href="{{ route('admin.salaries.edit', $salary->id) }}" class="add-new" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;">
                                <i class="ri-edit-line me-1"></i> Edit Record
                            </a>
                            @if($salary->employee)
                                <a href="{{ route('admin.employees.show', $salary->employee->id) }}" class="add-new" style="background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;">
                                    <i class="ri-user-line me-1"></i> Staff Profile
                                </a>
                            @endif
                            <button type="button" onclick="window.print();" class="add-new" style="background-color: #f65024; color: #fff; border: none; cursor: pointer;">
                                <i class="ri-printer-line me-1"></i> Print Payslip
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                {{-- Official Printable Salary Slip Card --}}
                <div class="card border print-area shadow-sm" style="border-radius: 12px; background: #ffffff;">
                    <div class="card-body p-4 p-md-5">
                        {{-- Slip Header --}}
                        <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                    style="width: 64px; height: 64px; background-color: #ffffff; border-radius: 10px; padding: 4px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0" style="color: #0b0f17; letter-spacing: -0.02em; font-size: 22px;">SHANTI NAGAR FOUNDATION</h3>
                                    <p class="text-muted mb-0" style="font-size: 13px; font-weight: 500;">Santi Nagar Association &bull; Reg No: DHK-NGO-88219</p>
                                    <p class="text-muted mb-0" style="font-size: 12px;">Shanti Nagar, Kakrail, Dhaka-1217, Bangladesh | Helpline: +880 1700-000000</p>
                                </div>
                            </div>
                            <div class="text-end flex-shrink-0">
                                <span class="badge" style="background-color: #ecfdf5; color: #065f46; border: 1px solid rgba(16, 185, 129, 0.35); font-size: 13px; padding: 6px 14px; border-radius: 6px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;">
                                    OFFICIAL SALARY SLIP
                                </span>
                                <div class="mt-2 text-muted" style="font-size: 12.5px;">
                                    Slip No: <strong class="text-dark font-monospace" style="font-size: 13px;">{{ $salary->salary_slip_number }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 12.5px;">
                                    Salary Period: <strong class="text-dark">{{ $salary->month_year }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 12.5px;">
                                    Disbursed Date: <strong class="text-dark">{{ $salary->payment_date?->format('M d, Y') }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Employee & Payment Info Cards --}}
                        <div class="row g-3 mb-4 receipt-info-row">
                            <div class="col-md-6 col-12 receipt-info-col">
                                <div class="p-3 rounded h-100" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                    <span class="text-muted d-block mb-1" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b !important;">
                                        Staff Member Details
                                    </span>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 15.5px;">
                                        {{ $salary->employee?->name ?? 'Staff Employee' }}
                                    </h5>
                                    <div class="text-muted" style="font-size: 12.5px; line-height: 1.5;">
                                        <div>Employee ID: <strong class="text-dark font-monospace">{{ $salary->employee?->employee_id ?? 'N/A' }}</strong></div>
                                        <div>Designation: <strong>{{ $salary->employee?->designation ?? 'Staff Member' }}</strong></div>
                                        <div>Department: <strong>{{ $salary->employee?->department ?? 'General' }}</strong></div>
                                        @if($salary->employee?->phone)
                                            <div>Phone: <strong>{{ $salary->employee->phone }}</strong></div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 receipt-info-col">
                                <div class="p-3 rounded h-100" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                    <span class="text-muted d-block mb-1" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b !important;">
                                        Disbursement &amp; Payment Method
                                    </span>
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 15px;">
                                        {{ strtoupper(str_replace('_', ' ', $salary->payment_method)) }}
                                    </h6>
                                    <div class="text-muted" style="font-size: 12.5px; line-height: 1.5;">
                                        <div>Txn / Cheque Ref: <strong class="text-dark font-monospace">{{ $salary->transaction_reference ?: 'N/A' }}</strong></div>
                                        <div>Payment Date: <strong>{{ $salary->payment_date?->format('M d, Y') }}</strong></div>
                                        <div>Status: <span class="badge {{ $salary->status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}" style="font-size: 10.5px;">{{ ucfirst($salary->status) }}</span></div>
                                        @if($salary->notes)
                                            <div>Notes: <em>{{ $salary->notes }}</em></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Itemized Salary Breakdown Table --}}
                        <div class="table-responsive mb-4 receipt-table-container">
                            <table class="table table-bordered mb-0 w-100" style="font-size: 13.5px; border-collapse: collapse; border-color: #cbd5e1; width: 100%;">
                                <thead>
                                    <tr style="background-color: #f1f5f9;">
                                        <th style="width: 50px; text-align: center; color: #334155; font-weight: 700; padding: 10px 8px;">SL</th>
                                        <th style="color: #334155; font-weight: 700; padding: 10px 12px;">Component / Breakdown Item</th>
                                        <th style="width: 140px; color: #334155; font-weight: 700; padding: 10px 12px; text-align: center;">Category</th>
                                        <th style="width: 170px; color: #334155; font-weight: 700; padding: 10px 14px; text-align: right;">Amount (BDT)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center align-middle" style="color: #475569; padding: 10px 8px;">1</td>
                                        <td class="align-middle" style="padding: 10px 12px;">
                                            <strong class="text-dark">Monthly Basic Salary</strong>
                                            <div class="text-muted" style="font-size: 11.5px;">Approved monthly contracted salary base</div>
                                        </td>
                                        <td class="text-center align-middle" style="padding: 10px 12px;">
                                            <span class="badge bg-light text-dark border" style="font-size: 11px;">Earnings</span>
                                        </td>
                                        <td class="align-middle text-dark text-end fw-semibold" style="font-size: 14px; padding: 10px 14px;">
                                            ৳ {{ number_format((float) $salary->basic_amount, 2) }}
                                        </td>
                                    </tr>
                                    @if((float) $salary->allowance > 0)
                                        <tr>
                                            <td class="text-center align-middle" style="color: #475569; padding: 10px 8px;">2</td>
                                            <td class="align-middle" style="padding: 10px 12px;">
                                                <strong class="text-dark">Allowance</strong>
                                                <div class="text-muted" style="font-size: 11.5px;">Medical, travel &amp; accommodation allowances</div>
                                            </td>
                                            <td class="text-center align-middle" style="padding: 10px 12px;">
                                                <span class="badge bg-light text-dark border" style="font-size: 11px;">Earnings</span>
                                            </td>
                                            <td class="align-middle text-dark text-end fw-semibold" style="font-size: 14px; padding: 10px 14px;">
                                                ৳ {{ number_format((float) $salary->allowance, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if((float) $salary->bonus > 0)
                                        <tr>
                                            <td class="text-center align-middle" style="color: #475569; padding: 10px 8px;">3</td>
                                            <td class="align-middle" style="padding: 10px 12px;">
                                                <strong class="text-dark">Festival / Special Bonus</strong>
                                                <div class="text-muted" style="font-size: 11.5px;">Eid festival or performance disbursement</div>
                                            </td>
                                            <td class="text-center align-middle" style="padding: 10px 12px;">
                                                <span class="badge bg-light text-dark border" style="font-size: 11px;">Earnings</span>
                                            </td>
                                            <td class="align-middle text-dark text-end fw-semibold" style="font-size: 14px; padding: 10px 14px;">
                                                ৳ {{ number_format((float) $salary->bonus, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    @if((float) $salary->deductions > 0)
                                        <tr style="background-color: #fffaf0;">
                                            <td class="text-center align-middle" style="color: #475569; padding: 10px 8px;">4</td>
                                            <td class="align-middle" style="padding: 10px 12px;">
                                                <strong class="text-danger">Deductions</strong>
                                                <div class="text-muted" style="font-size: 11.5px;">Tax withholding, advance salary adjustment, or leave deductions</div>
                                            </td>
                                            <td class="text-center align-middle" style="padding: 10px 12px;">
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size: 11px;">Deduction</span>
                                            </td>
                                            <td class="align-middle text-danger text-end fw-semibold" style="font-size: 14px; padding: 10px 14px;">
                                                - ৳ {{ number_format((float) $salary->deductions, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    @php
                                        $gross = $salary->basic_amount + $salary->allowance + $salary->bonus;
                                    @endphp
                                    <tr style="background-color: #f8fafc;">
                                        <td colspan="3" class="fw-semibold text-end" style="padding: 10px 14px; font-size: 13px; color: #475569; text-align: right;">
                                            Gross Earnings: ৳ {{ number_format($gross, 2) }} &nbsp;|&nbsp; Total Deductions: ৳ {{ number_format((float)$salary->deductions, 2) }} &nbsp;|&nbsp; <strong>Net Paid Amount:</strong>
                                        </td>
                                        <td class="fw-bold text-success text-end" style="font-size: 16px; padding: 12px 14px; background-color: #ecfdf5; text-align: right;">
                                            ৳ {{ number_format((float) $salary->net_paid_amount, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- Verification Status --}}
                        <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
                            <div>
                                <span class="text-muted me-2" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Status:</span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 12px; padding: 5px 12px; border-radius: 6px;">
                                    <i class="ri-checkbox-circle-line me-1"></i> Paid &amp; Audited
                                </span>
                            </div>
                            <div class="text-muted" style="font-size: 11.5px; font-style: italic;">
                                Official Computer Generated Salary Disbursement Slip
                            </div>
                        </div>

                        {{-- Professional 3-Column Signature Block --}}
                        <div class="row pt-4 mt-3 receipt-signatures">
                            <div class="col-4">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Prepared By (Accounts/HR)</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Staff Receiver's Signature</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Authorized President / Secretary</span>
                                </div>
                            </div>
                        </div>

                        {{-- Official Voucher Bottom Note --}}
                        <div class="mt-5 pt-3 border-top text-center receipt-footer-note" style="font-size: 11.5px; color: #64748b;">
                            <p class="mb-0">
                                <strong>Shanti Nagar Foundation (Santi Nagar Association)</strong> &bull; All payroll disbursements are maintained under the NGO Affairs Bureau regulations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <style>
        /* Screen signature styles */
        .receipt-signatures .signature-box {
            padding: 0 10px;
        }
        .receipt-signatures .signature-line {
            border-top: 1.5px dashed #94a3b8;
            margin-bottom: 8px;
            width: 85%;
            margin-left: auto;
            margin-right: auto;
        }
        .receipt-signatures .signature-title {
            font-size: 12.5px;
            font-weight: 700;
            color: #1e293b;
            display: block;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm 15mm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            html, body {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                height: auto !important;
            }

            /* 1. Hide all non-printable UI elements and dashboard chrome */
            .sidebar,
            header,
            footer,
            .footer,
            .copyright,
            nav,
            .no-print,
            .header-navigation,
            .title-with-breadcrumb,
            .breadcrumb,
            .add-new,
            .btn,
            button {
                display: none !important;
                visibility: hidden !important;
                height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* 2. Reset wrappers and layout grid */
            #main-wrapper,
            .content,
            .sidebar.active ~ .content,
            .sidebar:not(.active) ~ .content,
            .content-body,
            .container-fluid,
            .row {
                position: static !important;
                left: 0 !important;
                top: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            .col-12,
            .col-lg-9 {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                flex: 0 0 100% !important;
            }

            /* 3. Printable payslip card: NO OUTER BORDER on paper, clean full width */
            .print-area {
                position: relative !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                border-radius: 0 !important;
                box-shadow: none !important;
                background: #ffffff !important;
                page-break-inside: avoid;
            }

            .print-area .card-body {
                padding: 0 !important;
            }

            /* 4. Ensure info cards align with full width and equal heights */
            .receipt-info-row {
                display: flex !important;
                flex-direction: row !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                gap: 16px !important;
                width: 100% !important;
            }

            .receipt-info-col {
                flex: 1 1 0 !important;
                width: 50% !important;
                max-width: 50% !important;
                padding: 0 !important;
            }

            /* 5. Table perfect width and right edge alignment */
            .receipt-table-container {
                overflow: visible !important;
                width: 100% !important;
            }

            .receipt-table-container table {
                width: 100% !important;
                table-layout: fixed !important;
            }

            /* 6. In print mode, preserve 3-column signature layout horizontally */
            .receipt-signatures {
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between !important;
                width: 100% !important;
                margin-top: 40px !important;
                padding-top: 25px !important;
            }

            .receipt-signatures .col-4 {
                width: 30% !important;
                flex: 0 0 30% !important;
                max-width: 30% !important;
                float: left !important;
                display: block !important;
                padding: 0 !important;
            }

            .receipt-signatures .signature-line {
                border-top: 1.5px dashed #475569 !important;
                width: 100% !important;
                margin-bottom: 6px !important;
            }

            .receipt-signatures .signature-title {
                color: #0f172a !important;
                font-size: 12px !important;
                font-weight: 700 !important;
            }

            .receipt-footer-note {
                margin-top: 35px !important;
                padding-top: 15px !important;
            }
        }
    </style>
@endpush
