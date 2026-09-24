@extends('admin.app')
@section('title')
    Money Receipt &mdash; {{ $donation->receipt_number }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-12">
                {{-- Action Bar --}}
                <div class="d-flex justify-content-between align-items-center mb-3 no-print">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('admin.donations.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                            <i class="ri-arrow-left-line me-1"></i> Donation List
                        </a>
                        <a href="{{ route('admin.donations.edit', $donation->id) }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                            <i class="ri-edit-line me-1"></i> Edit
                        </a>
                    </div>
                    <button type="button" onclick="window.print();" class="add-new" style="background-color: #f65024; color: #fff; border: none; cursor: pointer;">
                        <i class="ri-printer-line me-1"></i> Print Money Receipt
                    </button>
                </div>

                {{-- Official Printable Money Receipt Card --}}
                <div class="card border print-area shadow-sm" style="border-radius: 12px; background: #ffffff;">
                    <div class="card-body p-4 p-md-5">
                        {{-- Receipt Header --}}
                        <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center justify-content-center me-3"
                                    style="width: 62px; height: 62px; background-color: #ffffff; border-radius: 10px; padding: 4px; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0" style="color: #0b0f17; letter-spacing: -0.02em; font-size: 20px;">SHANTI NAGAR FOUNDATION</h4>
                                    <p class="text-muted mb-0" style="font-size: 12.5px;">Santi Nagar Association &bull; Reg No: DHK-NGO-88219</p>
                                    <p class="text-muted mb-0" style="font-size: 12px;">Shanti Nagar, Kakrail, Dhaka-1217, Bangladesh | Helpline: +880 1700-000000</p>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge" style="background-color: #fff3ee; color: #f65024; border: 1px solid rgba(246, 80, 36, 0.3); font-size: 12.5px; padding: 6px 12px; border-radius: 6px; font-weight: 700; text-transform: uppercase;">
                                    OFFICIAL MONEY RECEIPT
                                </span>
                                <div class="mt-2 text-muted" style="font-size: 12.5px;">
                                    Receipt No: <strong class="text-dark font-monospace">{{ $donation->receipt_number }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 12.5px;">
                                    Date: <strong class="text-dark">{{ $donation->donation_date?->format('M d, Y') }}</strong>
                                </div>
                            </div>
                        </div>

                        {{-- Donor & Allocation Info --}}
                        <div class="row g-3 mb-4 p-3 rounded" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="col-md-6 col-12">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Received With Thanks From</span>
                                <h5 class="fw-bold text-dark mb-1" style="font-size: 16px;">
                                    {{ $donation->donor ? $donation->donor->name : 'Well-wisher (Anonymous Donor)' }}
                                </h5>
                                @if($donation->donor)
                                    <div class="text-muted" style="font-size: 12.5px;">
                                        @if($donation->donor->phone) <span><i class="ri-phone-line me-1"></i>{{ $donation->donor->phone }}</span> &bull; @endif
                                        @if($donation->donor->email) <span><i class="ri-mail-line me-1"></i>{{ $donation->donor->email }}</span> @endif
                                    </div>
                                    @if($donation->donor->address)
                                        <div class="text-muted mt-1" style="font-size: 12px;">
                                            <i class="ri-map-pin-line me-1"></i>{{ $donation->donor->address }}
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="col-md-6 col-12">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Designated Cause / Sector</span>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14.5px;">
                                    @if($donation->project)
                                        <span class="text-primary">{{ $donation->project->name }}</span>
                                    @else
                                        <span class="text-success">General Relief &amp; Welfare Fund</span>
                                    @endif
                                </h6>
                                <div class="text-muted" style="font-size: 12.5px;">
                                    Purpose: <strong>{{ $donation->purpose ?: 'Humanitarian Aid / Sadaqah' }}</strong>
                                </div>
                                <div class="text-muted" style="font-size: 12.5px;">
                                    Payment Channel: <strong class="text-dark">{{ strtoupper($donation->payment_method) }}</strong>
                                    @if($donation->transaction_id)
                                        (Trx: <span class="font-monospace">{{ $donation->transaction_id }}</span>)
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Amount Breakdown Table --}}
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered mb-0" style="font-size: 13.5px;">
                                <thead style="background-color: #f1f5f9;">
                                    <tr>
                                        <th style="width: 50px;">SL</th>
                                        <th>Description / Purpose</th>
                                        <th>Payment Mode</th>
                                        <th class="text-end" style="width: 160px;">Amount (BDT)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <strong>{{ $donation->purpose ?: 'Humanitarian Contribution' }}</strong>
                                            @if($donation->project)
                                                <div class="text-muted" style="font-size: 12px;">For Project: {{ $donation->project->name }} ({{ $donation->project->category ?? 'Relief' }})</div>
                                            @endif
                                            @if($donation->notes)
                                                <div class="text-muted mt-1" style="font-size: 11.5px;"><em>Remarks: {{ $donation->notes }}</em></div>
                                            @endif
                                        </td>
                                        <td>{{ $donation->payment_method }}</td>
                                        <td class="text-end fw-bold text-dark" style="font-size: 15px;">৳ {{ number_format((float) $donation->amount, 2) }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr style="background-color: #f8fafc;">
                                        <td colspan="3" class="text-end fw-bold">Grand Total Received:</td>
                                        <td class="text-end fw-bold text-success" style="font-size: 16px;">৳ {{ number_format((float) $donation->amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- In-Words & Verification --}}
                        <div class="row align-items-center mb-5 pb-4 border-bottom">
                            <div class="col-md-8 col-12">
                                <span class="text-muted d-block" style="font-size: 11px; text-transform: uppercase; font-weight: 600;">Status</span>
                                <span class="badge {{ $donation->status === 'completed' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}" style="font-size: 12px; padding: 4px 10px;">
                                    <i class="ri-checkbox-circle-line me-1"></i> {{ ucfirst($donation->status) }} &mdash; Verified Contribution
                                </span>
                            </div>
                            <div class="col-md-4 col-12 text-md-end text-muted mt-2 mt-md-0" style="font-size: 11px;">
                                <em>System-Generated Official Money Receipt</em>
                            </div>
                        </div>

                        {{-- Signatures Footer --}}
                        <div class="row pt-4 text-center" style="font-size: 12.5px;">
                            <div class="col-4">
                                <div class="border-top pt-2" style="border-color: #cbd5e1 !important;">
                                    <strong>Donor Signature</strong>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top pt-2" style="border-color: #cbd5e1 !important;">
                                    <strong>Accountant / Cashier</strong>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-top pt-2" style="border-color: #cbd5e1 !important;">
                                    <strong>Authorized Secretary</strong>
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

            /* Hide all non-printable UI elements */
            .sidebar,
            header,
            footer,
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
            }

            /* Reset wrappers and layout grid so they don't offset or constrain width */
            #main-wrapper,
            .content,
            .sidebar.active ~ .content,
            .sidebar:not(.active) ~ .content,
            .content-body,
            .container-fluid,
            .row,
            .col-12,
            .col-lg-9 {
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

            /* Printable receipt card fills available print area cleanly */
            .print-area {
                position: relative !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                border: 1.5px solid #cbd5e1 !important;
                border-radius: 8px !important;
                box-shadow: none !important;
                background: #ffffff !important;
                page-break-inside: avoid;
            }

            .print-area .card-body {
                padding: 24px 28px !important;
            }
        }
    </style>
@endpush
