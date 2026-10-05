@extends('admin.app')
@section('title')
    Create New Activity
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="activityForm" action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
                {{-- Main Form Left Column --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Activity Information</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.activities.index') }}">Activities</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.activities.index') }}" class="add-new">
                                <i class="ri-list-check me-1"></i> Activity List
                            </a>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Activity Titles (EN & BN) --}}
                                <div class="col-md-6 col-12">
                                    <label for="title" class="form-label custom-label">Activity Title (English) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('title') is-invalid @enderror"
                                        name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Winter Warmth & Blanket Distribution Camp" required>
                                    @error('title')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="title_bn" class="form-label custom-label">Activity Title (বাংলা / Bangla)</label>
                                    <input type="text" class="form-control custom-input @error('title_bn') is-invalid @enderror" 
                                        name="title_bn" id="title_bn" value="{{ old('title_bn') }}" placeholder="যেমন: শীতবস্ত্র ও কম্বল বিতরণ কর্মসূচি">
                                    @error('title_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Date, Time & Status --}}
                                <div class="col-md-4 col-12">
                                    <label for="event_date" class="form-label custom-label">Activity Date</label>
                                    <input type="date" class="form-control custom-input @error('event_date') is-invalid @enderror"
                                        name="event_date" id="event_date" value="{{ old('event_date') }}" onclick="this.showPicker()">
                                    @error('event_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="event_time" class="form-label custom-label">Time / Schedule</label>
                                    <input type="text" class="form-control custom-input @error('event_time') is-invalid @enderror"
                                        name="event_time" id="event_time" value="{{ old('event_time') }}" placeholder="e.g. 09:00 AM - 03:00 PM">
                                    @error('event_time')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="status" class="form-label custom-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('status') is-invalid @enderror" name="status" id="status" required>
                                        <option value="upcoming" {{ old('status', 'upcoming') == 'upcoming' ? 'selected' : '' }}>Upcoming (Scheduled)</option>
                                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing (Happening Now)</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed (Past Activity)</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('status')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Location (EN & BN) --}}
                                <div class="col-md-6 col-12">
                                    <label for="location" class="form-label custom-label">Venue / Location (English)</label>
                                    <input type="text" class="form-control custom-input @error('location') is-invalid @enderror"
                                        name="location" id="location" value="{{ old('location') }}" placeholder="e.g. Shantinagar Community Center, Dhaka">
                                    @error('location')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="location_bn" class="form-label custom-label">Venue / Location (বাংলা / Bangla)</label>
                                    <input type="text" class="form-control custom-input @error('location_bn') is-invalid @enderror"
                                        name="location_bn" id="location_bn" value="{{ old('location_bn') }}" placeholder="যেমন: শান্তিনগর কমিউনিটি সেন্টার, ঢাকা">
                                    @error('location_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Short Descriptions --}}
                                <div class="col-md-6 col-12">
                                    <label for="short_description" class="form-label custom-label">Short Summary (English)</label>
                                    <textarea class="form-control custom-input @error('short_description') is-invalid @enderror"
                                        name="short_description" id="short_description" rows="3" placeholder="Brief 1-2 sentence overview">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="short_description_bn" class="form-label custom-label">Short Summary (বাংলা)</label>
                                    <textarea class="form-control custom-input @error('short_description_bn') is-invalid @enderror"
                                        name="short_description_bn" id="short_description_bn" rows="3" placeholder="সংক্ষিপ্ত সারসংক্ষেপ">{{ old('short_description_bn') }}</textarea>
                                    @error('short_description_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Descriptions (CKEditor) --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Full Activity Details (English)</label>
                                    <textarea class="form-control custom-input ckeditor-input @error('description') is-invalid @enderror"
                                        name="description" id="description" rows="6" placeholder="Detailed objective, beneficiaries, schedule, and volunteer requirements">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="description_bn" class="form-label custom-label">Full Activity Details (বাংলা)</label>
                                    <textarea class="form-control custom-input ckeditor-input @error('description_bn') is-invalid @enderror"
                                        name="description_bn" id="description_bn" rows="6" placeholder="কার্যক্রমের বিস্তারিত বর্ণনা">{{ old('description_bn') }}</textarea>
                                    @error('description_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar Settings & Media Right Column --}}
                <div class="col-lg-4 col-12">
                    {{-- Publishing Controls Card --}}
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title" style="font-size: 14px;">Publishing Options</div>
                        </div>
                        <div class="card-body p-3">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="is_published">Publish on Website</label>
                                <div class="text-muted" style="font-size: 11.5px;">Visible on public activities &amp; home pages</div>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold text-dark" for="is_featured">Featured Activity</label>
                                <div class="text-muted" style="font-size: 11.5px;">Highlight in top spotlights &amp; homepage</div>
                            </div>

                            <div class="mb-3">
                                <label for="sort_order" class="form-label custom-label">Display Order Index</label>
                                <input type="number" class="form-control form-control-sm custom-input" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}">
                            </div>

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <button type="submit" class="btn submit-button w-100" style="background-color: #005daa; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                        <i class="ri-check-line me-1"></i> Save Activity
                                    </button>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.activities.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Featured Cover Photo (Matching Project Module) --}}
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">Featured Image (Cover Photo)</div>
                        </div>
                        <div class="card-body custom-form p-3">
                            @include('admin.includes.image-uploader', [
                                'name' => 'featured_image',
                                'label' => 'Upload Cover Photo',
                                'modalTitle' => 'Upload Activity Cover Photo',
                                'helpText' => 'JPG, PNG, WebP up to 5MB (1200×800px recommended)',
                                'shape' => 'rectangle',
                                'height' => '170px'
                            ])
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
