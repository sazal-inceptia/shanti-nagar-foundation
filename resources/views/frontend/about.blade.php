@extends('frontend.layouts.app')

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>About Us</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>Pages</li>
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
                                <p>Shanti Nagar Foundation is a non-profit humanitarian organization committed to uplifting
                                    underprivileged communities across Bangladesh through direct medical aid, orphan care,
                                    winter clothes distribution, hospital equipment supply, and educational assistance.</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="author-box">
                                    <div class="icon-box"><i class="icon-hand"></i></div>
                                    <span>Governing Body</span>
                                    <h3>Shanti Nagar Association</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_2">
                        <div class="image-box">
                            <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-2.jpg') }}"
                                    alt=""></figure>
                            <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-3.jpg') }}"
                                    alt=""></figure>
                            <div class="rotate-text">
                                <figure class="text-box rotate-me"><img
                                        src="{{ asset('assets/images/icons/rotate-text-2.png') }}" alt=""></figure>
                                <figure class="icon-box"><img src="{{ asset('assets/images/icons/bird-1.png') }}" alt="">
                                </figure>
                            </div>
                            <figure class="icon-box"><img src="{{ asset('assets/images/icons/heart-7.png') }}" alt="">
                            </figure>
                            <div class="text">
                                <h4><i class="icon-donation-1"></i>16+ Years of Experience</h4>
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
                            <p>Beguiled and demoralized by the charms of pleasure of the moment blinded that they cannot
                                foresee.</p>
                            <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>V</span>
                            <div class="icon-box"><i class="icon-medical-report"></i></div>
                            <h3>Our Vision</h3>
                            <p>Our power of choice untrammelled and when nothing prevents our being able to do what we like
                                best.</p>
                            <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>G</span>
                            <div class="icon-box"><i class="icon-goal"></i></div>
                            <h3>Our Goal</h3>
                            <p>Duty or the obligations of business it will frequently occurs that pleasures have repudiated
                                annoyances.</p>
                            <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>P</span>
                            <div class="icon-box"><i class="icon-fair-trade"></i></div>
                            <h3>Our Partners</h3>
                            <p>Riighteous indignation and dislike men who are so beguiled and demoralized by the pleasure of
                                the moment.</p>
                            <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
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
                    <h2>Dedicated Foundation Officers & Field Coordinators</h2>
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
                                        <p>{{ $member->department }} &bull; {{ $member->present_address }}</p>
                                    </div>
                                </div>
                                <ul class="social-links clearfix">
                                    <li><a href="tel:{{ $member->phone }}"><i class="fas fa-phone-alt"></i></a></li>
                                    <li><a href="mailto:{{ $member->email }}"><i class="fas fa-envelope"></i></a></li>
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
                    <span class="top-text">Our Contribution</span>
                    <h2>Our Impact Across Bangladesh</h2>
                </div>
                <div class="four-item-carousel owl-carousel owl-theme owl-nav-none">
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>150k+</h5>
                                <i class="icon-home"></i>
                            </div>
                            <h3>Dhaka Division</h3>
                            <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>95k+</h5>
                                <i class="icon-charity"></i>
                            </div>
                            <h3>Chattogram</h3>
                            <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>80k+</h5>
                                <i class="icon-donation"></i>
                            </div>
                            <h3>Sylhet Division</h3>
                            <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>65k+</h5>
                                <i class="icon-donation-1"></i>
                            </div>
                            <h3>Rajshahi Division</h3>
                            <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                        </div>
                    </div>
                    <div class="single-item">
                        <div class="inner-box">
                            <div class="icon-box">
                                <h5>50k+</h5>
                                <i class="icon-charity"></i>
                            </div>
                            <h3>Rangpur & North</h3>
                            <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contribution-section end -->


    <!-- reports-section -->
    <section class="reports-section sec-pad">
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-39.png') }});"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 content-column">
                    <div class="content_block_7">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="top-text">Annual Reports</span>
                                <h2>Our Legal & Financial Reports</h2>
                            </div>
                            <div class="text">
                                <p>The majority have suffered alteration injected gets humours randomises.</p>
                                <a href="/about" class="theme-btn btn-one">Download</a>
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
                                        <div class="piechart" data-fg-color="#f65024" data-value=".84">
                                        </div>
                                        <span>Year of <br />2020</span>
                                    </div>
                                    <div class="text">
                                        <h2>84%</h2>
                                        <h3>Income Statement</h3>
                                        <p>It is a long established fact that a reader will be distracted</p>
                                        <a href="/about"><i class="far fa-angle-right"></i>View Details</a>
                                    </div>
                                </div>
                                <div class="single-progress-box">
                                    <div class="box">
                                        <div class="piechart" data-fg-color="#03c0a8" data-value=".55">
                                        </div>
                                        <span>Year of <br />2020</span>
                                    </div>
                                    <div class="text">
                                        <h2>55%</h2>
                                        <h3>Expense Statement</h3>
                                        <p>Equal blame belongs to those who fail their duty hrough weakness</p>
                                        <a href="/about"><i class="far fa-angle-right"></i>View Details</a>
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
                                    data-stop="{{ (int) ($stats['directBeneficiaries'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Direct Beneficiaries</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- funfact-section end -->


@endsection