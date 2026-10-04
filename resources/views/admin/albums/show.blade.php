@extends('admin.app')
@section('title')
    Album Photos: {{ $album->title }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        @include('admin.includes.gallery-nav')
        {{-- Album Banner Header --}}
        <div class="card table-card mb-4">
            <div class="card-header table-header">
                <div class="title-with-breadcrumb">
                    <div class="table-title">Album: {{ $album->title }}</div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Albums</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $album->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.albums.edit', $album->id) }}" class="btn btn-sm btn-warning text-white" style="border-radius: 6px;">
                        <i class="ri-edit-line me-1"></i> Edit Album
                    </a>
                    <a href="{{ route('admin.albums.index') }}" class="add-new">
                        <i class="ri-arrow-left-line me-1"></i> Back to Albums
                    </a>
                </div>
            </div>
            <div class="card-body p-4 bg-light">
                <div class="row align-items-center">
                    <div class="col-md-auto text-center mb-3 mb-md-0">
                        <div style="width: 110px; height: 80px; border-radius: 8px; overflow: hidden; border: 2px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                            <img src="{{ $album->cover_image_url }}" onerror="this.src='{{ asset('assets/images/gallery/portfolio-7.jpg') }}'" alt="{{ $album->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-md">
                        <h4 class="fw-bold mb-1 text-dark">{{ $album->title }}</h4>
                        @if($album->title_bn)
                            <h6 class="text-primary mb-2" style="font-size: 14px;">{{ $album->title_bn }}</h6>
                        @endif
                        <div class="d-flex align-items-center flex-wrap gap-3 text-muted" style="font-size: 13px;">
                            @if($album->event_date)
                                <span><i class="ri-calendar-line text-primary me-1"></i> {{ $album->event_date->format('d M, Y') }}</span>
                            @endif
                            <span><i class="ri-image-2-line text-info me-1"></i> <strong>{{ $album->images->count() }}</strong> {{ __('Photos in Album') }}</span>
                            <span>
                                @if($album->is_active)
                                    <span class="badge bg-success"><i class="ri-check-line me-1"></i> Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft / Hidden</span>
                                @endif
                            </span>
                            @if($album->slug)
                                <a href="{{ route('gallery.album', $album->slug) }}" target="_blank" class="badge bg-soft-primary text-primary text-decoration-none">
                                    <i class="ri-external-link-line me-1"></i> View on Website
                                </a>
                            @endif
                        </div>
                        @if($album->description)
                            <p class="text-muted mt-2 mb-0" style="font-size: 13px;">{{ $album->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Upload New Photos Card --}}
        <div class="card table-card mb-4">
            <div class="card-header table-header">
                <div class="table-title" style="font-size: 15px;"><i class="ri-upload-cloud-2-line me-2 text-primary"></i> Upload Photos to this Album</div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="album_id" value="{{ $album->id }}">
                    <input type="hidden" name="is_active" value="1">

                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label custom-label">Select Photos (Multiple Allowed) <span class="text-danger">*</span></label>
                            <input type="file" name="images[]" class="form-control custom-input @error('images') is-invalid @enderror" multiple required accept="image/*">
                            <div class="text-muted mt-1" style="font-size: 11.5px;">You can select multiple photos at once. Supported: JPG, PNG, WEBP (Max 10MB each).</div>
                            @error('images')
                                <div class="text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label custom-label">Optional Photo Title / Group Caption</label>
                            <input type="text" name="title" class="form-control custom-input" placeholder="e.g. Relief Kit Handover at Shantinagar">
                        </div>

                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary" style="font-weight: 600; padding: 8px 24px;">
                                <i class="ri-upload-2-line me-1"></i> Start Uploading Photos
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Existing Photos Grid --}}
        <div class="card table-card">
            <div class="card-header table-header">
                <div class="table-title">Album Photo Gallery ({{ $album->images->count() }})</div>
            </div>
            <div class="card-body p-4">
                @if($album->images->count() > 0)
                    <div class="row g-3">
                        @foreach($album->images as $photo)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" id="photo-card-{{ $photo->id }}">
                                <div class="card h-100 border shadow-none" style="border-radius: 8px; overflow: hidden;">
                                    <div style="position: relative; height: 180px; overflow: hidden; background: #f1f5f9;">
                                        <a href="{{ $photo->image_url }}" data-fancybox="album-gallery" data-caption="{{ $photo->localized_title ?? $album->localized_title }}">
                                            <img src="{{ $photo->image_url }}" onerror="this.src='{{ asset('assets/images/gallery/portfolio-7.jpg') }}'" alt="{{ $photo->title ?? 'Photo' }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                        </a>
                                        <div style="position: absolute; top: 8px; right: 8px; display: flex; gap: 4px;">
                                            <button type="button" class="btn btn-sm btn-danger delete-photo-btn" data-url="{{ route('admin.gallery-images.destroy', $photo->id) }}" data-id="{{ $photo->id }}" style="padding: 3px 8px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);" title="Delete Photo">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-2 d-flex flex-column justify-content-between">
                                        <div class="mb-2">
                                            <div class="fw-bold text-dark text-truncate" style="font-size: 13px;">
                                                {{ $photo->title ?: __('No Title') }}
                                            </div>
                                            @if($photo->title_bn)
                                                <div class="text-muted text-truncate" style="font-size: 11.5px;">{{ $photo->title_bn }}</div>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                            <div class="form-check form-switch form-switch-sm mb-0">
                                                <input class="form-check-input photo-status-toggle" type="checkbox" data-url="{{ route('admin.gallery-images.toggle-status', $photo->id) }}" {{ $photo->is_active ? 'checked' : '' }}>
                                                <label class="form-check-label text-muted" style="font-size: 11px;">Active</label>
                                            </div>
                                            <a href="{{ route('admin.gallery-images.edit', $photo->id) }}" class="btn btn-sm btn-link text-primary p-0" style="font-size: 12px; text-decoration: none;">
                                                <i class="ri-edit-line me-1"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="ri-image-add-line display-4 d-block mb-3 text-secondary"></i>
                        <h5>No photos uploaded in this album yet.</h5>
                        <p class="mb-0">Use the upload box above to add high-resolution photos to this album.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    $(document).ready(function() {
        // Photo Status Toggle
        $(document).on('change', '.photo-status-toggle', function() {
            var url = $(this).data('url');
            var checkbox = $(this);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message || 'Status updated.');
                    }
                },
                error: function() {
                    toastr.error('Failed to update status.');
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });
        });

        // Delete Photo Instant
        $(document).on('click', '.delete-photo-btn', function() {
            var url = $(this).data('url');
            var id = $(this).data('id');

            Swal.fire({
                title: 'Delete Photo?',
                text: "Are you sure you want to remove this photo from the album?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            toastr.success(response.message || 'Photo removed.');
                            $('#photo-card-' + id).fadeOut(300, function() {
                                $(this).remove();
                            });
                        },
                        error: function() {
                            toastr.error('Failed to delete photo.');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
