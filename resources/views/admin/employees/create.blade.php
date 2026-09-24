@extends('admin.app')
@section('title')
    Register Staff Profile
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="employeeCreateForm" action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div class="row">
                {{-- Main Employee Details (Left 8 Cols) --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Employee Profile Information</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Staff</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.employees.index') }}" class="add-new">
                                <i class="ri-team-line me-1"></i> Staff Directory
                            </a>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Employee ID & Full Name --}}
                                <div class="col-md-5 col-12">
                                    <label for="employee_id" class="form-label custom-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input font-monospace @error('employee_id') is-invalid @enderror"
                                        name="employee_id" id="employee_id" value="{{ old('employee_id', $suggestedEmployeeId) }}" required>
                                    <div class="text-muted mt-1" style="font-size: 11px;">Auto-generated sequential employee code</div>
                                    @error('employee_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-7 col-12">
                                    <label for="name" class="form-label custom-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name') }}" placeholder="e.g. Md. Tariqul Islam" required>
                                    @error('name')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Designation & Department --}}
                                <div class="col-md-6 col-12">
                                    <label for="designation" class="form-label custom-label">Designation / Role <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('designation') is-invalid @enderror"
                                        name="designation" id="designation" value="{{ old('designation') }}" placeholder="e.g. Senior Field Coordinator" required>
                                    @error('designation')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="department" class="form-label custom-label">Department <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('department') is-invalid @enderror" name="department" id="department" required>
                                        <option value="">Select Department...</option>
                                        @foreach($departments as $deptKey => $deptLabel)
                                            <option value="{{ $deptKey }}" {{ old('department') == $deptKey ? 'selected' : '' }}>
                                                {{ $deptLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Contact: Phone & Email --}}
                                <div class="col-md-6 col-12">
                                    <label for="phone" class="form-label custom-label">Phone Number</label>
                                    <input type="text" class="form-control custom-input @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" value="{{ old('phone') }}" placeholder="e.g. +880 1711-223344">
                                    @error('phone')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="email" class="form-label custom-label">Email Address</label>
                                    <input type="email" class="form-control custom-input @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}" placeholder="e.g. tariqul@shantinagar.org">
                                    @error('email')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Joining Date, Base Salary, Status --}}
                                <div class="col-md-4 col-12">
                                    <label for="joining_date" class="form-label custom-label">Joining Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-input @error('joining_date') is-invalid @enderror"
                                        name="joining_date" id="joining_date" value="{{ old('joining_date', date('Y-m-d')) }}" onclick="this.showPicker()" required>
                                    @error('joining_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="base_salary" class="form-label custom-label">Basic Monthly Salary (৳) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0" class="form-control custom-input @error('base_salary') is-invalid @enderror"
                                            name="base_salary" id="base_salary" value="{{ old('base_salary') }}" placeholder="0.00" required>
                                    </div>
                                    @error('base_salary')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-12">
                                    <label for="employment_status" class="form-label custom-label">Employment Status <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('employment_status') is-invalid @enderror" name="employment_status" id="employment_status" required>
                                        @foreach($statuses as $stVal => $stLabel)
                                            <option value="{{ $stVal }}" {{ old('employment_status', 'active') == $stVal ? 'selected' : '' }}>
                                                {{ $stLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employment_status')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- NID Number --}}
                                <div class="col-md-6 col-12">
                                    <label for="nid_number" class="form-label custom-label">National ID (NID / Smart Card #)</label>
                                    <input type="text" class="form-control custom-input @error('nid_number') is-invalid @enderror"
                                        name="nid_number" id="nid_number" value="{{ old('nid_number') }}" placeholder="e.g. 19902692518000123">
                                    @error('nid_number')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="present_address" class="form-label custom-label">Present Address</label>
                                    <input type="text" class="form-control custom-input @error('present_address') is-invalid @enderror"
                                        name="present_address" id="present_address" value="{{ old('present_address') }}" placeholder="e.g. Flat 4B, Shanti Nagar, Dhaka">
                                    @error('present_address')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="permanent_address" class="form-label custom-label">Permanent Address</label>
                                    <textarea class="form-control custom-input @error('permanent_address') is-invalid @enderror"
                                        name="permanent_address" id="permanent_address" rows="2"
                                        placeholder="Permanent village/district address...">{{ old('permanent_address') }}</textarea>
                                    @error('permanent_address')
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
                                    <div class="table-title">Registration Actions</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    <p class="text-muted mb-3" style="font-size: 12px; line-height: 1.5;">
                                        Registering this staff profile enables monthly payroll disbursements, payslip generation, and service tracking.
                                    </p>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100" style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                                <i class="ri-check-line me-1"></i> Save Staff
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
                                    @include('admin.includes.image-uploader', [
                                        'name'        => 'photo',
                                        'label'       => 'Upload Staff Picture',
                                        'modalTitle'  => 'Upload Staff Profile Photo',
                                        'helpText'    => 'JPG, PNG, WebP up to 5MB (Square or Circle recommended)',
                                        'shape'       => 'circle',
                                        'height'      => '170px'
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
