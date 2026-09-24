@extends('admin.app')
@section('title')
    Edit Donor &mdash; {{ $donor->name }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="donorEditForm" action="{{ route('admin.donors.update', $donor->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Donor: {{ $donor->name }}</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.donors.index') }}">Donors</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.donors.index') }}" class="add-new">
                                <i class="ri-list-check me-1"></i> Donor List
                            </a>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Full Name --}}
                                <div class="col-md-8 col-12">
                                    <label for="name" class="form-label custom-label">Donor Name / Organization <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('name') is-invalid @enderror"
                                        name="name" id="name" value="{{ old('name', $donor->name) }}" required>
                                    @error('name')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Donor Type --}}
                                <div class="col-md-4 col-12">
                                    <label for="donor_type" class="form-label custom-label">Donor Category <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('donor_type') is-invalid @enderror" name="donor_type" id="donor_type" required>
                                        @foreach($donorTypes as $typeKey => $typeLabel)
                                            <option value="{{ $typeKey }}" {{ old('donor_type', $donor->donor_type instanceof \App\Enums\DonorType ? $donor->donor_type->value : $donor->donor_type) == $typeKey ? 'selected' : '' }}>
                                                {{ $typeLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('donor_type')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Phone & Email --}}
                                <div class="col-md-6 col-12">
                                    <label for="phone" class="form-label custom-label">Phone / WhatsApp Number</label>
                                    <input type="text" class="form-control custom-input @error('phone') is-invalid @enderror"
                                        name="phone" id="phone" value="{{ old('phone', $donor->phone) }}">
                                    @error('phone')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="email" class="form-label custom-label">Email Address</label>
                                    <input type="email" class="form-control custom-input @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email', $donor->email) }}">
                                    @error('email')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- City & Country --}}
                                <div class="col-md-6 col-12">
                                    <label for="city" class="form-label custom-label">City / District</label>
                                    <input type="text" class="form-control custom-input @error('city') is-invalid @enderror"
                                        name="city" id="city" value="{{ old('city', $donor->city) }}">
                                    @error('city')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="country" class="form-label custom-label">Country</label>
                                    <input type="text" class="form-control custom-input @error('country') is-invalid @enderror"
                                        name="country" id="country" value="{{ old('country', $donor->country) }}">
                                    @error('country')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Full Address --}}
                                <div class="col-12">
                                    <label for="address" class="form-label custom-label">Street Address / Organization HQ</label>
                                    <input type="text" class="form-control custom-input @error('address') is-invalid @enderror"
                                        name="address" id="address" value="{{ old('address', $donor->address) }}">
                                    @error('address')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Notes --}}
                                <div class="col-12">
                                    <label for="notes" class="form-label custom-label">Special Notes / Preferences</label>
                                    <textarea class="form-control custom-input @error('notes') is-invalid @enderror"
                                        name="notes" id="notes" rows="4">{{ old('notes', $donor->notes) }}</textarea>
                                    @error('notes')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Settings & Submit --}}
                <div class="col-lg-4 col-12">
                    <div class="card table-card">
                        <div class="card-header table-header">
                            <div class="table-title">Privacy &amp; Actions</div>
                        </div>
                        <div class="card-body custom-form p-3">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" name="is_anonymous" id="is_anonymous"
                                    value="1" {{ old('is_anonymous', $donor->is_anonymous) ? 'checked' : '' }} style="cursor: pointer;">
                                <label class="form-check-label fw-semibold" for="is_anonymous" style="font-size: 13.5px; cursor: pointer;">
                                    Mark as Anonymous Donor
                                </label>
                                <div class="text-muted mt-1" style="font-size: 11px;">
                                    Name will be masked on public financial disclosures and reports.
                                </div>
                            </div>

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <button type="submit" class="btn submit-button w-100" style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                        <i class="ri-check-line me-1"></i> Update Donor
                                    </button>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.donors.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
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
