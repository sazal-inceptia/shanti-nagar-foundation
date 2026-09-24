@extends('admin.app')
@section('title')
    Create Service
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

        .icon-preview-box {
            width: 42px;
            height: 42px;
            border-radius: 6px;
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #f95716;
            transition: all 0.2s ease;
        }

        .icon-suggestion-pill {
            cursor: pointer;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 4px;
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .icon-suggestion-pill:hover {
            background: #fff3ee;
            border-color: #f95716;
            color: #f95716;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        <form id="serviceCreateForm" action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data"
            autocomplete="off">
            @csrf
            <div class="row">
                {{-- Main Service Details --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">New Service Details</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('services.index') }}" class="add-new">
                                <i class="ri-list-check me-1"></i> Services List
                            </a>
                        </div>
                        <div class="card-body custom-form">
                            <div class="row g-3">
                                {{-- Service Title --}}
                                <div class="col-md-7 col-12">
                                    <label for="title" class="form-label custom-label">Service Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control custom-input @error('title') is-invalid @enderror" name="title"
                                        id="title" value="{{ old('title') }}"
                                        placeholder="e.g. Architectural Design &amp; Master Planning" required>
                                    @error('title')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Slug with Auto-Generator --}}
                                <div class="col-md-5 col-12">
                                    <label for="slug" class="form-label custom-label">URL Slug</label>
                                    <input type="text" class="form-control custom-input @error('slug') is-invalid @enderror"
                                        name="slug" id="slug" value="{{ old('slug') }}"
                                        placeholder="auto-generated-from-title">
                                    <small class="text-muted" style="font-size: 11px;">Leave blank to auto-generate unique
                                        slug</small>
                                    @error('slug')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Icon Class with Live Preview --}}
                                <div class="col-12">
                                    <label for="icon" class="form-label custom-label">Icon Class (RemixIcon or
                                        FontAwesome)</label>
                                    <div class="input-group align-items-start">
                                        <div class="input-group-text p-0 bg-transparent border-0 me-2">
                                            <div class="icon-preview-box" id="icon_preview_container">
                                                <i class="ri-hammer-line" id="icon_preview_element"></i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="form-control custom-input @error('icon') is-invalid @enderror"
                                            name="icon" id="icon" value="{{ old('icon', 'ri-hammer-line') }}"
                                            placeholder="e.g. ri-building-2-line, ri-tools-line, fa-solid fa-helmet-safety">
                                    </div>
                                    <div class="d-flex flex-wrap gap-1 mt-2 align-items-center">
                                        <span class="text-muted" style="font-size: 11px;">Quick suggestions:</span>
                                        <span class="icon-suggestion-pill" data-icon="ri-building-2-line"><i
                                                class="ri-building-2-line"></i> Commercial</span>
                                        <span class="icon-suggestion-pill" data-icon="ri-home-4-line"><i
                                                class="ri-home-4-line"></i> Residential</span>
                                        <span class="icon-suggestion-pill" data-icon="ri-tools-line"><i
                                                class="ri-tools-line"></i> Contracting</span>
                                        <span class="icon-suggestion-pill" data-icon="ri-draft-line"><i
                                                class="ri-draft-line"></i> Architectural</span>
                                        <span class="icon-suggestion-pill" data-icon="ri-road-map-line"><i
                                                class="ri-road-map-line"></i> Civil</span>
                                        <span class="icon-suggestion-pill" data-icon="ri-shield-check-line"><i
                                                class="ri-shield-check-line"></i> Quality</span>
                                    </div>
                                    @error('icon')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Short Description --}}
                                <div class="col-12">
                                    <label for="short_description" class="form-label custom-label">Short Summary</label>
                                    <textarea
                                        class="form-control custom-input @error('short_description') is-invalid @enderror"
                                        name="short_description" id="short_description" rows="3"
                                        placeholder="A concise 1-2 sentence overview for cards and summaries">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Description / Features with CKEditor --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Comprehensive Service Details
                                        &amp; Scope</label>
                                    <textarea class="form-control custom-input @error('description') is-invalid @enderror"
                                        name="description" id="description" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="error_msg">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar Controls & Media Uploaders --}}
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
                                                id="is_published" value="1" {{ old('is_published', '1') == '1' ? 'checked' : '' }} style="cursor: pointer;">
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
                                            <input type="number"
                                                class="form-control custom-input @error('sort_order') is-invalid @enderror"
                                                name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                                min="0">
                                            <div class="text-muted" style="font-size: 11px;">Lower numbers appear first
                                                (e.g. 0, 1, 2)</div>
                                            @error('sort_order')
                                                <div class="error_msg">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100">
                                                <i class="ri-check-line me-1"></i> Save Service
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('services.index') }}" class="btn leave-button w-100">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
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
            // 1. Auto-slug generator on title input
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

            // 2. Icon live preview & suggestion pills
            $('#icon').on('input', function () {
                var iconClass = $(this).val().trim() || 'ri-hammer-line';
                $('#icon_preview_element').attr('class', iconClass);
            });

            $('.icon-suggestion-pill').on('click', function () {
                var selectedIcon = $(this).data('icon');
                $('#icon').val(selectedIcon).trigger('input');
            });

            // 3. Initialize CKEditor
            if (typeof CKEDITOR !== 'undefined' && document.getElementById('description')) {
                CKEDITOR.replace('description', {
                    filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                    filebrowserUploadMethod: 'form',
                    height: 300
                });
            }

            function formatBytes(bytes, decimals = 1) {
                if (!+bytes) return '0 Bytes';
                const k = 1024;
                const dm = decimals < 0 ? 0 : decimals;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
            }
        });
    </script>
@endpush