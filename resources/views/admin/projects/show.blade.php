@extends('admin.app')
@section('title')
    Project Details &mdash; {{ $project->name }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            {{-- Main Details --}}
            <div class="col-lg-8 col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Project Details: {{ $project->name }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">Projects</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.projects.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-arrow-left-line me-1"></i> Project List
                            </a>
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="add-new">
                                <i class="ri-edit-line me-1"></i> Edit Project
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if($project->featured_image && file_exists(public_path($project->featured_image)))
                            <div class="mb-4 rounded overflow-hidden border text-center" style="max-height: 320px; background: #000;">
                                <img src="{{ asset($project->featured_image) }}" alt="{{ $project->name }}" style="max-height: 320px; width: auto; object-fit: contain;">
                            </div>
                        @endif

                        <div class="row g-3 mb-4">
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Category</span>
                                <span class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 12px; padding: 4px 8px; border-radius: 4px;">
                                    {{ $project->category ?? 'General' }}
                                </span>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Status</span>
                                @php
                                    $badgeStyle = match ($project->status) {
                                        'completed' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                                        'in_progress' => 'background-color: #fff3ee; color: #f65024; border: 1px solid rgba(246, 80, 36, 0.3);',
                                        'planned' => 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;',
                                        'cancelled' => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
                                        default => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                                    };
                                @endphp
                                <span class="badge" style="{{ $badgeStyle }} font-size: 12px; padding: 4px 8px; border-radius: 4px;">
                                    {{ ucwords(str_replace('_', ' ', (string) $project->status)) }}
                                </span>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Target Budget</span>
                                <span class="fw-bold text-dark" style="font-size: 14px;">৳ {{ number_format((float) $project->estimated_cost, 2) }}</span>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Location</span>
                                <span class="fw-semibold text-dark" style="font-size: 13px;">{{ $project->location ?: 'Dhaka, Bangladesh' }}</span>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6 col-12">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Start / Launch Date</span>
                                <span class="text-dark" style="font-size: 13px;">{{ $project->start_date?->format('M d, Y') ?: 'Not set' }}</span>
                            </div>
                            <div class="col-md-6 col-12">
                                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase;">Target Completion Date</span>
                                <span class="text-dark" style="font-size: 13px;">{{ $project->completion_date?->format('M d, Y') ?: 'Ongoing' }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-2" style="font-size: 14px;">Short Summary</h6>
                            <p class="text-muted" style="font-size: 13.5px; line-height: 1.6;">
                                {{ $project->short_description ?: 'No short summary provided.' }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-2" style="font-size: 14px;">Full Case Study &amp; Scope</h6>
                            <div style="font-size: 13.5px; color: #334155; line-height: 1.7;">
                                {!! nl2br(e($project->description)) ?: '<span class="text-muted">No full description provided.</span>' !!}
                            </div>
                        </div>

                        {{-- Gallery Photos --}}
                        @if($project->images->isNotEmpty())
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark border-bottom pb-2" style="font-size: 14px;">Project Documentation Gallery ({{ $project->images->count() }})</h6>
                                <div class="row g-2">
                                    @foreach($project->images as $img)
                                        <div class="col-md-3 col-sm-4 col-6">
                                            <a href="{{ asset($img->image_path) }}" target="_blank">
                                                <img src="{{ asset($img->image_path) }}" alt="Gallery" class="rounded border w-100" style="height: 110px; object-fit: cover;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Financial Audit Tables: Donations & Expenses --}}
                        <div class="mt-4 pt-2 border-top">
                            <ul class="nav nav-tabs border-bottom" id="projectAuditTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active fw-bold" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations-tab-pane" type="button" role="tab" aria-controls="donations-tab-pane" aria-selected="true" style="font-size: 13.5px;">
                                        <i class="ri-hand-heart-line me-1 text-success"></i> Donations ({{ $project->donations->count() }})
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fw-bold" id="expenses-tab" data-bs-toggle="tab" data-bs-target="#expenses-tab-pane" type="button" role="tab" aria-controls="expenses-tab-pane" aria-selected="false" style="font-size: 13.5px;">
                                        <i class="ri-file-list-3-line me-1 text-danger"></i> Expenses &amp; Vouchers ({{ $project->expenses->count() }})
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content pt-3" id="projectAuditTabContent">
                                {{-- Donations Pane --}}
                                <div class="tab-pane fade show active" id="donations-tab-pane" role="tabpanel" aria-labelledby="donations-tab" tabindex="0">
                                    @if($project->donations->isNotEmpty())
                                        <div class="table-responsive">
                                            <table class="table table-sm align-middle mb-0" style="font-size: 12.5px;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Receipt #</th>
                                                        <th>Donor</th>
                                                        <th>Amount (৳)</th>
                                                        <th>Method</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($project->donations as $donation)
                                                        <tr>
                                                            <td class="font-monospace fw-semibold">{{ $donation->receipt_number }}</td>
                                                            <td>{{ $donation->donor?->name ?? 'Anonymous' }}</td>
                                                            <td class="fw-bold text-success">৳ {{ number_format((float) $donation->amount, 2) }}</td>
                                                            <td><span class="badge bg-light text-dark border">{{ strtoupper($donation->payment_method) }}</span></td>
                                                            <td>{{ $donation->donation_date?->format('M d, Y') }}</td>
                                                            <td>
                                                                <span class="badge {{ $donation->status === 'completed' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' }}">
                                                                    {{ ucfirst($donation->status) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4 text-muted" style="font-size: 13px;">
                                            <i class="ri-hand-heart-line d-block fs-3 mb-1 text-secondary"></i>
                                            No donation transactions recorded for this project yet.
                                        </div>
                                    @endif
                                </div>

                                {{-- Expenses Pane --}}
                                <div class="tab-pane fade" id="expenses-tab-pane" role="tabpanel" aria-labelledby="expenses-tab" tabindex="0">
                                    @if($project->expenses->isNotEmpty())
                                        <div class="table-responsive">
                                            <table class="table table-sm align-middle mb-0" style="font-size: 12.5px;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Voucher #</th>
                                                        <th>Title / Vendor</th>
                                                        <th>Category</th>
                                                        <th>Amount (৳)</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($project->expenses as $expense)
                                                        <tr>
                                                            <td class="font-monospace fw-semibold">{{ $expense->voucher_number }}</td>
                                                            <td>
                                                                <span class="d-block fw-semibold text-dark">{{ $expense->title }}</span>
                                                                @if($expense->recipient_or_vendor)
                                                                    <span class="text-muted" style="font-size: 11px;">To: {{ $expense->recipient_or_vendor }}</span>
                                                                @endif
                                                            </td>
                                                            <td><span class="badge bg-light text-dark border">{{ $expense->expense_category }}</span></td>
                                                            <td class="fw-bold text-danger">৳ {{ number_format((float) $expense->amount, 2) }}</td>
                                                            <td>{{ $expense->expense_date?->format('M d, Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4 text-muted" style="font-size: 13px;">
                                            <i class="ri-file-list-3-line d-block fs-3 mb-1 text-secondary"></i>
                                            No expense vouchers recorded for this project yet.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Audit & Financials --}}
            <div class="col-lg-4 col-12">
                <div class="card table-card mb-3">
                    <div class="card-header table-header">
                        <div class="table-title">Financial Tracker</div>
                    </div>
                    <div class="card-body p-3">
                        <div class="p-3 rounded mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size: 12.5px;">Target Budget:</span>
                                <strong class="text-dark">৳ {{ number_format((float) $project->estimated_cost, 2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size: 12.5px;">Donations Raised:</span>
                                <strong class="text-success">৳ {{ number_format((float) $project->total_donations_raised, 2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size: 12.5px;">Actual Expenditure:</span>
                                <strong class="text-danger">৳ {{ number_format((float) $project->actual_expense_total, 2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between pt-2 border-top">
                                <span class="text-muted fw-semibold" style="font-size: 12.5px;">Net Cash Balance:</span>
                                <strong class="{{ $project->net_balance >= 0 ? 'text-primary' : 'text-danger' }}">
                                    ৳ {{ number_format((float) $project->net_balance, 2) }}
                                </strong>
                            </div>
                        </div>

                        @php
                            $raisedPercent = $project->funding_progress_percentage;
                            $barPercent = min(100, $raisedPercent);
                        @endphp
                        <div class="mb-2 d-flex justify-content-between" style="font-size: 12px;">
                            <span class="text-muted">Funding Progress</span>
                            <span class="fw-bold text-dark">{{ $raisedPercent }}%</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 4px;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $barPercent }}%; background-color: #059669;" aria-valuenow="{{ $barPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="table-title">System Metadata</div>
                    </div>
                    <div class="card-body p-3" style="font-size: 12.5px;">
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Slug:</span>
                            <span class="font-monospace text-dark">{{ $project->slug }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Homepage Featured:</span>
                            <span>{{ $project->is_featured ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Public Visibility:</span>
                            <span>{{ $project->is_published ? 'Published' : 'Hidden' }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1 border-bottom">
                            <span class="text-muted">Created:</span>
                            <span>{{ $project->created_at?->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Last Updated:</span>
                            <span>{{ $project->updated_at?->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection