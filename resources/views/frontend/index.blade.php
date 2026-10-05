@extends('frontend.layouts.app')

@section('title', site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') . ' — ' . __('Building Hope, Saving Lives'))

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
                                <h2>{{ __('Direct Relief') }}</h2>
                                <span>{{ __('For Deserving Families') }}</span>
                                <h2>{{ __('Across Bangladesh') }}</h2>
                                <p>{{ __('Delivering medical equipment, orphan kits, safe water & emergency food relief with 100% transparency and zero intermediaries.') }}</p>
                                <div class="btn-box">
                                    <a href="{{ route('donations') }}" class="banner-btn">{{ __('Explore Causes') }}</a>
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
                                <h2>{{ __('Healthcare Aid') }}</h2>
                                <span>{{ __('Supporting Public Wards') }}</span>
                                <h2>{{ __('Hospital Equipment') }}</h2>
                                <p>{{ __('Providing hospital fans, wheelchairs, emergency oxygen & medical aid for underprivileged patients at government and community clinics.') }}</p>
                                <div class="btn-box">
                                    <a href="{{ route('donations') }}" class="banner-btn">{{ __('Support Healthcare') }}</a>
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
                                <h2>{{ __('Safe Water') }}</h2>
                                <span>{{ __('Deep Tube-Wells in Rural Areas') }}</span>
                                <h2>{{ __('Pure Water for All') }}</h2>
                                <p>{{ __('Installing arsenic-free deep tube-wells and water filtration plants for coastal and remote rural communities in Bangladesh.') }}</p>
                                <div class="btn-box">
                                    <a href="{{ route('donations') }}" class="banner-btn">{{ __('View Projects') }}</a>
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

    <!-- about-style-three -->
    <section class="about-style-three" style="background-image: url({{ asset('assets/images/background/13.jpg') }});">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_6">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="top-text">{{ __('About Rotary Club of Shantinagar Dhaka') }}</span>
                                <h2>{{ __('Dedicated to Social Welfare & Humanitarian Support') }}</h2>
                            </div>
                            <div class="text">
                                <p>{{ __('Rotary Club of Shantinagar Dhaka is a grassroots non-profit humanitarian organization committed to uplifting underprivileged communities across Bangladesh through direct medical aid, hospital equipment supply, orphan welfare, winter clothes distribution, deep tube-well installations, and educational support.') }}</p>
                                <p>{{ __('We operate with a volunteer-first approach, ensuring direct on-ground procurement, verifying every beneficiary family in person, and maintaining itemized internal financial audit vouchers for 100% transparency.') }}</p>
                            </div>
                            <div class="inner-box clearfix">
                                <div class="author-box">
                                    <div class="icon-box"><i class="icon-hand"></i></div>
                                    <span>{{ __('Governing Secretariat') }}</span>
                                    <h3>{{ __('Shanti Nagar Association') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_2">
                        <div class="image-box">
                            <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-2.jpg') }}" alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}"></figure>
                            <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-3.jpg') }}" alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}"></figure>
                            <div class="rotate-text">
                                <figure class="text-box rotate-me"><img src="{{ asset('assets/images/icons/rotate-text-2.png') }}" alt=""></figure>
                                <figure class="icon-box"><img src="{{ asset('assets/images/icons/bird-1.png') }}" alt=""></figure>
                            </div>
                            <figure class="icon-box"><img src="{{ asset('assets/images/icons/heart-7.png') }}" alt=""></figure>
                            <div class="text">
                                <h4><i class="icon-donation-1"></i>{{ __('100% Direct Relief') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-style-three end -->

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
                            <h3><i class="icon-tax-free"></i>{{ __('Official Receipt & 100% Transparency') }}</h3>
                            <p>{{ __('Every donation receives an official numbered money receipt voucher.') }}</p>
                            <ul class="list-style-one clearfix">
                                <li>{{ __('Direct field procurement by volunteer teams') }}</li>
                                <li>{{ __('Itemized expense vouchers and proof records') }}</li>
                                <li>{{ __('Instant bKash, Nagad, Bank and Cash receipts') }}</li>
                            </ul>
                            <a href="{{ route('about') }}">{{ __('Learn How We Work') }}</a>
                        </div>
                    </div>
                    <div class="single-block banner-bg-3">
                        <div class="text">
                            <h3><i class="icon-gift"></i>{{ __('Sponsor an Orphan or Healthcare Ward') }}</h3>
                            <p>{{ __('Dedicate your Sadaqah or Zakat directly to an active relief drive.') }}</p>
                            <ul class="list-style-one clearfix">
                                <li>{{ __('Select specific project and cause') }}</li>
                                <li>{{ __('Direct updates and field photographs') }}</li>
                                <li>{{ __('Real-time community impact tracking') }}</li>
                            </ul>
                            <a href="{{ route('donations') }}">{{ __('Explore All Causes') }}</a>
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
                                        <span class="top-text">{{ $urgentProject->projectType ? $urgentProject->projectType->localized_name : __('Signature Project') }}</span>
                                        <h2>{{ $urgentProject->localized_name }}</h2>
                                    </div>
                                    <div class="text">
                                        <p>{{ Str::limit($urgentProject->localized_short_description ?: $urgentProject->localized_description, 130) }}</p>
                                    </div>
                                </div>
                                <div class="lower-box">
                                    <div class="pattern-layer urgent-shape-7"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2 urgent-shape-8"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-hand-holding-heart"></i></div>
                                            <h5>{{ __('Fund Raised') }}</h5>
                                            <div class="price">৳{{ localized_number($uRaised) }} <span>/ ৳{{ localized_number($uTarget) }}</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar"><span class="fill-bar fill-bar-percent" data-height="{{ $uPercent }}%"></span></div>
                                            <h5>{{ localized_number($uPercent) }}%</h5>
                                        </div>
                                        <div class="btn-box">
                                            <a href="{{ route('donation.details', $urgentProject->slug) }}" class="donate-box-btn">{{ __('Donate Now') }}</a>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-map-marker-alt"></i>
                                            <h5>{{ __('Location') }}</h5>
                                            <p>{{ Str::limit($urgentProject->localized_location ?: __('Dhaka, Bangladesh'), 40) }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>{{ localized_number($uSupporters) }}+</h5>
                                            <p>{{ __('Supporters') }}</p>
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
                                    <span class="top-text">{{ __('Our Projects') }}</span>
                                    <h2>{{ __('Spread Joy with a Donation') }}</h2>
                                </div>
                                <div class="tab-btn-box">
                                    <ul class="tab-btns tab-buttons clearfix">
                                        <li class="tab-btn active-btn" data-tab="#tab-1">
                                            <h5>{{ __('All Initiatives') }}</h5>
                                            <div class="icon"><i class="fal fa-angle-left"></i></div>
                                        </li>
                                        @if(isset($projectTypes))
                                            @foreach($projectTypes as $idx => $type)
                                                <li class="tab-btn" data-tab="#tab-{{ $idx + 2 }}">
                                                    <h5>{{ $type->localized_name }}</h5>
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
                                                    <figure class="image-box"><img src="{{ asset($project->featured_image) }}" alt="{{ $project->localized_name }}"></figure>
                                                    <div class="lower-content">
                                                        <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-11.png') }}');"></div>
                                                        <div class="donate-amount clearfix">
                                                            <div class="amount-box">
                                                                <div class="icon-box"><i class="fas fa-hand-holding-heart"></i></div>
                                                                <h5>{{ __('Fund Raised') }}</h5>
                                                                <div class="price">৳{{ localized_number($raised) }} <span>/ ৳{{ localized_number($target) }}</span></div>
                                                            </div>
                                                            <div class="percentage-box">
                                                                <div class="bar">
                                                                    <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                                                </div>
                                                                <div class="count-text">{{ localized_number($percent) }}%</div>
                                                            </div>
                                                        </div>
                                                        <div class="inner">
                                                            <div class="text">
                                                                <div class="category d-flex align-items-center gap-1 flex-wrap mb-1">
                                                                    @if($project->projectType)
                                                                        <span class="badge" style="{{ $project->projectType->badge_style }} font-size: 10.5px; padding: 2px 6px; border-radius: 4px;">{{ $project->projectType->localized_name }}</span>
                                                                    @endif
                                                                </div>
                                                                <h3><a href="{{ route('donation.details', $project->slug) }}">{{ Str::limit($project->localized_name, 40) }}</a></h3>
                                                            </div>
                                                            <ul class="info-box clearfix">
                                                                <li>
                                                                    <i class="far fa-calendar-alt"></i>
                                                                    <h5>{{ __('Days') }}</h5>
                                                                    <p>{{ $daysLeft !== null ? localized_number($daysLeft) . ' ' . __('Days Left') : __('Ongoing') }}</p>
                                                                </li>
                                                                <li>
                                                                    <i class="fas fa-users"></i>
                                                                    <h5>{{ localized_number($supporters) }}+</h5>
                                                                    <p>{{ __('Supporters') }}</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                @if(isset($projectTypes))
                                    @foreach($projectTypes as $idx => $type)
                                        @php
                                            $typeProjects = $featuredProjects->where('project_type_id', $type->id);
                                            if ($typeProjects->isEmpty()) {
                                                $typeProjects = $featuredProjects;
                                            }
                                        @endphp
                                        <div class="tab" id="tab-{{ $idx + 2 }}">
                                            <div class="three-item-carousel owl-carousel owl-theme owl-dots-none">
                                                @foreach($typeProjects as $project)
                                                    @php
                                                        $target = (float) $project->estimated_cost;
                                                        $raised = (float) $project->total_donations_raised;
                                                        $percent = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
                                                        $supporters = $project->donations->where('status', 'completed')->count();
                                                        $daysLeft = $project->days_left;
                                                    @endphp
                                                    <div class="case-block-one">
                                                        <div class="inner-box">
                                                            <figure class="image-box"><img src="{{ asset($project->featured_image) }}" alt="{{ $project->localized_name }}"></figure>
                                                            <div class="lower-content">
                                                                <div class="shape" style="background-image: url('{{ asset('assets/images/shape/shape-11.png') }}');"></div>
                                                                <div class="donate-amount clearfix">
                                                                    <div class="amount-box">
                                                                        <div class="icon-box"><i class="fas fa-hand-holding-heart"></i></div>
                                                                        <h5>{{ __('Fund Raised') }}</h5>
                                                                        <div class="price">৳{{ localized_number($raised) }} <span>/ ৳{{ localized_number($target) }}</span></div>
                                                                    </div>
                                                                    <div class="percentage-box">
                                                                        <div class="bar">
                                                                            <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                                                        </div>
                                                                        <div class="count-text">{{ localized_number($percent) }}%</div>
                                                                    </div>
                                                                </div>
                                                                <div class="inner">
                                                                    <div class="text">
                                                                        <div class="category d-flex align-items-center gap-1 flex-wrap mb-1">
                                                                            @if($project->projectType)
                                                                                <span class="badge" style="{{ $project->projectType->badge_style }} font-size: 10.5px; padding: 2px 6px; border-radius: 4px;">{{ $project->projectType->localized_name }}</span>
                                                                            @endif
                                                                        </div>
                                                                        <h3><a href="{{ route('donation.details', $project->slug) }}">{{ Str::limit($project->localized_name, 40) }}</a></h3>
                                                                        <p>{{ Str::limit($project->localized_short_description ?: $project->localized_description, 75) }}</p>
                                                                    </div>
                                                                    <ul class="info-box clearfix">
                                                                        <li>
                                                                            <i class="far fa-calendar-alt"></i>
                                                                            <h5>{{ __('Days') }}</h5>
                                                                            <p>{{ $daysLeft !== null ? localized_number($daysLeft) . ' ' . __('Days Left') : __('Ongoing') }}</p>
                                                                        </li>
                                                                        <li>
                                                                            <i class="fas fa-users"></i>
                                                                            <h5>{{ localized_number($supporters) }}+</h5>
                                                                            <p>{{ __('Supporters') }}</p>
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


    <!-- recent-case-section (Verified Donors) -->
    @if(isset($recentDonations) && $recentDonations->count() > 0)
        <section class="recent-case-section" style="background-image: url({{ asset('assets/images/background/1.jpg') }});">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="top-text">{{ __('Verified Contributors') }}</span>
                    <h2>{{ __('Compassionate Donors Empowering Our Humanitarian Missions') }}</h2>
                    <p>{{ __('Transparent recognition of our valued well-wishers and patrons driving grassroots humanitarian change.') }}</p>
                </div>

                <div class="three-item-carousel owl-carousel owl-theme owl-dots-none">
                    @foreach($recentDonations as $rd)
                        <div class="donor-clean-card">
                            <div class="card-inner">
                                <div class="avatar-wrap">
                                    <img src="{{ $rd->donor?->avatar_url ?: asset('assets/images/resource/default-donor.png') }}" alt="{{ $rd->donor?->name ?? __('Donors') }}">
                                    <span class="verified-badge" title="{{ __('Verified Donors') }}"><i class="fas fa-check"></i></span>
                                </div>
                                <h4 class="donor-name" title="{{ $rd->donor?->is_anonymous ? __('Well-wisher (Anonymous)') : $rd->donor?->name }}">
                                    {{ $rd->donor?->is_anonymous ? __('Well-wisher (Anonymous)') : $rd->donor?->name }}
                                </h4>
                                <span class="donor-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $rd->donor?->city ?: ($rd->donor?->address ?: __('Dhaka, Bangladesh')) }}
                                </span>
                                <div class="contribution-box">
                                    <div class="amount">৳{{ localized_number((float) $rd->amount) }}</div>
                                    <div class="cause" title="{{ $rd->project ? $rd->project->localized_name : __('General Humanitarian Fund') }}">
                                        {{ $rd->project ? Str::limit($rd->project->localized_name, 35) : __('General Humanitarian Fund') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- recent-case-section end -->



    <!-- funfact-section (Community Numbers & Database Counters) -->
    <section class="funfact-section alternat-2 centred funfact-bg-10">
        <div class="auto-container">
            <div class="sec-title light centred">
                <span class="top-text">{{ __('Community Numbers & Field Impact') }}</span>
                <h2>{{ __('Grassroots Change Driven by Honest Stewardship') }}</h2>
                <p>{{ __('Real-time humanitarian statistics directly tallied from our field projects, donor registry, and volunteer network.') }}</p>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-charity"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['activeVolunteers'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>{{ __('Active Volunteers') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                    <div class="funfact-block-one wow slideInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-donation"></i></div>
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="1500" data-stop="{{ (int) ($stats['completedDonationsCount'] ?? 0) }}">0</span><span>+</span>
                            </div>
                            <h4>{{ __('Completed Donations') }}</h4>
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
                            <h4>{{ __('Relief Initiatives') }}</h4>
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
                            <h4>{{ __('Verified Donors') }}</h4>
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
                                        <span class="top-text">{{ __('Our Activities') }}</span>
                                        <h2>{{ __('Participate in Our Community Activities') }}</h2>
                                    </div>
                                    <div class="text">
                                        <p>{{ __('Join our on-ground distribution camps and verification teams as a volunteer or observer across Dhaka and surrounding districts.') }}</p>
                                        <a href="{{ route('activities') }}" class="theme-btn btn-one">{{ __('All Activities') }}</a>
                                    </div>
                                    <div class="sponsors-inner">
                                        <h3>{{ __('Coordination Desk:') }}</h3>
                                        <p class="text-white-50">{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}, {{ site_setting('address', 'Shanti Nagar, Dhaka - 1217') }}</p>
                                        <h6><a href="{{ route('volunteer') }}">{{ __('Become a Volunteer') }}</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                            <div class="right-column">
                                @foreach($upcomingActivities as $act)
                                    @php
                                        $actDate = $act->event_date ? \Carbon\Carbon::parse($act->event_date) : now();
                                    @endphp
                                    <div class="events-block-one wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="shape event-shape-20"></div>
                                            <figure class="image-box">
                                                <img src="{{ $act->featured_image_url }}" alt="{{ $act->localized_title }}">
                                                <h3>{{ localized_number($actDate->format('d')) }}<span>{{ is_bengali() ? $actDate->translatedFormat('M') : $actDate->format('M') }}</span></h3>
                                            </figure>
                                            <div class="inner">
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>{{ $act->event_time ?: __('10:00 AM') }}</li>
                                                    @if($act->location)
                                                        <li><i class="far fa-map"></i>{{ Str::limit($act->localized_location ?: $act->location, 16) }}</li>
                                                    @endif
                                                </ul>
                                                <h3><a href="{{ route('activity.details', $act->slug) }}">{{ Str::limit($act->localized_title, 45) }}</a></h3>
                                                <div class="links"><a href="{{ route('activity.details', $act->slug) }}">{{ __('Join & View Details') }}</a></div>
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


    <!-- benefits-section -->
    <section class="benefits-section">
        <div class="pattern-layer benefit-shape-15"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 title-column">
                    <div class="title-inner">
                        <div class="sec-title">
                            <span class="top-text">{{ __('Our Core Principles') }}</span>
                            <h2>{{ __('Honesty, Accountability & Direct Impact') }}</h2>
                        </div>
                        <div class="text">
                            <p>{{ __('Rotary Club of Shantinagar Dhaka is built on absolute accountability. Every single Taka donated is cataloged and deployed directly to verified beneficiaries.') }}</p>
                            <a href="{{ route('about') }}" class="theme-btn btn-one">{{ __('Read About Us') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 inner-column">
                    <div class="inner-box wow fadeInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>{{ is_bengali() ? '০১' : '01' }}</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-stop-hand-drawn-signal-rhomb"></i></div>
                                    </div>
                                    <h3>{{ __('Zero Intermediaries') }}</h3>
                                    <p>{{ __('Our ground volunteers purchase goods directly to eliminate third-party agency margins.') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>{{ is_bengali() ? '০২' : '02' }}</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-puzzle-piece-shape-handmade-draw"></i></div>
                                    </div>
                                    <h3>{{ __('Verified Beneficiaries') }}</h3>
                                    <p>{{ __('Physical door-to-door ground verification guarantees relief reaches genuinely distressed citizens.') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>{{ is_bengali() ? '০৩' : '03' }}</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-financial-bar-chart"></i></div>
                                    </div>
                                    <h3>{{ __('Voucher Records') }}</h3>
                                    <p>{{ __('Itemized payment receipts, cheque references, and debit vouchers recorded in our audit database.') }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                                <div class="single-item">
                                    <span>{{ is_bengali() ? '০৪' : '04' }}</span>
                                    <div class="icon-box">
                                        <div class="shape benefit-shape-13"></div>
                                        <div class="shape-2 benefit-shape-14"></div>
                                        <div class="icon"><i class="icon-house-with-heart-hand-drawn-building"></i></div>
                                    </div>
                                    <h3>{{ __('Community Led') }}</h3>
                                    <p>{{ __('Coordinated alongside local community elders, healthcare workers, and youth teams.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- benefits-section end -->


@endsection

@push('custom-script')
<script>
    window.bannerAnimatedWords = [
        "{{ __('Service Above Self — Dedicated to Grassroots Humanitarian Welfare...') }}",
        "{{ __('Empowering Communities, Delivering Direct Medical & Relief Aid...') }}",
        "{{ __('100% Itemized Audit Transparency & Direct Field Impact...') }}"
    ];

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