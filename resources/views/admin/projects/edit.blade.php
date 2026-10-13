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
                                {{-- Project Name (EN & BN) --}}
                                <div class="col-md-6 col-12">
                                    <label for="name" class="form-label custom-label">Project Title (English) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $project->name) }}" required>
                                    @error('name')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="name_bn" class="form-label custom-label">Project Title (বাংলা / Bangla)</label>
                                    <input type="text" class="form-control custom-input @error('name_bn') is-invalid @enderror"
                                        name="name_bn" id="name_bn" value="{{ old('name_bn', $project->name_bn) }}" placeholder="যেমন: নিরাপদ খাবার পানির টিউবওয়েল স্থাপন">
                                    @error('name_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Project Type & Status --}}
                                <div class="col-md-6 col-12">
                                    <label for="project_type_id" class="form-label custom-label">Project Type</label>
                                    <select class="form-select custom-input @error('project_type_id') is-invalid @enderror"
                                        name="project_type_id" id="project_type_id">
                                        <option value="">Select Project Type...</option>
                                        @foreach($projectTypes as $type)
                                            <option value="{{ $type->id }}" {{ old('project_type_id', $project->project_type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }} {{ $type->name_bn ? '('.$type->name_bn.')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_type_id')
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

                                {{-- Target Budget & Site Location (EN & BN) --}}
                                <div class="col-md-4 col-12">
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

                                <div class="col-md-4 col-12">
                                    <label for="location" class="form-label custom-label">Location (English)</label>
                                    <input type="text"
                                        class="form-control custom-input @error('location') is-invalid @enderror"
                                        name="location" id="location" value="{{ old('location', $project->location) }}"
                                        placeholder="e.g. Shanti Nagar, Dhaka">
                                    @error('location')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="location_bn" class="form-label custom-label">Location (বাংলা / Bangla)</label>
                                    <input type="text"
                                        class="form-control custom-input @error('location_bn') is-invalid @enderror"
                                        name="location_bn" id="location_bn" value="{{ old('location_bn', $project->location_bn) }}"
                                        placeholder="যেমন: শান্তিনগর, ঢাকা">
                                    @error('location_bn')
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

                                {{-- Short Description (EN & BN) --}}
                                <div class="col-md-6 col-12">
                                    <label for="short_description" class="form-label custom-label">Short Summary (English)</label>
                                    <textarea
                                        class="form-control custom-input @error('short_description') is-invalid @enderror"
                                        name="short_description" id="short_description" rows="3"
                                        placeholder="Concise overview in English..."
                                        style="resize: none;">{{ old('short_description', $project->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="short_description_bn" class="form-label custom-label">Short Summary (বাংলা / Bangla)</label>
                                    <textarea
                                        class="form-control custom-input @error('short_description_bn') is-invalid @enderror"
                                        name="short_description_bn" id="short_description_bn" rows="3"
                                        placeholder="সংক্ষিপ্ত বিবরণ বাংলায় লিখুন..."
                                        style="resize: none;">{{ old('short_description_bn', $project->short_description_bn) }}</textarea>
                                    @error('short_description_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Description (EN & BN) --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Full Project Overview (English)</label>
                                    <textarea class="form-control custom-input @error('description') is-invalid @enderror"
                                        name="description" id="description"
                                        rows="6" placeholder="Detailed story, beneficiary criteria, and fund execution plan in English...">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description_bn" class="form-label custom-label">Full Project Overview (বাংলা / Bangla)</label>
                                    <textarea class="form-control custom-input @error('description_bn') is-invalid @enderror"
                                        name="description_bn" id="description_bn"
                                        rows="6" placeholder="প্রকল্পের বিস্তারিত বিবরণ ও সার্বিক মানবকল্যাণমূলক তথ্য বাংলায় লিখুন...">{{ old('description_bn', $project->description_bn) }}</textarea>
                                    @error('description_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div>
                            </div>
                        </div>

                    {{-- Official Field Report & Structured Narrative --}}
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">Structured Field Report & Narrative (Official Report)</div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Background --}}
                                <div class="col-12">
                                    <label for="background" class="form-label custom-label">Project Background & Problem Context (English)</label>
                                    <textarea class="form-control custom-input @error('background') is-invalid @enderror" 
                                        name="background" id="background" rows="3" placeholder="Explain the community challenge, origin context, and need for this project...">{{ old('background', $project->background) }}</textarea>
                                    @error('background')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="background_bn" class="form-label custom-label">Project Background (বাংলা / Bangla)</label>
                                    <textarea class="form-control custom-input @error('background_bn') is-invalid @enderror" 
                                        name="background_bn" id="background_bn" rows="3" placeholder="প্রকল্পের পটভূমি ও প্রেক্ষাপট বাংলায় লিখুন...">{{ old('background_bn', $project->background_bn) }}</textarea>
                                    @error('background_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Objectives --}}
                                <div class="col-md-6 col-12">
                                    <label for="objectives" class="form-label custom-label">Key Objectives (English - One per line)</label>
                                    <textarea class="form-control custom-input @error('objectives') is-invalid @enderror" 
                                        name="objectives" id="objectives" rows="4" placeholder="Enter each objective on a new line...">{{ old('objectives', is_array($project->objectives) ? implode("\n", $project->objectives) : $project->objectives) }}</textarea>
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">Type one objective per line.</small>
                                    @error('objectives')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="objectives_bn" class="form-label custom-label">Key Objectives (বাংলা - প্রতি লাইনে একটি)</label>
                                    <textarea class="form-control custom-input @error('objectives_bn') is-invalid @enderror" 
                                        name="objectives_bn" id="objectives_bn" rows="4" placeholder="প্রতি লাইনে একটি করে উদ্দেশ্য লিখুন...">{{ old('objectives_bn', is_array($project->objectives_bn) ? implode("\n", $project->objectives_bn) : $project->objectives_bn) }}</textarea>
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">প্রতি লাইনে একটি করে উদ্দেশ্য লিখুন।</small>
                                    @error('objectives_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Expected Impact & Outcomes --}}
                                <div class="col-md-6 col-12">
                                    <label for="impact_outcomes" class="form-label custom-label">Expected Impact & Outcomes (English - One per line)</label>
                                    <textarea class="form-control custom-input @error('impact_outcomes') is-invalid @enderror" 
                                        name="impact_outcomes" id="impact_outcomes" rows="4" placeholder="Enter each outcome/benefit on a new line...">{{ old('impact_outcomes', is_array($project->impact_outcomes) ? implode("\n", $project->impact_outcomes) : $project->impact_outcomes) }}</textarea>
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">Type one outcome per line.</small>
                                    @error('impact_outcomes')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="impact_outcomes_bn" class="form-label custom-label">Expected Impact & Outcomes (বাংলা - প্রতি লাইনে একটি)</label>
                                    <textarea class="form-control custom-input @error('impact_outcomes_bn') is-invalid @enderror" 
                                        name="impact_outcomes_bn" id="impact_outcomes_bn" rows="4" placeholder="প্রতি লাইনে একটি করে সুফল/ফলাফল লিখুন...">{{ old('impact_outcomes_bn', is_array($project->impact_outcomes_bn) ? implode("\n", $project->impact_outcomes_bn) : $project->impact_outcomes_bn) }}</textarea>
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">প্রতি লাইনে একটি করে সুফল লিখুন।</small>
                                    @error('impact_outcomes_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Challenges --}}
                                <div class="col-md-6 col-12">
                                    <label for="challenges" class="form-label custom-label">Implementation Challenges (English - One per line)</label>
                                    <textarea class="form-control custom-input @error('challenges') is-invalid @enderror" 
                                        name="challenges" id="challenges" rows="3" placeholder="Enter challenges faced/addressed on a new line...">{{ old('challenges', is_array($project->challenges) ? implode("\n", $project->challenges) : $project->challenges) }}</textarea>
                                    @error('challenges')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="challenges_bn" class="form-label custom-label">Implementation Challenges (বাংলা - প্রতি লাইনে একটি)</label>
                                    <textarea class="form-control custom-input @error('challenges_bn') is-invalid @enderror" 
                                        name="challenges_bn" id="challenges_bn" rows="3" placeholder="বাস্তবায়ন চ্যালেঞ্জসমূহ প্রতি লাইনে একটি করে লিখুন...">{{ old('challenges_bn', is_array($project->challenges_bn) ? implode("\n", $project->challenges_bn) : $project->challenges_bn) }}</textarea>
                                    @error('challenges_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Conclusion --}}
                                <div class="col-12">
                                    <label for="conclusion" class="form-label custom-label">Project Conclusion & Rotary Commitment (English)</label>
                                    <textarea class="form-control custom-input @error('conclusion') is-invalid @enderror" 
                                        name="conclusion" id="conclusion" rows="3" placeholder="Closing remarks, official handover statement, or Rotary commitment in English...">{{ old('conclusion', $project->conclusion) }}</textarea>
                                    @error('conclusion')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="conclusion_bn" class="form-label custom-label">Project Conclusion & Rotary Commitment (বাংলা / Bangla)</label>
                                    <textarea class="form-control custom-input @error('conclusion_bn') is-invalid @enderror" 
                                        name="conclusion_bn" id="conclusion_bn" rows="3" placeholder="সমাপনী বক্তব্য ও রোটারির অঙ্গীকার বাংলায় লিখুন...">{{ old('conclusion_bn', $project->conclusion_bn) }}</textarea>
                                    @error('conclusion_bn')
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
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100"
                                                style="background-color: #005daa; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
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
    @include('admin.includes.ckeditor-script')
@endpush