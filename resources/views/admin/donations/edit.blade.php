@extends('admin.app')
@section('title')
    Edit Donation &mdash; {{ $donation->receipt_number }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="donationEditForm" action="{{ route('admin.donations.update', $donation->id) }}" method="POST" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Donation Record: {{ $donation->receipt_number }}</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.donations.index') }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                    <i class="ri-list-check me-1"></i> Donation List
                                </a>
                                <a href="{{ route('admin.donations.show', $donation->id) }}" class="add-new">
                                    <i class="ri-printer-line me-1"></i> View Receipt
                                </a>
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Donor Selection --}}
                                <div class="col-md-7 col-12">
                                    <label for="donor_id" class="form-label custom-label">Donor Profile</label>
                                    <select class="form-select custom-input @error('donor_id') is-invalid @enderror" name="donor_id" id="donor_id">
                                        <option value="">-- Anonymous / General Donor --</option>
                                        @foreach($donors as $donor)
                                            <option value="{{ $donor->id }}" {{ old('donor_id', $donation->donor_id) == $donor->id ? 'selected' : '' }}>
                                                {{ $donor->name }} {{ $donor->phone ? "({$donor->phone})" : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('donor_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Receipt Number (Readonly in edit) --}}
                                <div class="col-md-5 col-12">
                                    <label class="form-label custom-label">Receipt Number</label>
                                    <input type="text" class="form-control custom-input font-monospace" value="{{ $donation->receipt_number }}" readonly style="background-color: #f8fafc;">
                                </div>

                                {{-- Project / Cause Allocation --}}
                                <div class="col-md-6 col-12">
                                    <label for="project_id" class="form-label custom-label">Allocate to Specific Project / Cause</label>
                                    <select class="form-select custom-input @error('project_id') is-invalid @enderror" name="project_id" id="project_id">
                                        <option value="">General Relief &amp; Operational Fund</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ old('project_id', $donation->project_id) == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }} ({{ $project->category ?? 'General' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Donation Purpose --}}
                                <div class="col-md-6 col-12">
                                    <label for="purpose" class="form-label custom-label">Donation Purpose / Sector</label>
                                    <input type="text" class="form-control custom-input @error('purpose') is-invalid @enderror"
                                        name="purpose" id="purpose" value="{{ old('purpose', $donation->purpose) }}" placeholder="e.g. Zakat, Sadaqah Jariyah, Medical Relief, Orphan Aid">
                                    @error('purpose')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Amount & Currency --}}
                                <div class="col-md-6 col-12">
                                    <label for="amount" class="form-label custom-label">Donation Amount (৳ BDT) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="1" class="form-control custom-input @error('amount') is-invalid @enderror"
                                            name="amount" id="amount" value="{{ old('amount', $donation->amount) }}" required>
                                    </div>
                                    @error('amount')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="donation_date" class="form-label custom-label">Date of Donation <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-input @error('donation_date') is-invalid @enderror"
                                        name="donation_date" id="donation_date" value="{{ old('donation_date', $donation->donation_date?->format('Y-m-d')) }}" onclick="this.showPicker()" required>
                                    @error('donation_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Payment Method & Transaction ID --}}
                                <div class="col-md-6 col-12">
                                    <label for="payment_method" class="form-label custom-label">Payment Channel <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('payment_method') is-invalid @enderror" name="payment_method" id="payment_method" required>
                                        @foreach($paymentMethods as $pmKey => $pmLabel)
                                            <option value="{{ $pmKey }}" {{ old('payment_method', $donation->payment_method) == $pmKey ? 'selected' : '' }}>
                                                {{ $pmLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payment_method')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="transaction_id" class="form-label custom-label">Transaction ID / Cheque / Trx No.</label>
                                    <input type="text" class="form-control custom-input @error('transaction_id') is-invalid @enderror"
                                        name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $donation->transaction_id) }}">
                                    @error('transaction_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Notes --}}
                                <div class="col-12">
                                    <label for="notes" class="form-label custom-label">Receipt / Audit Remarks</label>
                                    <textarea class="form-control custom-input @error('notes') is-invalid @enderror"
                                        name="notes" id="notes" rows="3">{{ old('notes', $donation->notes) }}</textarea>
                                    @error('notes')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Status & Submit --}}
                <div class="col-lg-4 col-12">
                    <div class="card table-card">
                        <div class="card-header table-header">
                            <div class="table-title">Verification &amp; Print</div>
                        </div>
                        <div class="card-body custom-form p-3">
                            <div class="mb-3">
                                <label for="status" class="form-label custom-label">Transaction Status <span class="text-danger">*</span></label>
                                <select class="form-select custom-input @error('status') is-invalid @enderror" name="status" id="status" required>
                                    @foreach($statuses as $stKey => $stLabel)
                                        <option value="{{ $stKey }}" {{ old('status', $donation->status) == $stKey ? 'selected' : '' }}>
                                            {{ $stLabel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="currency" value="{{ $donation->currency ?? 'BDT' }}">

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <button type="submit" class="btn submit-button w-100" style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                        <i class="ri-check-line me-1"></i> Update Record
                                    </button>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.donations.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
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
