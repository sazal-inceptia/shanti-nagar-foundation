@extends('frontend.layouts.app')

@section('title', __('Frequently Asked Questions') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Frequently Asked Questions') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Support') }}</li>
                    <li>{{ __('Frequently Asked Questions') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- faq-page-section -->
    <section class="faq-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_10">
                        <div class="content-box">
                            <figure class="image"><img src="{{ asset('assets/images/resource/faq-boy.png') }}" alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }} FAQ"></figure>
                            <div class="text wow fadeInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="icon-box"><i class="icon-search-1"></i></div>
                                <h3>{{ __('Have More Questions?') }}</h3>
                                <p>{{ __('Our coordination desk in Dhaka is here to help with your donation and volunteer queries.') }}</p>
                                <a href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                    <ul class="accordion-box">
                        <li class="accordion block active-block">
                            <div class="acc-btn active">
                                <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                <h5><i class="icon-question"></i>{{ __('What is Rotary Club of Shantinagar Dhaka?') }}</h5>
                            </div>
                            <div class="acc-content current">
                                <div class="text">
                                    <p>{{ __('Rotary Club of Shantinagar Dhaka is a grassroots non-profit humanitarian organization based in Dhaka, Bangladesh, dedicated to direct medical equipment aid, orphan welfare, arsenic-free deep tube-wells, and emergency food relief with 100% financial transparency.') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">
                                <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                <h5><i class="icon-question"></i>{{ __('How do I make a donation (bKash / Nagad / Bank)?') }}</h5>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>{{ __('You can donate easily via bKash, Nagad, Rocket, or direct bank transfer from our Donate page. Every contribution receives an official serial money receipt and electronic reference for your records.') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                             <div class="acc-btn">
                                <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                <h5><i class="icon-question"></i>{{ __('How does the Foundation guarantee 100% transparency?') }}</h5>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>{{ __('We practice direct volunteer procurement without middleman commissions. Every project maintains itemized supplier vouchers, salary registers, bank reconciliations, and photographic field distribution proofs available for audit.') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                             <div class="acc-btn">
                                <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                <h5><i class="icon-question"></i>{{ __('Can I contribute my Zakat or Sadaqah to specific relief projects?') }}</h5>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>{{ __('Yes. We operate a dedicated Zakat & Sadaqah fund that directly aids verified destitute families, hospital patients who cannot afford life-saving gear, and underprivileged orphan children.') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                             <div class="acc-btn">
                                <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                <h5><i class="icon-question"></i>{{ __('How can I join as a field volunteer?') }}</h5>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>{{ __('Passionate youth and community leaders can apply through our Volunteer Registration page. Our management team reviews and connects with approved volunteers for upcoming seasonal campaigns and distribution drives.') }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                             <div class="acc-btn">
                                <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                <h5><i class="icon-question"></i>{{ __('How are beneficiary families selected and verified?') }}</h5>
                            </div>
                            <div class="acc-content">
                                <div class="text">
                                    <p>{{ __('Our volunteer field officers and local elders personally survey and physically verify the living conditions of each family on-ground to ensure assistance reaches those in genuine, acute need.') }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-page-section end -->

@endsection
