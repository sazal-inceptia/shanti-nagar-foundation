@extends('frontend.layouts.app')

@section('title', __('Official Donation Money Receipt') . ' — ' . $donation->receipt_number)

@section('content')

    <!-- Printable Receipt Section -->
    <section class="receipt-page-section sec-pad" style="background-color: #f1f5f9; min-height: 80vh;">
        <div class="auto-container" style="max-width: 900px;">

            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4 p-3 border-0 shadow-sm no-print"
                    style="border-radius: 10px; background-color: #d1fae5; color: #065f46;">
                    <i class="fas fa-check-circle fs-4 me-3"></i>
                    <div>
                        <div class="fw-bold fs-6">{{ __('Pledge Recorded Successfully!') }}</div>
                        <div style="font-size: 14px;">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <!-- Top Action Toolbar (Hidden on Print) -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 no-print">
                <a href="{{ route('donate') }}" class="btn btn-outline-secondary" style="border-radius: 8px; font-weight: 600; font-size: 14px;">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('Make Another Donation') }}
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('home') }}" class="btn btn-light border" style="border-radius: 8px; font-weight: 600; font-size: 14px;">
                        <i class="fas fa-home me-1"></i> {{ __('Home') }}
                    </a>
                    <button type="button" onclick="window.print();" class="btn btn-primary"
                        style="border-radius: 8px; font-weight: 700; font-size: 14px; background-color: #005daa; border-color: #005daa;">
                        <i class="fas fa-print me-1"></i> {{ __('Print / Download PDF') }}
                    </button>
                </div>
            </div>

            <!-- Official Printable Receipt Card -->
            <div class="card border-0 shadow receipt-card" id="printable-receipt"
                style="border-radius: 16px; background: #ffffff; overflow: hidden; border: 2px solid #e2e8f0 !important;">
                
                <!-- Receipt Top Accent Banner -->
                <div style="background: linear-gradient(135deg, #005daa 0%, #002d62 100%); height: 10px; width: 100%;"></div>

                <div class="card-body p-4 p-md-5">
                    <!-- Header with Logo and Club Info -->
                    <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4 flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <div class="me-3 p-2 bg-white rounded border shadow-sm" style="width: 75px; height: 75px; display: flex; align-items: center; justify-content: center;">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}" style="max-height: 60px; max-width: 60px; object-fit: contain;">
                            </div>
                            <div>
                                <h3 class="fw-bold mb-1" style="color: #0b1c3f; font-size: 20px; letter-spacing: -0.02em;">
                                    {{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}
                                </h3>
                                <p class="text-muted mb-0" style="font-size: 12.5px; font-weight: 600;">
                                    {{ __('Govt. Reg. / Club ID: DHK-NGO-88219') }} &bull; {{ __('Rotary International District 3281') }}
                                </p>
                                <p class="text-muted mb-0" style="font-size: 12px;">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ site_setting('address', 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh.') }}
                                </p>
                            </div>
                        </div>
                        <div class="text-md-end">
                            <span class="badge px-3 py-2"
                                style="background-color: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-size: 12px; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; border-radius: 6px;">
                                {{ __('OFFICIAL MONEY RECEIPT') }}
                            </span>
                            <div class="mt-2 fw-bold text-dark" style="font-size: 16px; font-family: monospace;">
                                {{ $donation->receipt_number }}
                            </div>
                            <div class="text-muted" style="font-size: 12px;">
                                {{ __('Date') }}: {{ $donation->donation_date ? \Carbon\Carbon::parse($donation->donation_date)->format('d F, Y') : now()->format('d F, Y') }}
                            </div>
                        </div>
                    </div>

                    <!-- Donor & Contribution Grid -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0; height: 100%;">
                                <h6 class="text-uppercase fw-bold text-muted mb-3" style="font-size: 11px; letter-spacing: 0.08em;">
                                    {{ __('Received With Thanks From') }}
                                </h6>
                                <div class="fw-bold text-dark fs-5 mb-1">{{ $donation->donor?->name ?: __('Anonymous Donor') }}</div>
                                @if($donation->donor?->phone)
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fas fa-phone-alt me-1 text-primary"></i> {{ $donation->donor->phone }}
                                    </div>
                                @endif
                                @if($donation->donor?->email)
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fas fa-envelope me-1 text-primary"></i> {{ $donation->donor->email }}
                                    </div>
                                @endif
                                @if($donation->donor?->address)
                                    <div class="text-muted" style="font-size: 13px;">
                                        <i class="fas fa-map-pin me-1 text-primary"></i> {{ $donation->donor->address }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0; height: 100%;">
                                <h6 class="text-uppercase fw-bold text-muted mb-3" style="font-size: 11px; letter-spacing: 0.08em;">
                                    {{ __('Payment & Purpose Details') }}
                                </h6>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted" style="font-size: 13px;">{{ __('Designated Cause') }}:</span>
                                    <span class="fw-bold text-dark text-end" style="font-size: 13px;">
                                        {{ $donation->project ? $donation->project->localized_name : __('General Humanitarian Relief Fund') }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted" style="font-size: 13px;">{{ __('Payment Method') }}:</span>
                                    <span class="badge bg-secondary text-capitalize px-2 py-1" style="font-size: 12px;">
                                        {{ str_replace('_', ' ', $donation->payment_method ?: 'Online / Mobile') }}
                                    </span>
                                </div>
                                @if($donation->transaction_id)
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted" style="font-size: 13px;">{{ __('Trx ID / Ref') }}:</span>
                                        <span class="fw-bold text-primary font-monospace" style="font-size: 13px;">
                                            {{ $donation->transaction_id }}
                                        </span>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted" style="font-size: 13px;">{{ __('Payment Status') }}:</span>
                                    @if($donation->status === 'completed')
                                        <span class="badge bg-success" style="font-size: 12px;">{{ __('Verified & Confirmed') }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark" style="font-size: 12px;">{{ __('Pledge Recorded (Verification in Progress)') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Amount Box (Prominent) -->
                    <div class="p-4 rounded-3 text-center my-4"
                        style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1.5px dashed #22c55e;">
                        <span class="text-uppercase fw-bold" style="font-size: 12px; color: #15803d; letter-spacing: 0.08em;">
                            {{ __('Total Donated Amount (BDT)') }}
                        </span>
                        <div class="fw-extrabold my-1" style="font-size: 38px; color: #166534;">
                            ৳ {{ localized_number((float) $donation->amount) }}
                        </div>
                        <div class="text-muted fw-semibold" style="font-size: 13px;">
                            {{ __('Bangladeshi Taka Only') }} &bull; {{ __('100% Tax-Exempt Humanitarian Relief') }}
                        </div>
                    </div>

                    <!-- Signatures and Verification Seal -->
                    <div class="row pt-4 mt-4 border-top align-items-end">
                        <div class="col-4 text-center">
                            <div class="border-top pt-2 mx-auto" style="width: 140px; border-color: #94a3b8 !important;">
                                <div class="fw-bold text-dark" style="font-size: 12px;">{{ __('President') }}</div>
                                <div class="text-muted" style="font-size: 10.5px;">{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}</div>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="d-inline-block p-2 rounded-circle border"
                                style="width: 75px; height: 75px; border-color: #005daa !important; background-color: #f8fafc;">
                                <div style="font-size: 9px; font-weight: 800; color: #005daa; line-height: 1.2; padding-top: 10px;">
                                    ROTARY CLUB<br>SHANTINAGAR<br>★ SEAL ★
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <div class="border-top pt-2 mx-auto" style="width: 140px; border-color: #94a3b8 !important;">
                                <div class="fw-bold text-dark" style="font-size: 12px;">{{ __('Treasurer') }}</div>
                                <div class="text-muted" style="font-size: 10.5px;">{{ __('Finance & Accounts Desk') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Note -->
                    <div class="text-center mt-4 pt-3 border-top text-muted" style="font-size: 11px; line-height: 1.5;">
                        {{ __('This is a computer-generated money receipt from the official portal of Rotary Club of Shantinagar Dhaka. All donations are transparently audited and allocated directly to field humanitarian operations.') }}
                        <br>
                        {{ __('For queries or verification, call our accounts helpline: :phone or email: :email', ['phone' => site_setting('hotline', '+880 1711-000000'), 'email' => site_setting('email', 'contact@rotaryshantinagardhaka.org')]) }}
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Print CSS -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .no-print, header, footer, .main-header, .main-footer, .scroll-to-top, .page-title, nav {
                display: none !important;
            }
            #printable-receipt, #printable-receipt * {
                visibility: visible;
            }
            #printable-receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: 1px solid #ccc !important;
                box-shadow: none !important;
                margin: 0;
                padding: 0;
            }
            .receipt-page-section {
                padding: 0 !important;
                background: #ffffff !important;
            }
        }
    </style>

@endsection
