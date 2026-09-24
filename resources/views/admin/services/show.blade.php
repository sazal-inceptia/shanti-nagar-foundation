@extends('admin.app')
@section('title')
    Service Details - {{ $service->title }}
@endsection

@push('custom-style')
    <style>
        .service-meta-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .service-meta-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 3px;
        }

        .service-meta-value {
            font-size: 13.5px;
            font-weight: 600;
            color: #1e293b;
        }

        .service-desc-box {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
            font-size: 14px;
            line-height: 1.8;
            color: #334155;
        }

        .service-desc-box img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
        }

        .gallery-thumb-item {
            position: relative;
            border-radius: 6px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            height: 100px;
            background: #000;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .gallery-thumb-item:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .gallery-thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            {{-- Main Content Column --}}
            <div class="col-lg-8 col-12">
                {{-- Main Service Card --}}
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Service Details: {{ $service->title }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('services.index') }}" class="add-new"
                                style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-arrow-left-line me-1"></i> Services List
                            </a>
                            @can('service-edit')
                                <a href="{{ route('services.edit', $service->id) }}" class="add-new">
                                    <i class="ri-edit-line me-1"></i> Edit Service
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body custom-form p-4">
                        {{-- Service Header Banner --}}
                        <div class="d-flex flex-wrap align-items-center justify-content-between p-3.5 rounded mb-4"
                            style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width: 52px; height: 52px; background-color: #fff3ee; color: #f95716; border: 1px solid rgba(249, 87, 22, 0.2); font-size: 26px;">
                                    <i class="{{ $service->icon ?: 'ri-hammer-line' }}"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold text-dark mb-1" style="font-size: 19px;">{{ $service->title }}</h4>
                                    <div class="text-muted d-flex flex-wrap align-items-center gap-2" style="font-size: 12px;">
                                        <span>Slug: <code class="text-primary fw-medium">{{ $service->slug }}</code></span>
                                        <span>•</span>
                                        <span>Display Priority: <strong>#{{ $service->sort_order }}</strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                                @if($service->is_published)
                                    <span class="badge" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; padding: 6px 12px; border-radius: 6px; font-weight: 700;">
                                        <i class="ri-checkbox-circle-line me-1"></i> Published
                                    </span>
                                @else
                                    <span class="badge" style="background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-size: 12px; padding: 6px 12px; border-radius: 6px; font-weight: 700;">
                                        Draft
                                    </span>
                                @endif
                                @if($service->featured)
                                    <span class="badge" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 12px; padding: 6px 12px; border-radius: 6px; font-weight: 700;">
                                        <i class="ri-star-fill text-warning me-1"></i> Featured
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Short Description --}}
                        @if($service->short_description)
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-2"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                    Service Overview
                                </h6>
                                <p class="text-dark mb-0 p-3 rounded"
                                    style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 13.5px; line-height: 1.7;">
                                    {{ $service->short_description }}
                                </p>
                            </div>
                        @endif

                        {{-- Full Description / Scope --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-2"
                                style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                Full Capabilities &amp; Scope of Work
                            </h6>
                            <div class="service-desc-box">
                                {!! $service->description ?: '<em class="text-muted">No full description provided.</em>' !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Sidebar Parameters Column --}}
            <div class="col-lg-4 col-12">
                <div class="row g-3">
                    {{-- Status & Visibility Specifications --}}
                    <div class="col-12">
                        <div class="card table-card">
                            <div class="card-header table-header">
                                <div class="table-title">Service Parameters</div>
                            </div>
                            <div class="card-body custom-form">
                                <div class="d-flex flex-column gap-3">
                                    <div class="service-meta-box">
                                        <div class="service-meta-label">Icon Class</div>
                                        <div class="service-meta-value d-flex align-items-center gap-2">
                                            <i class="{{ $service->icon ?: 'ri-hammer-line' }} text-primary"
                                                style="font-size: 18px;"></i>
                                            <code>{{ $service->icon ?: 'ri-hammer-line' }}</code>
                                        </div>
                                    </div>

                                    <div class="service-meta-box">
                                        <div class="service-meta-label">URL Slug</div>
                                        <div class="service-meta-value font-monospace" style="font-size: 12px;">
                                            {{ $service->slug }}</div>
                                    </div>

                                    <div class="service-meta-box">
                                        <div class="service-meta-label">Display Priority Order</div>
                                        <div class="service-meta-value">{{ $service->sort_order }}</div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                        <span class="fw-semibold text-dark" style="font-size: 13px;">Website
                                            Visibility:</span>
                                        <span class="badge {{ $service->is_published ? 'bg-success' : 'bg-secondary' }}"
                                            style="font-size: 11px;">
                                            {{ $service->is_published ? 'Published' : 'Draft' }}
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                        <span class="fw-semibold text-dark" style="font-size: 13px;">Homepage
                                            Featured:</span>
                                        <span
                                            class="badge {{ $service->featured ? 'bg-warning text-dark' : 'bg-light text-muted border' }}"
                                            style="font-size: 11px;">
                                            {{ $service->featured ? 'Featured' : 'Standard' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actions Card --}}
                    <div class="col-12">
                        <div class="card table-card">
                            <div class="card-header table-header">
                                <div class="table-title">Quick Actions</div>
                            </div>
                            <div class="card-body custom-form">
                                <div class="d-flex flex-column gap-2">
                                    @can('service-edit')
                                        <a href="{{ route('services.edit', $service->id) }}"
                                            class="btn submit-button w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="ri-edit-line"></i> Edit Service
                                        </a>
                                    @endcan
                                    @can('service-delete')
                                        <button type="button" class="btn btn-outline-danger w-100 btn-delete-modal"
                                            data-title="{{ $service->title }}"
                                            data-url="{{ route('services.destroy', $service->id) }}"
                                            style="height: 32px; font-size: 13px; font-weight: 600;">
                                            <i class="ri-delete-bin-line me-1"></i> Delete Service
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header"
                    style="background-color: #fee2e2; border-bottom: 1px solid #fca5a5; padding: 16px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-error-warning-line text-danger" style="font-size: 22px;"></i>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deleteModalTitle" style="font-size: 16px;">
                            Confirm Service Deletion</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to permanently delete service <strong id="deleteServiceTitle"
                            class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This action will remove all service gallery media and assets associated with this record.
                    </p>
                </div>
                <div class="modal-footer"
                    style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deleteServiceForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger px-4"
                            style="font-size: 13px; height: 36px; border-radius: 6px; font-weight: 600;">
                            Delete Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.btn-delete-modal', function () {
                var title = $(this).data('title');
                var url = $(this).data('url');

                $('#deleteServiceTitle').text(title);
                $('#deleteServiceForm').attr('action', url);
                $('#deleteServiceModal').modal('show');
            });
        });
    </script>
@endpush