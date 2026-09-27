<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>Shanti Nagar Foundation</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.bootstrap-touchspin.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <!-- Toastr Flash Notification CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('custom-style')
</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">

        <!-- main header -->
        @include('frontend.partials.header')
        @yield('content')
        @include('frontend.partials.footer')
        <!-- main-footer end -->

        <!-- donate popup -->
        <div id="donate-popup" class="donate-popup">
            <div class="close-donate"><i class="icon-close"></i></div>
            <div class="popup-inner">
                <div class="donate-content">
                    <div class="sec-title centred">
                        <span class="top-text">Make Your Donation</span>
                        <h2>Creating a Brighter Tomorrow</h2>
                    </div>
                    <form action="{{ route('donate.submit') }}" method="post" class="default-form">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12 col-sm-12 donate-column">
                                <div class="donate-box">
                                    <div class="donate-option">
                                        <h3>Choose Contribution (BDT)</h3>
                                        <ul class="donate-list clearfix">
                                            <li>
                                                <input type="radio" id="donate-popup-amount-1" name="amount_preset" value="500" />
                                                <label for="donate-popup-amount-1" onclick="document.getElementById('popup-custom-amount').value = 500;">৳ 500</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-2" name="amount_preset" value="1000" checked="checked" />
                                                <label for="donate-popup-amount-2" onclick="document.getElementById('popup-custom-amount').value = 1000;">৳ 1,000</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-3" name="amount_preset" value="2500" />
                                                <label for="donate-popup-amount-3" onclick="document.getElementById('popup-custom-amount').value = 2500;">৳ 2,500</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-4" name="amount_preset" value="5000" />
                                                <label for="donate-popup-amount-4" onclick="document.getElementById('popup-custom-amount').value = 5000;">৳ 5,000</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-5" name="amount_preset" value="10000" />
                                                <label for="donate-popup-amount-5" onclick="document.getElementById('popup-custom-amount').value = 10000;">৳ 10,000</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-6" name="amount_preset" value="25000" />
                                                <label for="donate-popup-amount-6" onclick="document.getElementById('popup-custom-amount').value = 25000;">৳ 25,000</label>
                                            </li>
                                        </ul>
                                        <div class="other-amount">
                                            <div class="text">
                                                <h4>Custom Amount</h4>
                                                <p>Enter your amount in ৳ BDT</p>
                                            </div>
                                            <div class="amount-box">
                                                <div class="form-group mb-0">
                                                    <input type="number" id="popup-custom-amount" name="amount" value="1000" min="10" step="10" required style="width: 100%; height: 45px; border: 1px solid #e2e8f0; border-radius: 6px; padding: 0 15px; font-weight: 700;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-option mt-3">
                                        <h3>Payment Method</h3>
                                        <ul class="payment-list clearfix">
                                            <li>
                                                <input type="radio" id="popup-pm-1" name="payment_method" value="bkash" checked="checked" />
                                                <label for="popup-pm-1">bKash</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="popup-pm-2" name="payment_method" value="nagad" />
                                                <label for="popup-pm-2">Nagad</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="popup-pm-3" name="payment_method" value="bank_transfer" />
                                                <label for="popup-pm-3">Bank</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="popup-pm-4" name="payment_method" value="cash" />
                                                <label for="popup-pm-4">Cash</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 donate-form">
                                <div class="form-inner">
                                    <h3>Donor Information</h3>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Your Name <span>*</span></label>
                                                <input type="text" name="name" placeholder="Your full name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Email Address <span>*</span></label>
                                                <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
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
                                                <label>TrxID / Reference (Optional)</label>
                                                <input type="text" name="transaction_id" placeholder="e.g. bKash TrxID or Bank Ref">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Address / District</label>
                                                <input type="text" name="address" placeholder="e.g. Shanti Nagar, Dhaka">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one w-100">Complete Donation</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- donate popup -->

        <!-- scroll to top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="far fa-long-arrow-up"></i>
        </button>

    </div>

    <!-- jquery plugins -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/nav-tool.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('assets/js/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/text_animation.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>

    <!-- Toastr Flash Notification Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000"
        };

        $(document).ready(function () {
            @if(Session::has('success'))
                toastr.success("{!! addslashes(Session::get('success')) !!}", "Success");
            @endif

            @if(Session::has('error'))
                toastr.error("{!! addslashes(Session::get('error')) !!}", "Error");
            @endif

            @if(isset($errors) && $errors->any())
                @foreach($errors->all() as $error)
                    toastr.error("{!! addslashes($error) !!}", "Validation Error");
                @endforeach
            @endif
        });
    </script>

    <!-- main-js -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('custom-script')

</body><!-- End of .page_wrapper -->

</html>