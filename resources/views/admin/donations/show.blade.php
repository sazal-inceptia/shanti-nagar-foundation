@extends('admin.app')
@section('title')
    Money Receipt &mdash; {{ $donation->receipt_number }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        {{-- Top Header Action Card (Hidden on Print) --}}
        <div class="row no-print">
            <div class="col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Money Receipt: {{ $donation->receipt_number }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $donation->receipt_number }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <a href="{{ route('admin.donations.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;">
                                <i class="ri-arrow-left-line me-1"></i> Donation List
                            </a>
                            <a href="{{ route('admin.donations.edit', $donation->id) }}" class="add-new" style="background-color: #f1f5f9; color: #334155; border: 1px solid #e2e8f0;">
                                <i class="ri-edit-line me-1"></i> Edit Receipt
                            </a>
                            <button type="button" onclick="window.print();" class="add-new" style="background-color: #f65024; color: #fff; border: none; cursor: pointer;">
                                <i class="ri-printer-line me-1"></i> Print Receipt
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                {{-- Official Printable Money Receipt Card --}}
                <div class="card border print-area shadow-sm" style="border-radius: 12px; background: #ffffff;">
                    <div class="card-body p-4 p-md-5">
                        {{-- Receipt Header --}}
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
                                <span class="badge" style="background-color: #fff3ee; color: #f65024; border: 1px solid rgba(246, 80, 36, 0.35); font-size: 13px; padding: 6px 14px; border-radius: 6px; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;">
                                    OFFICIAL MONEY RECEIPT
                                </span>
                                <div class="mt-2 text-muted" style="font-size: 12.5px;">
                                    Receipt No: <strong class="text-dark font-monospace" style="font-size: 13px;">{{ $donation->receipt_number }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 12.5px;">
                                    Date: <strong class="text-dark">{{ $donation->donation_date?->format('M d, Y') }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Donor & Allocation Info Cards --}}
                        <div class="row g-3 mb-4 receipt-info-row">
                            <div class="col-md-6 col-12 receipt-info-col">
                                <div class="p-3 rounded h-100">
                                    <span class="text-muted d-block mb-1" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b !important;">
                                        Received With Thanks From (Donor)
                                    </span>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 15.5px;">
                                        {{ $donation->donor ? $donation->donor->name : 'Well-wisher (Anonymous Donor)' }}
                                    </h5>
                                    @if($donation->donor)
                                        <div class="text-muted" style="font-size: 12.5px; line-height: 1.5;">
                                            @if($donation->donor->phone) <span><i class="ri-phone-line me-1 text-primary"></i>{{ $donation->donor->phone }}</span><br> @endif
                                            @if($donation->donor->email) <span><i class="ri-mail-line me-1 text-primary"></i>{{ $donation->donor->email }}</span><br> @endif
                                            @if($donation->donor->address)
                                                <span><i class="ri-map-pin-line me-1 text-primary"></i>{{ $donation->donor->address }}</span>
                                            @else
                                                <span><i class="ri-map-pin-line me-1 text-muted"></i>Dhaka, Bangladesh</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-muted" style="font-size: 12.5px;">
                                            <span><i class="ri-map-pin-line me-1 text-muted"></i>Dhaka, Bangladesh</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-12 receipt-info-col">
                                <div class="p-3 rounded h-100 text-end">
                                    <span class="text-muted d-block mb-1" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b !important;">
                                        Cause &amp; Payment Details
                                    </span>
                                    <h6 class="fw-bold text-dark mb-1" style="font-size: 15px;">
                                        @if($donation->project)
                                            <span class="text-primary">{{ $donation->project->name }}</span>
                                        @else
                                            <span class="text-success">General Relief &amp; Welfare Fund</span>
                                        @endif
                                    </h6>
                                    <div class="text-muted" style="font-size: 12.5px; line-height: 1.5;">
                                        <div>Purpose: <strong class="text-dark">{{ $donation->purpose ?: 'Humanitarian Aid / Sadaqah' }}</strong></div>
                                        <div>Payment Method: <strong class="text-dark">{{ strtoupper($donation->payment_method) }}</strong></div>
                                        @if($donation->transaction_id)
                                            <div>Trx ID: <strong class="text-dark font-monospace">{{ $donation->transaction_id }}</strong></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Amount Breakdown Table --}}
                        <div class="table-responsive mb-4 receipt-table-container">
                            <table class="table table-bordered mb-0 w-100" style="font-size: 13.5px; border-collapse: collapse; border-color: #cbd5e1; width: 100%;">
                                <thead>
                                    <tr style="background-color: #f1f5f9;">
                                        <th style="width: 50px; text-align: center; color: #334155; font-weight: 700; padding: 10px 8px;">SL</th>
                                        <th style="color: #334155; font-weight: 700; padding: 10px 12px;">Description / Purpose</th>
                                        <th style="width: 140px; color: #334155; font-weight: 700; padding: 10px 12px; text-align: center;">Payment Mode</th>
                                        <th style="width: 170px; color: #334155; font-weight: 700; padding: 10px 14px; text-align: right;">Amount (BDT)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center align-middle" style="color: #475569; padding: 12px 8px;">1</td>
                                        <td class="align-middle" style="padding: 12px 14px;">
                                            <strong class="text-dark" style="font-size: 14px;">{{ $donation->purpose ?: 'Humanitarian Contribution' }}</strong>
                                            @if($donation->project)
                                                <div class="text-muted mt-1" style="font-size: 12px;">
                                                    <strong>Project:</strong> {{ $donation->project->name }} ({{ $donation->project->category ?? 'Relief & Welfare' }})
                                                </div>
                                            @endif
                                            @if($donation->notes)
                                                <div class="text-muted mt-1" style="font-size: 11.5px; font-style: italic;">
                                                    Remarks: {{ $donation->notes }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle" style="padding: 12px 12px;">
                                            <span class="badge" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-size: 12px; padding: 4px 8px;">
                                                {{ strtoupper($donation->payment_method) }}
                                            </span>
                                        </td>
                                        <td class="align-middle fw-bold text-dark text-end" style="font-size: 15px; padding: 12px 14px; text-align: right;">
                                            ৳ {{ number_format((float) $donation->amount, 2) }}
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #f8fafc;">
                                        <td colspan="3" class="fw-bold text-end" style="padding: 12px 14px; font-size: 14px; color: #1e293b; text-align: right;">
                                            Grand Total Received:
                                        </td>
                                        <td class="fw-bold text-success text-end" style="font-size: 16px; padding: 12px 14px; background-color: #f0fdf4; text-align: right;">
                                            ৳ {{ number_format((float) $donation->amount, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- Status & Verification --}}
                        <div class="d-flex justify-content-between align-items-center mb-5 pb-3 border-bottom">
                            <div>
                                <span class="text-muted me-2" style="font-size: 12px; font-weight: 600; text-transform: uppercase;">Status:</span>
                                <span class="badge {{ $donation->status === 'completed' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}" style="font-size: 12px; padding: 5px 12px; border-radius: 6px;">
                                    <i class="ri-checkbox-circle-line me-1"></i> {{ ucfirst($donation->status) }} &mdash; Verified Contribution
                                </span>
                            </div>
                            <div class="text-muted" style="font-size: 11.5px; font-style: italic;">
                                Official Computer Generated Money Receipt
                            </div>
                        </div>

                        {{-- Professional 3-Column Signature Block --}}
                        <div class="row pt-4 mt-3 receipt-signatures">
                            <div class="col-4">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Donor Signature</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Accountant / Cashier</span>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="signature-box text-center">
                                    <div class="signature-line"></div>
                                    <span class="signature-title">Authorized Secretary</span>
                                </div>
                            </div>
                        </div>

                        {{-- Official Receipt Bottom Note --}}
                        <div class="mt-5 pt-3 border-top text-center receipt-footer-note" style="font-size: 11.5px; color: #64748b;">
                            <p class="mb-0">
                                <strong>Shanti Nagar Foundation (Santi Nagar Association)</strong> &bull; All donations are utilized strictly for registered humanitarian relief and social welfare programs.
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

            /* 2. Reset wrappers and layout grid so they stretch 100% with no offsets */
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

            /* 3. Printable receipt card: NO OUTER BORDER on paper, clean full width */
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
