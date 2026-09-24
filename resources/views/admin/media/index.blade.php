@extends('admin.app')
@section('title')
    Media Library
@endsection

@push('custom-style')
    <style>
        .stat-badge-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-badge-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        /* Interactive Uploader Styles */
        .dropzone-box {
            border: 2px dashed #cbd5e1;
            border-radius: 10px;
            background-color: #f8fafc;
            padding: 28px 16px;
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
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background-color: rgba(249, 87, 22, 0.1);
            color: #f95716;
            font-size: 28px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .dropzone-box:hover .dropzone-icon {
            transform: scale(1.08);
        }

        .upload-btn {
            background-color: #f95716;
            border-color: #f95716;
            color: #ffffff;
            font-weight: 600;
            font-size: 13px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .upload-btn:hover {
            background-color: #ea580c;
            border-color: #ea580c;
            color: #ffffff;
            transform: translateY(-1px);
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
            border-color: #cbd5e1;
        }

        .preview-thumb {
            width: 100%;
            height: 110px;
            object-fit: cover;
            display: block;
            background-color: #f1f5f9;
        }

        .preview-doc-box {
            width: 100%;
            height: 110px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
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
        
        .preview-card:hover .media-copy-btn-wrapper {
            opacity: 1 !important;
        }

        /* Custom Pagination Styling to match DataTables */
        .pagination {
            margin-bottom: 0;
            font-size: 13px;
        }
        .page-item.active .page-link {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: #ffffff;
        }
        .page-link {
            color: #475569;
            padding: 6px 12px;
            border-radius: 4px !important;
            margin: 0 2px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
        }
        .page-link:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: #1e293b;
        }
        .page-item.disabled .page-link {
            background-color: #f8fafc;
            color: #94a3b8;
            border-color: #e2e8f0;
        }

        .media-preview-container {
            max-height: 400px;
            background-color: #0f172a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .media-preview-container img {
            max-height: 380px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        .info-pill {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
        }

        .info-pill-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 2px;
        }

        .info-pill-val {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            word-break: break-all;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                {{-- Quick Metrics Row --}}
                <div class="row g-3 mb-3">
                    <div class="col-xl-3 col-sm-6">
                        <div class="stat-badge-card">
                            <div class="stat-badge-icon" style="background-color: #eff6ff; color: #2563eb;">
                                <i class="ri-folder-image-line"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size: 12px; font-weight: 600;">Total Assets</div>
                                <div class="fw-bold text-dark" style="font-size: 18px;" id="statTotalCount">
                                    {{ $totalCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="stat-badge-card">
                            <div class="stat-badge-icon" style="background-color: #ecfdf5; color: #059669;">
                                <i class="ri-image-line"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size: 12px; font-weight: 600;">Images</div>
                                <div class="fw-bold text-dark" style="font-size: 18px;">{{ $imageCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="stat-badge-card">
                            <div class="stat-badge-icon" style="background-color: #fff7ed; color: #ea580c;">
                                <i class="ri-file-text-line"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size: 12px; font-weight: 600;">Documents &amp; PDFs
                                </div>
                                <div class="fw-bold text-dark" style="font-size: 18px;">{{ $docCount }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="stat-badge-card">
                            <div class="stat-badge-icon" style="background-color: #fdf4ff; color: #a855f7;">
                                <i class="ri-hard-drive-2-line"></i>
                            </div>
                            <div>
                                <div class="text-muted" style="font-size: 12px; font-weight: 600;">Storage Used</div>
                                @php
                                    $bytes = $totalSizeBytes;
                                    $units = ['B', 'KB', 'MB', 'GB'];
                                    for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
                                        $bytes /= 1024;
                                    }
                                    $readableStorage = round($bytes, 2) . ' ' . $units[$i];
                                @endphp
                                <div class="fw-bold text-dark" style="font-size: 18px;">{{ $readableStorage }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Media Table Card --}}
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">Media Library</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Media Library</li>
                                </ol>
                            </nav>
                        </div>
                        @can('media-create')
                            <button type="button" class="add-new" id="openUploadModalBtn" data-bs-toggle="modal"
                                data-bs-target="#uploadMediaModal">
                                <i class="ri-upload-cloud-2-line me-1"></i> Upload Media
                            </button>
                        @endcan
                    </div>

                    {{-- Dynamic Filters Bar --}}
                    <form method="GET" action="{{ route('media.index') }}" class="card-body border-bottom" style="background-color: #f8fafc; padding: 14px 20px;">
                        <div class="row g-2 align-items-end">
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Collection</label>
                                <select name="collection" id="filter_collection" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;" onchange="this.form.submit()">
                                    <option value="">All Collections</option>
                                    @foreach($collections as $col)
                                        <option value="{{ $col }}" {{ request('collection') === $col ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $col)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">File
                                    Type</label>
                                <select name="mime_type" id="filter_mime_type" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;" onchange="this.form.submit()">
                                    <option value="">All File Types</option>
                                    <option value="image" {{ request('mime_type') === 'image' ? 'selected' : '' }}>Images (JPEG, PNG, WEBP, SVG)</option>
                                    <option value="document" {{ request('mime_type') === 'document' ? 'selected' : '' }}>Documents &amp; PDFs</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <label class="form-label mb-1 text-muted"
                                    style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Uploaded
                                    By</label>
                                <select name="uploaded_by" id="filter_uploaded_by" class="form-select form-select-sm custom-input"
                                    style="height: 32px; font-size: 13px;" onchange="this.form.submit()">
                                    <option value="">All Uploaders</option>
                                    @foreach($uploaders as $u)
                                        <option value="{{ $u->id }}" {{ request('uploaded_by') == $u->id ? 'selected' : '' }}>{{ $u->name }} ({{ $u->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 d-flex align-items-end">
                                <a href="{{ route('media.index') }}" class="btn btn-sm btn-outline-secondary w-100"
                                    style="height: 32px; font-size: 13px; font-weight: 600; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-refresh-line me-1"></i> Reset Filters
                                </a>
                            </div>
                        </div>
                    </form>

                    {{-- Grid View --}}
                    <div class="card-body" style="padding: 20px;">
                        <div class="row g-3">
                            @forelse($mediaList as $media)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <div class="preview-card h-100 d-flex flex-column" onclick="openMediaPreview({{ $media->id }})" style="cursor: pointer;" title="{{ $media->file_name }}">
                                        @if($media->isImage())
                                            <img src="{{ $media->getUrl() }}" alt="{{ $media->alt_text ?? $media->file_name }}" class="preview-thumb">
                                        @else
                                            <div class="preview-doc-box h-100" style="min-height: 110px;">
                                                <i class="{{ str_contains($media->mime_type, 'pdf') ? 'ri-file-pdf-2-line text-danger' : 'ri-file-text-line text-primary' }}" style="font-size: 38px;"></i>
                                                <span class="text-muted fw-semibold mt-1" style="font-size: 11px;">{{ strtoupper(explode('/', $media->mime_type ?? '')[1] ?? 'DOC') }}</span>
                                            </div>
                                        @endif
                                        <div class="preview-info flex-grow-1 d-flex flex-column justify-content-between">
                                            <div>
                                                <span class="preview-filename">{{ $media->file_name }}</span>
                                                <span class="preview-filesize">{{ $media->readable_size }}</span>
                                            </div>
                                        </div>
                                        
                                        {{-- Hover Overlay for Action Buttons --}}
                                        <div class="position-absolute top-0 end-0 p-1 media-copy-btn-wrapper d-flex gap-1" style="opacity: 0; transition: opacity 0.2s; z-index: 10;">
                                            <a href="{{ route('media.download', $media->id) }}" class="btn btn-sm shadow-sm" onclick="event.stopPropagation();" title="Download" style="background-color: rgba(255, 255, 255, 0.95); width: 28px; height: 28px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; border: 1px solid #e2e8f0; color: #475569;">
                                                <i class="ri-download-2-line" style="font-size: 14px;"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm shadow-sm" onclick="event.stopPropagation(); copyMediaUrl('{{ $media->getUrl() }}')" title="Copy URL" style="background-color: rgba(255, 255, 255, 0.95); width: 28px; height: 28px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; border: 1px solid #e2e8f0;">
                                                <i class="ri-file-copy-line" style="font-size: 14px; color: #475569;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5 text-muted">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background-color: #f1f5f9; color: #94a3b8;">
                                        <i class="ri-folder-image-line" style="font-size: 32px;"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark">No Media Found</h6>
                                    <p style="font-size: 13px;">Upload some files or change your filters to see them here.</p>
                                </div>
                            @endforelse
                        </div>
                        @if($mediaList->hasPages() || $mediaList->total() > 0)
                            <div class="row align-items-center mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
                                <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start mb-3 mb-md-0">
                                    <div class="text-muted" style="font-size: 13px;">
                                        Showing <span class="fw-semibold">{{ $mediaList->firstItem() ?? 0 }}</span> to <span class="fw-semibold">{{ $mediaList->lastItem() ?? 0 }}</span> of <span class="fw-semibold">{{ $mediaList->total() }}</span> entries
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                    <div>
                                        {{ $mediaList->onEachSide(1)->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Upload Media Modal --}}
    @can('media-create')
        <div class="modal fade" id="uploadMediaModal" tabindex="-1" aria-labelledby="uploadMediaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0"
                                style="width: 32px; height: 32px; background-color: #f95716;">
                                <i class="ri-upload-cloud-2-line" style="font-size: 18px;"></i>
                            </div>
                            <div>
                                <h5 class="modal-title fw-bold text-dark mb-0" id="uploadMediaModalLabel"
                                    style="font-size: 15.5px;">
                                    Upload Media Assets
                                </h5>
                                <span class="text-muted" style="font-size: 11.5px;">Add photos, blueprints, or documents to the
                                    media repository</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="mediaUploadForm" enctype="multipart/form-data">
                            {{-- Hidden actual file input --}}
                            <input type="file" id="fileInput" name="files[]" multiple accept=".jpg,.jpeg,.png,.webp,.svg,.pdf"
                                class="d-none">

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 13px;">Target
                                        Collection</label>
                                    <select name="collection" id="upload_collection" class="form-select custom-input"
                                        style="height: 38px; font-size: 13px;">
                                        <option value="library" selected>General Library (library)</option>
                                        <option value="gallery">Project / Service Gallery (gallery)</option>
                                        <option value="documents">Engineering Documents (documents)</option>
                                        <option value="main_image">Main Cover Images (main_image)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mb-1 fw-semibold text-dark" style="font-size: 13px;">Asset Title /
                                        Label (Optional)</label>
                                    <input type="text" name="title" id="upload_title" class="form-control custom-input"
                                        placeholder="e.g. Skyline Structural Blueprint" style="height: 38px; font-size: 13px;">
                                </div>
                            </div>

                            {{-- Interactive Dropzone --}}
                            <div class="dropzone-box mb-3" id="dropZone">
                                <div class="dropzone-icon">
                                    <i class="ri-image-add-line"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px;">Drag &amp; drop files here</h6>
                                <p class="text-muted mb-3" style="font-size: 12px;">Supports JPG, PNG, WebP, SVG, and PDF up to
                                    15MB each</p>
                                <button type="button" class="btn btn-sm upload-btn px-4" id="btnBrowseFiles">
                                    <i class="ri-folder-open-line me-1"></i> Browse Files
                                </button>
                            </div>

                            {{-- Staged Files Grid Preview --}}
                            <div id="stagedFilesContainer" class="d-none mb-3">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold text-dark" style="font-size: 13px;">
                                        <i class="ri-checkbox-circle-line text-success me-1"></i> Staged Files (<span
                                            id="stagedCount">0</span>)
                                    </span>
                                    <button type="button" id="clearStagedBtn"
                                        class="btn btn-sm btn-link text-danger text-decoration-none p-0"
                                        style="font-size: 12px;">
                                        <i class="ri-delete-bin-line me-1"></i> Clear All
                                    </button>
                                </div>
                                <div class="row g-2" id="stagedFilesGrid" style="max-height: 240px; overflow-y: auto;"></div>
                            </div>

                            {{-- Upload Progress --}}
                            <div id="uploadProgressBarContainer" class="progress d-none mb-3" style="height: 8px;">
                                <div id="uploadProgressBar"
                                    class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" style="width: 0%"></div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal"
                                    style="height: 36px; font-weight: 600;">Cancel</button>
                                <button type="submit" id="startUploadBtn" class="btn btn-primary btn-sm px-4"
                                    style="height: 36px; font-weight: 600; background-color: #f95716; border-color: #f95716;"
                                    disabled>
                                    <i class="ri-upload-2-line me-1"></i> Start Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    {{-- View / Inspect Media Modal --}}
    <div class="modal fade" id="previewMediaModal" tabindex="-1" aria-labelledby="previewMediaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <h5 class="modal-title fw-bold text-dark" id="previewMediaModalLabel" style="font-size: 16px;">
                        <i class="ri-file-search-line text-primary me-1"></i> Media Asset Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        {{-- Preview Graphic --}}
                        <div class="col-lg-6 col-12">
                            <div class="media-preview-container p-2" id="previewContainer">
                                <img id="modalPreviewImg" src="" alt="Media preview" class="d-none">
                                <div id="modalPreviewDoc" class="d-none text-center p-4">
                                    <i id="modalDocIcon" class="ri-file-text-line text-white" style="font-size: 64px;"></i>
                                    <p id="modalDocName" class="text-light mt-2 mb-0 fw-semibold" style="font-size: 13px;">
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <a id="modalDirectLink" href="#" target="_blank" class="btn btn-sm btn-outline-primary"
                                    style="font-size: 12px;">
                                    <i class="ri-external-link-line me-1"></i> Open Original in New Tab
                                </a>
                            </div>
                        </div>

                        {{-- Metadata Pills --}}
                        <div class="col-lg-6 col-12">
                            <div class="d-flex flex-column gap-2">
                                <div class="info-pill">
                                    <div class="info-pill-label">File Name</div>
                                    <div class="info-pill-val" id="modalFileName">—</div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="info-pill">
                                            <div class="info-pill-label">Collection</div>
                                            <div class="info-pill-val" id="modalCollection">—</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-pill">
                                            <div class="info-pill-label">File Size</div>
                                            <div class="info-pill-val" id="modalFileSize">—</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="info-pill">
                                            <div class="info-pill-label">MIME Type</div>
                                            <div class="info-pill-val" id="modalMimeType">—</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="info-pill">
                                            <div class="info-pill-label">Dimensions</div>
                                            <div class="info-pill-val" id="modalDimensions">—</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-pill">
                                    <div class="info-pill-label">Public Access URL</div>
                                    <div class="d-flex align-items-center justify-content-between gap-2 mt-1">
                                        <input type="text" id="modalCopyUrlInput" readonly
                                            class="form-control form-control-sm bg-white"
                                            style="font-size: 12px; height: 30px;">
                                        <button type="button" id="modalCopyUrlBtn" class="btn btn-sm btn-dark flex-shrink-0"
                                            style="height: 30px; font-size: 12px;" title="Copy to clipboard">
                                            <i class="ri-file-copy-line me-1"></i> Copy
                                        </button>
                                    </div>
                                </div>

                                <div class="info-pill">
                                    <div class="info-pill-label">Uploaded By / Date</div>
                                    <div class="info-pill-val" style="font-size: 12px;">
                                        <span id="modalUploader">—</span> • <span id="modalCreatedAt"
                                            class="text-muted">—</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('custom-script')
    <script type="text/javascript">
        $(document).ready(function () {
            var listUrl = "{{ route('media.index') }}";
            var storeUrl = "{{ route('media.store') }}";

            // ==========================================
            // Interactive Drag & Drop Upload Staging
            // ==========================================
            var stagedFiles = [];
            var $dropZone = $('#dropZone');
            var $fileInput = $('#fileInput');

            function formatBytes(bytes) {
                if (bytes === 0) return '0 B';
                var k = 1024;
                var sizes = ['B', 'KB', 'MB', 'GB'];
                var i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Click trigger for browse
            $('#btnBrowseFiles').on('click', function (e) {
                e.stopPropagation();
                $fileInput.trigger('click');
            });

            $dropZone.on('click', function (e) {
                if (!$(e.target).closest('button').length) {
                    $fileInput.trigger('click');
                }
            });

            $dropZone.on('dragover dragenter', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $dropZone.addClass('dragover');
            });

            $dropZone.on('dragleave dragend drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $dropZone.removeClass('dragover');
            });

            $dropZone.on('drop', function (e) {
                var files = e.originalEvent.dataTransfer.files;
                if (files && files.length > 0) {
                    handleFilesSelected(files);
                }
            });

            $fileInput.on('change', function () {
                if (this.files && this.files.length > 0) {
                    handleFilesSelected(this.files);
                }
            });

            function handleFilesSelected(fileList) {
                for (var i = 0; i < fileList.length; i++) {
                    var file = fileList[i];
                    if (file.size > 15 * 1024 * 1024) {
                        toastr.warning(file.name + ' exceeds 15MB limit', 'File Too Large');
                        continue;
                    }
                    stagedFiles.push(file);
                }
                renderStagedFiles();
            }

            function renderStagedFiles() {
                var $grid = $('#stagedFilesGrid');
                $grid.empty();

                if (stagedFiles.length === 0) {
                    $('#stagedFilesContainer').addClass('d-none');
                    $('#startUploadBtn').prop('disabled', true);
                    return;
                }

                $('#stagedFilesContainer').removeClass('d-none');
                $('#stagedCount').text(stagedFiles.length);
                $('#startUploadBtn').prop('disabled', false);

                stagedFiles.forEach(function (file, index) {
                    var isImg = file.type.startsWith('image/');

                    if (isImg) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var cardHtml = '<div class="col-6 col-md-3" id="staged_item_' + index + '">' +
                                '<div class="preview-card">' +
                                '<button type="button" class="preview-remove-btn remove-staged-btn" data-index="' + index + '" title="Remove file">' +
                                '<i class="ri-close-line"></i>' +
                                '</button>' +
                                '<img src="' + e.target.result + '" class="preview-thumb" alt="' + file.name + '">' +
                                '<div class="preview-info">' +
                                '<span class="preview-filename">' + file.name + '</span>' +
                                '<span class="preview-filesize">' + formatBytes(file.size) + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $grid.append(cardHtml);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        var isPdf = file.type.includes('pdf') || file.name.endsWith('.pdf');
                        var docIcon = isPdf ? 'ri-file-pdf-2-line text-danger' : 'ri-file-text-line text-primary';
                        var docType = isPdf ? 'PDF Document' : 'Document';

                        var cardHtml = '<div class="col-6 col-md-3" id="staged_item_' + index + '">' +
                            '<div class="preview-card">' +
                            '<button type="button" class="preview-remove-btn remove-staged-btn" data-index="' + index + '" title="Remove file">' +
                            '<i class="ri-close-line"></i>' +
                            '</button>' +
                            '<div class="preview-doc-box">' +
                            '<i class="' + docIcon + '" style="font-size: 38px;"></i>' +
                            '<span class="text-muted fw-semibold mt-1" style="font-size: 11px;">' + docType + '</span>' +
                            '</div>' +
                            '<div class="preview-info">' +
                            '<span class="preview-filename">' + file.name + '</span>' +
                            '<span class="preview-filesize">' + formatBytes(file.size) + '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $grid.append(cardHtml);
                    }
                });
            }

            $(document).on('click', '.remove-staged-btn', function (e) {
                e.stopPropagation();
                var idx = parseInt($(this).data('index'));
                stagedFiles.splice(idx, 1);
                renderStagedFiles();
            });

            $('#clearStagedBtn').on('click', function () {
                stagedFiles = [];
                renderStagedFiles();
                $fileInput.val('');
            });

            // Submit upload via AJAX
            $('#mediaUploadForm').on('submit', function (e) {
                e.preventDefault();
                if (stagedFiles.length === 0) return;

                var formData = new FormData();
                var collection = $('#upload_collection').val();
                var title = $('#upload_title').val();

                formData.append('collection', collection);
                if (title) formData.append('title', title);

                if (stagedFiles.length === 1) {
                    formData.append('file', stagedFiles[0]);
                } else {
                    for (var i = 0; i < stagedFiles.length; i++) {
                        formData.append('files[]', stagedFiles[i]);
                    }
                }

                $('#uploadProgressBarContainer').removeClass('d-none');
                $('#uploadProgressBar').css('width', '10%');
                $('#startUploadBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status"></span> Uploading...');

                $.ajax({
                    url: storeUrl,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                $('#uploadProgressBar').css('width', percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (res) {
                        toastr.success(res.message || 'Media uploaded successfully', 'Success');
                        $('#uploadMediaModal').modal('hide');
                        $('#mediaUploadForm')[0].reset();
                        stagedFiles = [];
                        renderStagedFiles();
                        $('#uploadProgressBarContainer').addClass('d-none');
                        $('#uploadProgressBar').css('width', '0%');
                        $('#startUploadBtn').prop('disabled', false).html('<i class="ri-upload-2-line me-1"></i> Start Upload');
                        window.location.reload();
                    },
                    error: function (xhr) {
                        var err = 'Failed to upload media.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            err = xhr.responseJSON.message;
                        }
                        toastr.error(err, 'Upload Failed');
                        $('#uploadProgressBarContainer').addClass('d-none');
                        $('#uploadProgressBar').css('width', '0%');
                        $('#startUploadBtn').prop('disabled', false).html('<i class="ri-upload-2-line me-1"></i> Start Upload');
                    }
                });
            });

            // Open Preview / Inspect
            window.openMediaPreview = function (id) {
                var showUrl = "{{ url('/dashboard/media') }}/" + id;
                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    headers: { 'Accept': 'application/json' },
                    success: function (res) {
                        if (!res.success || !res.data) return;
                        var m = res.data;

                        $('#modalFileName').text(m.file_name);
                        $('#modalCollection').text(m.collection_name);
                        $('#modalFileSize').text(m.readable_size);
                        $('#modalMimeType').text(m.mime_type || 'Unknown');
                        $('#modalDimensions').text(m.dimensions || 'N/A (Document)');
                        $('#modalCopyUrlInput').val(m.url);
                        $('#modalDirectLink').attr('href', m.url);
                        $('#modalUploader').text(m.uploader ? m.uploader.name : 'System');
                        $('#modalCreatedAt').text(m.formatted_created_at || '—');

                        if (m.is_image) {
                            $('#modalPreviewImg').attr('src', m.url).removeClass('d-none');
                            $('#modalPreviewDoc').addClass('d-none');
                        } else {
                            $('#modalPreviewImg').addClass('d-none');
                            $('#modalPreviewDoc').removeClass('d-none');
                            $('#modalDocName').text(m.file_name);
                            var docIcon = (m.mime_type && m.mime_type.includes('pdf')) ? 'ri-file-pdf-2-line text-danger' : 'ri-file-text-line text-white';
                            $('#modalDocIcon').attr('class', docIcon);
                        }

                        $('#previewMediaModal').modal('show');
                    },
                    error: function () {
                        toastr.error('Could not load media details', 'Error');
                    }
                });
            };

            // Copy Media URL to Clipboard
            window.copyMediaUrl = function (url) {
                navigator.clipboard.writeText(url).then(function () {
                    toastr.success('Media URL copied to clipboard!', 'Copied');
                }).catch(function () {
                    toastr.info(url, 'Media URL');
                });
            };

            $('#modalCopyUrlBtn').on('click', function () {
                var url = $('#modalCopyUrlInput').val();
                copyMediaUrl(url);
            });

        });
    </script>
@endpush