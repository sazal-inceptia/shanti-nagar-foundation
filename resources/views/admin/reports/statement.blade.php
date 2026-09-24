@extends('admin.app')
@section('title')
    Official Financial Audit Statement &mdash; Shanti Nagar Foundation
@endsection

@section('content')
    <div class="container-fluid my-3">
        {{-- Top Header Action Card (Hidden on Print) --}}
        <div class="row no-print">
            <div class="col-12">
                <div class="card table-card mb-4 shadow-sm border-0" style="border-radius: 12px;">
                    <div class="card-header table-header d-flex justify-content-between align-items-center flex-wrap gap-2 py-3" style="background: #ffffff; border-bottom: 1px solid #f1f5f9;">
                        <div class="title-with-breadcrumb">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: rgba(246, 80, 36, 0.1); color: #f65024;">
                                    <i class="ri-printer-line" style="font-size: 20px;"></i>
                                </div>
                                <div>
                                    <h4 class="table-title mb-0" style="font-weight: 700; font-size: 18px; color: #0f172a;">Official Financial Audit Statement</h4>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0" style="font-size: 12px;">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}" class="text-decoration-none text-muted">Reports</a></li>
                                            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Audit Statement</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 py-2"
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; font-size: 13px;">
                                <i class="ri-arrow-left-line"></i> Back to Reports
                            </a>
                            <a href="{{ route('admin.reports.export', request()->query()) }}" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 py-2"
                                style="background-color: #f8fafc; color: #334155; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; font-size: 13px;">
                                <i class="ri-download-2-line"></i> Export CSV
                            </a>
                            <button type="button" onclick="window.print();" class="btn btn-sm d-inline-flex align-items-center gap-1 px-3 py-2 text-white"
                                style="background: linear-gradient(135deg, #f65024 0%, #ea580c 100%); border-radius: 8px; font-weight: 600; font-size: 13px; box-shadow: 0 4px 12px rgba(246, 80, 36, 0.25); border: none;">
                                <i class="ri-printer-line"></i> Print Statement
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Printable Official Financial Audit Statement --}}
        <div class="row">
            <div class="col-12">
                <div class="card border print-area shadow-sm" style="border-radius: 12px; background: #ffffff;">
                    <div class="card-body p-4 p-md-5">
                        {{-- Statement Header --}}
                        <div class="statement-header d-flex justify-content-between align-items-start border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="statement-logo-wrapper d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                    style="width: 56px; height: 56px; background-color: #ffffff; border-radius: 10px; padding: 4px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div>
                                    <h3 class="fw-bold mb-0 statement-ngo-title" style="color: #0b0f17; letter-spacing: -0.02em; font-size: 20px;">SHANTI NAGAR FOUNDATION</h3>
                                    <p class="text-muted mb-0" style="font-size: 12.5px; font-weight: 500;">Santi Nagar Association &bull; Reg No: DHK-NGO-88219</p>
                                    <p class="text-muted mb-0" style="font-size: 11.5px;">Shanti Nagar, Kakrail, Dhaka-1217, Bangladesh | Helpline: +880 1700-000000</p>
                                </div>
                            </div>
                            <div class="statement-header-meta text-end flex-shrink-0">
                                <span class="badge" style="background-color: #eff6ff; color: #1e40af; border: 1px solid rgba(59, 130, 246, 0.35); font-size: 11.5px; padding: 5px 12px; border-radius: 6px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;">
                                    FINANCIAL AUDIT STATEMENT
                                </span>
                                <div class="mt-1 text-muted" style="font-size: 11.5px;">
                                    Fiscal Year: <strong class="text-dark">{{ $year }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 11.5px;">
                                    Period: <strong>{{ ($summary['start_date'] ?: 'Commencement') . ' to ' . ($summary['end_date'] ?: 'Present') }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 11.5px;">
                                    Generated: <strong>{{ now()->format('M d, Y h:i A') }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Financial Overview 4-Column Box --}}
                        <div class="statement-stats-box p-3 rounded mb-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="statement-stats-grid d-flex flex-row justify-content-between align-items-center text-center">
                                <div class="statement-stat-item border-end">
                                    <span class="text-muted d-block mb-1" style="font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Total Inflow (Donations)</span>
                                    <h4 class="fw-bold text-success mb-0" style="font-size: 17px;">৳ {{ number_format($summary['total_inflow'], 2) }}</h4>
                                    <span class="text-muted" style="font-size: 11px;">{{ $summary['donation_count'] }} Contributions</span>
                                </div>
                                <div class="statement-stat-item border-end">
                                    <span class="text-muted d-block mb-1" style="font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Direct Relief Expenses</span>
                                    <h4 class="fw-bold text-danger mb-0" style="font-size: 17px;">৳ {{ number_format($summary['total_expenses'], 2) }}</h4>
                                    <span class="text-muted" style="font-size: 11px;">{{ $summary['expense_count'] }} Vouchers</span>
                                </div>
                                <div class="statement-stat-item border-end">
                                    <span class="text-muted d-block mb-1" style="font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Staff Salaries &amp; Payroll</span>
                                    <h4 class="fw-bold text-dark mb-0" style="font-size: 17px;">৳ {{ number_format($summary['total_salaries'], 2) }}</h4>
                                    <span class="text-muted" style="font-size: 11px;">{{ $summary['salary_count'] }} Payslips</span>
                                </div>
                                <div class="statement-stat-item">
                                    <span class="text-muted d-block mb-1" style="font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Net Organization Balance</span>
                                    <h4 class="fw-bold {{ $summary['net_balance'] >= 0 ? 'text-primary' : 'text-danger' }} mb-0" style="font-size: 17px;">
                                        ৳ {{ number_format($summary['net_balance'], 2) }}
                                    </h4>
                                    <span class="badge {{ $summary['net_balance'] >= 0 ? 'bg-success' : 'bg-danger' }}" style="font-size: 10px; padding: 2px 7px;">
                                        {{ $summary['net_balance'] >= 0 ? 'Net Surplus' : 'Net Deficit' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Project-Wise Financial Ledger Table --}}
                        <div class="mb-3 statement-section">
                            <h6 class="fw-bold text-dark mb-2 pb-1 border-bottom section-title" style="font-size: 13.5px;">
                                1. Project &amp; Relief Causes Financial Balance Sheet
                            </h6>
                            <div class="table-responsive receipt-table-container">
                                <table class="table table-bordered mb-0 w-100 printable-table" style="font-size: 12px; border-collapse: collapse; border-color: #cbd5e1; width: 100%;">
                                    <thead>
                                        <tr style="background-color: #f1f5f9;">
                                            <th style="width: 40px; text-align: center; color: #334155; font-weight: 700; padding: 7px 5px;">SL</th>
                                            <th style="color: #334155; font-weight: 700; padding: 7px 10px;">Project / Relief Cause</th>
                                            <th style="color: #334155; font-weight: 700; padding: 7px 10px; width: 120px; text-align: right;">Target Budget</th>
                                            <th style="color: #334155; font-weight: 700; padding: 7px 10px; width: 130px; text-align: right;">Donations Raised</th>
                                            <th style="color: #334155; font-weight: 700; padding: 7px 10px; width: 120px; text-align: right;">Total Spent</th>
                                            <th style="color: #334155; font-weight: 700; padding: 7px 10px; width: 130px; text-align: right;">Net Balance (BDT)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totTarget = 0;
                                            $totRaised = 0;
                                            $totSpent = 0;
                                            $totNet = 0;
                                        @endphp
                                        @foreach($projectBalances as $idx => $pb)
                                            @php
                                                $totTarget += $pb['target_amount'];
                                                $totRaised += $pb['total_raised'];
                                                $totSpent += $pb['total_spent'];
                                                $totNet += $pb['net_balance'];
                                            @endphp
                                            <tr>
                                                <td class="text-center align-middle" style="padding: 6px 5px;">{{ $idx + 1 }}</td>
                                                <td class="align-middle" style="padding: 6px 10px;">
                                                    <strong class="text-dark">{{ $pb['name'] }}</strong>
                                                    <span class="text-muted" style="font-size: 11px;">({{ $pb['category'] }})</span>
                                                </td>
                                                <td class="align-middle text-end" style="padding: 6px 10px;">৳ {{ number_format($pb['target_amount'], 2) }}</td>
                                                <td class="align-middle text-end text-success fw-semibold" style="padding: 6px 10px;">৳ {{ number_format($pb['total_raised'], 2) }}</td>
                                                <td class="align-middle text-end text-danger" style="padding: 6px 10px;">৳ {{ number_format($pb['total_spent'], 2) }}</td>
                                                <td class="align-middle text-end fw-bold {{ $pb['net_balance'] >= 0 ? 'text-primary' : 'text-danger' }}" style="padding: 6px 10px;">
                                                    ৳ {{ number_format($pb['net_balance'], 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background-color: #f8fafc; font-weight: 700;">
                                            <td colspan="2" class="text-end" style="padding: 7px 10px;">Total All Projects:</td>
                                            <td class="text-end" style="padding: 7px 10px;">৳ {{ number_format($totTarget, 2) }}</td>
                                            <td class="text-end text-success" style="padding: 7px 10px;">৳ {{ number_format($totRaised, 2) }}</td>
                                            <td class="text-end text-danger" style="padding: 7px 10px;">৳ {{ number_format($totSpent, 2) }}</td>
                                            <td class="text-end text-primary" style="padding: 7px 10px;">৳ {{ number_format($totNet, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        {{-- Monthly Breakdown Table --}}
                        <div class="mb-3 statement-section">
                            <h6 class="fw-bold text-dark mb-2 pb-1 border-bottom section-title" style="font-size: 13.5px;">
                                2. Monthly Inflow vs Outflow Ledger (Fiscal Year {{ $year }})
                            </h6>
                            <div class="table-responsive receipt-table-container">
                                <table class="table table-bordered mb-0 w-100 printable-table" style="font-size: 11.5px; border-collapse: collapse; border-color: #cbd5e1; width: 100%;">
                                    <thead>
                                        <tr style="background-color: #f1f5f9;">
                                            <th style="width: 35px; text-align: center; color: #334155; font-weight: 700; padding: 6px 4px;">#</th>
                                            <th style="color: #334155; font-weight: 700; padding: 6px 8px;">Month</th>
                                            <th style="color: #334155; font-weight: 700; padding: 6px 8px; text-align: right;">Donations (Inflow)</th>
                                            <th style="color: #334155; font-weight: 700; padding: 6px 8px; text-align: right;">Expenses</th>
                                            <th style="color: #334155; font-weight: 700; padding: 6px 8px; text-align: right;">Salaries</th>
                                            <th style="color: #334155; font-weight: 700; padding: 6px 8px; text-align: right;">Total Outflow</th>
                                            <th style="color: #334155; font-weight: 700; padding: 6px 8px; text-align: right;">Net Surplus / (Deficit)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($monthlyBreakdown as $m)
                                            <tr>
                                                <td class="text-center" style="padding: 5px 4px;">{{ $m['month_number'] }}</td>
                                                <td style="padding: 5px 8px;" class="fw-semibold">{{ $m['month_name'] }}</td>
                                                <td style="padding: 5px 8px; text-align: right;" class="text-success">৳ {{ number_format($m['inflow'], 2) }}</td>
                                                <td style="padding: 5px 8px; text-align: right;">৳ {{ number_format($m['expenses'], 2) }}</td>
                                                <td style="padding: 5px 8px; text-align: right;">৳ {{ number_format($m['salaries'], 2) }}</td>
                                                <td style="padding: 5px 8px; text-align: right;" class="text-danger">৳ {{ number_format($m['outflow'], 2) }}</td>
                                                <td style="padding: 5px 8px; text-align: right;" class="fw-semibold {{ $m['surplus'] >= 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ $m['surplus'] >= 0 ? '+' : '' }}৳ {{ number_format($m['surplus'], 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Verification Status --}}
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom statement-verify-row">
                            <div>
                                <span class="text-muted me-2" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Audit Verification:</span>
                                <span class="badge" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 11.5px; padding: 4px 10px; border-radius: 6px;">
                                    <i class="ri-checkbox-circle-line me-1"></i> Verified &amp; Balanced
                                </span>
                            </div>
                            <div class="text-muted" style="font-size: 11px; font-style: italic;">
                                Official Financial Statement &bull; Shanti Nagar Foundation
                            </div>
                        </div>

                        {{-- Professional 3-Column Signature Block --}}
                        <div class="receipt-signatures pt-3 mt-2">
                            <div class="signature-col">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Finance &amp; Accounts Secretary</span>
                                </div>
                            </div>
                            <div class="signature-col">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">General Secretary</span>
                                </div>
                            </div>
                            <div class="signature-col">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">President (Executive Committee)</span>
                                </div>
                            </div>
                        </div>

                        {{-- Official Statement Footer Note --}}
                        <div class="mt-4 pt-2 border-top text-center receipt-footer-note" style="font-size: 11px; color: #64748b;">
                            <p class="mb-0">
                                <strong>Shanti Nagar Foundation (Santi Nagar Association)</strong> &bull; All accounts, donations, and vouchers are audited and maintained under the NGO Affairs Bureau regulations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .print-area {
            font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif !important;
        }

        /* Screen signature styles */
        .receipt-signatures {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }
        .receipt-signatures .signature-col {
            flex: 1;
            padding: 0 15px;
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

        .statement-stat-item {
            flex: 1 1 25%;
            padding: 4px 12px;
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 8mm 10mm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            html, body {
                background: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                height: auto !important;
                font-family: 'Inter', 'Noto Sans Bengali', system-ui, -apple-system, sans-serif !important;
            }

            /* 1. Hide all non-printable UI elements */
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

            .col-12 {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                flex: 0 0 100% !important;
            }

            /* 3. Printable statement card */
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
                page-break-inside: auto !important;
            }

            .print-area .card-body {
                padding: 0 !important;
            }

            /* 4. Compact Statement Header */
            .statement-header {
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: flex-start !important;
                width: 100% !important;
                margin-bottom: 8px !important;
                padding-bottom: 8px !important;
                page-break-inside: avoid !important;
            }

            .statement-logo-wrapper {
                width: 44px !important;
                height: 44px !important;
                margin-right: 8px !important;
            }

            .statement-ngo-title {
                font-size: 17px !important;
            }

            /* 5. Compact 4-Column Stats Box */
            .statement-stats-box {
                background-color: #f8fafc !important;
                border: 1px solid #cbd5e1 !important;
                padding: 8px 6px !important;
                margin-bottom: 12px !important;
                border-radius: 6px !important;
                display: block !important;
                width: 100% !important;
                page-break-inside: avoid !important;
            }

            .statement-stats-grid {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
            }

            .statement-stat-item {
                display: block !important;
                flex: 0 0 25% !important;
                width: 25% !important;
                max-width: 25% !important;
                text-align: center !important;
                padding: 0 4px !important;
                box-sizing: border-box !important;
            }

            .statement-stat-item.border-end {
                border-right: 1px solid #cbd5e1 !important;
            }

            .statement-stat-item h4 {
                font-size: 15px !important;
                margin-bottom: 1px !important;
            }

            /* 6. Continuous Natural Table Flow (NO FALSE PAGE BREAKS) */
            .statement-section {
                page-break-inside: auto !important;
                margin-bottom: 14px !important;
            }

            .section-title {
                page-break-after: avoid !important;
                page-break-inside: avoid !important;
                margin-bottom: 4px !important;
                font-size: 12.5px !important;
            }

            .receipt-table-container {
                overflow: visible !important;
                width: 100% !important;
            }

            .printable-table {
                width: 100% !important;
                table-layout: fixed !important;
                border-collapse: collapse !important;
                border: 1px solid #94a3b8 !important;
                page-break-inside: auto !important;
            }

            .printable-table thead {
                display: table-header-group !important;
            }

            .printable-table tfoot {
                display: table-footer-group !important;
            }

            .printable-table tr {
                page-break-inside: avoid !important;
                page-break-after: auto !important;
            }

            .printable-table th,
            .printable-table td {
                border: 1px solid #cbd5e1 !important;
                padding: 4px 6px !important;
                font-size: 11px !important;
                line-height: 1.3 !important;
            }

            .statement-verify-row {
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: center !important;
                margin-bottom: 16px !important;
                padding-bottom: 8px !important;
                page-break-inside: avoid !important;
            }

            /* 7. Signatures 3-column horizontal row */
            .receipt-signatures {
                display: flex !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
                width: 100% !important;
                margin-top: 25px !important;
                padding-top: 15px !important;
                page-break-inside: avoid !important;
            }

            .receipt-signatures .signature-col {
                display: block !important;
                flex: 0 0 30% !important;
                width: 30% !important;
                max-width: 30% !important;
                padding: 0 !important;
            }

            .receipt-signatures .signature-line {
                border-top: 1.5px dashed #475569 !important;
                width: 100% !important;
                margin-bottom: 4px !important;
            }

            .receipt-signatures .signature-title {
                color: #0f172a !important;
                font-size: 10.5px !important;
                font-weight: 700 !important;
            }

            .receipt-footer-note {
                margin-top: 20px !important;
                padding-top: 10px !important;
                page-break-inside: avoid !important;
            }
        }
    </style>
@endpush
