@extends('admin.app')
@section('title')
    Edit Gallery Photo
@endsection

@section('content')
    <div class="container-fluid my-3">
        @include('admin.includes.gallery-nav')
        <form action="{{ route('admin.gallery-images.update', $galleryImage->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Photo Details</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.gallery-images.index') }}">Gallery Photos</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Photo</li>
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
                                            <option value="{{ $album->id }}" {{ (old('album_id', $galleryImage->album_id) == $album->id) ? 'selected' : '' }}>
                                                📁 {{ $album->title }} @if($album->event_date) ({{ $album->event_date->format('Y-m-d') }}) @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Title EN & BN --}}
                                <div class="col-md-6 col-12">
                                    <label for="title" class="form-label custom-label">Photo Title (English)</label>
                                    <input type="text" class="form-control custom-input" name="title" id="title" value="{{ old('title', $galleryImage->title) }}">
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="title_bn" class="form-label custom-label">Photo Title (বাংলা / Bangla)</label>
                                    <input type="text" class="form-control custom-input" name="title_bn" id="title_bn" value="{{ old('title_bn', $galleryImage->title_bn) }}">
                                </div>

                                {{-- Caption EN & BN --}}
                                <div class="col-md-6 col-12">
                                    <label for="caption" class="form-label custom-label">Caption / Description (English)</label>
                                    <textarea class="form-control custom-input" name="caption" id="caption" rows="3">{{ old('caption', $galleryImage->caption) }}</textarea>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="caption_bn" class="form-label custom-label">Caption / Description (বাংলা / Bangla)</label>
                                    <textarea class="form-control custom-input" name="caption_bn" id="caption_bn" rows="3">{{ old('caption_bn', $galleryImage->caption_bn) }}</textarea>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="sort_order" class="form-label custom-label">Sort Priority</label>
                                    <input type="number" class="form-control custom-input" name="sort_order" id="sort_order" value="{{ old('sort_order', $galleryImage->sort_order) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar: Image Preview & Replace --}}
                <div class="col-lg-4 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">Photo File & Status</div>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                @include('admin.includes.image-uploader', [
                                    'name' => 'image',
                                    'label' => 'Upload Photo',
                                    'modalTitle' => 'Upload Gallery Image',
                                    'helpText' => 'JPG, PNG, WebP up to 10MB',
                                    'shape' => 'rectangle',
                                    'height' => '170px',
                                    'currentImage' => $galleryImage->image_path ? asset($galleryImage->image_path) : null,
                                    'currentName' => $galleryImage->title ?? 'Gallery Photo'
                                ])
                            </div>

                            <hr>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $galleryImage->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold ms-2" for="is_active">Publish in Gallery</label>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ $galleryImage->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold ms-2" for="is_featured">Featured Photo</label>
                            </div>

                            <div class="row g-2 mt-4">
                                <div class="col-6">
                                    <button type="submit" class="btn submit-button w-100" style="background-color: #005daa; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                        <i class="ri-check-line me-1"></i> Update
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

@push('custom-script')
<script>
    function previewSingleImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush
