@extends('admin.app')
@section('title')
    Create Project
@endsection

@push('custom-style')
    <style>
        /* Interactive Uploader Styles */
        .dropzone-box {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            background-color: #f8fafc;
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .dropzone-box:hover,
        .dropzone-box.dragover {
            border-color: #f95716;
            background-color: #fff7ed;
            transform: translateY(-1px);
        }

        .dropzone-box.dragover {
            box-shadow: 0 0 0 4px rgba(249, 87, 22, 0.15);
        }

        .dropzone-icon {
            width: 52px;
            height: 52px;
            line-height: 52px;
            border-radius: 50%;
            background-color: rgba(249, 87, 22, 0.1);
            color: #f95716;
            font-size: 26px;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .dropzone-box:hover .dropzone-icon {
            transform: scale(1.08);
        }

        .preview-card {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.04);
            position: relative;
            transition: all 0.2s ease;
        }

        .preview-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .preview-thumb {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
            background-color: #f1f5f9;
        }

        .preview-info {
            padding: 8px 10px;
            background: #ffffff;
        }

        .preview-filename {
            font-size: 11.5px;
            font-weight: 600;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .preview-filesize {
            font-size: 10.5px;
            color: #64748b;
        }

        .preview-remove-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.9);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
            z-index: 5;
        }

        .preview-remove-btn:hover {
            background: #dc2626;
            transform: scale(1.15);
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        <form id="projectCreateForm" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="row">
                {{-- Main Project Details --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">New Project Details</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('projects.index') }}" class="add-new">
                                <i class="ri-list-check me-1"></i> Project List
                            </a>
                        </div>
                        <div class="card-body custom-form">
                            <div class="row g-3">
                                {{-- Project Title --}}
                                <div class="col-md-8 col-12">
                                    <label for="title" class="form-label custom-label">Project Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control custom-input @error('title') is-invalid @enderror" name="title"
                                        id="title" value="{{ old('title') }}" placeholder="e.g. Apex Corporate Tower"
                                        required>
                                    @error('title')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="col-md-4 col-12">
                                    <label for="slug" class="form-label custom-label">Slug (URL Identifier)</label>
                                    <input type="text" class="form-control custom-input @error('slug') is-invalid @enderror"
                                        name="slug" id="slug" value="{{ old('slug') }}"
                                        placeholder="auto-generated-if-blank">
                                    <div class="text-muted mt-1" style="font-size: 11px;">Leave empty to generate
                                        automatically from title</div>
                                    @error('slug')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Category & Status --}}
                                <div class="col-md-6 col-12">
                                    <label for="category" class="form-label custom-label">Category / Sector <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('category') is-invalid @enderror"
                                        name="category" id="category" required>
                                        <option value="">Select Category...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="status" class="form-label custom-label">Project Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('status') is-invalid @enderror"
                                        name="status" id="status" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->value }}" {{ old('status', 'ongoing') == $status->value ? 'selected' : '' }}>
                                                {{ $status->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Client & Site Location --}}
                                <div class="col-md-6 col-12">
                                    <label for="client_name" class="form-label custom-label">Client / Stakeholder</label>
                                    <input type="text"
                                        class="form-control custom-input @error('client_name') is-invalid @enderror"
                                        name="client_name" id="client_name" value="{{ old('client_name') }}"
                                        placeholder="e.g. Apex Holdings Group">
                                    @error('client_name')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="location" class="form-label custom-label">Site Location</label>
                                    <input type="text"
                                        class="form-control custom-input @error('location') is-invalid @enderror"
                                        name="location" id="location" value="{{ old('location') }}"
                                        placeholder="e.g. Gulshan Avenue, Dhaka">
                                    @error('location')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Timeline Dates --}}
                                <div class="col-md-6 col-12">
                                    <label for="start_date" class="form-label custom-label">Commencement Date</label>
                                    <input type="date"
                                        class="form-control custom-input @error('start_date') is-invalid @enderror"
                                        name="start_date" id="start_date" value="{{ old('start_date') }}" onclick="this.showPicker()">
                                    @error('start_date')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="completion_date" class="form-label custom-label">Completion / Delivery
                                        Date</label>
                                    <input type="date"
                                        class="form-control custom-input @error('completion_date') is-invalid @enderror"
                                        name="completion_date" id="completion_date" value="{{ old('completion_date') }}" onclick="this.showPicker()">
                                    @error('completion_date')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Short Description --}}
                                <div class="col-12">
                                    <label for="short_description" class="form-label custom-label">Executive Summary /
                                        Brief</label>
                                    <textarea
                                        class="form-control custom-input @error('short_description') is-invalid @enderror"
                                        name="short_description" id="short_description" rows="3"
                                        placeholder="Concise 1-2 sentence overview for cards and portfolio highlights..."
                                        style="resize: none;">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Description with CKEditor --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Detailed Case Study &amp; Scope
                                        of Work</label>
                                    <textarea class="form-control custom-input" name="description" id="description"
                                        rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Project Milestones & Timeline --}}
                    <div class="card table-card mb-4" id="milestones-section">
                        <div class="card-header table-header d-flex justify-content-between align-items-center">
                            <div>
                                <div class="table-title">Project Execution Milestones &amp; Delivery Phases</div>
                                <div class="text-muted" style="font-size: 11.5px;">Add structural phases, target handover
                                    dates, and progress tracking.</div>
                            </div>
                            <button type="button" class="btn btn-sm add-new" id="btnAddMilestone"
                                style="padding: 6px 12px; font-size: 12px;">
                                <i class="ri-add-circle-line me-1"></i> Add Phase
                            </button>
                        </div>
                        <div class="card-body custom-form p-3">
                            <div id="milestonesContainer" class="d-flex flex-column gap-3">
                                {{-- Dynamic milestone rows --}}
                            </div>
                            <div id="noMilestonesNotice" class="text-center py-4 rounded border border-dashed"
                                style="background: #f8fafc; border-color: #cbd5e1;">
                                <i class="ri-flag-line text-muted" style="font-size: 28px;"></i>
                                <p class="text-muted mb-2 mt-1" style="font-size: 13px;">No execution milestones added yet.
                                </p>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="btnFirstMilestone"
                                    style="font-size: 12px;">
                                    <i class="ri-add-line me-1"></i> Add First Milestone Phase
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Search Engine Optimization (SEO) --}}
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">SEO &amp; Discoverability</div>
                        </div>
                        <div class="card-body custom-form">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="meta_title" class="form-label custom-label">Meta Title</label>
                                    <input type="text"
                                        class="form-control custom-input @error('meta_title') is-invalid @enderror"
                                        name="meta_title" id="meta_title" value="{{ old('meta_title') }}"
                                        placeholder="Title for Google search engine results...">
                                    @error('meta_title')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="meta_description" class="form-label custom-label">Meta Description</label>
                                    <textarea
                                        class="form-control custom-input @error('meta_description') is-invalid @enderror"
                                        name="meta_description" id="meta_description" rows="2"
                                        placeholder="Summary snippet for search results (recommended under 160 characters)..."
                                        style="resize: none;">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label custom-label">SEO Meta Image (Open Graph / Social Sharing)</label>
                                    @include('admin.includes.image-uploader', [
                                        'name' => 'meta_image',
                                        'id' => 'project_meta_image',
                                        'label' => 'Upload Meta Image',
                                        'modalTitle' => 'Upload Project SEO Meta Image',
                                        'helpText' => 'JPG, PNG, WebP up to 5MB (1200×630px recommended)',
                                        'shape' => 'rectangle',
                                        'height' => '140px'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Media & Actions --}}
                <div class="col-lg-4 col-12">
                    <div class="row g-3">
                        {{-- Save / Publish Actions --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Publish Actions</div>
                                </div>
                                <div class="card-body custom-form">
                                    <div class="d-flex flex-column gap-3 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_published"
                                                id="is_published" value="1" {{ old('is_published', 1) ? 'checked' : '' }}
                                                style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold" for="is_published"
                                                style="font-size: 13.5px; cursor: pointer;">
                                                Visible on Website
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="featured" id="featured"
                                                value="1" {{ old('featured') ? 'checked' : '' }} style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold" for="featured"
                                                style="font-size: 13.5px; cursor: pointer;">
                                                Feature on Homepage
                                            </label>
                                        </div>
                                        <div>
                                            <label for="sort_order" class="form-label custom-label mb-1">Display Priority
                                                Order</label>
                                            <input type="number" class="form-control custom-input" name="sort_order"
                                                id="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                            <div class="text-muted" style="font-size: 11px;">Lower numbers appear first
                                                (e.g. 0, 1, 2)</div>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100">
                                                <i class="ri-check-line me-1"></i> Save Project
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('projects.index') }}" class="btn leave-button w-100">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Main Cover Image --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Main Cover Image</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @include('admin.includes.image-uploader', [
                                        'name' => 'main_image',
                                        'label' => 'Upload Cover Image',
                                        'modalTitle' => 'Upload Project Cover Image',
                                        'shape' => 'rectangle',
                                        'height' => '170px'
                                    ])
                                </div>
                            </div>
                        </div>

                        {{-- Multi-File Gallery Uploader --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Project Gallery Photos</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @include('admin.includes.multi-image-uploader', [
                                        'name'       => 'gallery[]',
                                        'instanceId' => 'prj_create_gallery',
                                        'label'      => 'Upload Gallery Photos',
                                        'modalTitle' => 'Upload Project Gallery Photos',
                                        'helpText'   => 'PNG, JPG, WebP up to 5MB each — select multiple',
                                    ])
                                </div>
                            </div>
                        </div>

                        {{-- Technical Documents --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Engineering Documents</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @include('admin.includes.multi-image-uploader', [
                                        'name'        => 'documents[]',
                                        'label'       => 'Upload Documents',
                                        'modalTitle'  => 'Upload Engineering Documents',
                                        'helpText'    => 'PDF, DOC, DOCX, XLS, TXT up to 10MB each',
                                        'accept'      => '.pdf,.doc,.docx,.xls,.xlsx,.txt',
                                        'fileType'    => 'document',
                                        'maxSizeMb'   => 10,
                                        'icon'        => 'ri-file-upload-line',
                                        'applyBtnText'=> 'Apply Documents'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('custom-script')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Auto-slug generator on title input
            var slugManuallyChanged = false;
            $('#slug').on('input', function () {
                slugManuallyChanged = $(this).val().trim().length > 0;
            });

            $('#title').on('input', function () {
                if (!slugManuallyChanged) {
                    var titleVal = $(this).val();
                    var slug = titleVal.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .trim()
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    $('#slug').val(slug);
                }
            });

            // Initialize CKEditor
            if (typeof CKEDITOR !== 'undefined' && document.getElementById('description')) {
                CKEDITOR.replace('description', {
                    filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    height: 300
                });
            }

            // ==========================================
            // 3. DYNAMIC MILESTONES REPEATER
            // ==========================================
            var milestoneIndex = 0;

            function addMilestoneRow(data = {}) {
                $('#noMilestonesNotice').hide();
                var index = milestoneIndex++;
                var title = data.title || '';
                var targetDate = data.target_date || '';
                var completionDate = data.completion_date || '';
                var status = data.status || 'pending';
                var progress = data.progress_percentage !== undefined ? data.progress_percentage : 0;
                var description = data.description || '';

                var rowHtml = `
                        <div class="milestone-card p-3 rounded border bg-white position-relative" data-index="${index}" style="border-color: #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <span class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size: 13px;">
                                    <span class="badge bg-light text-dark border milestone-num" style="width: 24px; height: 24px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 11px;">1</span>
                                    Phase Details
                                </span>
                                <button type="button" class="btn btn-sm text-danger p-0 btn-remove-milestone" title="Remove Phase" style="font-size: 14px; line-height: 1;">
                                    <i class="ri-delete-bin-line"></i> Remove
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6 col-12">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Phase / Milestone Title <span class="text-danger">*</span></label>
                                    <input type="text" name="milestones[${index}][title]" class="form-control form-control-sm" placeholder="e.g. Substructure & Deep Foundation" value="${title}" required>
                                </div>
                                <div class="col-md-3 col-sm-6 col-6">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Status</label>
                                    <select name="milestones[${index}][status]" class="form-select form-select-sm">
                                        <option value="pending" ${status === 'pending' ? 'selected' : ''}>Pending</option>
                                        <option value="in_progress" ${status === 'in_progress' ? 'selected' : ''}>In Progress</option>
                                        <option value="completed" ${status === 'completed' ? 'selected' : ''}>Completed</option>
                                        <option value="delayed" ${status === 'delayed' ? 'selected' : ''}>Delayed</option>
                                        <option value="on_hold" ${status === 'on_hold' ? 'selected' : ''}>On Hold</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-sm-6 col-6">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Progress (%)</label>
                                    <input type="number" min="0" max="100" name="milestones[${index}][progress_percentage]" class="form-control form-control-sm" placeholder="0 - 100" value="${progress}">
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Target Date</label>
                                    <input type="date" name="milestones[${index}][target_date]" class="form-control form-control-sm" value="${targetDate}" onclick="this.showPicker()">
                                </div>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Handover Date</label>
                                    <input type="date" name="milestones[${index}][completion_date]" class="form-control form-control-sm" value="${completionDate}" onclick="this.showPicker()">
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Site Photo / Milestone Image</label>
                                    <input type="file" name="milestones[${index}][image]" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp,image/jpg">
                                </div>
                                <div class="col-12">
                                    <label class="form-label mb-1" style="font-size: 11.5px; font-weight: 600;">Scope / Key Deliverables</label>
                                    <textarea name="milestones[${index}][description]" id="milestone_desc_${index}" class="form-control form-control-sm" rows="3" placeholder="Brief details about this construction phase...">${description}</textarea>
                                </div>
                            </div>
                        </div>
                    `;

                $('#milestonesContainer').append(rowHtml);
                updateMilestoneNumbers();

                // Initialize CKEditor on newly created milestone description
                if (typeof CKEDITOR !== 'undefined' && document.getElementById(`milestone_desc_${index}`)) {
                    CKEDITOR.replace(`milestone_desc_${index}`, {
                        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                        filebrowserUploadMethod: 'form',
                        height: 180
                    });
                }
            }

            function updateMilestoneNumbers() {
                var count = 0;
                $('.milestone-card').each(function (i) {
                    $(this).find('.milestone-num').text(i + 1);
                    count++;
                });
                if (count === 0) {
                    $('#noMilestonesNotice').show();
                } else {
                    $('#noMilestonesNotice').hide();
                }
            }

            $('#btnAddMilestone, #btnFirstMilestone').on('click', function () {
                addMilestoneRow();
            });

            $(document).on('click', '.btn-remove-milestone', function () {
                var $card = $(this).closest('.milestone-card');
                var idx = $card.data('index');
                var editorId = 'milestone_desc_' + idx;

                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances[editorId]) {
                    CKEDITOR.instances[editorId].destroy();
                }

                $card.remove();
                updateMilestoneNumbers();
            });

            // Ensure all CKEditor instances sync data before form submission
            $('form').on('submit', function () {
                if (typeof CKEDITOR !== 'undefined') {
                    for (var instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                }
            });
        });
    </script>
@endpush