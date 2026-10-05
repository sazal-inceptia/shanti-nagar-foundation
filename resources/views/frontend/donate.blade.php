@extends('frontend.layouts.app')

@section('title', __('Direct Donation Portal') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/projects-hero-bg.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Direct Donation Portal') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Direct Donation') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- donation-page-section -->
    <section class="donation-page-section sec-pad">
    <div class="auto-container">
        <div class="donate-content">
            <div class="sec-title centred">
                <span class="top-text">{{ __('Support Our Humanity Causes') }}</span>
                <h2>{{ __('Make Your Donation to Rotary Club of Shantinagar Dhaka') }}</h2>
                <p>{{ __('Every single Taka you contribute reaches genuine underprivileged families across Bangladesh.') }}</p>
            </div>
            <form action="{{ route('donate.submit') }}" method="post" class="default-form">
                @csrf
                <div class="row clearfix">
                    {{-- Left Column: Amount & Method --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 donate-column">
                        <div class="donate-box donate-box-card">
                            {{-- Project Selector --}}
                            <div class="form-group mb-4">
                                <label class="project-select-label" for="donate-page-project-select">
                                    <i class="fas fa-hand-holding-heart text-primary me-1"></i> {{ __('Target Relief Project / Cause') }}
                                </label>
                                <div class="select-box">
                                    <select class="ignore form-select project-select" name="project_id" id="donate-page-project-select">
                                        <option value="">{{ __('General Humanitarian Fund (Where Most Needed)') }}</option>
                                        @foreach($projects as $prj)
                                            <option value="{{ $prj->id }}" {{ old('project_id', request('project')) == $prj->id ? 'selected' : '' }}>
                                                {{ $prj->localized_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Amount Presets --}}
                            <div class="donate-option">
                                <h3>{{ __('Select Contribution (BDT)') }}</h3>
                                <ul class="donate-list clearfix">
                                    <li>
                                        <input type="radio" id="donate-page-amount-1" name="amount_preset" value="500" />
                                        <label for="donate-page-amount-1" onclick="setDonateAmount(500);">৳ {{ localized_number(500) }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-2" name="amount_preset" value="1000" checked="checked" />
                                        <label for="donate-page-amount-2" onclick="setDonateAmount(1000);">৳ {{ localized_number(1000) }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-3" name="amount_preset" value="2500" />
                                        <label for="donate-page-amount-3" onclick="setDonateAmount(2500);">৳ {{ localized_number(2500) }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-4" name="amount_preset" value="5000" />
                                        <label for="donate-page-amount-4" onclick="setDonateAmount(5000);">৳ {{ localized_number(5000) }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-5" name="amount_preset" value="10000" />
                                        <label for="donate-page-amount-5" onclick="setDonateAmount(10000);">৳ {{ localized_number(10000) }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="donate-page-amount-6" name="amount_preset" value="25000" />
                                        <label for="donate-page-amount-6" onclick="setDonateAmount(25000);">৳ {{ localized_number(25000) }}</label>
                                    </li>
                                </ul>
                                <div class="other-amount mt-3">
                                    <div class="text">
                                        <h4>{{ __('Enter Custom Amount (৳)') }}</h4>
                                        <p>{{ __('Enter any specific amount in BDT') }}</p>
                                    </div>
                                    <div class="amount-box">
                                        <input type="number" id="custom-donate-amount" name="amount" value="{{ old('amount', 1000) }}" min="10" step="1" required
                                            class="custom-donate-input">
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Method Selection --}}
                            <div class="payment-option mt-4">
                                <h3>{{ __('Choose Payment Channel') }}</h3>
                                <ul class="payment-list clearfix">
                                    <li>
                                        <input type="radio" id="page-pm-1" name="payment_method" value="bkash" {{ old('payment_method', 'bkash') == 'bkash' ? 'checked' : '' }} />
                                        <label for="page-pm-1">{{ __('bKash') }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-2" name="payment_method" value="nagad" {{ old('payment_method') == 'nagad' ? 'checked' : '' }} />
                                        <label for="page-pm-2">{{ __('Nagad') }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-3" name="payment_method" value="rocket" {{ old('payment_method') == 'rocket' ? 'checked' : '' }} />
                                        <label for="page-pm-3">{{ __('Rocket') }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-4" name="payment_method" value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }} />
                                        <label for="page-pm-4">{{ __('Bank Transfer') }}</label>
                                    </li>
                                    <li>
                                        <input type="radio" id="page-pm-5" name="payment_method" value="cash" {{ old('payment_method') == 'cash' ? 'checked' : '' }} />
                                        <label for="page-pm-5">{{ __('Cash / Direct') }}</label>
                                    </li>
                                </ul>

                                {{-- Official Foundation Payment Credentials Card --}}
                                <div class="mt-4 p-3 rounded" style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 13px;">
                                    <div class="fw-bold text-dark mb-2" style="font-size: 13.5px;">
                                        <i class="fas fa-info-circle text-primary me-1"></i> {{ __('Direct Account Details') }}
                                    </div>
                                    <div class="mb-1 text-muted">
                                        <strong class="text-dark">{{ __('bKash') }} (Merchant):</strong> {{ site_setting('bkash_number', '+880 1711-223344') }}
                                    </div>
                                    <div class="mb-1 text-muted">
                                        <strong class="text-dark">{{ __('Nagad') }} (Merchant):</strong> {{ site_setting('nagad_number', '+880 1811-556677') }}
                                    </div>
                                    <div class="text-muted">
                                        <strong class="text-dark">{{ __('Bank Transfer') }}:</strong> {{ site_setting('bank_name', 'Islami Bank Bangladesh Ltd') }} &bull; A/C: {{ site_setting('bank_account_number', '2050 3820 1000 8941') }} ({{ site_setting('bank_account_name', 'Rotary Club of Shantinagar Dhaka') }})
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Donor Information --}}
                    <div class="col-lg-6 col-md-12 col-sm-12 donate-form">
                        <div class="form-inner donate-form-card">
                            <h3>{{ __('Donor Information') }}</h3>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>{{ __('Full Name') }} <span>*</span></label>
                                        <input type="text" name="name" placeholder="{{ __('e.g. Tanvir Ahmed') }}" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="form-group">
                                        <label>{{ __('Email Address') }} <span>*</span></label>
                                        <input type="email" name="email" placeholder="{{ __('e.g. tanvir@gmail.com') }}" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="form-group">
                                        <label>{{ __('Phone Number') }} <span>*</span></label>
                                        <input type="text" name="phone" placeholder="{{ site_setting('hotline', '+880 1711-000000') }}" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>{{ __('Transaction ID / Reference') }}</label>
                                        <input type="text" name="transaction_id" placeholder="{{ __('e.g. 9B8C7D6E or Bank Deposit Slip #') }}" value="{{ old('transaction_id') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>{{ __('Living Address / Location') }}</label>
                                        <input type="text" name="address" placeholder="{{ __('e.g. Shanti Nagar, Dhaka') }}" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group">
                                        <label>{{ __('Additional Notes / Dedication') }}</label>
                                        <textarea name="notes" placeholder="{{ __('Write any message or dedication for this cause...') }}" class="donate-notes-input">{{ old('notes') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                    <div class="form-group message-btn mt-2">
                                        <button type="submit" class="theme-btn btn-one w-100 submit-donate-btn">
                                            <i class="fas fa-heart me-1"></i> {{ __('Complete Donation') }}
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

@push('custom-script')
<script>
    function setDonateAmount(val) {
        var input = document.getElementById('custom-donate-amount');
        if (input) {
            input.value = val;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var customInput = document.getElementById('custom-donate-amount');
        if (customInput) {
            customInput.addEventListener('input', function () {
                var currentVal = this.value;
                var radios = document.querySelectorAll('input[name="amount_preset"]');
                var matched = false;
                radios.forEach(function (radio) {
                    if (radio.value === currentVal) {
                        radio.checked = true;
                        matched = true;
                    } else {
                        radio.checked = false;
                    }
                });
            });
        }
    });
</script>
@endpush
