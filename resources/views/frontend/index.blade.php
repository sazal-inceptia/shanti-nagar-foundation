@extends('frontend.layouts.app')

@section('title', 'Shanti Nagar Foundation — Grassroots Humanitarian Aid & Relief in Bangladesh')

@section('content')

    <!-- banner-section -->
    <section class="banner-section">
        <div class="banner-carousel">
            <div class="swiper-container banner-content">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="image-layer banner-slide-1"></div>
                        <div class="auto-container">
                            <div class="content-box">
                                <h2>Direct Relief</h2>
                                <span>For Deserving Families</span>
                                <h2>Across Bangladesh</h2>
                                <p>Delivering medical equipment, orphan kits, safe water & emergency food relief<br />with 100% transparency and zero intermediaries.</p>
                                <div class="btn-box">
                                    <a href="{{ route('donations') }}" class="banner-btn">Explore Causes</a>
                                </div>
                            </div>
                        </div>
                        <div class="othre-text centred">
                            <span class="animation_text_word"></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="image-layer banner-slide-2"></div>
                        <div class="auto-container">
                            <div class="content-box">
                                <h2>Healthcare Aid</h2>
                                <span>Supporting Public Wards</span>
                                <h2>Hospital Equipment</h2>
                                <p>Providing hospital fans, wheelchairs, emergency oxygen & medical aid<br />for underprivileged patients at government and community clinics.</p>
                                <div class="btn-box">
                                    <a href="{{ route('donations') }}" class="banner-btn">Support Healthcare</a>
                                </div>
                            </div>
                        </div>
                        <div class="othre-text centred">
                            <span class="animation_text_word"></span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="image-layer banner-slide-3"></div>
                        <div class="auto-container">
                            <div class="content-box">
                                <h2>Safe Water</h2>
                                <span>Deep Tube-Wells in Rural Areas</span>
                                <h2>Pure Water for All</h2>
                                <p>Installing arsenic-free deep tube-wells and water filtration plants<br />for coastal and remote rural communities in Bangladesh.</p>
                                <div class="btn-box">
                                    <a href="{{ route('donations') }}" class="banner-btn">View Projects</a>
                                </div>
                            </div>
                        </div>
                        <div class="othre-text centred">
                            <span class="animation_text_word"></span>
                        </div>
                    </div>
                </div>
                <div class="swiper-nav-button">
                    <div class="swiper-button-next"><i class="far fa-arrow-right"></i></div>
                    <div class="swiper-button-prev"><i class="far fa-arrow-left"></i></div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-section end -->

    <!-- about-section -->
    <section class="about-section sec-pad">
        <div class="pattern-layer about-shape-5"></div>
        <div class="auto-container">
            <div class="row clearfix align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_1">
                        <div class="image-box">
                            <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-1.png') }}" alt="Shanti Nagar Foundation Relief"></figure>
                            <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-2.png') }}" alt="Community Aid"></figure>
                            <figure class="image image-3"><img src="{{ asset('assets/images/icons/heart-2.png') }}" alt=""></figure>
                            <figure class="image image-4"><img src="{{ asset('assets/images/icons/heart-3.png') }}" alt=""></figure>
                            <figure class="image image-5"><img src="{{ asset('assets/images/icons/imoji-1.png') }}" alt=""></figure>
                            <div class="text">
                                <h4><i class="icon-donation"></i>100% Direct Relief</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_1">
                        <div class="content-box">
                            <div class="inner">
                                <div class="sec-title">
                                    <span class="top-text">About Shanti Nagar Foundation</span>
                                    <h2>Grassroots Humanitarian Aid & Social Empowerment</h2>
                                </div>
                                <div class="text">
                                    <p>Headquartered in Shanti Nagar, Dhaka, our foundation connects generous donors with verified humanitarian causes across Bangladesh. Every donation directly funds essential medical gear, educational materials, emergency seasonal relief, and community welfare.</p>
                                    <p>Our volunteer network supervises direct on-ground procurement, verifying every beneficiary and maintaining itemized internal financial audit vouchers for absolute integrity.</p>
                                </div>
                                <div class="btn-box">
                                    <a href="{{ route('about') }}" class="theme-btn btn-one">Our Mission & Transparency</a>
                                </div>
                            </div>
                            <div class="funfact-inner">
                                <div class="counter-block-one wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="icon-charity"></i></div>
                                        <div class="count-outer count-box">
                                            <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['activeVolunteers'] ?? 0) }}">0</span>
                                        </div>
                                        <h4>Active Volunteers</h4>
                                    </div>
                                </div>
                                <div class="counter-block-one wow fadeInRight animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="icon-donation-1"></i></div>
                                        <div class="count-outer count-box">
                                            <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['directBeneficiaries'] ?? 0) }}">0</span><span>+</span>
                                        </div>
                                        <h4>Beneficiaries Reached</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

    <!-- urgent-case-section -->
    @if(isset($urgentProject) && $urgentProject)
        @php
            $uTarget = (float) $urgentProject->estimated_cost;
            $uRaised = (float) $urgentProject->total_donations_raised;
            $uPercent = $uTarget > 0 ? min(100, round(($uRaised / $uTarget) * 100)) : 0;
            $uSupporters = $urgentProject->donations->where('status', 'completed')->count();
        @endphp
        <section class="urgent-case-section banner-bg-1">
            <div class="outer-container">
                <div class="inner-box clearfix">
                    <div class="single-block banner-bg-2">
                        <div class="text">
                            <h3><i class="icon-tax-free"></i>Official Receipt &<br />100% Transparency</h3>
                            <p>Every donation receives an official numbered money receipt voucher.</p>
                            <ul class="list-style-one clearfix">
                                <li>Direct field procurement by volunteer teams</li>
                                <li>Itemized expense vouchers and proof records</li>
                                <li>Instant bKash, Nagad, Bank and Cash receipts</li>
                            </ul>
                            <a href="{{ route('about') }}">Learn How We Work</a>
                        </div>
                    </div>
                    <div class="single-block banner-bg-3">
                        <div class="text">
                            <h3><i class="icon-gift"></i>Sponsor an Orphan or<br />Healthcare Ward</h3>
                            <p>Dedicate your Sadaqah or Zakat directly to an active relief drive.</p>
                            <ul class="list-style-one clearfix">
                                <li>Select specific project and cause</li>
                                <li>Direct updates and field photographs</li>
                                <li>Real-time community impact tracking</li>
                            </ul>
                            <a href="{{ route('donations') }}">Explore All Causes</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-xl-6 col-lg-12 col-md-12 offset-xl-6">
                            <div class="urgent-case-block">
                                <div class="upper-box banner-bg-4">
                                    <div class="sec-title light">
                                        <span class="top-text">Priority Relief Mission</span>
                                        <h2>{{ $urgentProject->name }}</h2>
                                    </div>
                                    <div class="text">
                                        <p>{{ Str::limit($urgentProject->short_description ?: $urgentProject->description, 130) }}</p>
                                    </div>
                                    <div class="timer">
                                        <div class="cs-countdown" data-countdown="12/31/2026 23:59:59"></div>
                                    </div>
                                </div>
                                <div class="lower-box">
                                    <div class="pattern-layer urgent-shape-7"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2 urgent-shape-8"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-hand-holding-heart"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">৳{{ number_format($uRaised) }} <span>/ ৳{{ number_format($uTarget) }}</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar"><span class="fill-bar fill-bar-percent" data-height="{{ $uPercent }}%"></span></div>
                                            <h5>{{ $uPercent }}%</h5>
                                        </div>
                                        <div class="btn-box">
                                            <a href="{{ route('donation.details', $urgentProject->slug) }}" class="donate-box-btn">Donate Now</a>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-map-marker-alt"></i>
                                            <h5>Location</h5>
                                            <p>{{ Str::limit($urgentProject->location, 16) }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>{{ $uSupporters }}+</h5>
                                            <p>Supporters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-hand-holding-usd"></i>
                                            <h5><a href="{{ route('donation.details', $urgentProject->slug) }}">Details</a></h5>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- urgent-case-section end -->

    <!-- case-section -->
    @if(isset($featuredProjects) && $featuredProjects->count() > 0)
        <section class="case-section">
            <div class="auto-container">
                <div class="tabs-box">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12 col-sm-12 title-column">
                            <div class="title-inner text-right">
                                <div class="sec-title">
                                    <span class="top-text">Our Projects</span>
                                    <h2>Spread Joy with a Donation</h2>
                                </div>
                                <div class="tab-btn-box">
                                    <ul class="tab-btns tab-buttons clearfix">
                                        <li class="tab-btn active-btn" data-tab="#tab-1">
                                            <h5>All Categories</h5>
                                            <div class="icon"><i class="fal fa-angle-left"></i></div>
                                        </li>
                                        @if(isset($projectCategories))
                                            @foreach($projectCategories as $idx => $cat)
                                                <li class="tab-btn" data-tab="#tab-{{ $idx + 2 }}">
                                                    <h5>{{ $cat }}</h5>
                                                    <div class="icon"><i class="fal fa-angle-left"></i></div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 inner-column">
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="three-item-carousel owl-carousel owl-theme owl-dots-none">
                                        @foreach($featuredProjects as $project)
                                            @php
                                                $target = (float) $project->estimated_cost;
                                                $raised = (float) $project->total_donations_raised;
                                                $percent = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
                                                $supporters = $project->donations->where('status', 'completed')->count();
                                                $daysLeft = $project->days_left;
                                            @endphp
                                            <div class="case-block-one">
                                                <div class="inner-box">
                                                    <figure class="image-box"><img src="{{ asset($project->featured_image) }}" alt="{{ $project->name }}"></figure>
                                                    <div class="lower-content">
                                                        <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-11.png') }}');"></div>
                                                        <div class="donate-amount clearfix">
                                                            <div class="amount-box">
                                                                <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                                                <h5>Charity Raised</h5>
                                                                <div class="price">৳{{ number_format($raised) }} <span>/ ৳{{ number_format($target) }}</span></div>
                                                            </div>
                                                            <div class="percentage-box">
                                                                <div class="bar">
                                                                    <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                                                </div>
                                                                <div class="count-text">{{ $percent }}%</div>
                                                            </div>
                                                        </div>
                                                        <div class="inner">
                                                            <div class="text">
                                                                <div class="category"><a href="{{ route('donation.details', $project->slug) }}"># {{ $project->category }}</a></div>
                                                                <h3><a href="{{ route('donation.details', $project->slug) }}">{{ Str::limit($project->name, 40) }}</a></h3>
                                                                <p>{{ Str::limit($project->short_description ?: $project->description, 75) }}</p>
                                                            </div>
                                                            <ul class="info-box clearfix">
                                                                <li>
                                                                    <i class="far fa-calendar-alt"></i>
                                                                    <h5>Days</h5>
                                                                    <p>{{ $daysLeft !== null ? $daysLeft . ' Days Left' : 'Ongoing' }}</p>
                                                                </li>
                                                                <li>
                                                                    <i class="fas fa-users"></i>
                                                                    <h5>{{ $supporters }}+</h5>
                                                                    <p>Supporters</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @if(isset($projectCategories))
                                    @foreach($projectCategories as $idx => $cat)
                                        @php
                                            $catProjects = $featuredProjects->where('category', $cat);
                                            if ($catProjects->isEmpty()) {
                                                $catProjects = $featuredProjects;
                                            }
                                        @endphp
                                        <div class="tab" id="tab-{{ $idx + 2 }}">
                                            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none">
                                                @foreach($catProjects as $project)
                                                    @php
                                                        $target = (float) $project->estimated_cost;
                                                        $raised = (float) $project->total_donations_raised;
                                                        $percent = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
                                                        $supporters = $project->donations->where('status', 'completed')->count();
                                                        $daysLeft = $project->days_left;
                                                    @endphp
                                                    <div class="case-block-one">
                                                        <div class="inner-box">
                                                            <figure class="image-box"><img src="{{ asset($project->featured_image) }}" alt="{{ $project->name }}"></figure>
                                                            <div class="lower-content">
                                                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-11.png') }}');"></div>
                                                                <div class="donate-amount clearfix">
                                                                    <div class="amount-box">
                                                                        <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                                                        <h5>Charity Raised</h5>
                                                                        <div class="price">৳{{ number_format($raised) }} <span>/ ৳{{ number_format($target) }}</span></div>
                                                                    </div>
                                                                    <div class="percentage-box">
                                                                        <div class="bar">
                                                                            <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                                                        </div>
                                                                        <div class="count-text">{{ $percent }}%</div>
                                                                    </div>
                                                                </div>
                                                                <div class="inner">
                                                                    <div class="text">
                                                                        <div class="category"><a href="{{ route('donation.details', $project->slug) }}"># {{ $project->category }}</a></div>
                                                                        <h3><a href="{{ route('donation.details', $project->slug) }}">{{ Str::limit($project->name, 40) }}</a></h3>
                                                                        <p>{{ Str::limit($project->short_description ?: $project->description, 75) }}</p>
                                                                    </div>
                                                                    <ul class="info-box clearfix">
                                                                        <li>
                                                                            <i class="far fa-calendar-alt"></i>
                                                                            <h5>Days</h5>
                                                                            <p>{{ $daysLeft !== null ? $daysLeft . ' Days Left' : 'Ongoing' }}</p>
                                                                        </li>
                                                                        <li>
                                                                            <i class="fas fa-users"></i>
                                                                            <h5>{{ $supporters }}+</h5>
                                                                            <p>Supporters</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- case-section end -->

    <!-- recent-case-section (Recent Verified Donors) -->
    @if(isset($recentDonations) && $recentDonations->count() > 0)
        <section class="recent-case-section">
            <div class="bg-layer banner-bg-5"></div>
            <div class="pattern-layer case-shape-12"></div>
            <div class="auto-container">
                <div class="inner-box">
                    <div class="shape case-shape-21"></div>
                    <div class="inner">
                        <div class="sec-title centred light">
                            <span class="top-text">Verified Contributors</span>
                            <h2>Compassionate Donors Empowering Our Humanitarian Missions</h2>
                        </div>
                        <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                            @foreach($recentDonations as $rd)
                                <div class="single-item">
                                    <figure class="image-box">
                                        @if($rd->donor?->avatar_url)
                                            <img src="{{ $rd->donor->avatar_url }}" alt="{{ $rd->donor->name }}">
                                        @endif
                                    </figure>
                                    <div class="text">
                                        <h3>{{ $rd->donor?->is_anonymous ? 'Well-wisher (Anonymous)' : $rd->donor?->name }}@if($rd->donor?->city || $rd->donor?->address), <span>{{ $rd->donor->city ?: $rd->donor->address }}</span>@endif</h3>
                                        @if($rd->project)
                                            <h6>Contributed ৳{{ number_format((float) $rd->amount) }} for {{ $rd->project->name }}</h6>
                                        @else
                                            <h6>Contributed ৳{{ number_format((float) $rd->amount) }}</h6>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- recent-case-section end -->

    <!-- benefits-section -->
    <section class="benefits-section">
        <div class="pattern-layer benefit-shape-15"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 title-column">
                    <div class="title-inner">
                        <div class="sec-title">
                            <span class="top-text">Our Core Principles</span>
                            <h2>Honesty, Accountability & Direct Impact</h2>
                        </div>
                        <div class="text">
                            <p>Shanti Nagar Foundation is built on absolute accountability. Every single Taka donated is cataloged and deployed directly to verified beneficiaries.</p>
                            <a href="{{ route('about') }}" class="theme-btn btn-one">Read About Us</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 inner-column">
                    <div class="inner-box wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>01</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-stop-hand-drawn-signal-rhomb"></i></div>
                                    </div>
                                    <h3>Zero Intermediaries</h3>
                                    <p>Our ground volunteers purchase goods directly to eliminate third-party agency margins.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>02</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-puzzle-piece-shape-handmade-draw"></i></div>
                                    </div>
                                    <h3>Verified Beneficiaries</h3>
                                    <p>Physical door-to-door ground verification guarantees relief reaches genuinely distressed citizens.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>03</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-financial-bar-chart"></i></div>
                                    </div>
                                    <h3>Voucher Records</h3>
                                    <p>Itemized payment receipts, cheque references, and debit vouchers recorded in our audit database.</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>04</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-house-with-heart-hand-drawn-building"></i></div>
                                    </div>
                                    <h3>Community Led</h3>
                                    <p>Coordinated alongside local community elders, healthcare workers, and youth teams.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- benefits-section end -->

    <!-- funfact-section (Community Numbers & Database Counters) -->
    <section class="funfact-section alternat-2 centred funfact-bg-10">
        <div class="auto-container">
            <div class="sec-title light centred">
                <span class="top-text">Community Numbers & Field Impact</span>
                <h2>Grassroots Change Driven by Honest Stewardship</h2>
                <p>Real-time humanitarian statistics directly tallied from our field projects, donor registry, and volunteer network.</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-charity"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['activeVolunteers'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Active Volunteers</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-donation"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['directBeneficiaries'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Direct Beneficiaries</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-home"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['totalProjects'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Relief Initiatives</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-donation-1"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['totalDonors'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>Verified Donors</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- funfact-section end -->

    <!-- events-section (Upcoming Activities & Drives) -->
    @if(isset($upcomingActivities) && $upcomingActivities->count() > 0)
        <section class="events-section">
            <div class="pattern-layer event-shape-17"></div>
            <div class="bg-layer event-bg-7"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <div class="shape event-shape-18"></div>
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                            <div class="content_block_2">
                                <div class="content-box">
                                    <div class="sec-title light">
                                        <span class="top-text">Our Activities</span>
                                        <h2>Participate in Our Community Activities</h2>
                                    </div>
                                    <div class="text">
                                        <p>Join our on-ground distribution camps and verification teams as a volunteer or observer across Dhaka and surrounding districts.</p>
                                        <a href="{{ route('events') }}" class="theme-btn btn-one">All Activities</a>
                                    </div>
                                    <div class="sponsors-inner">
                                        <h3>Coordination Desk:</h3>
                                        <p class="text-white-50">Shanti Nagar Foundation Central Cell, Dhaka - 1217</p>
                                        <h6><a href="{{ route('volunteer') }}">Become a Volunteer</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                            <div class="right-column">
                                @foreach($upcomingActivities as $act)
                                    @php
                                        $actDate = $act->start_date ? \Carbon\Carbon::parse($act->start_date) : now();
                                    @endphp
                                    <div class="events-block-one wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="shape event-shape-20"></div>
                                            <figure class="image-box">
                                                @if($act->featured_image)
                                                    <img src="{{ asset($act->featured_image) }}" alt="{{ $act->name }}">
                                                @endif
                                                <h3>{{ $actDate->format('d') }}<span>{{ $actDate->format('M') }}</span></h3>
                                            </figure>
                                            <div class="inner">
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>10.00 AM</li>
                                                    @if($act->location)
                                                        <li><i class="far fa-map"></i>{{ Str::limit($act->location, 16) }}</li>
                                                    @endif
                                                </ul>
                                                <h3><a href="{{ route('event.details', $act->slug) }}">{{ Str::limit($act->name, 45) }}</a></h3>
                                                <div class="links"><a href="{{ route('event.details', $act->slug) }}">Join & View Details</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- events-section end -->

    <!-- team-section (Volunteers) -->
    <section class="team-section centred">
        <div class="pattern-layer team-shape-23"></div>
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="top-text">Volunteer Activities</span>
                <h2>Dedicated Field Coordinators & Volunteers</h2>
                <p>The youth and community members driving our humanitarian logistics and distribution on the ground.</p>
            </div>
            <div class="row clearfix g-4 justify-content-center">
                @if(isset($recentVolunteers) && $recentVolunteers->count() > 0)
                    @foreach($recentVolunteers as $idx => $vol)
                        @php
                            $avatarColors = ['team-avatar-orange', 'team-avatar-teal', 'team-avatar-dark', 'team-avatar-teal'];
                            $colorClass = $avatarColors[$idx % count($avatarColors)];
                        @endphp
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="p-4 border rounded bg-white shadow-sm h-100 text-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-3 {{ $colorClass }}">
                                    {{ strtoupper(substr($vol->name, 0, 1)) }}
                                </div>
                                <h4 class="fw-bold mb-1">{{ $vol->name }}</h4>
                                <span class="text-muted small d-block mb-2">{{ $vol->address ?: 'Shanti Nagar, Dhaka' }}</span>
                                <p class="small text-muted">{{ Str::limit($vol->experience ?: 'Ground logistics & relief distribution coordination.', 60) }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="p-4 border rounded bg-white shadow-sm h-100 text-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-3 team-avatar-orange">
                                S
                            </div>
                            <h4 class="fw-bold mb-1">Shanti Nagar Unit</h4>
                            <span class="text-muted small d-block mb-2">Dhaka Central Division</span>
                            <p class="small text-muted">Relief kit packaging & medical equipment logistics.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('volunteer') }}" class="theme-btn btn-one">Join Our Volunteer Team</a>
            </div>
        </div>
    </section>
    <!-- team-section end -->

@endsection

@push('custom-script')
<script>
    $(document).ready(function() {
        $('.progress-bar-fill').each(function() {
            var width = $(this).data('width');
            $(this).css('width', width);
        });
        $('.fill-bar-percent').each(function() {
            var height = $(this).data('height');
            $(this).css('height', height);
        });

        // Fill count bars
        function updateCountBars() {
            $('.case-section .count-bar').each(function() {
                var percent = $(this).attr('data-percent') || $(this).data('percent');
                if (percent) {
                    $(this).css('width', percent).addClass('counted');
                }
            });
        }
        updateCountBars();

        // Case section tab click refresh
        $('.case-section .tab-btn').on('click', function() {
            var targetTab = $(this).attr('data-tab');
            setTimeout(function() {
                $(targetTab).find('.three-item-carousel').trigger('refresh.owl.carousel');
                updateCountBars();
            }, 150);
        });
    });
</script>
@endpush