@extends('admin.app')
@section('title')
    Activity Details &mdash; {{ $activity->title }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">{{ $activity->title }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.activities.index') }}">Activities</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $activity->title }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.activities.edit', $activity->id) }}" class="add-new">
                                <i class="ri-edit-line me-1"></i> Edit Activity
                            </a>
                            <a href="{{ route('activity.details', $activity->slug) }}" target="_blank" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-external-link-line me-1"></i> Public View
                            </a>
                            <a href="{{ route('admin.activities.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-arrow-left-line me-1"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            {{-- Left side image banner --}}
                            <div class="col-lg-5 col-12">
                                <div class="rounded overflow-hidden border shadow-sm" style="max-height: 280px;">
                                    <img src="{{ $activity->featured_image_url }}" alt="{{ $activity->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>

                                <div class="card mt-3 border bg-light p-3 rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted" style="font-size: 12px;">Status:</span>
                                        <span class="badge" style="{{ $activity->status_badge_style }} font-size: 11px; padding: 4px 8px;">
                                            {{ ucwords(str_replace('_', ' ', $activity->status)) }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted" style="font-size: 12px;">Event Date:</span>
                                        <span class="text-dark fw-bold" style="font-size: 13px;">
                                            {{ $activity->event_date ? $activity->event_date->format('d M, Y (l)') : 'Not specified' }}
                                        </span>
                                    </div>
                                    @if($activity->event_time)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="text-muted" style="font-size: 12px;">Schedule Time:</span>
                                            <span class="text-dark fw-semibold" style="font-size: 13px;">{{ $activity->event_time }}</span>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted" style="font-size: 12px;">Published:</span>
                                        <span class="badge {{ $activity->is_published ? 'bg-success' : 'bg-secondary' }}" style="font-size: 11px;">
                                            {{ $activity->is_published ? 'Yes' : 'No' }}
                                        </span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted" style="font-size: 12px;">Featured:</span>
                                        <span class="badge {{ $activity->is_featured ? 'bg-primary' : 'bg-light text-dark border' }}" style="font-size: 11px;">
                                            {{ $activity->is_featured ? 'Yes' : 'No' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Right side info --}}
                            <div class="col-lg-7 col-12">
                                <div class="mb-3">
                                    <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">English Title</span>
                                    <h4 class="fw-bold text-dark mb-1">{{ $activity->title }}</h4>
                                </div>

                                @if($activity->title_bn)
                                    <div class="mb-3">
                                        <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Bangla Title</span>
                                        <h5 class="fw-bold text-primary mb-1">{{ $activity->title_bn }}</h5>
                                    </div>
                                @endif

                                @if($activity->location || $activity->location_bn)
                                    <div class="mb-3">
                                        <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Venue / Location</span>
                                        <div class="text-dark fw-semibold" style="font-size: 13.5px;">
                                            <i class="ri-map-pin-line text-danger me-1"></i>
                                            {{ $activity->location }}
                                            @if($activity->location_bn)
                                                <span class="text-muted fw-normal">({{ $activity->location_bn }})</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if($activity->short_description)
                                    <div class="mb-3">
                                        <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Short Summary</span>
                                        <p class="text-dark mb-0" style="font-size: 13.5px; line-height: 1.6;">{{ $activity->short_description }}</p>
                                    </div>
                                @endif

                                @if($activity->description)
                                    <div class="mb-3">
                                        <span class="text-muted d-block" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Full Overview</span>
                                        <div class="p-3 bg-light rounded text-dark" style="font-size: 13.5px; line-height: 1.7; white-space: pre-wrap;">{{ $activity->description }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
