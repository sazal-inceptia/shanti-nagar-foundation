@extends('frontend.layouts.app')

@section('content')

<!-- donation-page-section -->
<section class="donation-page-section sec-pad">
    <div class="outer-container">
        <div class="donate-content">
            <div class="sec-title centred">
                <span class="top-text">Support Our Humanity Causes</span>
                <h2>Make Your Donation to Shanti Nagar Foundation</h2>
                <p>Every single Taka you contribute reaches genuine underprivileged families across Bangladesh.</p>
            </div>
            <form action="{{ route('donate.submit') }}" method="post" class="default-form">
                @csrf
                <div class="row clearfix">
                    {{-- Left Column: Amount & Method --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 donate-column">
                        <div class="donate-box donate-box-card">
                            {{-- Project Selector --}}
                            <div class="form-group mb-4">
                                <label class="project-select-label">
                                    Target Relief Project / Cause
                                </label>
                                <div class="select-box">
                                    <select class="wide project-select" name="project_id">
                                        <option value="">General Humanitarian Fund (Where Most Needed)</option>
                                        @foreach($projects as $prj)
                                            <option value="{{ $prj->id }}" {{ old('project_id', request('project')) == $prj->id ? 'selected' : '' }}>
                                                {{ $prj->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Amount Presets --}}
                            <div class="donate-option">
                                <h3>Select Contribution (BDT)</h3>
                                <ul class="donate-list clearfix">
                                    <li>
                                        <input type="radio" id="donate-page-amount-1" name="amount_preset" value="500" />
                                        <label for="donate-page-amount-1" onclick="document.getElementById('custom-donate-amount').value = 500;">৳ 500</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-2" name="amount_preset" value="1000" checked="checked" />
                                        <label for="donate-page-amount-2" onclick="document.getElementById('custom-donate-amount').value = 1000;">৳ 1,000</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-3" name="amount_preset" value="2500" />
                                        <label for="donate-page-amount-3" onclick="document.getElementById('custom-donate-amount').value = 2500;">৳ 2,500</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-4" name="amount_preset" value="5000" />
                                        <label for="donate-page-amount-4" onclick="document.getElementById('custom-donate-amount').value = 5000;">৳ 5,000</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-5" name="amount_preset" value="10000" />
                                        <label for="donate-page-amount-5" onclick="document.getElementById('custom-donate-amount').value = 10000;">৳ 10,000</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-6" name="amount_preset" value="25000" />
                                        <label for="donate-page-amount-6" onclick="document.getElementById('custom-donate-amount').value = 25000;">৳ 25,000</label>
                                    </li>
                                </ul>
                                <div class="other-amount mt-3">
                                    <div class="text">
                                        <h4>Custom Amount</h4>
                                        <p>Enter your customized amount in ৳ BDT</p>
                                    </div>
                                    <div class="amount-box">
                                        <input type="number" id="custom-donate-amount" name="amount" value="{{ old('amount', 1000) }}" min="10" step="10" required
                                            class="custom-donate-input">
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Method Selection --}}
                            <div class="payment-option mt-4">
                                <h3>Choose Payment Channel</h3>
                                <ul class="payment-list clearfix">
                                    <li>
                                        <input type="radio" id="page-pm-1" name="payment_method" value="bkash" {{ old('payment_method', 'bkash') == 'bkash' ? 'checked' : '' }} />
                                        <label for="page-pm-1">bKash</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-2" name="payment_method" value="nagad" {{ old('payment_method') == 'nagad' ? 'checked' : '' }} />
                                        <label for="page-pm-2">Nagad</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-3" name="payment_method" value="rocket" {{ old('payment_method') == 'rocket' ? 'checked' : '' }} />
                                        <label for="page-pm-3">Rocket</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-4" name="payment_method" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }} />
                                        <label for="page-pm-4">Bank Transfer</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-5" name="payment_method" value="cash" {{ old('payment_method') == 'cash' ? 'checked' : '' }} />
                                        <label for="page-pm-5">Cash / Direct</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Donor Information --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 donate-form">
                        <div class="form-inner donate-form-card">
                            <h3>Donor Information &amp; Receipt Details</h3>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>Your Full Name <span>*</span></label>
                                        <input type="text" name="name" placeholder="e.g. Mahfuzur Rahman" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="form-group">
                                        <label>Email Address <span>*</span></label>
                                        <input type="email" name="email" placeholder="e.g. mahfuz@example.com" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="form-group">
                                        <label>Phone Number <span>*</span></label>
                                        <input type="text" name="phone" placeholder="+880 1700-000000" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>Transaction ID / Reference Number (If Paid)</label>
                                        <input type="text" name="transaction_id" placeholder="e.g. 9B8C7D6E or Bank Deposit Slip #" value="{{ old('transaction_id') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>Donor Address / City</label>
                                        <input type="text" name="address" placeholder="e.g. Shanti Nagar, Dhaka" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>Special Note / Dedication (Optional)</label>
                                        <textarea name="notes" placeholder="In memory of / Zakat / General blessing..." class="donate-notes-input">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group message-btn mt-2">
                                        <button type="submit" class="theme-btn btn-one w-100 submit-donate-btn">
                                            <i class="fas fa-heart me-1"></i> Confirm &amp; Submit Donation
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- donation-page-section end -->

@endsection
