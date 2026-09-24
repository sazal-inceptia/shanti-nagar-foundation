@extends('admin.app')
@section('title')
    Donor Profile &mdash; {{ $donor->name }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            {{-- Main Details & Donation History --}}
            <div class="col-lg-8 col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Donor Profile: {{ $donor->name }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.donors.index') }}">Donors</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.donors.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-arrow-left-line me-1"></i> Donor List
                            </a>
                            <a href="{{ route('admin.donations.create') }}?donor_id={{ $donor->id }}" class="add-new">
                                <i class="ri-hand-coin-line me-1"></i> Add Donation
                            </a>
                            <a href="{{ route('admin.donors.edit', $donor->id) }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-edit-line me-1"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Donor Type</span>
                                @php
                                    $typeEnum = $donor->donor_type instanceof \App\Enums\DonorType 
                                        ? $donor->donor_type 
                                        : \App\Enums\DonorType::tryFrom((string)$donor->donor_type) ?? \App\Enums\DonorType::Individual;
                                @endphp
                                <span class="badge" style="{{ $typeEnum->badgeStyle() }} font-size: 12px; padding: 4px 8px; border-radius: 4px;">
                                    {{ $typeEnum->label() }}
                                </span>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Total Donated</span>
                                <span class="fw-bold text-success" style="font-size: 14px;">৳ {{ number_format((float) $donor->total_donation, 2) }}</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Total Contributions</span>
                                <span class="fw-bold text-dark" style="font-size: 14px;">{{ $donor->donations->count() }} times</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">City / Country</span>
                                <span class="fw-semibold text-dark" style="font-size: 13px;">{{ $donor->city ?: 'Dhaka' }}, {{ $donor->country ?: 'Bangladesh' }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-2" style="font-size: 14px;">Contact &amp; Address</h6>
                            <div class="row g-2 text-muted" style="font-size: 13.5px;">
                                <div class="col-md-6 col-12">
                                    <strong class="text-dark">Phone:</strong> {{ $donor->phone ?: 'Not provided' }}
                                </div>
                                <div class="col-md-6 col-12">
                                    <strong class="text-dark">Email:</strong> {{ $donor->email ?: 'Not provided' }}
                                </div>
                                <div class="col-12 mt-1">
                                    <strong class="text-dark">Address:</strong> {{ $donor->address ?: 'Not provided' }}
                                </div>
                            </div>
                        </div>

                        @if($donor->notes)
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark border-bottom pb-2" style="font-size: 14px;">Donor Notes</h6>
                                <p class="text-muted" style="font-size: 13px; line-height: 1.6;">
                                    {{ $donor->notes }}
                                </p>
                            </div>
                        @endif

                        {{-- Donation Audit History --}}
                        <div class="mt-4 pt-2 border-top">
                            <h6 class="fw-bold text-dark mb-3" style="font-size: 14px;">
                                <i class="ri-history-line me-1 text-primary"></i> Lifetime Donation History ({{ $donor->donations->count() }})
                            </h6>
                            @if($donor->donations->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table table-sm align-middle mb-0" style="font-size: 12.5px;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Receipt #</th>
                                                <th>Allocated Project</th>
                                                <th>Amount (৳)</th>
                                                <th>Payment Method</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th class="text-center">Receipt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($donor->donations as $donation)
                                                <tr>
                                                    <td class="font-monospace fw-semibold">
                                                        <a href="{{ route('admin.donations.show', $donation->id) }}" class="text-decoration-none fw-bold text-dark">
                                                            {{ $donation->receipt_number }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($donation->project)
                                                            <a href="{{ route('admin.projects.show', $donation->project->id) }}" class="badge" style="background-color: #f1f5f9; color: #334155; text-decoration: none;">
                                                                {{ $donation->project->name }}
                                                            </a>
                                                        @else
                                                            <span class="badge bg-light text-muted border">General Relief Fund</span>
                                                        @endif
                                                    </td>
                                                    <td class="fw-bold text-success">৳ {{ number_format((float) $donation->amount, 2) }}</td>
                                                    <td><span class="badge bg-light text-dark border">{{ strtoupper($donation->payment_method) }}</span></td>
                                                    <td>{{ $donation->donation_date?->format('M d, Y') }}</td>
                                                    <td>
                                                        <span class="badge {{ $donation->status === 'completed' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}">
                                                            {{ ucfirst($donation->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn btn-sm btn-outline-secondary p-1" title="View & Print Money Receipt" style="font-size: 11px; border-radius: 4px;">
                                                            <i class="ri-printer-line"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4 text-muted" style="font-size: 13px;">
                                    <i class="ri-hand-heart-line d-block fs-3 mb-1 text-secondary"></i>
                                    No donation records logged for this donor yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Metadata & Summary --}}
            <div class="col-lg-4 col-12">
                <div class="card table-card mb-3">
                    <div class="card-header table-header">
                        <div class="table-title">Contribution Summary</div>
                    </div>
                    <div class="card-body p-3">
                        <div class="p-3 rounded mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size: 12.5px;">Lifetime Contributed:</span>
                                <strong class="text-success" style="font-size: 15px;">৳ {{ number_format((float) $donor->total_donation, 2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size: 12.5px;">Completed Donations:</span>
                                <strong class="text-dark">{{ $donor->donations->where('status', 'completed')->count() }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted" style="font-size: 12.5px;">Latest Contribution:</span>
                                <span class="text-dark fw-semibold">
                                    {{ $donor->donations->first()?->donation_date?->format('M d, Y') ?: 'None yet' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="table-title">System Record</div>
                    </div>
                    <div class="card-body p-3" style="font-size: 12.5px;">
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Anonymous Flag:</span>
                            <span>{{ $donor->is_anonymous ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Registered On:</span>
                            <span>{{ $donor->created_at?->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Last Updated:</span>
                            <span>{{ $donor->updated_at?->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
