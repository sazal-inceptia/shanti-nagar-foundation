@extends('admin.app')
@section('title')
    Edit Photo Album - {{ $album->title }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        @include('admin.includes.gallery-nav')
        <form action="{{ route('admin.albums.update', $album->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Album: {{ $album->title }}</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Albums</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.albums.show', $album->id) }}" class="btn btn-sm btn-info text-white" style="border-radius: 6px;">
                                    <i class="ri-image-line me-1"></i> Manage Photos
                                </a>
                                <a href="{{ route('admin.albums.index') }}" class="add-new">
                                    <i class="ri-list-check me-1"></i> Album List
                                </a>
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Title EN & BN --}}
                                <div class="col-md-6 col-12">
                                    <label for="title" class="form-label custom-label">Album Title (English) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('title') is-invalid @enderror" 
                                        name="title" id="title" value="{{ old('title', $album->title) }}" required>
                                    @error('title')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="title_bn" class="form-label custom-label">Album Title (বাংলা / Bangla)</label>
                                    <input type="text" class="form-control custom-input @error('title_bn') is-invalid @enderror" 
                                        name="title_bn" id="title_bn" value="{{ old('title_bn', $album->title_bn) }}">
                                    @error('title_bn')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Event Date & Sort Order --}}
                                <div class="col-md-6 col-12">
                                    <label for="event_date" class="form-label custom-label">Event / Activity Date</label>
                                    <input type="date" class="form-control custom-input @error('event_date') is-invalid @enderror"
                                        name="event_date" id="event_date" value="{{ old('event_date', $album->event_date?->format('Y-m-d')) }}">
                                    @error('event_date')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="sort_order" class="form-label custom-label">Sort Priority</label>
                                    <input type="number" class="form-control custom-input @error('sort_order') is-invalid @enderror"
                                        name="sort_order" id="sort_order" value="{{ old('sort_order', $album->sort_order) }}">
                                    @error('sort_order')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Description EN & BN --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Description (English)</label>
                                    <textarea class="form-control custom-input @error('description') is-invalid @enderror"
                                        name="description" id="description" rows="3">{{ old('description', $album->description) }}</textarea>
                                    @error('description')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description_bn" class="form-label custom-label">Description (বাংলা / Bangla)</label>
                                    <textarea class="form-control custom-input @error('description_bn') is-invalid @enderror"
                                        name="description_bn" id="description_bn" rows="3">{{ old('description_bn', $album->description_bn) }}</textarea>
                                    @error('description_bn')
                                        <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar: Cover Image & Status --}}
                <div class="col-lg-4 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">Cover Photo & Status</div>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <label class="form-label custom-label">Album Cover Image</label>
                                <input type="file" name="cover_image" class="form-control custom-input" accept="image/*" onchange="previewCover(event)">
                                <div class="text-muted mt-1" style="font-size: 11.5px;">Recommended resolution: 800x600 px (Max: 5MB)</div>
                                <div class="mt-3 text-center border rounded p-2 bg-light" style="min-height: 140px; display: flex; align-items: center; justify-content: center;">
                                    <img id="coverPreview" src="{{ $album->cover_image_url }}" onerror="this.src='{{ asset('assets/images/gallery/portfolio-7.jpg') }}'" alt="Preview" style="max-width: 100%; max-height: 180px; object-fit: cover; border-radius: 6px;">
                                </div>
                            </div>

                            <hr>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $album->is_active ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold ms-2" for="is_active">Publish on Website</label>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary" style="font-weight: 600; padding: 10px;">
                                    <i class="ri-check-line me-1"></i> Update Album
                                </button>
                                <a href="{{ route('admin.albums.show', $album->id) }}" class="btn btn-outline-info">
                                    <i class="ri-image-line me-1"></i> Go to Photos ({{ $album->images->count() }})
                                </a>
                                <a href="{{ route('admin.albums.index') }}" class="btn btn-outline-secondary">
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
    function previewCover(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('coverPreview');
            output.src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush
