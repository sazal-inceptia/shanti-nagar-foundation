<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>@yield('title', 'Rotary Club of Shantinagar Dhaka — Grassroots Humanitarian Aid & Relief in Bangladesh')</title>
    <meta name="description" content="@yield('meta_description', 'Rotary Club of Shantinagar Dhaka is a non-profit grassroots humanitarian organization in Dhaka, Bangladesh providing direct medical equipment, orphan care, winter warmth, and safe water.')">
    <meta property="og:title" content="@yield('title', 'Rotary Club of Shantinagar Dhaka — Grassroots Humanitarian Aid & Relief in Bangladesh')">
    <meta property="og:description" content="@yield('meta_description', 'Delivering transparent humanitarian relief, healthcare support, and community welfare across Bangladesh.')">
    <meta property="og:image" content="@yield('meta_image', asset('assets/images/logo.png'))">
    <meta property="og:type" content="website">

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

    <!-- Theme-Aligned CKEditor Rich Content Styling -->
    <style>
        .ck-content, .project-desc, .event-desc-text, .rich-content {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            line-height: 28px;
            color: #666666;
            word-wrap: break-word;
        }

        /* Headings matching theme Quicksand font & weights */
        .ck-content h1, .project-desc h1, .event-desc-text h1,
        .ck-content h2, .project-desc h2, .event-desc-text h2,
        .ck-content h3, .project-desc h3, .event-desc-text h3,
        .ck-content h4, .project-desc h4, .event-desc-text h4,
        .ck-content h5, .project-desc h5, .event-desc-text h5,
        .ck-content h6, .project-desc h6, .event-desc-text h6 {
            font-family: 'Quicksand', sans-serif;
            color: #232323;
            font-weight: 700;
            line-height: 1.35;
            margin-top: 28px;
            margin-bottom: 14px;
        }
        .ck-content h1, .project-desc h1, .event-desc-text h1 { font-size: 32px; line-height: 42px; }
        .ck-content h2, .project-desc h2, .event-desc-text h2 { font-size: 26px; line-height: 36px; }
        .ck-content h3, .project-desc h3, .event-desc-text h3 { font-size: 22px; line-height: 32px; }
        .ck-content h4, .project-desc h4, .event-desc-text h4 { font-size: 19px; line-height: 28px; }

        .ck-content p, .project-desc p, .event-desc-text p {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            line-height: 28px;
            color: #666666;
            margin-bottom: 20px;
        }

        /* Inline Text Elements */
        .ck-content strong, .project-desc strong, .event-desc-text strong,
        .ck-content b, .project-desc b, .event-desc-text b {
            font-weight: 700;
            color: #232323;
        }
        .ck-content em, .project-desc em, .event-desc-text em,
        .ck-content i, .project-desc i, .event-desc-text i {
            font-style: italic;
        }
        .ck-content u, .project-desc u, .event-desc-text u {
            text-decoration: underline;
        }
        .ck-content s, .project-desc s, .event-desc-text s,
        .ck-content del, .project-desc del, .event-desc-text del {
            text-decoration: line-through;
            color: #a0aec0;
        }
        .ck-content mark, .project-desc mark, .event-desc-text mark {
            background-color: var(--theme-secondary-light, #fff9e6);
            color: #975a16;
            padding: 2px 8px;
            border-radius: 4px;
            border-bottom: 2px solid var(--theme-secondary, #ffb81c);
        }

        /* Links matching Rotary Blue & Gold Underline */
        .ck-content a, .project-desc a, .event-desc-text a {
            color: var(--theme-primary, #005daa);
            text-decoration: underline;
            text-decoration-color: var(--theme-secondary, #ffb81c);
            text-underline-offset: 4px;
            font-weight: 600;
            transition: all 300ms ease;
        }
        .ck-content a:hover, .project-desc a:hover, .event-desc-text a:hover {
            color: var(--theme-primary-hover, #004c8c);
            text-decoration-color: var(--theme-primary, #005daa);
        }

        /* Lists matching Theme Structure */
        .ck-content ul, .project-desc ul, .event-desc-text ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 24px;
        }
        .ck-content ul > li, .project-desc ul > li, .event-desc-text ul > li {
            position: relative;
            padding-left: 28px;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            line-height: 26px;
            color: #666666;
            margin-bottom: 10px;
        }
        .ck-content ul > li:before, .project-desc ul > li:before, .event-desc-text ul > li:before {
            content: '';
            position: absolute;
            left: 8px;
            top: 10px;
            width: 7px;
            height: 7px;
            background-color: var(--theme-primary, #005daa);
            border-radius: 50%;
        }
        .ck-content ol, .project-desc ol, .event-desc-text ol {
            padding-left: 24px;
            margin-bottom: 24px;
        }
        .ck-content ol > li, .project-desc ol > li, .event-desc-text ol > li {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            line-height: 26px;
            color: #666666;
            margin-bottom: 10px;
            padding-left: 6px;
        }

        /* Blockquote matching Theme Quote Cards */
        .ck-content blockquote, .project-desc blockquote, .event-desc-text blockquote {
            position: relative;
            display: block;
            background-color: var(--theme-primary-light, #e8f1f8);
            border-left: 5px solid var(--theme-primary, #005daa);
            border-radius: 12px;
            padding: 24px 30px;
            margin: 30px 0;
            box-shadow: 0 4px 20px rgba(0, 93, 170, 0.05);
        }
        .ck-content blockquote p, .project-desc blockquote p, .event-desc-text blockquote p {
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
            font-size: 17px;
            line-height: 28px;
            color: #232323;
            margin-bottom: 0;
            font-style: italic;
        }

        /* Horizontal Divider */
        .ck-content hr, .project-desc hr, .event-desc-text hr {
            border: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--theme-primary-light, #e8f1f8), var(--theme-primary, #005daa), var(--theme-primary-light, #e8f1f8), transparent);
            margin: 35px 0;
        }

        /* Theme Image Box & Captions */
        .ck-content figure.image, .project-desc figure.image, .event-desc-text figure.image {
            margin: 30px 0;
            text-align: center;
            display: table;
            clear: both;
            max-width: 100%;
        }
        .ck-content figure.image img, .project-desc figure.image img, .event-desc-text figure.image img,
        .ck-content img, .project-desc img, .event-desc-text img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 93, 170, 0.08);
            transition: all 300ms ease;
        }
        .ck-content figure.image.image-style-side, .project-desc figure.image.image-style-side, .event-desc-text figure.image.image-style-side {
            float: right;
            margin-left: 30px;
            margin-bottom: 20px;
            max-width: 48%;
        }
        .ck-content figure.image.image-style-block, .project-desc figure.image.image-style-block, .event-desc-text figure.image.image-style-block {
            margin: 30px auto;
            display: block;
        }
        .ck-content figcaption, .project-desc figcaption, .event-desc-text figcaption {
            font-family: 'Caveat', cursive;
            font-size: 19px;
            color: var(--theme-primary, #005daa);
            font-weight: 600;
            text-align: center;
            margin-top: 10px;
            caption-side: bottom;
            display: table-caption;
            line-height: 1.4;
        }

        /* Tables Styled in Harmony with Theme */
        .ck-content figure.table, .project-desc figure.table, .event-desc-text figure.table {
            margin: 30px 0;
            overflow-x: auto;
            display: block;
            width: 100%;
            -webkit-overflow-scrolling: touch;
        }
        .ck-content figure.table table, .project-desc figure.table table, .event-desc-text figure.table table {
            width: 100% !important;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid var(--theme-border, #e2e8f0);
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 93, 170, 0.05);
        }
        .ck-content figure.table th, .project-desc figure.table th, .event-desc-text figure.table th {
            background-color: var(--theme-primary, #005daa);
            color: #ffffff;
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 18px;
            border: 1px solid var(--theme-primary-hover, #004c8c);
            text-align: left;
            letter-spacing: 0.3px;
        }
        .ck-content figure.table td, .project-desc figure.table td, .event-desc-text figure.table td {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 15px;
            color: #555555;
            padding: 13px 18px;
            border-bottom: 1px solid #edf2f7;
            border-right: 1px solid #edf2f7;
            line-height: 24px;
        }
        .ck-content figure.table td:last-child, .project-desc figure.table td:last-child, .event-desc-text figure.table td:last-child {
            border-right: 0;
        }
        .ck-content figure.table tr:last-child td, .project-desc figure.table tr:last-child td, .event-desc-text figure.table tr:last-child td {
            border-bottom: 0;
        }
        .ck-content figure.table tr:nth-child(even), .project-desc figure.table tr:nth-child(even), .event-desc-text figure.table tr:nth-child(even) {
            background-color: #fafbfd;
        }
        .ck-content figure.table tr:hover, .project-desc figure.table tr:hover, .event-desc-text figure.table tr:hover {
            background-color: var(--theme-primary-light, #e8f1f8);
        }

        /* Media / Video Embeds */
        .ck-content figure.media, .project-desc figure.media, .event-desc-text figure.media,
        .ck-content .media, .project-desc .media, .event-desc-text .media {
            margin: 32px 0;
            position: relative;
            width: 100%;
            clear: both;
        }
        .ck-content figure.media iframe, .project-desc figure.media iframe, .event-desc-text figure.media iframe,
        .ck-content .media iframe, .project-desc .media iframe, .event-desc-text .media iframe,
        .ck-content iframe, .project-desc iframe, .event-desc-text iframe {
            width: 100% !important;
            aspect-ratio: 16 / 9;
            min-height: 380px;
            border: 2px solid var(--theme-primary-light, #e8f1f8);
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0, 93, 170, 0.1);
        }

        /* Code Blocks */
        .ck-content pre, .project-desc pre, .event-desc-text pre {
            background: #141517;
            color: #f8fafc;
            padding: 18px 22px;
            border-radius: 10px;
            border-left: 4px solid var(--theme-secondary, #ffb81c);
            overflow-x: auto;
            font-family: 'Fira Code', Consolas, Monaco, monospace;
            font-size: 14px;
            line-height: 24px;
            margin: 24px 0;
        }
        .ck-content code, .project-desc code, .event-desc-text code {
            background: var(--theme-primary-light, #e8f1f8);
            color: var(--theme-primary-dark, #003366);
            padding: 3px 7px;
            border-radius: 4px;
            font-family: 'Fira Code', Consolas, Monaco, monospace;
            font-size: 13.5px;
            font-weight: 600;
        }
        .ck-content pre code, .project-desc pre code, .event-desc-text pre code {
            background: transparent;
            color: inherit;
            padding: 0;
        }

        /* Mobile Layout */
        @media (max-width: 767px) {
            .ck-content figure.image.image-style-side, .project-desc figure.image.image-style-side, .event-desc-text figure.image.image-style-side {
                float: none !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                max-width: 100% !important;
                display: block !important;
            }
            .ck-content figure.media iframe, .project-desc figure.media iframe, .event-desc-text figure.media iframe,
            .ck-content .media iframe, .project-desc .media iframe, .event-desc-text .media iframe {
                min-height: 230px !important;
            }
        }
    </style>

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

        <!-- floating help drawer -->
        @include('frontend.partials.help-drawer')

        <!-- donate popup -->
        <div id="donate-popup" class="donate-popup">
            <div class="close-donate"><i class="icon-close"></i></div>
            <div class="popup-inner">
                <div class="donate-content">
                    <div class="sec-title centred">
                        <span class="top-text">{{ __('Make Your Donation') }}</span>
                        <h2>{{ __('Creating a Brighter Tomorrow') }}</h2>
                    </div>
                    <form action="{{ route('donate.submit') }}" method="post" class="default-form">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12 col-sm-12 donate-column">
                                <div class="donate-box">
                                    {{-- Project Selector in Popup --}}
                                    <div class="form-group mb-4">
                                        <label class="project-select-label" for="popup-project-select">
                                            <i class="fas fa-hand-holding-heart text-primary me-1"></i> {{ __('Target Relief Project / Cause') }}
                                        </label>
                                        <div class="select-box">
                                            <select class="ignore form-select project-select" name="project_id" id="popup-project-select">
                                                <option value="">{{ __('General Humanitarian Fund (Where Most Needed)') }}</option>
                                                @if(isset($siteProjects))
                                                    @foreach($siteProjects as $prj)
                                                        <option value="{{ $prj->id }}">{{ $prj->localized_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="donate-option">
                                        <h3>{{ __('Choose Contribution (BDT)') }}</h3>
                                        <ul class="donate-list clearfix">
                                            <li>
                                                <input type="radio" id="donate-popup-amount-1" name="amount_preset" value="500" />
                                                <label for="donate-popup-amount-1" onclick="setPopupAmount(500);">৳ {{ localized_number(500) }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-2" name="amount_preset" value="1000" checked="checked" />
                                                <label for="donate-popup-amount-2" onclick="setPopupAmount(1000);">৳ {{ localized_number(1000) }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-3" name="amount_preset" value="2500" />
                                                <label for="donate-popup-amount-3" onclick="setPopupAmount(2500);">৳ {{ localized_number(2500) }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-4" name="amount_preset" value="5000" />
                                                <label for="donate-popup-amount-4" onclick="setPopupAmount(5000);">৳ {{ localized_number(5000) }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-5" name="amount_preset" value="10000" />
                                                <label for="donate-popup-amount-5" onclick="setPopupAmount(10000);">৳ {{ localized_number(10000) }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-popup-amount-6" name="amount_preset" value="25000" />
                                                <label for="donate-popup-amount-6" onclick="setPopupAmount(25000);">৳ {{ localized_number(25000) }}</label>
                                            </li>
                                        </ul>
                                        <div class="other-amount">
                                            <div class="text">
                                                <h4>{{ __('Enter Custom Amount (৳)') }}</h4>
                                                <p>{{ __('Enter any specific amount in BDT') }}</p>
                                            </div>
                                            <div class="amount-box">
                                                <div class="form-group mb-0">
                                                    <input type="number" id="popup-custom-amount" name="amount" value="1000" min="10" step="1" required class="popup-custom-amount-input custom-donate-input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="payment-option mt-3">
                                        <h3>{{ __('Choose Payment Channel') }}</h3>
                                        <ul class="payment-list clearfix">
                                            <li>
                                                <input type="radio" id="popup-pm-1" name="payment_method" value="bkash" checked="checked" />
                                                <label for="popup-pm-1">{{ __('bKash') }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="popup-pm-2" name="payment_method" value="nagad" />
                                                <label for="popup-pm-2">{{ __('Nagad') }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="popup-pm-3" name="payment_method" value="bank_transfer" />
                                                <label for="popup-pm-3">{{ __('Bank Transfer') }}</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="popup-pm-4" name="payment_method" value="cash" />
                                                <label for="popup-pm-4">{{ __('Cash / Direct') }}</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 donate-form">
                                <div class="form-inner">
                                    <h3>{{ __('Donor Information') }}</h3>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>{{ __('Your Name') }} <span>*</span></label>
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
                                                <input type="text" name="transaction_id" placeholder="{{ __('e.g. 9B8C7D6E or Bank Deposit Slip #') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>{{ __('Living Address / Location') }}</label>
                                                <input type="text" name="address" placeholder="{{ __('e.g. Shanti Nagar, Dhaka') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one w-100">{{ __('Complete Donation') }}</button>
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

        function setPopupAmount(val) {
            var input = document.getElementById('popup-custom-amount');
            if (input) {
                input.value = val;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var customInput = document.getElementById('popup-custom-amount');
            if (customInput) {
                customInput.addEventListener('input', function () {
                    var currentVal = this.value;
                    var radios = document.querySelectorAll('#donate-popup input[name="amount_preset"]');
                    radios.forEach(function (radio) {
                        if (radio.value === currentVal) {
                            radio.checked = true;
                        } else {
                            radio.checked = false;
                        }
                    });
                });
            }
        });
    </script>

    <!-- main-js -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('custom-script')

</body><!-- End of .page_wrapper -->

</html>