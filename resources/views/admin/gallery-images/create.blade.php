@extends('admin.app')
@section('title')
    Upload Gallery Photos
@endsection

@section('content')
    <div class="container-fluid my-3">
        @include('admin.includes.gallery-nav')
        <form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Upload Gallery Photos</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.gallery-images.index') }}">Gallery Photos</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Upload</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.gallery-images.index') }}" class="add-new">
                                <i class="ri-list-check me-1"></i> Photos List
                            </a>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Target Album Selection --}}
                                <div class="col-12">
                                    <label for="album_id" class="form-label custom-label">Assign to Album (Optional)</label>
                                    <select name="album_id" id="album_id" class="form-select custom-input">
                                        <option value="">-- Standalone Photo (No Album / General Gallery) --</option>
                                        @foreach($albums as $album)
                                            <option value="{{ $album->id }}" {{ (old('album_id', $selectedAlbumId) == $album->id) ? 'selected' : '' }}>
                                                📁 {{ $album->title }} @if($album->event_date) ({{ $album->event_date->format('Y-m-d') }}) @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted mt-1" style="font-size: 11.5px;">Choose an album to group these photos together, or leave empty to upload as standalone general gallery images.</div>
                                </div>

                                {{-- File Upload Input --}}
                                <div class="col-12">
                                    <label class="form-label custom-label">Select Photo(s) <span class="text-danger">*</span></label>
                                    <input type="file" name="images[]" id="images_input" class="form-control custom-input @error('images') is-invalid @enderror" multiple required accept="image/*" onchange="previewMultipleImages(event)">
                                    <div class="text-muted mt-1" style="font-size: 11.5px;">You can select single or multiple files. Supported formats: JPG, PNG, WEBP (Max 10MB each).</div>
                                    @error('images')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Preview Container --}}
                                <div class="col-12">
                                    <div id="imagePreviewContainer" class="row g-2 mt-2 p-2 border rounded bg-light" style="display: none; max-height: 280px; overflow-y: auto;"></div>
                                </div>

                                <hr class="my-2">

                                {{-- Title EN & BN --}}
                                <div class="col-md-6 col-12">
                                    <label for="title" class="form-label custom-label">Photo Title (English - Optional)</label>
                                    <input type="text" class="form-control custom-input" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Voluntary Blood Donation Drive">
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="title_bn" class="form-label custom-label">Photo Title (বাংলা / Bangla - Optional)</label>
                                    <input type="text" class="form-control custom-input" name="title_bn" id="title_bn" value="{{ old('title_bn') }}" placeholder="যেমন: স্বেচ্ছায় রক্তদান কর্মসূচি">
                                </div>

                                {{-- Caption EN & BN --}}
                                <div class="col-md-6 col-12">
                                    <label for="caption" class="form-label custom-label">Caption / Description (English)</label>
                                    <textarea class="form-control custom-input" name="caption" id="caption" rows="2" placeholder="Brief note about the photo...">{{ old('caption') }}</textarea>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="caption_bn" class="form-label custom-label">Caption / Description (বাংলা / Bangla)</label>
                                    <textarea class="form-control custom-input" name="caption_bn" id="caption_bn" rows="2" placeholder="ছবি সম্পর্কিত সংক্ষিপ্ত তথ্য...">{{ old('caption_bn') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar: Visibility & Submission --}}
                <div class="col-lg-4 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">Settings & Action</div>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                                <label class="form-check-label fw-bold ms-2" for="is_active">Publish in Gallery</label>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1">
                                <label class="form-check-label fw-bold ms-2" for="is_featured">Featured Photo</label>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary" style="font-weight: 600; padding: 10px;">
                                    <i class="ri-upload-cloud-2-line me-1"></i> Upload & Save
                                </button>
                                <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('custom-script')
<script>
    function previewMultipleImages(event) {
        var container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';
        var files = event.target.files;

        if (files.length > 0) {
            container.style.display = 'flex';
            Array.from(files).forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var col = document.createElement('div');
                    col.className = 'col-3 text-center';
                    col.innerHTML = '<div style="height: 70px; border-radius: 4px; overflow: hidden; border: 1px solid #cbd5e1; background: #fff;">' +
                        '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                        '</div>';
                    container.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        } else {
            container.style.display = 'none';
        }
    }
</script>
@endpush
