@extends('admin.app')
@section('title')
    My Profile &amp; Account Settings
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">My Profile &amp; Security</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="card-body" style="padding: 24px;">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="font-size: 13.5px;">
                                <i class="ri-checkbox-circle-line me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 13.5px;">
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="row g-4">
                            {{-- Left Column: Profile Card --}}
                            <div class="col-lg-4 col-12">
                                <div class="card border text-center p-4"
                                    style="border-radius: 12px; background-color: #f8fafc;">
                                    <div class="mb-3 d-flex justify-content-center">
                                        @if(!empty($user->image) && file_exists(public_path($user->image)))
                                            <img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="100"
                                                height="100" class="rounded-circle object-fit-cover shadow-sm"
                                                style="border: 3px solid #f95716;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm"
                                                style="width: 100px; height: 100px; background-color: #f95716; font-size: 38px; font-weight: 700;">
                                                {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 17px;">{{ $user->name }}</h5>
                                    <p class="text-muted mb-2" style="font-size: 13px;">{{ $user->email }}</p>

                                    <div class="d-flex justify-content-center gap-2 mb-3">
                                        <span class="badge"
                                            style="background-color: #fff3ee; color: #f95716; border: 1px solid rgba(249, 87, 22, 0.3); font-size: 11px; padding: 4px 10px; font-weight: 600;">
                                            {{ ucwords(str_replace('-', ' ', $user->role ?? 'Administrator')) }}
                                        </span>
                                        <span class="badge"
                                            style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 11px; padding: 4px 10px; font-weight: 600;">
                                            <i class="ri-checkbox-circle-fill me-1"></i>Active
                                        </span>
                                    </div>

                                    <hr style="border-color: #e2e8f0;">

                                    <div class="text-start" style="font-size: 12.5px;">
                                        <div class="d-flex justify-content-between py-1 text-muted">
                                            <span>Phone:</span>
                                            <strong class="text-dark">{{ $user->phone ?? 'Not provided' }}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between py-1 text-muted">
                                            <span>Member Since:</span>
                                            <strong
                                                class="text-dark">{{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Right Column: Edit Details & Security Forms --}}
                            <div class="col-lg-8 col-12">
                                {{-- 1. Personal Details Form --}}
                                <div class="card border mb-4" style="border-radius: 12px;">
                                    <div class="card-header border-bottom py-3" style="background-color: transparent;">
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 15px;">
                                            <i class="ri-user-settings-line text-primary me-1"></i> Personal Profile
                                            Information
                                        </h6>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="POST" action="{{ route('admin.profile.update') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row g-3">
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Full Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control form-control-sm"
                                                        value="{{ old('name', $user->name) }}" required
                                                        style="font-size: 13px; height: 38px;">
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Email Address <span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control form-control-sm"
                                                        value="{{ old('email', $user->email) }}" required
                                                        style="font-size: 13px; height: 38px;">
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Phone Number</label>
                                                    <input type="text" name="phone" class="form-control form-control-sm"
                                                        value="{{ old('phone', $user->phone) }}"
                                                        placeholder="+880 1711-XXXXXX"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Account Role</label>
                                                    <input type="text" class="form-control form-control-sm bg-light"
                                                        value="{{ ucwords(str_replace('-', ' ', $user->role ?? 'Administrator')) }}"
                                                        disabled style="font-size: 13px; height: 38px;">
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <label class="form-label text-dark fw-semibold d-block mb-1"
                                                        style="font-size: 13px;">Profile Photo</label>
                                                    @include('admin.includes.image-uploader', [
                                                        'name' => 'image',
                                                        'label' => 'Upload Profile Photo',
                                                        'modalTitle' => 'Upload Admin Profile Photo',
                                                        'helpText' => 'JPG, PNG, WebP up to 2MB (Square / Circle recommended)',
                                                        'currentImage' => $user->image && (file_exists(public_path($user->image)) || str_starts_with($user->image, 'http')) ? asset($user->image) : null,
                                                        'currentName' => $user->name ?? 'Admin Photo',
                                                        'shape' => 'circle',
                                                        'height' => '130px'
                                                    ])
                                                </div>
                                            </div>

                                            <div class="mt-4 text-end">
                                                <button type="submit" class="btn btn-sm btn-primary px-4"
                                                    style="height: 38px; font-size: 13.5px; border-radius: 6px; font-weight: 600;">
                                                    <i class="ri-save-line me-1"></i> Save Profile Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- 2. Password Change Form --}}
                                <div class="card border" style="border-radius: 12px;">
                                    <div class="card-header border-bottom py-3" style="background-color: transparent;">
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 15px;">
                                            <i class="ri-lock-password-line text-warning me-1"></i> Update Security Password
                                        </h6>
                                    </div>
                                    <div class="card-body p-4">
                                        <form method="POST" action="{{ route('admin.profile.password') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="row g-3">
                                                <div class="col-md-4 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Current Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="current_password"
                                                        class="form-control form-control-sm" required
                                                        style="font-size: 13px; height: 38px;">
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">New Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="password"
                                                        class="form-control form-control-sm" required
                                                        style="font-size: 13px; height: 38px;">
                                                </div>

                                                <div class="col-md-4 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Confirm Password <span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control form-control-sm" required
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                            </div>

                                            <div class="mt-4 text-end">
                                                <button type="submit" class="btn btn-sm btn-dark px-4"
                                                    style="height: 38px; font-size: 13.5px; border-radius: 6px; font-weight: 600;">
                                                    <i class="ri-shield-check-line me-1"></i> Update Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection