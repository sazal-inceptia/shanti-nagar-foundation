@extends('admin.app')
@section('title')
    Edit Project &mdash; {{ $project->name }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="projectEditForm" action="{{ route('admin.projects.update', $project->id) }}" method="POST"
            enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Main Project Details --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Project: {{ $project->name }}</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('admin.projects.index') }}">Projects</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.projects.index') }}" class="add-new">
                                    <i class="ri-list-check me-1"></i> Project List
                                </a>
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Project Name --}}
                                <div class="col-md-8 col-12">
                                    <label for="name" class="form-label custom-label">Project Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $project->name) }}" required>
                                    @error('name')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="col-md-4 col-12">
                                    <label for="slug" class="form-label custom-label">Slug (URL)</label>
                                    <input type="text" class="form-control custom-input @error('slug') is-invalid @enderror"
                                        name="slug" id="slug" value="{{ old('slug', $project->slug) }}">
                                    @error('slug')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Category & Status --}}
                                <div class="col-md-6 col-12">
                                    <label for="category" class="form-label custom-label">Sector / Category <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('category') is-invalid @enderror"
                                        name="category" id="category" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}" {{ old('category', $project->category) == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="status" class="form-label custom-label">Campaign Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('status') is-invalid @enderror"
                                        name="status" id="status" required>
                                        <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress (Active)</option>
                                        <option value="planned" {{ old('status', $project->status) == 'planned' ? 'selected' : '' }}>Planned (Upcoming)</option>
                                        <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed (Achieved)</option>
                                        <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Target Budget & Site Location --}}
                                <div class="col-md-6 col-12">
                                    <label for="estimated_cost" class="form-label custom-label">Target Budget (৳ BDT) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0"
                                            class="form-control custom-input @error('estimated_cost') is-invalid @enderror"
                                            name="estimated_cost" id="estimated_cost"
                                            value="{{ old('estimated_cost', $project->estimated_cost) }}">
                                    </div>
                                    @error('estimated_cost')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="location" class="form-label custom-label">Beneficiary Location</label>
                                    <input type="text"
                                        class="form-control custom-input @error('location') is-invalid @enderror"
                                        name="location" id="location" value="{{ old('location', $project->location) }}"
                                        placeholder="e.g. Shanti Nagar, Dhaka">
                                    @error('location')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Timeline Dates --}}
                                <div class="col-md-6 col-12">
                                    <label for="start_date" class="form-label custom-label">Launch / Start Date</label>
                                    <input type="date"
                                        class="form-control custom-input @error('start_date') is-invalid @enderror"
                                        name="start_date" id="start_date"
                                        value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                        onclick="this.showPicker()">
                                    @error('start_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="completion_date" class="form-label custom-label">Target Completion
                                        Date</label>
                                    <input type="date"
                                        class="form-control custom-input @error('completion_date') is-invalid @enderror"
                                        name="completion_date" id="completion_date"
                                        value="{{ old('completion_date', $project->completion_date?->format('Y-m-d')) }}"
                                        onclick="this.showPicker()">
                                    @error('completion_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Short Description --}}
                                <div class="col-12">
                                    <label for="short_description" class="form-label custom-label">Short Summary (Featured
                                        Snippet)</label>
                                    <textarea
                                        class="form-control custom-input @error('short_description') is-invalid @enderror"
                                        name="short_description" id="short_description" rows="3"
                                        style="resize: none;">{{ old('short_description', $project->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Description --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Full Project Overview &amp;
                                        Humanitarian Impact</label>
                                    <textarea class="form-control custom-input @error('description') is-invalid @enderror"
                                        name="description" id="description"
                                        rows="8">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Media & Actions --}}
                <div class="col-lg-4 col-12">
                    <div class="row g-3">
                        {{-- Publish Actions --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Publish Status</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    <div class="d-flex flex-column gap-3 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_published"
                                                id="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }} style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold" for="is_published"
                                                style="font-size: 13.5px; cursor: pointer;">
                                                Visible on Website
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_featured"
                                                id="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} style="cursor: pointer;">
                                            <label class="form-check-label fw-semibold" for="is_featured"
                                                style="font-size: 13.5px; cursor: pointer;">
                                                Feature on Homepage
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100"
                                                style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                                <i class="ri-check-line me-1"></i> Update Cause
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin.projects.index') }}" class="btn leave-button w-100"
                                                style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Main Featured Cover Image --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Featured Image (Cover Photo)</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @include('admin.includes.image-uploader', [
                                        'name' => 'featured_image',
                                        'label' => 'Upload Cover Photo',
                                        'modalTitle' => 'Upload Campaign Cover Photo',
                                        'helpText' => 'JPG, PNG, WebP up to 5MB (1200×800px recommended)',
                                        'currentImage' => $project->featured_image && file_exists(public_path($project->featured_image)) ? asset($project->featured_image) : null,
                                        'currentName' => $project->name ?? 'Cover Photo',
                                        'shape' => 'rectangle',
                                        'height' => '170px'
                                    ])
                                </div>
                            </div>
                        </div>

                        {{-- Multi-File Project Gallery --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Gallery Documentation Photos ({{ $project->images->count() }})
                                    </div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @if($project->images->isNotEmpty())
                                        <div class="row g-2 mb-3">
                                            @foreach($project->images as $img)
                                                <div class="col-4 position-relative">
                                                    <img src="{{ asset($img->image_path) }}" alt="Gallery Image"
                                                        class="rounded border w-100" style="height: 65px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @include('admin.includes.multi-image-uploader', [
                                        'name' => 'gallery[]',
                                        'instanceId' => 'prj_edit_gallery',
                                        'label' => 'Add Gallery Photos',
                                        'modalTitle' => 'Upload Field Documentation Photos',
                                        'helpText' => 'PNG, JPG, WebP up to 5MB each — select multiple',
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
    <script>
        $(document).ready(function () {
            // Edit form scripts
        });
    </script>
@endpush