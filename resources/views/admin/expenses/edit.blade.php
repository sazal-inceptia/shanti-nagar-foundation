@extends('admin.app')
@section('title')
    Edit Expense Voucher &mdash; {{ $expense->voucher_number }}
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="expenseEditForm" action="{{ route('admin.expenses.update', $expense->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="row">
                {{-- Main Expense Details (Left 8 Cols) --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">Edit Expense Voucher: {{ $expense->voucher_number }}</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.expenses.index') }}">Expenses</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.expenses.show', $expense->id) }}" class="add-new" style="background-color: #f1f5f9; color: #334155;">
                                    <i class="ri-printer-line me-1"></i> View Voucher
                                </a>
                                <a href="{{ route('admin.expenses.index') }}" class="add-new">
                                    <i class="ri-list-check me-1"></i> Expense List
                                </a>
                            </div>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Voucher Number & Expense Date --}}
                                <div class="col-md-6 col-12">
                                    <label for="voucher_number" class="form-label custom-label">Voucher Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input font-monospace @error('voucher_number') is-invalid @enderror"
                                        name="voucher_number" id="voucher_number" value="{{ old('voucher_number', $expense->voucher_number) }}" required>
                                    @error('voucher_number')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="expense_date" class="form-label custom-label">Date of Expenditure <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-input @error('expense_date') is-invalid @enderror"
                                        name="expense_date" id="expense_date" value="{{ old('expense_date', $expense->expense_date?->format('Y-m-d')) }}" onclick="this.showPicker()" required>
                                    @error('expense_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Category & Project Allocation --}}
                                <div class="col-md-6 col-12">
                                    <label for="expense_category" class="form-label custom-label">Expense Category <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('expense_category') is-invalid @enderror" name="expense_category" id="expense_category" required>
                                        @foreach($categories as $catVal => $catLabel)
                                            <option value="{{ $catVal }}" {{ old('expense_category', $expense->expense_category) == $catVal ? 'selected' : '' }}>
                                                {{ $catLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('expense_category')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="project_id" class="form-label custom-label">Allocated Project / Relief Sector</label>
                                    <select class="form-select custom-input @error('project_id') is-invalid @enderror" name="project_id" id="project_id">
                                        <option value="">General Office / Central Admin (Unallocated)</option>
                                        @foreach($projects as $prj)
                                            <option value="{{ $prj->id }}" {{ old('project_id', $expense->project_id) == $prj->id ? 'selected' : '' }}>
                                                {{ $prj->name }} ({{ $prj->category ?? 'Relief' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Title & Recipient/Vendor --}}
                                <div class="col-md-7 col-12">
                                    <label for="title" class="form-label custom-label">Expense Title / Item Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('title') is-invalid @enderror"
                                        name="title" id="title" value="{{ old('title', $expense->title) }}" required>
                                    @error('title')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-5 col-12">
                                    <label for="recipient_or_vendor" class="form-label custom-label">Vendor / Recipient Name</label>
                                    <input type="text" class="form-control custom-input @error('recipient_or_vendor') is-invalid @enderror"
                                        name="recipient_or_vendor" id="recipient_or_vendor" value="{{ old('recipient_or_vendor', $expense->recipient_or_vendor) }}">
                                    @error('recipient_or_vendor')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Amount & Payment Method --}}
                                <div class="col-md-6 col-12">
                                    <label for="amount" class="form-label custom-label">Expense Amount (৳ BDT) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0.01" class="form-control custom-input @error('amount') is-invalid @enderror"
                                            name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" required>
                                    </div>
                                    @error('amount')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="payment_method" class="form-label custom-label">Payment Channel <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('payment_method') is-invalid @enderror" name="payment_method" id="payment_method" required>
                                        @foreach($paymentMethods as $pmKey => $pmLabel)
                                            <option value="{{ $pmKey }}" {{ old('payment_method', $expense->payment_method) == $pmKey ? 'selected' : '' }}>
                                                {{ $pmLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payment_method')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Scope & Detailed Notes --}}
                                <div class="col-12">
                                    <label for="description" class="form-label custom-label">Detailed Scope / Expenditure Breakdown</label>
                                    <textarea class="form-control custom-input @error('description') is-invalid @enderror"
                                        name="description" id="description" rows="4">{{ old('description', $expense->description) }}</textarea>
                                    @error('description')
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
                                    <div class="table-title">Voucher Actions</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    <p class="text-muted mb-3" style="font-size: 12px; line-height: 1.5;">
                                        Updating this voucher will automatically refresh related project budget and financial reports.
                                    </p>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100" style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                                <i class="ri-check-line me-1"></i> Update Voucher
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin.expenses.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
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
                                    <div class="table-title">Voucher / Bill Attachment</div>
                                </div>
                                <div class="card-body custom-form p-3">
                                    @php
                                        $currentFilePath = $expense->receipt_voucher_file && file_exists(public_path($expense->receipt_voucher_file))
                                            ? asset($expense->receipt_voucher_file)
                                            : null;
                                    @endphp
                                    @include('admin.includes.image-uploader', [
                                        'name'         => 'receipt_voucher_file',
                                        'label'        => 'Upload Scanned Bill / Voucher',
                                        'modalTitle'   => 'Upload Expense Voucher Attachment',
                                        'helpText'     => 'JPG, PNG, WebP, PDF up to 5MB',
                                        'currentImage' => $currentFilePath,
                                        'currentName'  => basename((string)$expense->receipt_voucher_file) ?: 'Voucher Attachment',
                                        'shape'        => 'rectangle',
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
