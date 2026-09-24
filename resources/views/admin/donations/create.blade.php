@extends('admin.app')
@section('title')
    Record New Donation
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="donationCreateForm" action="{{ route('admin.donations.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                {{-- Main Donation Details --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">New Donation Entry</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.donations.index') }}">Donations</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">New Entry</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.donations.index') }}" class="add-new">
                                <i class="ri-list-check me-1"></i> Donation List
                            </a>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Donor Selection with Quick Add Option --}}
                                <div class="col-md-7 col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label for="donor_id" class="form-label custom-label mb-0">Select Existing Donor</label>
                                        <button type="button" id="toggleNewDonorBtn" class="btn btn-link p-0 text-decoration-none" style="font-size: 12px; color: #f65024; font-weight: 600;">
                                            + Or Add New Donor
                                        </button>
                                    </div>
                                    <select class="form-select custom-input @error('donor_id') is-invalid @enderror" name="donor_id" id="donor_id">
                                        <option value="">-- Anonymous / General Donor --</option>
                                        @foreach($donors as $donor)
                                            <option value="{{ $donor->id }}" {{ (old('donor_id', request('donor_id')) == $donor->id) ? 'selected' : '' }}>
                                                {{ $donor->name }} {{ $donor->phone ? "({$donor->phone})" : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('donor_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Receipt Number --}}
                                <div class="col-md-5 col-12">
                                    <label for="receipt_number" class="form-label custom-label">Receipt Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input font-monospace @error('receipt_number') is-invalid @enderror"
                                        name="receipt_number" id="receipt_number" value="{{ old('receipt_number', $suggestedReceiptNumber) }}" required>
                                    @error('receipt_number')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Quick New Donor Row (Collapsible) --}}
                                <div class="col-12" id="newDonorContainer" style="{{ old('new_donor_name') ? '' : 'display: none;' }}">
                                    <div class="p-3 rounded border" style="background: #fff8f6; border-color: rgba(246, 80, 36, 0.2) !important;">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold" style="font-size: 13px; color: #f65024;">
                                                <i class="ri-user-add-line me-1"></i> Quick Register New Donor
                                            </span>
                                            <button type="button" id="closeNewDonorBtn" class="btn btn-sm btn-link text-muted p-0" style="font-size: 11.5px;">Close</button>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-4 col-12">
                                                <input type="text" class="form-control form-control-sm custom-input" name="new_donor_name" id="new_donor_name"
                                                    value="{{ old('new_donor_name') }}" placeholder="Full Name (Required)">
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <input type="text" class="form-control form-control-sm custom-input" name="new_donor_phone" id="new_donor_phone"
                                                    value="{{ old('new_donor_phone') }}" placeholder="Phone / Mobile">
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <input type="email" class="form-control form-control-sm custom-input" name="new_donor_email" id="new_donor_email"
                                                    value="{{ old('new_donor_email') }}" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Project / Cause Allocation --}}
                                <div class="col-md-6 col-12">
                                    <label for="project_id" class="form-label custom-label">Allocate to Specific Project / Cause</label>
                                    <select class="form-select custom-input @error('project_id') is-invalid @enderror" name="project_id" id="project_id">
                                        <option value="">General Relief &amp; Operational Fund</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ (old('project_id', request('project_id')) == $project->id) ? 'selected' : '' }}>
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
                                        name="purpose" id="purpose" value="{{ old('purpose') }}" placeholder="e.g. Zakat, Sadaqah Jariyah, Medical Relief, Orphan Aid">
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
                                            name="amount" id="amount" value="{{ old('amount') }}" placeholder="e.g. 5000" required>
                                    </div>
                                    @error('amount')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="donation_date" class="form-label custom-label">Date of Donation <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-input @error('donation_date') is-invalid @enderror"
                                        name="donation_date" id="donation_date" value="{{ old('donation_date', date('Y-m-d')) }}" onclick="this.showPicker()" required>
                                    @error('donation_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Payment Method & Transaction ID --}}
                                <div class="col-md-6 col-12">
                                    <label for="payment_method" class="form-label custom-label">Payment Channel <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('payment_method') is-invalid @enderror" name="payment_method" id="payment_method" required>
                                        @foreach($paymentMethods as $pmKey => $pmLabel)
                                            <option value="{{ $pmKey }}" {{ old('payment_method', 'Cash') == $pmKey ? 'selected' : '' }}>
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
                                        name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}" placeholder="e.g. BK-8899AA77 or CHQ-DBBL-4455">
                                    @error('transaction_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Notes --}}
                                <div class="col-12">
                                    <label for="notes" class="form-label custom-label">Receipt / Audit Remarks</label>
                                    <textarea class="form-control custom-input @error('notes') is-invalid @enderror"
                                        name="notes" id="notes" rows="3" placeholder="Special instructions or donor message...">{{ old('notes') }}</textarea>
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
                                        <option value="{{ $stKey }}" {{ old('status', 'completed') == $stKey ? 'selected' : '' }}>
                                            {{ $stLabel }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="currency" value="BDT">

                            <div class="row g-2 pt-2 border-top">
                                <div class="col-6">
                                    <button type="submit" class="btn submit-button w-100" style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                        <i class="ri-check-line me-1"></i> Save &amp; Print
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

@push('custom-script')
    <script>
        $(document).ready(function () {
            $('#toggleNewDonorBtn').on('click', function () {
                $('#newDonorContainer').slideToggle(200);
            });
            $('#closeNewDonorBtn').on('click', function () {
                $('#newDonorContainer').slideUp(200);
                $('#new_donor_name, #new_donor_phone, #new_donor_email').val('');
            });
        });
    </script>
@endpush
