@extends('frontend.layouts.app')

@section('title', 'About Us — Shanti Nagar Foundation')

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>About Us</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- about-style-three -->
    <section class="about-style-three" style="background-image: url({{ asset('assets/images/background/13.jpg') }});">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_6">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="top-text">About Shanti Nagar Foundation</span>
                                <h2>Dedicated to Social Welfare & Humanitarian Support</h2>
                            </div>
                            <div class="text">
                                <p>Shanti Nagar Foundation is a grassroots non-profit humanitarian organization committed to uplifting underprivileged communities across Bangladesh through direct medical aid, hospital equipment supply, orphan welfare, winter clothes distribution, deep tube-well installations, and educational support.</p>
                                <p>We operate with a volunteer-first approach, ensuring direct on-ground procurement, verifying every beneficiary family in person, and maintaining itemized internal financial audit vouchers for 100% transparency.</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="author-box">
                                    <div class="icon-box"><i class="icon-hand"></i></div>
                                    <span>Governing Secretariat</span>
                                    <h3>Shanti Nagar Association</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_2">
                        <div class="image-box">
                            <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-2.jpg') }}" alt="Shanti Nagar Foundation Relief"></figure>
                            <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-3.jpg') }}" alt="Community Aid Bangladesh"></figure>
                            <div class="rotate-text">
                                <figure class="text-box rotate-me"><img src="{{ asset('assets/images/icons/rotate-text-2.png') }}" alt=""></figure>
                                <figure class="icon-box"><img src="{{ asset('assets/images/icons/bird-1.png') }}" alt=""></figure>
                            </div>
                            <figure class="icon-box"><img src="{{ asset('assets/images/icons/heart-7.png') }}" alt=""></figure>
                            <div class="text">
                                <h4><i class="icon-donation-1"></i>100% Direct Relief</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-style-three end -->

    <!-- feature-section -->
    <section class="feature-section centred">
        <div class="fluid-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>M</span>
                            <div class="icon-box"><i class="icon-mission"></i></div>
                            <h3>Our Mission</h3>
                            <p>Delivering urgent medical equipment, healthcare aid, and emergency relief to underserved communities across Bangladesh through direct volunteer field distribution.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>V</span>
                            <div class="icon-box"><i class="icon-medical-report"></i></div>
                            <h3>Our Vision</h3>
                            <p>A self-reliant Bangladesh where every deserving family has access to safe drinking water, essential hospital healthcare, and dignified livelihood support.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>G</span>
                            <div class="icon-box"><i class="icon-goal"></i></div>
                            <h3>Our Goal</h3>
                            <p>Ensuring absolute financial accountability by eliminating middlemen, procuring goods directly, and preserving itemized audit vouchers for every Taka contributed.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>C</span>
                            <div class="icon-box"><i class="icon-fair-trade"></i></div>
                            <h3>Our Community</h3>
                            <p>Mobilizing passionate youth volunteers, healthcare workers, and local elders to identify, physically verify, and support vulnerable families with empathy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-section end -->


    <!-- team-section -->
    @if(isset($teamMembers) && $teamMembers->count() > 0)
        <section class="team-section centred">
            <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-23.png') }});"></div>
            <div class="fluid-container">
                <div class="sec-title centred">
                    <span class="top-text">Meet Our Team</span>
                    <h2>Dedicated Foundation Officers & Coordinators</h2>
                </div>
                <div class="five-item-carousel owl-carousel owl-theme owl-nav-none">
                    @foreach($teamMembers as $member)
                        <div class="team-block-one">
                            <div class="inner-box">
                                <figure class="image-box">
                                    @if($member->photo_url)
                                        <img src="{{ $member->photo_url }}" alt="{{ $member->name }}">
                                    @endif
                                </figure>
                                <div class="content-box">
                                    <div class="info">
                                        <span class="designation">{{ $member->designation }}</span>
                                        <h3>{{ $member->name }}</h3>
                                    </div>
                                    @if($member->photo_url)
                                        <figure class="thumb-box"><img src="{{ $member->photo_url }}" alt="{{ $member->name }}"></figure>
                                    @endif
                                    <div class="text">
                                        <p>{{ $member->department }} &bull; {{ $member->present_address ?: 'Shanti Nagar, Dhaka' }}</p>
                                    </div>
                                </div>
                                <ul class="social-links clearfix">
                                    @if($member->phone)
                                        <li><a href="tel:{{ $member->phone }}" title="Call {{ $member->name }}"><i class="fas fa-phone-alt"></i></a></li>
                                    @endif
                                    @if($member->email)
                                        <li><a href="mailto:{{ $member->email }}" title="Email {{ $member->name }}"><i class="fas fa-envelope"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- team-section end -->


    <!-- contribution-section -->
    <section class="contribution-section centred">
        <div class="auto-container">
            <div class="inner-container">
                <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-38.png') }});">
                </div>
                <div class="sec-title light centred">
                    <span class="top-text">Core Relief Pillars</span>
                    <h2>Our Key Focus Areas Across Bangladesh</h2>
                </div>
                <div class="four-item-carousel owl-carousel owl-theme owl-nav-none">
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>Relief</h5>
                                <i class="icon-donation"></i>
                            </div>
                            <h3>Hospital Aid</h3>
                            <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Causes</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>Pure Water</h5>
                                <i class="icon-charity"></i>
                            </div>
                            <h3>Deep Tube-Wells</h3>
                            <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Causes</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>Education</h5>
                                <i class="icon-home"></i>
                            </div>
                            <h3>Orphan Welfare</h3>
                            <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Causes</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>Emergency</h5>
                                <i class="icon-donation-1"></i>
                            </div>
                            <h3>Food & Winter Relief</h3>
                            <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Causes</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>Empowerment</h5>
                                <i class="icon-fair-trade"></i>
                            </div>
                            <h3>Zakat & Sadaqah</h3>
                            <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Causes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contribution-section end -->


    <!-- reports-section -->
    @php
        $totalRaised = (float) ($stats['totalDonationsRaised'] ?? 0);
        $totalSpent = (float) ($stats['totalFundsUtilized'] ?? 0);
        $totalFieldExp = (float) ($stats['totalExpenses'] ?? 0);

        $utilizationRatio = $totalRaised > 0 ? min(100, round(($totalSpent / $totalRaised) * 100)) : 100;
        $directAidRatio = $totalSpent > 0 ? min(100, round(($totalFieldExp / $totalSpent) * 100)) : 95;

        $pieVal1 = number_format($utilizationRatio / 100, 2);
        $pieVal2 = number_format($directAidRatio / 100, 2);
    @endphp
    <section class="reports-section sec-pad">
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-39.png') }});"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 content-column">
                    <div class="content_block_7">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="top-text">Financial Accountability</span>
                                <h2>100% Transparent Financial Stewardship</h2>
                            </div>
                            <div class="text">
                                <p>Every single Taka received is deployed directly to verified ground missions, accompanied by itemized vendor receipts and money receipts.</p>
                                <a href="{{ route('donations') }}" class="theme-btn btn-one">Explore Active Relief</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                    <div class="content_block_8">
                        <div class="content-box">
                            <div class="progress-inner">
                                <div class="single-progress-box">
                                    <div class="box">
                                        <div class="piechart" data-fg-color="#f65024" data-value="{{ $pieVal1 }}">
                                        </div>
                                        <span>Fund <br />Utilization</span>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $utilizationRatio }}%</h2>
                                        <h3>Fund Deployment Ratio</h3>
                                        <p>Donations directly translated into active field relief, equipment, and community welfare.</p>
                                        <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Active Causes</a>
                                    </div>
                                </div>
                                <div class="single-progress-box">
                                    <div class="box">
                                        <div class="piechart" data-fg-color="#03c0a8" data-value="{{ $pieVal2 }}">
                                        </div>
                                        <span>Direct <br />Field Aid</span>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $directAidRatio }}%</h2>
                                        <h3>Direct Procurement Ratio</h3>
                                        <p>Direct procurement of hospital gear, tube-wells, and food supplies with zero intermediary cut.</p>
                                        <a href="{{ route('about') }}"><i class="far fa-angle-right"></i>Our Transparency Policy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- reports-section end -->


    <!-- funfact-section (Transparency & Fund Summary) -->
    <section class="funfact-section alternat-2 centred funfact-bg-10">
        <div class="auto-container">
            <div class="sec-title light centred">
                <span class="top-text">Financial Transparency & Impact</span>
                <h2>Fund Summary & Community Numbers</h2>
                <p>We maintain 100% financial accountability for every taka contributed and utilized for social causes.</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-donation-1"></i></div>
                            <div class="count-outer count-box">
                                <span>৳</span><span class="count-text" data-speed="1500"
                                    data-stop="{{ (int) ($stats['totalDonationsRaised'] ?? 0) }}">0</span>
                            </div>
                            <h4>Total Donations Raised</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-charity"></i></div>
                            <div class="count-outer count-box">
                                <span>৳</span><span class="count-text" data-speed="1500"
                                    data-stop="{{ (int) ($stats['totalFundsUtilized'] ?? 0) }}">0</span>
                            </div>
                            <h4>Total Funds Utilized</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-home"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500"
                                    data-stop="{{ (int) ($stats['projectsCompleted'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Social Projects Completed</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-donation"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500"
                                    data-stop="{{ (int) ($stats['totalDonors'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Verified Donors</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- funfact-section end -->

@endsection