@extends('admin.app')
@section('title')
    Disburse Employee Salary
@endsection

@section('content')
    <div class="container-fluid my-3">
        <form id="salaryCreateForm" action="{{ route('admin.salaries.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row">
                {{-- Main Salary Details (Left 8 Cols) --}}
                <div class="col-lg-8 col-12">
                    <div class="card table-card mb-4">
                        <div class="card-header table-header">
                            <div class="title-with-breadcrumb">
                                <div class="table-title">New Salary Disbursement Voucher</div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('admin.salaries.index') }}">Salaries</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Disburse</li>
                                    </ol>
                                </nav>
                            </div>
                            <a href="{{ route('admin.salaries.index') }}" class="add-new">
                                <i class="ri-wallet-3-line me-1"></i> Payroll Records
                            </a>
                        </div>
                        <div class="card-body custom-form p-4">
                            <div class="row g-3">
                                {{-- Select Employee --}}
                                <div class="col-md-7 col-12">
                                    <label for="employee_id" class="form-label custom-label">Select Staff Member <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('employee_id') is-invalid @enderror" name="employee_id" id="employee_id" required>
                                        <option value="">Choose Staff Member...</option>
                                        @foreach($employees as $emp)
                                            <option value="{{ $emp->id }}"
                                                data-base-salary="{{ $emp->base_salary }}"
                                                data-designation="{{ $emp->designation }}"
                                                data-department="{{ $emp->department }}"
                                                data-code="{{ $emp->employee_id }}"
                                                {{ (old('employee_id') == $emp->id || ($selectedEmployee && $selectedEmployee->id == $emp->id)) ? 'selected' : '' }}>
                                                {{ $emp->name }} — {{ $emp->designation }} ({{ $emp->employee_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Month / Period --}}
                                <div class="col-md-5 col-12">
                                    <label for="month_year" class="form-label custom-label">Salary Month / Period <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control custom-input @error('month_year') is-invalid @enderror"
                                        name="month_year" id="month_year" value="{{ old('month_year', date('F Y')) }}" placeholder="e.g. September 2026" required>
                                    @error('month_year')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Payment Date & Status --}}
                                <div class="col-md-6 col-12">
                                    <label for="payment_date" class="form-label custom-label">Disbursement Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control custom-input @error('payment_date') is-invalid @enderror"
                                        name="payment_date" id="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}" onclick="this.showPicker()" required>
                                    @error('payment_date')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="status" class="form-label custom-label">Payment Status <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('status') is-invalid @enderror" name="status" id="status" required>
                                        <option value="paid" {{ old('status', 'paid') === 'paid' ? 'selected' : '' }}>Paid &amp; Disbursed</option>
                                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending Approval</option>
                                    </select>
                                    @error('status')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Breakdown Fields: Basic, Allowance, Bonus, Deductions --}}
                                <div class="col-12 mt-4">
                                    <h6 class="fw-bold text-dark mb-2 pb-1 border-bottom" style="font-size: 14px;">
                                        <i class="ri-calculator-line me-1 text-primary"></i> Salary Breakdown (৳ BDT)
                                    </h6>
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="basic_amount" class="form-label custom-label">Basic Salary <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0" class="form-control custom-input calc-field @error('basic_amount') is-invalid @enderror"
                                            name="basic_amount" id="basic_amount"
                                            value="{{ old('basic_amount', $selectedEmployee ? $selectedEmployee->base_salary : '0.00') }}" required>
                                    </div>
                                    @error('basic_amount')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="allowance" class="form-label custom-label">Allowance (Medical / Transport / House)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0" class="form-control custom-input calc-field @error('allowance') is-invalid @enderror"
                                            name="allowance" id="allowance" value="{{ old('allowance', '0.00') }}">
                                    </div>
                                    @error('allowance')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="bonus" class="form-label custom-label">Festival / Performance Bonus</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted">৳</span>
                                        <input type="number" step="0.01" min="0" class="form-control custom-input calc-field @error('bonus') is-invalid @enderror"
                                            name="bonus" id="bonus" value="{{ old('bonus', '0.00') }}">
                                    </div>
                                    @error('bonus')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="deductions" class="form-label custom-label">Deductions (Absence / Advance / Tax)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-danger">- ৳</span>
                                        <input type="number" step="0.01" min="0" class="form-control custom-input calc-field @error('deductions') is-invalid @enderror"
                                            name="deductions" id="deductions" value="{{ old('deductions', '0.00') }}">
                                    </div>
                                    @error('deductions')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Payment Method & Reference --}}
                                <div class="col-md-6 col-12">
                                    <label for="payment_method" class="form-label custom-label">Payment Channel <span class="text-danger">*</span></label>
                                    <select class="form-select custom-input @error('payment_method') is-invalid @enderror" name="payment_method" id="payment_method" required>
                                        @foreach($paymentMethods as $pmKey => $pmLabel)
                                            <option value="{{ $pmKey }}" {{ old('payment_method', 'bank_transfer') === $pmKey ? 'selected' : '' }}>
                                                {{ $pmLabel }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('payment_method')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12">
                                    <label for="transaction_reference" class="form-label custom-label">Cheque / Txn / Bank Ref #</label>
                                    <input type="text" class="form-control custom-input @error('transaction_reference') is-invalid @enderror"
                                        name="transaction_reference" id="transaction_reference" value="{{ old('transaction_reference') }}" placeholder="e.g. CHQ-99014 or TR-882190">
                                    @error('transaction_reference')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="notes" class="form-label custom-label">Remarks / Audit Notes</label>
                                    <textarea class="form-control custom-input @error('notes') is-invalid @enderror"
                                        name="notes" id="notes" rows="2" placeholder="Internal notes or approval references...">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="error_msg text-danger mt-1" style="font-size: 12px;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Live Net Calculation Card & Actions (Right 4 Cols) --}}
                <div class="col-lg-4 col-12">
                    <div class="row g-3">
                        {{-- Live Payroll Calculation Card --}}
                        <div class="col-12">
                            <div class="card table-card border-0 shadow-sm" style="background: #ffffff;">
                                <div class="card-header table-header" style="background: linear-gradient(135deg, #0b0f17 0%, #1e293b 100%);">
                                    <div class="table-title text-white" style="font-size: 14px;">
                                        <i class="ri-wallet-fill text-warning me-1"></i> Net Payable Calculation
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="p-3 rounded mb-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                        <div class="d-flex justify-content-between mb-1" style="font-size: 12.5px;">
                                            <span class="text-muted">Basic Salary:</span>
                                            <span class="fw-semibold text-dark" id="calc_preview_basic">৳ 0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size: 12.5px;">
                                            <span class="text-muted">Allowance:</span>
                                            <span class="text-dark" id="calc_preview_allowance">+ ৳ 0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size: 12.5px;">
                                            <span class="text-muted">Bonus:</span>
                                            <span class="text-dark" id="calc_preview_bonus">+ ৳ 0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2" style="font-size: 12.5px;">
                                            <span class="text-danger">Deductions:</span>
                                            <span class="text-danger" id="calc_preview_deductions">- ৳ 0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between pt-2 border-top border-secondary-subtle align-items-center">
                                            <span class="fw-bold text-dark" style="font-size: 13.5px;">Net Disbursed:</span>
                                            <span class="fw-bold text-success" id="calc_preview_net" style="font-size: 18px;">৳ 0.00</span>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn submit-button w-100" style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; height: 38px;">
                                                <i class="ri-check-line me-1"></i> Save Voucher
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin.salaries.index') }}" class="btn leave-button w-100" style="background-color: #f1f5f9; color: #334155; border-radius: 6px; font-weight: 600; height: 38px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none;">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Employee Quick Info Badge --}}
                        <div class="col-12" id="employee_preview_card" style="display: none;">
                            <div class="card border-0 shadow-sm p-3" style="background-color: #eff6ff; border-radius: 10px; border: 1px solid #bfdbfe !important;">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="ri-user-star-line text-primary" style="font-size: 20px;"></i>
                                    <h6 class="fw-bold text-primary mb-0" id="preview_emp_name">Selected Staff</h6>
                                </div>
                                <div class="text-muted" style="font-size: 12px; line-height: 1.5;">
                                    <div>ID: <strong class="text-dark font-monospace" id="preview_emp_id">EMP-000</strong></div>
                                    <div>Designation: <strong class="text-dark" id="preview_emp_desig">-</strong></div>
                                    <div>Department: <strong class="text-dark" id="preview_emp_dept">-</strong></div>
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
    <script type="text/javascript">
        $(document).ready(function () {
            function updateCalculations() {
                var basic = parseFloat($('#basic_amount').val()) || 0;
                var allow = parseFloat($('#allowance').val()) || 0;
                var bonus = parseFloat($('#bonus').val()) || 0;
                var ded = parseFloat($('#deductions').val()) || 0;

                var net = basic + allow + bonus - ded;
                if (net < 0) net = 0;

                $('#calc_preview_basic').text('৳ ' + basic.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                $('#calc_preview_allowance').text('+ ৳ ' + allow.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                $('#calc_preview_bonus').text('+ ৳ ' + bonus.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                $('#calc_preview_deductions').text('- ৳ ' + ded.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                $('#calc_preview_net').text('৳ ' + net.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            }

            function updateEmployeeInfo() {
                var selected = $('#employee_id option:selected');
                if (selected.val()) {
                    var baseSalary = selected.data('base-salary');
                    var desig = selected.data('designation');
                    var dept = selected.data('department');
                    var code = selected.data('code');
                    var name = selected.text().split('—')[0].trim();

                    if (!$('#basic_amount').val() || parseFloat($('#basic_amount').val()) === 0) {
                        $('#basic_amount').val(baseSalary);
                    }

                    $('#preview_emp_name').text(name);
                    $('#preview_emp_id').text(code);
                    $('#preview_emp_desig').text(desig);
                    $('#preview_emp_dept').text(dept);
                    $('#employee_preview_card').slideDown();
                } else {
                    $('#employee_preview_card').slideUp();
                }
                updateCalculations();
            }

            $('#employee_id').on('change', function () {
                var selected = $('#employee_id option:selected');
                if (selected.val()) {
                    $('#basic_amount').val(selected.data('base-salary'));
                }
                updateEmployeeInfo();
            });

            $('.calc-field').on('input keyup change', function () {
                updateCalculations();
            });

            // Initial run
            updateEmployeeInfo();
            updateCalculations();
        });
    </script>
@endpush
