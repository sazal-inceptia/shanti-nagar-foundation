@extends('frontend.layouts.app')

@section('title', __('About Us') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/about-hero-bg.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('About Us') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('About Us') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- 0) Highlight for Best President Ever -->
    <section class="best-president-section">
        <div class="auto-container">
            <div class="best-president-card">
                <!-- Atmospheric Ghost Background -->
                <div class="card-bg-ghost"
                    style="background-image: url('{{ $bestPresident?->photo_url ?: asset('assets/images/team/mahbub.jpg') }}');">
                </div>
                <div class="card-bg-overlay"></div>

                <div class="row align-items-center clearfix content-wrap">
                    <div class="col-lg-7 col-md-12 col-sm-12 content-col">
                        <span class="spotlight-subtitle">{{ $bestPresident?->designation?->localized_name ?? __('Charter President & Chief Adviser') }}</span>
                        <h2>{{ $bestPresident?->localized_name ?? __('Rtn. Chowdhury Md. Hamid Al Mahbub PHF') }}</h2>
                        
                        <div class="quote-box">
                            <i class="fas fa-quote-right quote-watermark"></i>
                            “{{ trim($bestPresident?->localized_speech ?: __('Rotary is not just an organization; it is a global brotherhood dedicated to selfless humanitarian service. Our mission at Rotary Club of Shantinagar Dhaka is to bring sustainable change, dignity, and empowerment to every marginalized family we touch.'), '"“”') }}”
                        </div>
                        
                        <p class="bio-desc">
                            {{ $bestPresident?->localized_bio ?: __('Charter President (2017-2018), Major Donor & Paul Harris Fellow (PHF). The pioneering founder and visionary behind our club’s humanitarian relief and grassroots community development programs across Bangladesh.') }}
                        </p>

                        <div class="president-signature-wrap">
                            <span class="president-sign">{{ $bestPresident?->localized_name ?? __('Rtn. Chowdhury Md. Hamid Al Mahbub PHF') }}</span>
                            <span class="sign-title"><i class="fas fa-check-circle me-1"></i>
                                {{ $bestPresident?->signature_title ? __($bestPresident->signature_title) : __('Charter President • Chief Adviser') }}</span>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 col-sm-12 image-col mt-4 mt-lg-0">
                        <div class="image-wrapper">
                            <div class="img-frame">
                                <img class="main-portrait"
                                    src="{{ $bestPresident?->photo_url ?: asset('assets/images/team/mahbub.jpg') }}"
                                    alt="{{ $bestPresident?->localized_name ?? __('Charter President') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Best President Ever Highlight -->


    <!-- 1) Executive Leadership (President, Secretary, Treasurer - One by One) -->
    <section class="leadership-section" style="background-image: url({{ asset('assets/images/background/1.jpg') }});">
        <div class="shape-layer">
            <div class="shape-1" style="background-image: url({{ asset('assets/images/shape/shape-23.png') }});"></div>
            <div class="shape-2" style="background-image: url({{ asset('assets/images/shape/shape-12.png') }});"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="top-text">{{ __('Executive Leadership') }}</span>
                <h2>{{ __('Club Leadership') }}</h2>
                <p>{{ __('Guiding Rotary Club of Shantinagar Dhaka with visionary compassion, financial integrity, and grassroots action.') }}
                </p>
            </div>

            <div class="leadership-stack">
                <!-- 1. President (Top - LTR) -->
                <div class="leader-speech-card president-theme rtl-layout">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5 text-center leader-profile-col">
                            <span class="role-badge"><i class="fas fa-user-tie me-1"></i>
                                {{ $president?->badge_title ? __($president->badge_title) : __('President') }}</span>
                            <div class="avatar-box">
                                <img src="{{ $president?->photo_url ?: asset('assets/images/team/arifulhaque.jpg') }}"
                                    alt="{{ $president?->localized_name ?? __('President') }}">
                            </div>
                            <h3>{{ $president?->localized_name ?? __('Rtn. Md. Ariful Hoque PHF') }}</h3>
                            <span
                                class="designation-text">{{ $president?->designation?->localized_name ?? __('President') }}</span>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                {{ $president?->present_address ? Str::limit($president->present_address, 30) : __('Shanti Nagar, Dhaka') }}
                            </div>
                            <ul class="contact-links">
                                <li><a href="tel:{{ $president?->phone ?: '+8801711223344' }}"
                                        title="{{ __('Call President') }}"><i class="fas fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $president?->email ?: 'president@rotaryshantinagardhaka.org' }}"
                                        title="{{ __('Email President') }}"><i class="fas fa-envelope"></i></a></li>
                                @if($president?->facebook_url)
                                    <li><a href="{{ $president->facebook_url }}" target="_blank" title="Facebook"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($president?->linkedin_url)
                                    <li><a href="{{ $president->linkedin_url }}" target="_blank" title="LinkedIn"><i
                                                class="fab fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-7 leader-speech-col">
                            <div class="speech-content">
                                <div class="speech-header">
                                    <span class="speech-tag"><i class="fas fa-quote-left me-2"></i>
                                        {{ $president?->speech_tag ? __($president->speech_tag) : __("President's Address & Vision") }}</span>
                                </div>
                                <blockquote>
                                    "{{ $president?->localized_speech ?: __('Our sacred mission is ensuring no underprivileged family in our community is left without healthcare, clean water, or emergency shelter. At Rotary Club of Shantinagar Dhaka, we believe true leadership is rooted in selfless service. By uniting generous benefactors with verified grassroots programs, we turn empathy into permanent, dignity-restoring action across Bangladesh.') }}"
                                </blockquote>
                                <div class="speech-footer">
                                    <span
                                        class="leader-sign">{{ $president?->signature_text ?: ($president?->localized_name ?? __('Rtn. Md. Ariful Hoque PHF')) }}</span>
                                    <span
                                        class="sign-sub">{{ $president?->signature_title ? __($president->signature_title) : __('President • Rotary Club of Shantinagar Dhaka') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. General Secretary (Middle - RTL) -->
                <div class="leader-speech-card secretary-theme">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-7 order-lg-1 order-md-1 order-2 leader-speech-col">
                            <div class="speech-content">
                                <div class="speech-header">
                                    <span class="speech-tag"><i class="fas fa-quote-left me-2"></i>
                                        {{ $secretary?->speech_tag ? __($secretary->speech_tag) : __("General Secretary's Statement") }}</span>
                                </div>
                                <blockquote>
                                    "{{ $secretary?->localized_speech ?: __('Unwavering transparency, rapid disaster mobilization, and grounded field execution define our operational ethos. Every project is meticulously planned, vetted, and executed with our dedicated volunteer force to ensure immediate and direct relief to those facing hardship.') }}"
                                </blockquote>
                                <div class="speech-footer">
                                    <span
                                        class="leader-sign">{{ $secretary?->signature_text ?: ($secretary?->localized_name ?? __('Rtn. Md. Abdus Samad Al Azad PHF')) }}</span>
                                    <span
                                        class="sign-sub">{{ $secretary?->signature_title ? __($secretary->signature_title) : __('General Secretary • Rotary Club of Shantinagar Dhaka') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 order-lg-2 order-md-2 order-1 text-center leader-profile-col">
                            <span class="role-badge"><i class="fas fa-clipboard-check me-1"></i>
                                {{ $secretary?->badge_title ? __($secretary->badge_title) : __('General Secretary') }}</span>
                            <div class="avatar-box">
                                <img src="{{ $secretary?->photo_url ?: asset('assets/images/team/samad.jpg') }}"
                                    alt="{{ $secretary?->localized_name ?? __('General Secretary') }}">
                            </div>
                            <h3>{{ $secretary?->localized_name ?? __('Rtn. Md. Abdus Samad Al Azad PHF') }}</h3>
                            <span
                                class="designation-text">{{ $secretary?->designation?->localized_name ?? __('General Secretary') }}</span>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                {{ $secretary?->present_address ? Str::limit($secretary->present_address, 30) : __('Shanti Nagar, Dhaka') }}
                            </div>
                            <ul class="contact-links">
                                <li><a href="tel:{{ $secretary?->phone ?: '+8801811334455' }}"
                                        title="{{ __('Call Secretary') }}"><i class="fas fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $secretary?->email ?: 'secretary@rotaryshantinagardhaka.org' }}"
                                        title="{{ __('Email Secretary') }}"><i class="fas fa-envelope"></i></a></li>
                                @if($secretary?->facebook_url)
                                    <li><a href="{{ $secretary->facebook_url }}" target="_blank" title="Facebook"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($secretary?->linkedin_url)
                                    <li><a href="{{ $secretary->linkedin_url }}" target="_blank" title="LinkedIn"><i
                                                class="fab fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 3. Treasurer (Bottom - LTR) -->
                <div class="leader-speech-card treasurer-theme rtl-layout">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5 text-center leader-profile-col">
                            <span class="role-badge"><i class="fas fa-coins me-1"></i>
                                {{ $treasurer?->badge_title ? __($treasurer->badge_title) : __('Treasurer') }}</span>
                            <div class="avatar-box">
                                <img src="{{ $treasurer?->photo_url ?: asset('assets/images/team/tasmina.jpg') }}"
                                    alt="{{ $treasurer?->localized_name ?? __('Treasurer') }}">
                            </div>
                            <h3>{{ $treasurer?->localized_name ?? __('Rtn. Tasmina Hossain Luna') }}</h3>
                            <span
                                class="designation-text">{{ $treasurer?->designation?->localized_name ?? __('Treasurer') }}</span>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                {{ $treasurer?->present_address ? Str::limit($treasurer->present_address, 30) : __('Bijoy Nagar, Dhaka') }}
                            </div>
                            <ul class="contact-links">
                                <li><a href="tel:{{ $treasurer?->phone ?: '+8801911445566' }}"
                                        title="{{ __('Call Treasurer') }}"><i class="fas fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $treasurer?->email ?: 'treasurer@rotaryshantinagardhaka.org' }}"
                                        title="{{ __('Email Treasurer') }}"><i class="fas fa-envelope"></i></a></li>
                                @if($treasurer?->facebook_url)
                                    <li><a href="{{ $treasurer->facebook_url }}" target="_blank" title="Facebook"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($treasurer?->linkedin_url)
                                    <li><a href="{{ $treasurer->linkedin_url }}" target="_blank" title="LinkedIn"><i
                                                class="fab fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-7 leader-speech-col">
                            <div class="speech-content">
                                <div class="speech-header">
                                    <span class="speech-tag"><i class="fas fa-quote-left me-2"></i>
                                        {{ $treasurer?->speech_tag ? __($treasurer->speech_tag) : __("Treasurer's Financial Assurance") }}</span>
                                </div>
                                <blockquote>
                                    "{{ $treasurer?->localized_speech ?: __('We treat every single Taka as a sacred public trust (Amanah). Through strict auditing, zero-leakage fund tracking, and transparent reporting, we guarantee that your contributions directly uplift real human lives with the highest financial integrity.') }}"
                                </blockquote>
                                <div class="speech-footer">
                                    <span
                                        class="leader-sign">{{ $treasurer?->signature_text ?: ($treasurer?->localized_name ?? __('Engr. Shahabuddin Ahmed')) }}</span>
                                    <span
                                        class="sign-sub">{{ $treasurer?->signature_title ? __($treasurer->signature_title) : __('Treasurer • Rotary Club of Shantinagar Dhaka') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Executive Leadership -->


    <!-- 2) Board of Directors (BOD Members - LTR Carousel) -->
    <section class="team-section centred sec-pad">
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-23.png') }});"></div>
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="top-text">{{ __('Board of Directors (BOD)') }}</span>
                <h2>{{ __('Esteemed Directors Guiding Our Strategic Initiatives') }}</h2>
                <p>{{ __('Dedicated community leaders and professionals stewarding specific humanitarian relief portfolios.') }}
                </p>
            </div>

            <div class="bod-ltr-carousel owl-carousel owl-theme owl-dots-none">
                @php
                    $renderBod = $bodMembers->count() > 0 && $bodMembers->count() < 6 ? $bodMembers->concat($bodMembers) : $bodMembers;
                @endphp

                @foreach($renderBod as $bod)
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ $bod->photo_url }}"
                                    alt="{{ $bod->localized_name }}">
                            </figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">{{ $bod->designation_name }}</span>
                                    <h3>{{ $bod->localized_name }}</h3>
                                </div>
                                <figure class="thumb-box"><img
                                        src="{{ $bod->photo_url }}"
                                        alt="{{ $bod->localized_name }}"></figure>
                                <div class="text">
                                    <p>{{ $bod->designation?->category ? __($bod->designation->category) : __('Board of Directors') }}
                                    </p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                @if(!empty($bod->phone))
                                    <li>
                                        <a href="tel:{{ $bod->phone }}" title="{{ __('Call') }} {{ $bod->localized_name }}"><i
                                                class="fas fa-phone"></i></a>
                                    </li>
                                @endif
                                @if(!empty($bod->email))
                                    <li>
                                        <a href="mailto:{{ $bod->email }}" title="{{ __('Email') }} {{ $bod->localized_name }}"><i
                                                class="fas fa-envelope"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End BOD Members -->


    <!-- 3) Other Members / Field Team - RTL Carousel -->
    <section class="team-section officers-team-section centred sec-pad">
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-12.png') }});"></div>
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="top-text">{{ __('Foundation Officers & Coordinators') }}</span>
                <h2>{{ __('Dedicated Ground Officers & Operations Team') }}</h2>
                <p>{{ __('The passionate on-field coordinators, accountants, and volunteer supervisors executing daily relief drives.') }}
                </p>
            </div>

            <div class="members-rtl-carousel owl-carousel owl-theme owl-dots-none" dir="rtl">
                @php
                    $renderOthers = $otherMembers->count() > 0 && $otherMembers->count() < 6 ? $otherMembers->concat($otherMembers) : $otherMembers;
                @endphp
                @foreach($renderOthers as $om)
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ $om->photo_url }}"
                                    alt="{{ $om->localized_name }}">
                            </figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">{{ $om->designation_name }}</span>
                                    <h3>{{ $om->localized_name }}</h3>
                                </div>
                                <figure class="thumb-box"><img
                                        src="{{ $om->photo_url }}"
                                        alt="{{ $om->localized_name }}"></figure>
                                <div class="text">
                                    <p>{{ $om->present_address ? Str::limit($om->present_address, 30) : __('Dhaka, Bangladesh') }}
                                    </p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                @if(!empty($om->phone))
                                    <li>
                                        <a href="tel:{{ $om->phone }}" title="{{ __('Call') }} {{ $om->localized_name }}"><i
                                                class="fas fa-phone"></i></a>
                                    </li>
                                @endif
                                @if(!empty($om->email))
                                    <li>
                                        <a href="mailto:{{ $om->email }}" title="{{ __('Email') }} {{ $om->localized_name }}"><i
                                                class="fas fa-envelope"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Other Members -->



    <!-- 8) Club Heritage & Charter Milestones (Glassmorphic Flow Showcase) -->
    <section class="heritage-showcase-section sec-pad" style="background-image: url('{{ asset('assets/images/background/about-hero-bg.jpg') }}');">
        <!-- Solid Tint Overlay -->
        <div class="heritage-overlay"></div>

        <div class="auto-container heritage-content-container">
            <!-- Section Header -->
            <div class="sec-title light centred">
                <span class="top-text">{{ __('Club Heritage & Charter Journey') }}</span>
                <h2>{{ __('From Humble Beginnings to Impactful Humanitarian Service') }}</h2>
                <p>{{ __('Follow the sequential journey of Rotary Club of Shantinagar Dhaka across milestones of grassroots impact, clean water, crisis relief, and audit transparency.') }}</p>
            </div>

            <!-- Full-Width 5-Step Glassmorphic Flow Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5 g-3 g-xl-4 justify-content-center heritage-flow-grid">
                <!-- Milestone 1: 2017 -->
                <div class="col mb-4 heritage-flow-col" data-step="1">
                    <div class="heritage-glass-card">
                        <!-- Step Connector Flow Line from middle (Desktop) -->
                        <div class="flow-connector d-none d-xl-block">
                            <span class="flow-line"><span class="flow-line-fill"></span></span>
                        </div>

                        <div class="heritage-card-header">
                            <span class="heritage-year-badge">{{ __('2017') }}</span>
                            <div class="heritage-icon-box">
                                <i class="fas fa-certificate"></i>
                            </div>
                        </div>
                        <span class="heritage-category">{{ __('Charter & Inception') }}</span>
                        <h4 class="heritage-title">{{ __('Club Inception & RI District Charter') }}</h4>
                        <p class="heritage-desc">
                            {{ __('Rotary Club of Shantinagar Dhaka received its official charter under RI District 3281 Bangladesh with a dedicated founding board.') }}
                        </p>
                    </div>
                </div>

                <!-- Milestone 2: 2019 -->
                <div class="col mb-4 heritage-flow-col" data-step="2">
                    <div class="heritage-glass-card">
                        <!-- Step Connector Flow Line from middle (Desktop) -->
                        <div class="flow-connector d-none d-xl-block">
                            <span class="flow-line"><span class="flow-line-fill"></span></span>
                        </div>

                        <div class="heritage-card-header">
                            <span class="heritage-year-badge badge-gold">{{ __('2019') }}</span>
                            <div class="heritage-icon-box icon-gold">
                                <i class="fas fa-tint"></i>
                            </div>
                        </div>
                        <span class="heritage-category cat-gold">{{ __('Clean Water & Health') }}</span>
                        <h4 class="heritage-title">{{ __('Safe Water & Deep Tube-Wells') }}</h4>
                        <p class="heritage-desc">
                            {{ __('Expanded rural water projects across riverine belts, deploying arsenic-free deep tube-wells and community filtration units.') }}
                        </p>
                    </div>
                </div>

                <!-- Milestone 3: 2021 -->
                <div class="col mb-4 heritage-flow-col" data-step="3">
                    <div class="heritage-glass-card">
                        <!-- Step Connector Flow Line from middle (Desktop) -->
                        <div class="flow-connector d-none d-xl-block">
                            <span class="flow-line"><span class="flow-line-fill"></span></span>
                        </div>

                        <div class="heritage-card-header">
                            <span class="heritage-year-badge">{{ __('2021') }}</span>
                            <div class="heritage-icon-box">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                        </div>
                        <span class="heritage-category">{{ __('Emergency Healthcare') }}</span>
                        <h4 class="heritage-title">{{ __('Healthcare & Oxygen Bank') }}</h4>
                        <p class="heritage-desc">
                            {{ __('Formed a dedicated 24/7 oxygen cylinder response bank, provided clinic PPE gear, and dispatched emergency relief packages.') }}
                        </p>
                    </div>
                </div>

                <!-- Milestone 4: 2023 -->
                <div class="col mb-4 heritage-flow-col" data-step="4">
                    <div class="heritage-glass-card">
                        <!-- Step Connector Flow Line from middle (Desktop) -->
                        <div class="flow-connector d-none d-xl-block">
                            <span class="flow-line"><span class="flow-line-fill"></span></span>
                        </div>

                        <div class="heritage-card-header">
                            <span class="heritage-year-badge badge-gold">{{ __('2023') }}</span>
                            <div class="heritage-icon-box icon-gold">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                        <span class="heritage-category cat-gold">{{ __('Youth & Winter Relief') }}</span>
                        <h4 class="heritage-title">{{ __('Orphan Toolkits & Warmth Drive') }}</h4>
                        <p class="heritage-desc">
                            {{ __('Institutionalized orphan educational study toolkits, winter blanket distribution, and youth vocational skills drives.') }}
                        </p>
                    </div>
                </div>

                <!-- Milestone 5: 2024 - Present -->
                <div class="col mb-4 heritage-flow-col" data-step="5">
                    <div class="heritage-glass-card active-card">
                        <div class="heritage-card-header">
                            <span class="heritage-year-badge badge-present">{{ __('2024–Pres') }}</span>
                            <div class="heritage-icon-box icon-present">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                        </div>
                        <span class="heritage-category">{{ __('Audit Transparency') }}</span>
                        <h4 class="heritage-title">{{ __('100% Itemized Public Audit') }}</h4>
                        <p class="heritage-desc">
                            {{ __('Pioneered transparent philanthropy standards with live donation receipts, zero intermediary cuts, and public itemized audit records.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Heritage Showcase -->


    <!-- 4) Feature Section (Mission, Vision, Goal, Community) -->
    <section class="feature-section about-page-features centred">
        <div class="fluid-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>{{ is_bengali() ? 'মি' : 'M' }}</span>
                            <div class="icon-box"><i class="icon-mission"></i></div>
                            <h3>{{ __('Our Mission') }}</h3>
                            <p>{{ __('Delivering urgent medical equipment, healthcare aid, and emergency relief to underserved communities across Bangladesh through direct volunteer field distribution.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>{{ is_bengali() ? 'দৃ' : 'V' }}</span>
                            <div class="icon-box"><i class="icon-medical-report"></i></div>
                            <h3>{{ __('Our Vision') }}</h3>
                            <p>{{ __('A self-reliant Bangladesh where every deserving family has access to safe drinking water, essential hospital healthcare, and dignified livelihood support.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>{{ is_bengali() ? 'ল' : 'G' }}</span>
                            <div class="icon-box"><i class="icon-goal"></i></div>
                            <h3>{{ __('Our Goal') }}</h3>
                            <p>{{ __('Ensuring absolute financial accountability by eliminating middlemen, procuring goods directly, and preserving itemized audit vouchers for every Taka contributed.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>{{ is_bengali() ? 'স' : 'C' }}</span>
                            <div class="icon-box"><i class="icon-fair-trade"></i></div>
                            <h3>{{ __('Our Community') }}</h3>
                            <p>{{ __('Mobilizing passionate youth volunteers, healthcare workers, and local elders to identify, physically verify, and support vulnerable families with empathy.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Section -->


    <!-- 7) Rotary 4-Way Test & Governance Charter -->
    <section class="four-way-test-section sec-pad">
        <div class="pattern-layer"></div>
        <div class="auto-container">
            <div class="sec-title light centred">
                <span class="top-text">{{ __('Rotary 4-Way Test') }}</span>
                <h2>{{ __('Guiding Principles of Our Thoughts, Words & Actions') }}</h2>
                <p>{{ __('Of the things we think, say or do, Rotarians worldwide adhere to this moral code of high ethical standards:') }}</p>
            </div>

            <div class="row clearfix">
                <!-- Test 1 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="test-card">
                        <div class="test-number">1</div>
                        <h4>{{ __('1. Is it the TRUTH?') }}</h4>
                        <p>{{ __('We uphold absolute honesty, transparent record-keeping, and verifiable field facts in every initiative.') }}</p>
                    </div>
                </div>
                <!-- Test 2 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="test-card">
                        <div class="test-number">2</div>
                        <h4>{{ __('2. Is it FAIR to all concerned?') }}</h4>
                        <p>{{ __('Ensuring justice, equitable distribution of relief, and dignity for every single beneficiary.') }}</p>
                    </div>
                </div>
                <!-- Test 3 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="test-card">
                        <div class="test-number">3</div>
                        <h4>{{ __('3. Will it build GOODWILL and BETTER FRIENDSHIPS?') }}</h4>
                        <p>{{ __('Fostering unselfish fellowship, communal harmony, and passionate humanitarian volunteerism.') }}</p>
                    </div>
                </div>
                <!-- Test 4 -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                    <div class="test-card">
                        <div class="test-number">4</div>
                        <h4>{{ __('4. Will it be BENEFICIAL to all concerned?') }}</h4>
                        <p>{{ __('Directing 100% of donor funds towards measurable, life-changing impact on human lives.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Rotary Charter Strip -->
            <div class="row mt-4 pt-3 text-center align-items-center justify-content-center governance-strip">
                <div class="col-lg-3 col-md-6 col-6 py-2">
                    <div class="strip-label">{{ __('Chartered Under') }}</div>
                    <div class="strip-value">{{ __('RI District 3281, Bangladesh') }}</div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 py-2">
                    <div class="strip-label">{{ __('Zero Overhead Cut') }}</div>
                    <div class="strip-value">{{ __('100% to Beneficiaries') }}</div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 py-2">
                    <div class="strip-label">{{ __('Democratic Governance') }}</div>
                    <div class="strip-value">{{ __('Annual Board Elections') }}</div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 py-2">
                    <div class="strip-label">{{ __('Certified Audit') }}</div>
                    <div class="strip-value">{{ __('Annual Financial Transparency') }}</div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Rotary 4-Way Test -->

    <!-- 9) Past Presidents & Roll of Honour (Same design as Core Relief Pillars Carousel) -->
    <section class="contribution-section roll-of-honour-section centred">
        <div class="auto-container">
            <div class="inner-container">
                <div class="pattern-layer" style="background-image: url('{{ asset('assets/images/shape/shape-38.png') }}');"></div>
                <div class="sec-title light centred">
                    <span class="top-text">{{ __('Rotary Legacy & Leadership') }}</span>
                    <h2>{{ __('Past Presidents & Roll of Honour') }}</h2>
                    <p>{{ __('Honouring the visionary leaders of Rotary Club of Shantinagar Dhaka whose selfless stewardship built our enduring humanitarian legacy.') }}</p>
                </div>

                <div class="four-item-carousel owl-carousel owl-theme owl-nav-none">
                    @php
                        $renderLeaders = $pastPresidents->count() > 0 && $pastPresidents->count() < 4 ? $pastPresidents->concat($pastPresidents) : $pastPresidents;
                    @endphp
                    @foreach($renderLeaders as $leader)
                        <div class="single-item">
                            <div class="inner-box president-pillar-card">
                                <div class="icon-box president-photo-box">
                                    <h5>{{ $leader->year_badge ?: ($leader->tenure ?: date('Y', strtotime($leader->joining_date))) }}</h5>
                                    <div class="leader-avatar-circle">
                                        <img src="{{ $leader->photo_url }}" alt="{{ $leader->localized_name }}">
                                    </div>
                                </div>
                                <h3>{{ $leader->localized_name }}</h3>
                                <p class="leader-role-text">{{ $leader->designation_name }}</p>
                                @if($leader->localized_focus_area)
                                    <span class="leader-focus-tag">
                                        <i class="far fa-shield-check me-1"></i> {{ $leader->localized_focus_area }}
                                    </span>
                                @endif
                                @if($leader->localized_theme)
                                    <a href="javascript:void(0);" class="leader-theme-link" title="{{ __('RI Theme') }}: {{ $leader->localized_theme }}">
                                        <i class="far fa-angle-right"></i>"{{ $leader->localized_theme }}"
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Roll of Honour -->


    <!-- 10) Weekly Fellowship Meeting & Venue Info Card (Same design as Financial Accountability Reports Section) -->
    <section class="reports-section weekly-meeting-section sec-pad">
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-39.png') }});"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Left Column (content_block_7) -->
                <div class="col-lg-4 col-md-12 col-sm-12 content-column">
                    <div class="content_block_7">
                        <div class="content-box">
                            <div class="sec-title">
                                <span class="top-text">{{ __('Weekly Fellowship Meeting') }}</span>
                                <h2>{{ __('Join Us in Fellowship & Service Planning') }}</h2>
                            </div>
                            <div class="text">
                                <p>{{ __('Rotarians from any club and prospective members are always welcome to join our weekly fellowship and service project planning sessions.') }}</p>
                                <a href="{{ route('contact') }}" class="theme-btn btn-one">{{ __('Attend as Guest') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (content_block_8) -->
                <div class="col-lg-8 col-md-12 col-sm-12 content-column">
                    <div class="content_block_8">
                        <div class="content-box">
                            <div class="progress-inner">
                                <!-- Box 1: Schedule -->
                                <div class="single-progress-box">
                                    <div class="box meeting-icon-box">
                                        <div class="meeting-circle-bg">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <span class="span1">{{ __('Every') }} <br />{{ __('Saturday') }}</span>
                                    </div>
                                    <div class="text">
                                        <h2>{{ __('7:00 PM – 8:30 PM') }}</h2>
                                        <h3>{{ __('Regular Fellowship Schedule') }}</h3>
                                        <p>{{ __('Weekly club assembly, agenda discussions, 4-Way test recitations, and fellowship dinner.') }}</p>
                                        <a href="{{ route('contact') }}"><i class="far fa-angle-right"></i>{{ __('Confirm Your Attendance') }}</a>
                                    </div>
                                </div>

                                <!-- Box 2: Venue -->
                                <div class="single-progress-box">
                                    <div class="box meeting-icon-box">
                                        <div class="meeting-circle-bg gold-bg">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <span class="span2">{{ __('Shanti') }} <br />{{ __('Nagar') }}</span>
                                    </div>
                                    <div class="text">
                                        <h2>{{ __('Rotary Secretariat') }}</h2>
                                        <h3>{{ __('Fellowship Hall, Shanti Nagar, Dhaka') }}</h3>
                                        <p>{{ __('Centrally located clubhouse venue with executive boardrooms and fellowship dining facilities.') }}</p>
                                        <a href="{{ route('contact') }}"><i class="far fa-angle-right"></i>{{ __('Get Location & Directions') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Weekly Meeting -->

@endsection



@push('custom-script')
    <script>
        (function () {
            function initGsapAnimations() {
                if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
                    setTimeout(initGsapAnimations, 60);
                    return;
                }

                gsap.registerPlugin(ScrollTrigger);

                // Parallax Scroll on Ambient Shapes in Roll of Honour Section
                const shapeRoll1 = document.querySelector(".roll-of-honour-section .shape-layer .shape-1");
                if (shapeRoll1) {
                    gsap.to(shapeRoll1, {
                        scrollTrigger: {
                            trigger: ".roll-of-honour-section",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: 1.2
                        },
                        yPercent: -35,
                        rotation: 25,
                        ease: "none"
                    });
                }

                const shapeRoll2 = document.querySelector(".roll-of-honour-section .shape-layer .shape-2");
                if (shapeRoll2) {
                    gsap.to(shapeRoll2, {
                        scrollTrigger: {
                            trigger: ".roll-of-honour-section",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: 1.4
                        },
                        yPercent: 45,
                        rotation: -20,
                        ease: "none"
                    });
                }

                // 1. Parallax Scroll on Ambient Decorative Shapes in Leadership Section
                const shape1 = document.querySelector(".leadership-section .shape-layer .shape-1");
                if (shape1) {
                    gsap.to(shape1, {
                        scrollTrigger: {
                            trigger: ".leadership-section",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: 1.2
                        },
                        yPercent: -45,
                        rotation: 35,
                        ease: "none"
                    });
                }

                const shape2 = document.querySelector(".leadership-section .shape-layer .shape-2");
                if (shape2) {
                    gsap.to(shape2, {
                        scrollTrigger: {
                            trigger: ".leadership-section",
                            start: "top bottom",
                            end: "bottom top",
                            scrub: 1.4
                        },
                        yPercent: 55,
                        rotation: -30,
                        ease: "none"
                    });
                }

                // 2. Pure Unit Card Slide Animation (Right to 0 / Left to 0 alternating)
                const leaderCards = document.querySelectorAll('.leadership-section .leader-speech-card');
                leaderCards.forEach((card, index) => {
                    const entersFromRight = (index % 2 === 0);
                    const initialX = entersFromRight ? 160 : -160;

                    gsap.fromTo(card,
                        {
                            opacity: 0,
                            x: initialX,
                            scale: 0.98
                        },
                        {
                            opacity: 1,
                            x: 0,
                            scale: 1,
                            duration: 0.85,
                            ease: "power3.out",
                            scrollTrigger: {
                                trigger: card,
                                start: "top 85%",
                                toggleActions: "play reverse play reverse"
                            }
                        }
                    );
                });


                // 3. Heritage Glassmorphic Sequential Flow Animation (1st -> 2nd -> 3rd -> 4th -> 5th)
                const flowCards = document.querySelectorAll('.heritage-showcase-section .heritage-flow-col');
                if (flowCards && flowCards.length > 0) {
                    const flowTl = gsap.timeline({
                        scrollTrigger: {
                            trigger: ".heritage-showcase-section",
                            start: "top 75%",
                            toggleActions: "play reverse play reverse"
                        }
                    });

                    flowCards.forEach((col) => {
                        const card = col.querySelector('.heritage-glass-card');
                        const fill = col.querySelector('.flow-line-fill');

                        flowTl.fromTo(card,
                            { opacity: 0, y: 22, scale: 0.95 },
                            { opacity: 1, y: 0, scale: 1, duration: 0.28, ease: "power2.out" }
                        );

                        if (fill) {
                            flowTl.fromTo(fill,
                                { scaleX: 0 },
                                { scaleX: 1, duration: 0.15, ease: "power1.inOut" },
                                "-=0.08"
                            );
                        }
                    });
                }

                // 4. Past Presidents & Roll of Honour Container Reveal
                const rollSection = document.querySelector('.roll-of-honour-section .inner-container');
                if (rollSection) {
                    gsap.fromTo(rollSection,
                        { opacity: 0, y: 30, scale: 0.98 },
                        {
                            opacity: 1,
                            y: 0,
                            scale: 1,
                            duration: 0.6,
                            ease: "power2.out",
                            scrollTrigger: {
                                trigger: rollSection,
                                start: "top 85%",
                                toggleActions: "play reverse play reverse"
                            }
                        }
                    );
                }

                ScrollTrigger.refresh();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initGsapAnimations);
            } else {
                initGsapAnimations();
            }

            window.addEventListener('load', function () {
                if (typeof ScrollTrigger !== 'undefined') {
                    ScrollTrigger.refresh();
                }
            });
        })();
    </script>
@endpush