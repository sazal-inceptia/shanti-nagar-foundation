@extends('admin.app')
@section('title')
    Edit Staff Profile &mdash; {{ $employee->name }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="employeeEditForm" action="{{ route('admin.employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Main Employee Details (Left 8 Cols) --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Employee Profile</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Staff</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.employees.show', $employee->id) }}" class="add-new" style="background-color: #eff6ff; color: #1e40af;">
                                    <i class="ri-user-line me-1"></i> View Profile
                                </a>
                                <a href="{{ route('admin.employees.index') }}" class="add-new">
                                    <i class="ri-team-line me-1"></i> Staff Directory
                                </a>
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Employee ID & Full Name (EN & BN) --}}
                                <div class="col-md-4 col-12">
                                    <label for="employee_id" class="form-label custom-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input font-monospace @error('employee_id') is-invalid @enderror"
                                        name="employee_id" id="employee_id" value="{{ old('employee_id', $employee->employee_id) }}" required>
                                    <div class="text-muted mt-1" style="font-size: 11px;">Unique employee identification code</div>
                                    @error('employee_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="name" class="form-label custom-label">Full Name (English) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $employee->name) }}" required>
                                    @error('name')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="name_bn" class="form-label custom-label">Full Name (বাংলা / Bangla)</label>
                                    <input type="text" class="form-control custom-input @error('name_bn') is-invalid @enderror"
                                        name="name_bn" id="name_bn" value="{{ old('name_bn', $employee->name_bn) }}" placeholder="যেমন: মো: তরিকুল ইসলাম">
                                    @error('name_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Designation / Role --}}
                                <div class="col-md-6 col-12">
                                    <label for="designation_id" class="form-label custom-label">Designation / Role <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('designation_id') is-invalid @enderror" name="designation_id" id="designation_id" required>
                                        <option value="">Select Designation...</option>
                                        @foreach($designations as $desig)
                                            <option value="{{ $desig->id }}" {{ old('designation_id', $employee->designation_id) == $desig->id ? 'selected' : '' }}>
                                                {{ $desig->name }} {{ $desig->category ? '('.$desig->category.')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Contact: Phone & Email --}}
                                <div class="col-md-6 col-12">
                                    <label for="phone" class="form-label custom-label">Phone Number</label>
                                    <input type="text" class="form-control custom-input @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" placeholder="e.g. +880 1711-223344">
                                    @error('phone')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="email" class="form-label custom-label">Email Address</label>
                                    <input type="email" class="form-control custom-input @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email', $employee->email) }}" placeholder="e.g. staff@rotaryshantinagardhaka.org">
                                    @error('email')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Joining Date, Base Salary, Status --}}
                                <div class="col-md-4 col-12">
                                    <label for="joining_date" class="form-label custom-label">Joining Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-input @error('joining_date') is-invalid @enderror"
                                        name="joining_date" id="joining_date" value="{{ old('joining_date', $employee->joining_date?->format('Y-m-d')) }}" onclick="this.showPicker()" required>
                                    @error('joining_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="base_salary" class="form-label custom-label">Basic Monthly Salary (৳) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0" class="form-control custom-input @error('base_salary') is-invalid @enderror"
                                            name="base_salary" id="base_salary" value="{{ old('base_salary', $employee->base_salary) }}" required>
                                    </div>
                                    @error('base_salary')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="is_active" class="form-label custom-label">Status</label>
                                    <div class="form-check form-switch pt-2">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_active" id="is_active" value="1"
                                            {{ old('is_active', $employee->is_active) ? 'checked' : '' }} style="width: 40px; height: 20px; cursor: pointer;">
                                        <label class="form-check-label ms-2 fw-semibold text-dark" for="is_active" style="font-size: 13px;">
                                            Active Staff Member
                                        </label>
                                    </div>
                                    @error('is_active')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- NID Number --}}
                                <div class="col-md-6 col-12">
                                    <label for="nid_number" class="form-label custom-label">National ID (NID / Smart Card #)</label>
                                    <input type="text" class="form-control custom-input @error('nid_number') is-invalid @enderror"
                                        name="nid_number" id="nid_number" value="{{ old('nid_number', $employee->nid_number) }}">
                                    @error('nid_number')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="present_address" class="form-label custom-label">Present Address</label>
                                    <input type="text" class="form-control custom-input @error('present_address') is-invalid @enderror"
                                        name="present_address" id="present_address" value="{{ old('present_address', $employee->present_address) }}">
                                    @error('present_address')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="permanent_address" class="form-label custom-label">Permanent Address</label>
                                    <textarea class="form-control custom-input @error('permanent_address') is-invalid @enderror"
                                        name="permanent_address" id="permanent_address" rows="2">{{ old('permanent_address', $employee->permanent_address) }}</textarea>
                                    @error('permanent_address')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Rotary Leadership & Roll of Honour Details Card --}}
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="table-title">
                                <i class="ri-medal-line me-1 text-primary"></i> Rotary Leadership &amp; Roll of Honour (Optional)
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <p class="text-muted mb-3" style="font-size: 12px; line-height: 1.5;">
                                Fill in these fields for Executive Officers, Spotlight Founder, or Past Presidents shown on the About page.
                            </p>
                            <div class="row g-3">
                                {{-- Distinction / Badge Title & Tenure --}}
                                <div class="col-md-6 col-12">
                                    <label for="badge_title" class="form-label custom-label">Distinction / Badge Title</label>
                                    <input type="text" class="form-control custom-input @error('badge_title') is-invalid @enderror"
                                        name="badge_title" id="badge_title" value="{{ old('badge_title', $employee->badge_title) }}" placeholder="e.g. PHF, Major Donor, Charter President">
                                    @error('badge_title')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-6">
                                    <label for="tenure" class="form-label custom-label">Tenure Period</label>
                                    <input type="text" class="form-control custom-input @error('tenure') is-invalid @enderror"
                                        name="tenure" id="tenure" value="{{ old('tenure', $employee->tenure) }}" placeholder="e.g. 2018 – 2019">
                                    @error('tenure')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-6">
                                    <label for="year_badge" class="form-label custom-label">Year Badge Tag</label>
                                    <input type="text" class="form-control custom-input @error('year_badge') is-invalid @enderror"
                                        name="year_badge" id="year_badge" value="{{ old('year_badge', $employee->year_badge) }}" placeholder="e.g. 2018-19">
                                    @error('year_badge')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Presidential Theme (EN & BN) --}}
                                <div class="col-md-6 col-12">
                                    <label for="rotary_theme" class="form-label custom-label">Rotary Presidential Theme (English)</label>
                                    <input type="text" class="form-control custom-input @error('rotary_theme') is-invalid @enderror"
                                        name="rotary_theme" id="rotary_theme" value="{{ old('rotary_theme', $employee->rotary_theme) }}" placeholder='e.g. "Be the Inspiration"'>
                                    @error('rotary_theme')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="rotary_theme_bn" class="form-label custom-label">Rotary Presidential Theme (বাংলা)</label>
                                    <input type="text" class="form-control custom-input @error('rotary_theme_bn') is-invalid @enderror"
                                        name="rotary_theme_bn" id="rotary_theme_bn" value="{{ old('rotary_theme_bn', $employee->rotary_theme_bn) }}" placeholder="যেমন: বি দ্য ইন্সপিরেশন">
                                    @error('rotary_theme_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Focus Area / Major Milestone (EN & BN) --}}
                                <div class="col-md-6 col-12">
                                    <label for="focus_area" class="form-label custom-label">Key Focus / Milestone (English)</label>
                                    <input type="text" class="form-control custom-input @error('focus_area') is-invalid @enderror"
                                        name="focus_area" id="focus_area" value="{{ old('focus_area', $employee->focus_area) }}" placeholder="e.g. Deep Tube-Wells & Safe Water">
                                    @error('focus_area')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="focus_area_bn" class="form-label custom-label">Key Focus / Milestone (বাংলা)</label>
                                    <input type="text" class="form-control custom-input @error('focus_area_bn') is-invalid @enderror"
                                        name="focus_area_bn" id="focus_area_bn" value="{{ old('focus_area_bn', $employee->focus_area_bn) }}" placeholder="যেমন: গভীর নলকূপ ও নিরাপদ পানি">
                                    @error('focus_area_bn')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Speech / Vision Quote & Bio --}}
                                <div class="col-12">
                                    <label for="speech" class="form-label custom-label">Executive Speech / Vision Quote</label>
                                    <textarea class="form-control custom-input @error('speech') is-invalid @enderror"
                                        name="speech" id="speech" rows="2" placeholder="Leader speech or quote shown in leadership card...">{{ old('speech', $employee->speech) }}</textarea>
                                    @error('speech')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="order_index" class="form-label custom-label">Display Order Index</label>
                                    <input type="number" min="0" class="form-control custom-input @error('order_index') is-invalid @enderror"
                                        name="order_index" id="order_index" value="{{ old('order_index', $employee->order_index) }}">
                                    @error('order_index')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="signature_text" class="form-label custom-label">Signature Display Name</label>
                                    <input type="text" class="form-control custom-input @error('signature_text') is-invalid @enderror"
                                        name="signature_text" id="signature_text" value="{{ old('signature_text', $employee->signature_text) }}" placeholder="e.g. Rtn. Md. Ariful Hoque PHF">
                                    @error('signature_text')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="signature_title" class="form-label custom-label">Signature Title</label>
                                    <input type="text" class="form-control custom-input @error('signature_title') is-invalid @enderror"
                                        name="signature_title" id="signature_title" value="{{ old('signature_title', $employee->signature_title) }}" placeholder="e.g. President • Rotary Club of Shantinagar">
                                    @error('signature_title')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Actions & Unified Image Uploader (Right 4 Cols) --}}
                <div class="col-lg-4 col-12">
                    <div class="row g-3">
                        {{-- Save Actions --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Update Actions</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    <p class="text-muted mb-3" style="font-size: 12px; line-height: 1.5;">
                                        Updating staff details automatically syncs with payroll processing and generated payslips.
                                    </p>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100" style="background-color: #005daa; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                                <i class="ri-check-line me-1"></i> Update Staff
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin.employees.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Unified Interactive Image Uploader Component --}}
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-header table-header">
                                    <div class="table-title">Staff Profile Photo</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @php
                                        $currentPhotoPath = $employee->photo && file_exists(public_path($employee->photo))
                                            ? asset($employee->photo)
                                            : null;
                                    @endphp
                                    @include('admin.includes.image-uploader', [
                                        'name'         => 'photo',
                                        'label'        => 'Upload Staff Picture',
                                        'modalTitle'   => 'Update Staff Profile Photo',
                                        'helpText'     => 'JPG, PNG, WebP up to 5MB (Square or Circle recommended)',
                                        'currentImage' => $currentPhotoPath,
                                        'currentName'  => basename((string)$employee->photo) ?: 'Employee Photo',
                                        'shape'        => 'circle',
                                        'height'       => '170px'
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
