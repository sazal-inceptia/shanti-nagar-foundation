@extends('admin.app')
@section('title')
    Project Details - {{ $project->title }}
@endsection

@push('custom-style')
    <style>
        .project-meta-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
        }

        .project-meta-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 3px;
        }

        .project-meta-value {
            font-size: 13.5px;
            font-weight: 600;
            color: #1e293b;
        }

        .scope-content-box {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
            font-size: 14px;
            line-height: 1.8;
            color: #334155;
        }

        .scope-content-box img {
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
                {{-- Main Project Card --}}
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Project Details: {{ $project->title }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('projects.index') }}" class="add-new"
                                style="background-color: #f1f5f9; color: #334155;">
                                <i class="ri-arrow-left-line me-1"></i> Project List
                            </a>
                            @can('project-edit')
                                <a href="{{ route('projects.edit', $project->id) }}" class="add-new">
                                    <i class="ri-edit-line me-1"></i> Edit Project
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body custom-form p-4">
                        {{-- Cover Image Showcase --}}
                        <div class="position-relative rounded overflow-hidden mb-4 border"
                            style="height: 260px; background: #0b0f17;">
                            <img src="{{ $project->main_image_url }}" alt="{{ $project->title }}"
                                onerror="this.onerror=null;this.src='{{ asset('admin/assets/images/default.jpg') }}';"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="position-absolute bottom-0 start-0 end-0 p-3 d-flex justify-content-between align-items-end"
                                style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 100%);">
                                <div>
                                    <span class="badge bg-primary mb-1"
                                        style="font-size: 11px;">{{ $project->category }}</span>
                                    <h4 class="text-white fw-bold mb-0" style="font-size: 20px;">{{ $project->title }}</h4>
                                </div>
                                <div class="d-flex gap-2">
                                    @php
                                        $status = $project->status instanceof \App\Enums\ProjectStatus ? $project->status : \App\Enums\ProjectStatus::tryFrom($project->status);
                                        $badgeStyle = match ($status) {
                                            \App\Enums\ProjectStatus::COMPLETED => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                                            \App\Enums\ProjectStatus::ONGOING => 'background-color: #fff3ee; color: #f95716; border: 1px solid rgba(249, 87, 22, 0.3);',
                                            \App\Enums\ProjectStatus::UPCOMING => 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;',
                                            default => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                                        };
                                    @endphp
                                    <span class="badge"
                                        style="{{ $badgeStyle }} font-size: 11.5px; padding: 5px 10px; border-radius: 4px; font-weight: 700;">
                                        {{ $status ? $status->label() : ucfirst($project->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Executive Summary --}}
                        @if($project->short_description)
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-2"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                    Executive Summary
                                </h6>
                                <p class="text-dark mb-0 p-3 rounded"
                                    style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 13.5px; line-height: 1.7;">
                                    {{ $project->short_description }}
                                </p>
                            </div>
                        @endif

                        {{-- Full Description / Case Study --}}
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-2"
                                style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                Detailed Scope of Work &amp; Case Study
                            </h6>
                            <div class="scope-content-box">
                                {!! $project->description ?: '<em class="text-muted">No detailed scope of work provided.</em>' !!}
                            </div>
                        </div>

                        {{-- Project Execution Milestones & Delivery Phases --}}
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold text-dark mb-0"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                    Project Milestones ({{ $project->milestones->count() }})
                                </h6>
                                @can('project-edit')
                                    <a href="{{ route('projects.edit', $project->id) }}#milestones-section"
                                        class="text-primary fw-semibold" style="font-size: 12px;">
                                        <i class="ri-edit-line me-1"></i> Manage in Full Editor
                                    </a>
                                @endcan
                            </div>

                            @if($project->milestones->isNotEmpty())
                                <div class="d-flex flex-column gap-2" id="milestonesListContainer">
                                    @foreach($project->milestones as $milestone)
                                        @php
                                            $mStatus = $milestone->status instanceof \App\Enums\MilestoneStatus ? $milestone->status : \App\Enums\MilestoneStatus::tryFrom($milestone->status);
                                            $mStatusValue = $mStatus ? $mStatus->value : (string) $milestone->status;
                                            $mStatusLabel = $mStatus ? $mStatus->label() : ucfirst((string) $milestone->status);

                                            $mBadgeStyle = match ($mStatus) {
                                                \App\Enums\MilestoneStatus::COMPLETED => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                                                \App\Enums\MilestoneStatus::IN_PROGRESS => 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;',
                                                \App\Enums\MilestoneStatus::DELAYED => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
                                                \App\Enums\MilestoneStatus::ON_HOLD => 'background-color: #fffbeb; color: #92400e; border: 1px solid #fde68a;',
                                                default => 'background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0;',
                                            };

                                            $milestonePayload = [
                                                'id' => $milestone->id,
                                                'project_id' => $milestone->project_id,
                                                'title' => $milestone->title,
                                                'status' => $mStatusValue,
                                                'status_label' => $mStatusLabel,
                                                'badge_style' => $mBadgeStyle,
                                                'progress_percentage' => (int) $milestone->progress_percentage,
                                                'target_date' => $milestone->target_date ? $milestone->target_date->format('Y-m-d') : '',
                                                'target_date_formatted' => $milestone->target_date ? $milestone->target_date->format('M d, Y') : '—',
                                                'completion_date' => $milestone->completion_date ? $milestone->completion_date->format('Y-m-d') : '',
                                                'completion_date_formatted' => $milestone->completion_date ? $milestone->completion_date->format('M d, Y') : '—',
                                                'description' => $milestone->description ?? '',
                                                'image_url' => $milestone->image_url ?? '',
                                                'update_url' => route('milestones.update', $milestone->id),
                                            ];
                                        @endphp
                                        <div class="p-2 px-3 rounded border d-flex justify-content-between align-items-center milestone-row-item"
                                            id="milestone-row-{{ $milestone->id }}"
                                            style="background-color: #ffffff; border-color: #e2e8f0; transition: all 0.15s ease;"
                                            data-milestone="{{ json_encode($milestonePayload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) }}">
                                            <div class="d-flex align-items-center gap-2 text-truncate me-2">
                                                <span class="badge bg-light text-dark border fw-bold flex-shrink-0"
                                                    style="font-size: 11px; width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%;">
                                                    {{ $loop->iteration }}
                                                </span>
                                                <span class="fw-semibold text-dark text-truncate milestone-title-text"
                                                    style="font-size: 13.5px;">
                                                    {{ $milestone->title }}
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center gap-1 flex-shrink-0">
                                                <button type="button" class="btn btn-sm btn-outline-primary btn-view-milestone"
                                                    title="View Milestone Details"
                                                    style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                    <i class="ri-eye-line" style="font-size: 15px;"></i>
                                                </button>
                                                @can('project-edit')
                                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-milestone"
                                                        title="Edit Milestone"
                                                        style="width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px;">
                                                        <i class="ri-edit-line" style="font-size: 15px;"></i>
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-3 text-center rounded border"
                                    style="background-color: #f8fafc; border-color: #e2e8f0;">
                                    <i class="ri-flag-line text-muted" style="font-size: 24px;"></i>
                                    <p class="text-muted mb-0 mt-1" style="font-size: 13px;">No execution milestones added for
                                        this project yet.</p>
                                    @can('project-edit')
                                        <a href="{{ route('projects.edit', $project->id) }}#milestones-section"
                                            class="btn btn-sm btn-outline-primary mt-2" style="font-size: 12px;">
                                            <i class="ri-add-line me-1"></i> Add Milestones
                                        </a>
                                    @endcan
                                </div>
                            @endif
                        </div>

                        {{-- Project Gallery --}}
                        @if($project->getMedia('gallery')->isNotEmpty())
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-2"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                    Photo Gallery ({{ $project->getMedia('gallery')->count() }} Photos)
                                </h6>
                                <div class="row g-2">
                                    @foreach($project->getMedia('gallery') as $media)
                                        @php
                                            $mediaUrl = $media->getUrl();
                                            if (\Illuminate\Support\Str::startsWith($mediaUrl, ['http://', 'https://'])) {
                                                $mediaUrl = parse_url($mediaUrl, PHP_URL_PATH) ?: $mediaUrl;
                                            }
                                        @endphp
                                        <div class="col-6 col-sm-4 col-md-3">
                                            <a href="{{ $mediaUrl }}" target="_blank" class="d-block gallery-thumb-item"
                                                title="{{ $media->file_name }}">
                                                <img src="{{ $mediaUrl }}" alt="{{ $media->name }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('admin/assets/images/default.jpg') }}';">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Technical Documents --}}
                        @if($project->getMedia('documents')->isNotEmpty())
                            <div class="mb-2">
                                <h6 class="fw-bold text-dark mb-2"
                                    style="font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                                    Engineering &amp; Technical Documents
                                </h6>
                                <ul class="list-group list-group-flush border rounded overflow-hidden">
                                    @foreach($project->getMedia('documents') as $doc)
                                        @php
                                            $docUrl = $doc->getUrl();
                                            if (\Illuminate\Support\Str::startsWith($docUrl, ['http://', 'https://'])) {
                                                $docUrl = parse_url($docUrl, PHP_URL_PATH) ?: $docUrl;
                                            }
                                        @endphp
                                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3"
                                            style="font-size: 13px; background: #f8fafc;">
                                            <div class="d-flex align-items-center text-truncate me-2">
                                                <i class="ri-file-pdf-line text-danger me-2" style="font-size: 20px;"></i>
                                                <span class="fw-semibold text-dark text-truncate">{{ $doc->file_name }}</span>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-light text-dark border">{{ $doc->readable_size }}</span>
                                                <a href="{{ $docUrl }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary py-0 px-2"
                                                    style="font-size: 12px; height: 26px; line-height: 24px;">
                                                    <i class="ri-download-2-line me-1"></i> View
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- SEO Information Card --}}
                <div class="card table-card mb-4">
                    <div class="card-header table-header">
                        <div class="table-title">SEO &amp; Search Engine Visibility</div>
                    </div>
                    <div class="card-body custom-form p-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="project-meta-box">
                                    <div class="project-meta-label">Meta Title</div>
                                    <div class="project-meta-value">{{ $project->meta_title ?: '—' }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="project-meta-box">
                                    <div class="project-meta-label">Meta Description</div>
                                    <div class="project-meta-value text-muted" style="font-weight: 400;">
                                        {{ $project->meta_description ?: '—' }}
                                    </div>
                                </div>
                            </div>
                            @if($project->hasMedia('meta_image'))
                                <div class="col-12">
                                    <div class="project-meta-box">
                                        <div class="project-meta-label">SEO Social Share Image</div>
                                        <div class="mt-2">
                                            <img src="{{ $project->meta_image_url }}" alt="SEO Image" class="img-fluid rounded border" style="max-height: 160px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar Parameters Column --}}
            <div class="col-lg-4 col-12">
                <div class="row g-3">
                    {{-- Status & Visibility Parameters --}}
                    <div class="col-12">
                        <div class="card table-card">
                            <div class="card-header table-header">
                                <div class="table-title">Project Specifications</div>
                            </div>
                            <div class="card-body custom-form">
                                <div class="d-flex flex-column gap-3">
                                    <div class="project-meta-box">
                                        <div class="project-meta-label">Sector / Category</div>
                                        <div class="project-meta-value">{{ $project->category }}</div>
                                    </div>

                                    <div class="project-meta-box">
                                        <div class="project-meta-label">Client / Stakeholder</div>
                                        <div class="project-meta-value">
                                            {{ $project->client_name ?: 'Confidential / Direct' }}
                                        </div>
                                    </div>

                                    <div class="project-meta-box">
                                        <div class="project-meta-label">Site Location</div>
                                        <div class="project-meta-value">
                                            @if($project->location)
                                                <i class="ri-map-pin-line text-danger me-1"></i> {{ $project->location }}
                                            @else
                                                <span class="text-muted">Not specified</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="project-meta-box">
                                                <div class="project-meta-label">Commenced</div>
                                                <div class="project-meta-value" style="font-size: 12.5px;">
                                                    {{ $project->start_date ? $project->start_date->format('M d, Y') : '—' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="project-meta-box">
                                                <div class="project-meta-label">Completion</div>
                                                <div class="project-meta-value" style="font-size: 12.5px;">
                                                    {{ $project->completion_date ? $project->completion_date->format('M d, Y') : '—' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="project-meta-box">
                                        <div class="project-meta-label">Slug Identifier</div>
                                        <div class="project-meta-value font-monospace" style="font-size: 12px;">
                                            {{ $project->slug }}
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                        <span class="fw-semibold text-dark" style="font-size: 13px;">Website
                                            Visibility:</span>
                                        <span class="badge {{ $project->is_published ? 'bg-success' : 'bg-secondary' }}"
                                            style="font-size: 11px;">
                                            {{ $project->is_published ? 'Published' : 'Draft' }}
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-2 rounded"
                                        style="background: #f8fafc; border: 1px solid #e2e8f0;">
                                        <span class="fw-semibold text-dark" style="font-size: 13px;">Homepage
                                            Featured:</span>
                                        <span
                                            class="badge {{ $project->featured ? 'bg-warning text-dark' : 'bg-light text-muted border' }}"
                                            style="font-size: 11px;">
                                            {{ $project->featured ? 'Featured' : 'Standard' }}
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
                                    @can('project-edit')
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                            class="btn submit-button w-100 d-flex align-items-center justify-content-center gap-1">
                                            <i class="ri-edit-line"></i> Edit Project
                                        </a>
                                    @endcan
                                    @can('project-delete')
                                        <button type="button" class="btn btn-outline-danger w-100 btn-delete-modal"
                                            data-title="{{ $project->title }}"
                                            data-url="{{ route('projects.destroy', $project->id) }}"
                                            style="height: 32px; font-size: 13px; font-weight: 600;">
                                            <i class="ri-delete-bin-line me-1"></i> Delete Project
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

    {{-- View Milestone Modal --}}
    <div class="modal fade" id="viewMilestoneModal" tabindex="-1" aria-labelledby="viewMilestoneModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header"
                    style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 14px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-flag-line text-primary" style="font-size: 20px;"></i>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="viewMilestoneModalTitle"
                            style="font-size: 15px;">Milestone Phase Details</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                        <h5 class="fw-bold text-dark mb-0" id="modalViewTitle" style="font-size: 16px; line-height: 1.4;">
                        </h5>
                        <span id="modalViewStatusBadge" class="badge flex-shrink-0"
                            style="font-size: 11.5px; padding: 4px 8px; border-radius: 4px; font-weight: 600;"></span>
                    </div>

                    {{-- Image Preview Container --}}
                    <div id="modalViewImageWrap" class="mb-3 rounded overflow-hidden border"
                        style="display: none; max-height: 220px; background-color: #f1f5f9;">
                        <img id="modalViewImage" src="" alt="Milestone Image" class="w-100 h-100 object-fit-cover"
                            style="max-height: 220px;">
                    </div>

                    {{-- Progress Bar --}}
                    <div class="mb-3 p-2 rounded" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex justify-content-between align-items-center mb-1" style="font-size: 12px;">
                            <span class="text-muted fw-semibold">Phase Progress</span>
                            <span class="fw-bold text-dark" id="modalViewProgressText">0%</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div id="modalViewProgressBar" class="progress-bar bg-success" role="progressbar"
                                style="width: 0%;"></div>
                        </div>
                    </div>

                    {{-- Timeline Dates --}}
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-2 rounded border"
                                style="background-color: #f8fafc; border-color: #e2e8f0; font-size: 12px;">
                                <div class="text-muted" style="font-size: 11px;">Target Date</div>
                                <div class="fw-bold text-dark" id="modalViewTargetDate">—</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 rounded border"
                                style="background-color: #f8fafc; border-color: #e2e8f0; font-size: 12px;">
                                <div class="text-muted" style="font-size: 11px;">Handover Date</div>
                                <div class="fw-bold text-dark" id="modalViewCompletionDate">—</div>
                            </div>
                        </div>
                    </div>

                    {{-- Description / Scope --}}
                    <div>
                        <div class="fw-semibold text-dark mb-1"
                            style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">
                            Scope &amp; Deliverables
                        </div>
                        <div id="modalViewDescription" class="p-2 rounded border text-muted"
                            style="font-size: 13px; line-height: 1.6; background-color: #ffffff; min-height: 60px;">
                            —
                        </div>
                    </div>
                </div>
                <div class="modal-footer"
                    style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 10px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 12.5px;">Close</button>
                    @can('project-edit')
                        <button type="button" class="btn btn-sm submit-button px-3" id="btnSwitchToEdit"
                            style="font-size: 12.5px;">
                            <i class="ri-edit-line me-1"></i> Edit Milestone
                        </button>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Milestone Modal --}}
    <div class="modal fade" id="editMilestoneModal" tabindex="-1" aria-labelledby="editMilestoneModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header"
                    style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 14px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-edit-2-line text-primary" style="font-size: 20px;"></i>
                        <h5 class="modal-title fw-bold text-dark mb-0" id="editMilestoneModalTitle"
                            style="font-size: 15px;">Edit Milestone Phase</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editMilestoneModalForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" id="editModalMilestoneId">
                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                    <div class="modal-body custom-form" style="padding: 20px;">
                        <div class="row g-2">
                            <div class="col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Phase /
                                    Milestone Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="editModalTitle" class="form-control form-control-sm"
                                    required>
                            </div>
                            <div class="col-sm-6 col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Status</label>
                                <select name="status" id="editModalStatus" class="form-select form-select-sm">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="delayed">Delayed</option>
                                    <option value="on_hold">On Hold</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Progress
                                    (%)</label>
                                <input type="number" min="0" max="100" name="progress_percentage" id="editModalProgress"
                                    class="form-control form-control-sm" placeholder="0 - 100">
                            </div>
                            <div class="col-sm-6 col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Target
                                    Date</label>
                                <input type="date" name="target_date" id="editModalTargetDate"
                                    class="form-control form-control-sm" onclick="this.showPicker()">
                            </div>
                            <div class="col-sm-6 col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Handover
                                    Date</label>
                                <input type="date" name="completion_date" id="editModalCompletionDate"
                                    class="form-control form-control-sm" onclick="this.showPicker()">
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Site Photo /
                                    Milestone Image</label>
                                <div id="editModalImagePreviewWrap" class="mb-1" style="display: none;">
                                    <div class="d-flex align-items-center gap-2 p-1 px-2 border rounded bg-light">
                                        <img id="editModalImagePreview" src="" alt="Current image" class="rounded border"
                                            style="width: 36px; height: 36px; object-fit: cover;">
                                        <span class="text-muted" style="font-size: 11px;">Current Photo attached (upload
                                            below to replace)</span>
                                    </div>
                                </div>
                                <input type="file" name="image" id="editModalImageInput"
                                    class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp,image/jpg">
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Scope / Key
                                    Deliverables</label>
                                <textarea name="description" id="editModalDescription" class="form-control form-control-sm"
                                    rows="3" placeholder="Brief details about this construction phase..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"
                        style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 10px 20px;">
                        <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal"
                            style="font-size: 12.5px;">Cancel</button>
                        <button type="submit" class="btn btn-sm submit-button px-4" id="btnSaveMilestoneModal"
                            style="font-size: 12.5px; font-weight: 600;">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="border-radius: 10px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(11, 15, 23, 0.1);">
                <div class="modal-header"
                    style="background-color: #fee2e2; border-bottom: 1px solid #fca5a5; padding: 16px 20px;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-error-warning-line text-danger" style="font-size: 22px;"></i>
                        <h5 class="modal-title fw-bold text-danger mb-0" id="deleteModalTitle" style="font-size: 16px;">
                            Confirm Project Deletion</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p class="mb-2" style="font-size: 14px; color: #334155;">
                        Are you sure you want to permanently delete project <strong id="deleteProjectTitle"
                            class="text-dark"></strong>?
                    </p>
                    <p class="text-muted mb-0" style="font-size: 12.5px;">
                        This action will remove all gallery media, specs, and documents associated with this project.
                    </p>
                </div>
                <div class="modal-footer"
                    style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 12px 20px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary px-3" data-bs-dismiss="modal"
                        style="font-size: 13px; height: 36px; border-radius: 6px;">Cancel</button>
                    <form id="deleteProjectForm" method="POST" action="">
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
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Delete project confirmation
            $(document).on('click', '.btn-delete-modal', function () {
                var title = $(this).data('title');
                var url = $(this).data('url');

                $('#deleteProjectTitle').text(title);
                $('#deleteProjectForm').attr('action', url);
                $('#deleteProjectModal').modal('show');
            });

            var activeMilestoneData = null;

            // Helper to get milestone data from row
            function getMilestoneRowData(btn) {
                var row = $(btn).closest('.milestone-row-item');
                var data = row.attr('data-milestone');
                if (typeof data === 'string') {
                    try {
                        return JSON.parse(data);
                    } catch (e) {
                        return row.data('milestone');
                    }
                }
                return row.data('milestone');
            }

            // Helper to set milestone data back to row
            function setMilestoneRowData(id, data) {
                var row = $('#milestone-row-' + id);
                row.attr('data-milestone', JSON.stringify(data));
                row.find('.milestone-title-text').text(data.title);
            }

            // 1. View Milestone Modal
            $(document).on('click', '.btn-view-milestone', function () {
                var m = getMilestoneRowData(this);
                if (!m) return;
                activeMilestoneData = m;

                $('#modalViewTitle').text(m.title);

                var badge = $('#modalViewStatusBadge');
                badge.text(m.status_label || m.status);
                if (m.badge_style) {
                    badge.attr('style', m.badge_style + ' font-size: 11.5px; padding: 4px 8px; border-radius: 4px; font-weight: 600;');
                }

                var progress = parseInt(m.progress_percentage) || 0;
                $('#modalViewProgressText').text(progress + '%');
                $('#modalViewProgressBar').css('width', progress + '%');

                $('#modalViewTargetDate').text(m.target_date_formatted || '—');
                $('#modalViewCompletionDate').text(m.completion_date_formatted || '—');
                $('#modalViewDescription').html(m.description || '<span class="text-muted">No detailed scope provided.</span>');

                if (m.image_url) {
                    $('#modalViewImage').attr('src', m.image_url);
                    $('#modalViewImageWrap').show();
                } else {
                    $('#modalViewImageWrap').hide();
                }

                $('#viewMilestoneModal').modal('show');
            });

            // Switch from View Modal to Edit Modal
            $('#btnSwitchToEdit').on('click', function () {
                $('#viewMilestoneModal').modal('hide');
                if (activeMilestoneData) {
                    openEditMilestoneModal(activeMilestoneData);
                }
            });

            // 2. Open Edit Milestone Modal
            $(document).on('click', '.btn-edit-milestone', function () {
                var m = getMilestoneRowData(this);
                if (!m) return;
                openEditMilestoneModal(m);
            });

            function openEditMilestoneModal(m) {
                activeMilestoneData = m;

                $('#editModalMilestoneId').val(m.id);
                $('#editModalTitle').val(m.title);
                $('#editModalStatus').val(m.status);
                $('#editModalProgress').val(m.progress_percentage !== undefined ? m.progress_percentage : 0);
                $('#editModalTargetDate').val(m.target_date || '');
                $('#editModalCompletionDate').val(m.completion_date || '');
                $('#editModalDescription').val(m.description || '');
                $('#editModalImageInput').val('');

                if (typeof CKEDITOR !== 'undefined') {
                    if (CKEDITOR.instances['editModalDescription']) {
                        CKEDITOR.instances['editModalDescription'].setData(m.description || '');
                    } else if (document.getElementById('editModalDescription')) {
                        CKEDITOR.replace('editModalDescription', {
                            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                            filebrowserUploadMethod: 'form',
                            height: 180
                        });
                        CKEDITOR.instances['editModalDescription'].on('instanceReady', function () {
                            this.setData(m.description || '');
                        });
                    }
                }

                if (m.image_url) {
                    $('#editModalImagePreview').attr('src', m.image_url);
                    $('#editModalImagePreviewWrap').show();
                } else {
                    $('#editModalImagePreviewWrap').hide();
                }

                $('#editMilestoneModalForm').data('update-url', m.update_url);
                $('#editMilestoneModal').modal('show');
            }

            // 3. Save Milestone via AJAX
            $('#editMilestoneModalForm').on('submit', function (e) {
                e.preventDefault();
                var form = this;

                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['editModalDescription']) {
                    CKEDITOR.instances['editModalDescription'].updateElement();
                }

                var updateUrl = $(form).data('update-url') || ('/dashboard/milestones/' + $('#editModalMilestoneId').val());
                var submitBtn = $('#btnSaveMilestoneModal');

                var formData = new FormData(form);

                submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');

                $.ajax({
                    url: updateUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val()
                    },
                    success: function (res) {
                        submitBtn.prop('disabled', false).html('Save Changes');
                        $('#editMilestoneModal').modal('hide');

                        if (typeof toastr !== 'undefined') {
                            toastr.success(res.message || 'Milestone updated successfully');
                        }

                        // Update in-memory data and DOM
                        if (res.data) {
                            var updated = res.data;
                            var id = updated.id;
                            var existingData = activeMilestoneData || {};

                            var mStatusValue = updated.status;
                            var mStatusLabel = (mStatusValue.charAt(0).toUpperCase() + mStatusValue.slice(1)).replace('_', ' ');

                            var badgeStyle = 'background-color: #f8fafc; color: #475569; border: 1px solid #e2e8f0;';
                            if (mStatusValue === 'completed') badgeStyle = 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;';
                            else if (mStatusValue === 'in_progress') badgeStyle = 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;';
                            else if (mStatusValue === 'delayed') badgeStyle = 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;';
                            else if (mStatusValue === 'on_hold') badgeStyle = 'background-color: #fffbeb; color: #92400e; border: 1px solid #fde68a;';

                            var newPayload = {
                                id: id,
                                project_id: updated.project_id,
                                title: updated.title,
                                status: mStatusValue,
                                status_label: mStatusLabel,
                                badge_style: badgeStyle,
                                progress_percentage: parseInt(updated.progress_percentage) || 0,
                                target_date: updated.target_date ? updated.target_date.substring(0, 10) : '',
                                target_date_formatted: updated.target_date ? updated.target_date.substring(0, 10) : '—',
                                completion_date: updated.completion_date ? updated.completion_date.substring(0, 10) : '',
                                completion_date_formatted: updated.completion_date ? updated.completion_date.substring(0, 10) : '—',
                                description: updated.description || '',
                                image_url: updated.image_url || existingData.image_url || '',
                                update_url: updateUrl
                            };

                            setMilestoneRowData(id, newPayload);
                        }
                    },
                    error: function (xhr) {
                        submitBtn.prop('disabled', false).html('Save Changes');
                        var msg = 'Failed to update milestone.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        if (typeof toastr !== 'undefined') {
                            toastr.error(msg);
                        } else {
                            alert(msg);
                        }
                    }
                });
            });
        });
    </script>
@endpush