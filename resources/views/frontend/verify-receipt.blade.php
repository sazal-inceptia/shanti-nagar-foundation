@extends('frontend.layouts.app')

@section('title', __('Receipt Verification & Transparency Portal') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title / Hero -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/contact-hero-bg.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Receipt Verification & Transparency Portal') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('donate') }}">{{ __('Donate') }}</a></li>
                    <li>{{ __('Receipt Verification') }}</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Main Verification & Transparency Section -->
    <section class="verification-section sec-pad" style="background-color: #f8fafc;">
        <div class="auto-container">

            <!-- Search Banner Card -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 col-md-12">
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 18px; background: #ffffff; border-top: 5px solid #005daa !important;">
                        <div class="text-center mb-4">
                            <span class="badge px-3 py-2 text-uppercase mb-2"
                                style="background-color: #e0f2fe; color: #005daa; font-weight: 800; font-size: 12px; letter-spacing: 0.05em; border-radius: 6px;">
                                <i class="fas fa-shield-alt me-1"></i> {{ __('Public Accountability & Verification') }}
                            </span>
                            <h2 class="fw-bold text-dark mb-2" style="font-size: 28px;">
                                {{ __('Verify Donation Receipt') }}
                            </h2>
                            <p class="text-muted mx-auto" style="max-width: 650px; font-size: 14.5px;">
                                {{ __('Enter your Money Receipt Number (e.g. REC-2026-0001), Donor Mobile Number, or bKash/Bank Transaction ID to verify official credit status.') }}
                            </p>
                        </div>

                        <!-- Verification Search Form -->
                        <form action="{{ route('verify.receipt') }}" method="GET" class="search-form">
                            <div class="row g-2 align-items-center">
                                <div class="col-lg-9 col-md-8 col-12">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" name="query" class="form-control border-start-0"
                                            value="{{ $query }}"
                                            placeholder="{{ __('e.g. REC-2026-0001 or 01711223344 or 9B8C7D6E') }}"
                                            style="border-radius: 0 10px 10px 0; border-color: #cbd5e1; font-size: 15px; height: 54px;"
                                            required autofocus>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <button type="submit" class="theme-btn btn-one w-100 justify-content-center d-inline-flex align-items-center"
                                        style="height: 54px; font-size: 15px; border-radius: 10px;">
                                        <i class="fas fa-check-circle me-2"></i> {{ __('Verify Receipt') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top flex-wrap gap-2 text-muted" style="font-size: 12.5px;">
                            <div>
                                <i class="fas fa-info-circle text-primary me-1"></i>
                                <span>{{ __('Supported inputs: Full Receipt ID, Mobile Number, or bKash TrxID') }}</span>
                            </div>
                            @if(!empty($query))
                                <a href="{{ route('verify.receipt') }}" class="text-danger text-decoration-none fw-semibold">
                                    <i class="fas fa-times-circle me-1"></i> {{ __('Clear Search & View All Stats') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Results Section (When searched) -->
            @if($results !== null)
                <div class="row justify-content-center mb-5" id="search-results">
                    <div class="col-lg-10 col-md-12">
                        @if($results->isNotEmpty())
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold text-dark mb-0" style="font-size: 20px;">
                                    <i class="fas fa-file-invoice text-success me-2"></i>
                                    {{ __('Verification Results') }} ({{ localized_number($results->total()) }})
                                </h4>
                                <span class="badge bg-success px-3 py-2" style="font-size: 12px; border-radius: 6px;">
                                    <i class="fas fa-check-circle me-1"></i> {{ __('Official Records Matched') }}
                                </span>
                            </div>

                            @foreach($results as $item)
                                <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0 !important;">
                                    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center flex-wrap gap-2 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <span class="badge px-3 py-2 me-3"
                                                style="background-color: #f1f5f9; color: #0b1c3f; font-family: monospace; font-size: 15px; font-weight: 700; border-radius: 6px;">
                                                <i class="fas fa-receipt text-primary me-1"></i> {{ $item->receipt_number }}
                                            </span>
                                            <span class="text-muted" style="font-size: 13px;">
                                                <i class="far fa-calendar-alt me-1"></i> {{ $item->donation_date ? $item->donation_date->format('d M, Y') : '-' }}
                                            </span>
                                        </div>
                                        <div>
                                            @if($item->status === 'completed')
                                                <span class="badge px-3 py-2" style="background-color: #dcfce7; color: #15803d; font-size: 12.5px; font-weight: 700; border-radius: 6px;">
                                                    <i class="fas fa-check-circle me-1"></i> {{ __('Verified & Credited') }}
                                                </span>
                                            @elseif($item->status === 'pending')
                                                <span class="badge px-3 py-2" style="background-color: #fef3c7; color: #b45309; font-size: 12.5px; font-weight: 700; border-radius: 6px;">
                                                    <i class="fas fa-clock me-1"></i> {{ __('Pledge Pending Verification') }}
                                                </span>
                                            @else
                                                <span class="badge px-3 py-2" style="background-color: #fee2e2; color: #b91c1c; font-size: 12.5px; font-weight: 700; border-radius: 6px;">
                                                    <i class="fas fa-times-circle me-1"></i> {{ ucfirst($item->status) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-body p-4">
                                        <div class="row g-4 align-items-center">
                                            <div class="col-md-7 col-12">
                                                <div class="mb-3">
                                                    <small class="text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">{{ __('Donor / Contributor') }}</small>
                                                    <div class="fw-bold text-dark fs-5">
                                                        {{ $item->donor?->name ?: __('Anonymous Donor') }}
                                                    </div>
                                                    @if($item->donor?->phone)
                                                        @php
                                                            $p = $item->donor->phone;
                                                            $maskedPhone = strlen($p) >= 7 ? substr($p, 0, 3) . '*****' . substr($p, -3) : $p;
                                                        @endphp
                                                        <small class="text-muted"><i class="fas fa-phone-alt me-1 text-primary"></i> {{ $maskedPhone }}</small>
                                                    @endif
                                                </div>

                                                <div class="mb-2">
                                                    <small class="text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">{{ __('Humanitarian Cause Supported') }}</small>
                                                    <div class="fw-semibold text-primary" style="font-size: 15px;">
                                                        @if($item->project)
                                                            <a href="{{ route('project.details', $item->project->slug) }}" class="text-decoration-none">
                                                                <i class="fas fa-hand-holding-heart me-1"></i> {{ $item->project->localized_name }}
                                                            </a>
                                                        @else
                                                            <span class="text-dark"><i class="fas fa-globe-asia me-1"></i> {{ __('General Humanitarian Fund') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if($item->transaction_id)
                                                    <div class="text-muted" style="font-size: 12.5px;">
                                                        <strong>{{ __('TrxID / Ref') }}:</strong> <code class="text-dark">{{ $item->transaction_id }}</code>
                                                        &bull; <strong>{{ __('Channel') }}:</strong> {{ ucfirst(str_replace('_', ' ', $item->payment_method)) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-5 col-12 text-md-end border-start-md ps-md-4">
                                                <small class="text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.05em;">{{ __('Contribution Amount') }}</small>
                                                <div class="fw-bold text-success mb-3" style="font-size: 28px; font-family: 'Nunito Sans', sans-serif;">
                                                    ৳{{ localized_number((float) $item->amount) }}
                                                </div>
                                                <div class="d-flex flex-column gap-2">
                                                    <a href="{{ route('donation.receipt', $item->receipt_number) }}" target="_blank"
                                                        class="theme-btn btn-one btn-sm text-center justify-content-center d-inline-flex align-items-center"
                                                        style="border-radius: 8px;">
                                                        <i class="fas fa-print me-2"></i> {{ __('View & Print Official Receipt') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $results->links() }}
                            </div>
                        @else
                            <!-- No Results State -->
                            <div class="card border-0 shadow-sm p-4 p-md-5 text-center" style="border-radius: 16px; background-color: #ffffff;">
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                        style="width: 70px; height: 70px; background-color: #fee2e2; color: #dc2626;">
                                        <i class="fas fa-search-minus fs-2"></i>
                                    </div>
                                </div>
                                <h4 class="fw-bold text-dark mb-2">{{ __('No Donation Receipt Found') }}</h4>
                                <p class="text-muted mx-auto mb-4" style="max-width: 550px; font-size: 14.5px;">
                                    {{ __('We could not find any active donation or pledge matching ":query". Please check for possible typos in the receipt serial or contact our accounts desk.', ['query' => $query]) }}
                                </p>
                                <div class="p-3 mx-auto rounded-3 mb-4 text-start" style="max-width: 580px; background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 13px;">
                                    <div class="fw-bold text-dark mb-2"><i class="fas fa-lightbulb text-warning me-1"></i> {{ __('Helpful Tips & Troubleshooting') }}:</div>
                                    <ul class="mb-0 ps-3 text-muted">
                                        <li class="mb-1">{{ __('Receipt numbers follow the serial pattern: REC-YYYY-XXXX (e.g. REC-2026-0001).') }}</li>
                                        <li class="mb-1">{{ __('If you made a payment via bKash/Nagad just moments ago, our volunteer accounts team verifies statements regularly within 10-30 minutes.') }}</li>
                                        <li>{{ __('You can also search by your 11-digit Bangladeshi mobile number used during payment.') }}</li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 8px; font-weight: 600;">
                                        <i class="fas fa-envelope me-1"></i> {{ __('Contact Support') }}
                                    </a>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('hotline', '+8801711000000')) }}" class="theme-btn btn-one btn-sm px-4 py-2" style="border-radius: 8px;">
                                        <i class="fas fa-phone-alt me-1"></i> {{ __('Call Hotline') }}: {{ site_setting('hotline', '+880 1711-000000') }}
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- 4 Key Transparency Metrics -->
            <div class="row g-4 mb-5">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center" style="border-radius: 14px; background: #ffffff;">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #e0f2fe; color: #005daa;">
                                <i class="fas fa-coins fs-4"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;">৳{{ localized_number($totalVerifiedDonations) }}</h3>
                        <p class="text-muted mb-0" style="font-size: 13px; font-weight: 600;">{{ __('Total Verified Donations') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center" style="border-radius: 14px; background: #ffffff;">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #dcfce7; color: #16a34a;">
                                <i class="fas fa-receipt fs-4"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;">{{ localized_number($completedCount) }}+</h3>
                        <p class="text-muted mb-0" style="font-size: 13px; font-weight: 600;">{{ __('Audited Money Receipts') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center" style="border-radius: 14px; background: #ffffff;">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #fef3c7; color: #d97706;">
                                <i class="fas fa-hand-holding-heart fs-4"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;">{{ localized_number($projectsSupported) }}</h3>
                        <p class="text-muted mb-0" style="font-size: 13px; font-weight: 600;">{{ __('Active Humanitarian Causes') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0 shadow-sm p-4 h-100 text-center" style="border-radius: 14px; background: #ffffff;">
                        <div class="mb-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background-color: #f3e8ff; color: #9333ea;">
                                <i class="fas fa-users fs-4"></i>
                            </span>
                        </div>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 26px;">{{ localized_number($totalDonors) }}+</h3>
                        <p class="text-muted mb-0" style="font-size: 13px; font-weight: 600;">{{ __('Grassroots Benefactors') }}</p>
                    </div>
                </div>
            </div>

            <!-- Transparency Guarantee Pillars -->
            <div class="card border-0 shadow-sm p-4 p-md-5 mb-5" style="border-radius: 18px; background: #ffffff;">
                <div class="sec-title text-center mb-4">
                    <span class="top-text">{{ __('Rotary Accountability Framework') }}</span>
                    <h2>{{ __('How We Guarantee 100% Financial Transparency') }}</h2>
                    <p class="mx-auto" style="max-width: 700px;">
                        {{ __('Every single contribution entrusted to the Rotary Club of Shantinagar Dhaka is guarded under strict governance with zero hidden charges.') }}
                    </p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-3 h-100" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex align-items-center mb-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3"
                                    style="width: 44px; height: 44px; background-color: #e0f2fe; color: #005daa;">
                                    <i class="fas fa-barcode"></i>
                                </span>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 16px;">{{ __('Serialized Receipts') }}</h5>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.6;">
                                {{ __('Every pledge generates a unique electronic serial money receipt verifiable on this portal anytime by any auditor or donor.') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-3 h-100" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex align-items-center mb-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3"
                                    style="width: 44px; height: 44px; background-color: #dcfce7; color: #16a34a;">
                                    <i class="fas fa-clipboard-check"></i>
                                </span>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 16px;">{{ __('Itemized Field Vouchers') }}</h5>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.6;">
                                {{ __('Zero middleman leakages. Hospital gear, orphan bags, and tube-well materials are bought with itemized supplier cash memos and photographic proofs.') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="p-4 rounded-3 h-100" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex align-items-center mb-3">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-3"
                                    style="width: 44px; height: 44px; background-color: #fef3c7; color: #d97706;">
                                    <i class="fas fa-university"></i>
                                </span>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 16px;">{{ __('Reconciled Bank Accounts') }}</h5>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13.5px; line-height: 1.6;">
                                {{ __('All MFS (bKash/Nagad) and bank deposits are reconciled against club ledger books under Rotary District 3281 annual auditing guidelines.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Verified Public Contributions Feed -->
            <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                    <div>
                        <h4 class="fw-bold text-dark mb-1" style="font-size: 20px;">
                            <i class="fas fa-list-check text-primary me-2"></i> {{ __('Recent Audited Contributions') }}
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 13px;">
                            {{ __('Public ledger of latest verified contributions across our humanitarian projects.') }}
                        </p>
                    </div>
                    <a href="{{ route('donate') }}" class="theme-btn btn-one btn-sm" style="border-radius: 8px;">
                        <i class="fas fa-heart me-1"></i> {{ __('Make a Contribution') }}
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13.5px;">
                        <thead style="background-color: #f8fafc; color: #475569;">
                            <tr>
                                <th class="py-3 px-3 border-0">{{ __('Receipt #') }}</th>
                                <th class="py-3 border-0">{{ __('Donor') }}</th>
                                <th class="py-3 border-0">{{ __('Cause / Project') }}</th>
                                <th class="py-3 border-0">{{ __('Date') }}</th>
                                <th class="py-3 text-end border-0">{{ __('Amount (৳)') }}</th>
                                <th class="py-3 text-center border-0">{{ __('Verification') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentAudited as $donation)
                                <tr>
                                    <td class="py-3 px-3">
                                        <a href="{{ route('donation.receipt', $donation->receipt_number) }}" target="_blank"
                                            class="fw-bold text-primary font-monospace text-decoration-none">
                                            {{ $donation->receipt_number }}
                                        </a>
                                    </td>
                                    <td class="py-3">
                                        @if($donation->donor?->is_anonymous)
                                            <span class="text-muted fst-italic">{{ __('Well-Wisher (Anonymous)') }}</span>
                                        @else
                                            <span class="fw-semibold text-dark">{{ $donation->donor?->name ?: __('Well-Wisher') }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if($donation->project)
                                            <a href="{{ route('project.details', $donation->project->slug) }}" class="text-decoration-none text-secondary">
                                                {{ Str::limit($donation->project->localized_name, 38) }}
                                            </a>
                                        @else
                                            <span class="text-muted">{{ __('General Fund') }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3 text-muted">
                                        {{ $donation->donation_date ? $donation->donation_date->format('d M, Y') : '-' }}
                                    </td>
                                    <td class="py-3 text-end fw-bold text-success">
                                        ৳{{ localized_number((float) $donation->amount) }}
                                    </td>
                                    <td class="py-3 text-center">
                                        <a href="{{ route('donation.receipt', $donation->receipt_number) }}" target="_blank"
                                            class="badge px-2 py-1 text-decoration-none"
                                            style="background-color: #dcfce7; color: #15803d; font-size: 11px; border-radius: 4px;">
                                            <i class="fas fa-check-circle me-1"></i> {{ __('Verified Receipt') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        {{ __('No verified donation records available yet.') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

@endsection
