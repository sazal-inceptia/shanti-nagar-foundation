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
                                    @include('admin.includes.multi-image-uploader', [
                                        'name'       => 'images[]',
                                        'instanceId' => 'gallery_create_images',
                                        'label'      => 'Upload Photos',
                                        'modalTitle' => 'Select Gallery Photographs',
                                        'helpText'   => 'PNG, JPG, WebP up to 10MB each — select multiple',
                                    ])
                                    @error('images')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
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

                            <div class="row g-2 mt-4">
                                <div class="col-6">
                                    <button type="submit" class="btn submit-button w-100" style="background-color: #005daa; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                        <i class="ri-check-line me-1"></i> Upload
                                    </button>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.gallery-images.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
