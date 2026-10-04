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


    <!-- 0) Highlight for Best President Ever -->
    <section class="best-president-section">
        <div class="auto-container">
            <div class="best-president-card">
                <!-- Atmospheric Ghost Background (User's Idea) -->
                <div class="card-bg-ghost"
                    style="background-image: url('{{ $bestPresident?->photo_url ?: asset('assets/images/team/team-9.jpg') }}');">
                </div>
                <div class="card-bg-overlay"></div>

                <div class="row align-items-center clearfix content-wrap">
                    <div class="col-lg-7 col-md-12 col-sm-12 content-col">
                        <span class="tribute-badge"><i class="fas fa-crown"></i> {{ $bestPresident?->badge_title ?: 'Honorary Tribute • Lifetime Patron' }}</span>
                        <h2>{{ $bestPresident?->name ?? 'Alhaj Mohammad Nurul Islam' }}</h2>
                        <span
                            class="leader-title">{{ $bestPresident?->designation?->name ?? (is_string($bestPresident?->designation) ? $bestPresident->designation : 'Best President Ever & Lifetime Patron') }}</span>
                        <div class="quote-box">
                            <i class="fas fa-quote-right quote-watermark"></i>
                            “{{ $bestPresident?->speech ?: 'A true humanitarian mission is not measured by the size of donations, but by the purity of transparency and the dignity restored to every vulnerable life we touch.' }}”
                        </div>
                        <p class="bio-desc">
                            {{ $bestPresident?->bio ?: 'Recognized as the foundational cornerstone and most beloved leader of Shanti Nagar Foundation. Under his visionary stewardship, our grassroots relief initiatives reached over 50,000 underprivileged families with 100% itemized audit transparency and direct field procurement.' }}
                        </p>
                        <div class="president-signature-wrap">
                            <span class="president-sign">{{ $bestPresident?->signature_text ?: ($bestPresident?->name ?? 'Alhaj Mohammad Nurul Islam') }}</span>
                            <span class="sign-title"><i class="fas fa-check-circle me-1"></i> {{ $bestPresident?->signature_title ?: 'Founding Pillar • Lifetime Patron' }}</span>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 image-col mt-4 mt-lg-0">
                        <div class="image-wrapper">
                            <div class="img-frame">
                                <img class="main-portrait"
                                    src="{{ $bestPresident?->photo_url ?: asset('assets/images/team/team-9.jpg') }}"
                                    alt="{{ $bestPresident?->name ?? 'Best President Ever' }}">
                                <div class="crown-badge" title="Best President Ever"><i class="fas fa-crown"></i></div>
                                <div class="frame-plaque"><i class="fas fa-award me-1"></i> Lifetime Presidential Honor
                                </div>
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
                <span class="top-text">Executive Leadership</span>
                <h2>Governing Secretariat & Leadership Messages</h2>
                <p>Guiding Shanti Nagar Foundation with visionary compassion, financial integrity, and grassroots action.
                </p>
            </div>

            <div class="leadership-stack">
                <!-- 1. President (Top - LTR) -->
                <div class="leader-speech-card president-theme rtl-layout">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5 text-center leader-profile-col">
                            <span class="role-badge"><i class="fas fa-user-tie me-1"></i> {{ $president?->badge_title ?: 'President' }}</span>
                            <div class="avatar-box">
                                <img src="{{ $president?->photo_url ?: asset('assets/images/team/team-5.jpg') }}"
                                    alt="{{ $president?->name ?? 'President' }}">
                            </div>
                            <h3>{{ $president?->name ?? 'Advocate Mahfuzur Rahman' }}</h3>
                            <span
                                class="designation-text">{{ $president?->designation?->name ?? (is_string($president?->designation) ? $president->designation : 'President, Governing Body') }}</span>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                {{ $president?->present_address ?: 'Shanti Nagar, Dhaka' }}
                            </div>
                            <ul class="contact-links">
                                <li><a href="tel:{{ $president?->phone ?: '+8801711223344' }}" title="Call President"><i
                                            class="fas fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $president?->email ?: 'president@shantinagarfoundation.org' }}"
                                        title="Email President"><i class="fas fa-envelope"></i></a></li>
                                @if($president?->facebook_url)
                                <li><a href="{{ $president->facebook_url }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($president?->linkedin_url)
                                <li><a href="{{ $president->linkedin_url }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-7 leader-speech-col">
                            <div class="speech-content">
                                <div class="speech-header">
                                    <span class="speech-tag"><i class="fas fa-quote-left me-2"></i> {{ $president?->speech_tag ?: "President's Address & Vision" }}</span>
                                </div>
                                <blockquote>
                                    "{{ $president?->speech ?: 'Our sacred mission is ensuring no underprivileged family in our community is left without healthcare, clean water, or emergency shelter. At Shanti Nagar Foundation, we believe true leadership is rooted in selfless service. By uniting generous benefactors with verified grassroots programs, we turn empathy into permanent, dignity-restoring action across Bangladesh.' }}"
                                </blockquote>
                                <div class="speech-footer">
                                    <span class="leader-sign">{{ $president?->signature_text ?: ($president?->name ?? 'Advocate Mahfuzur Rahman') }}</span>
                                    <span class="sign-sub">{{ $president?->signature_title ?: 'President • Shanti Nagar Foundation' }}</span>
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
                                    <span class="speech-tag"><i class="fas fa-quote-left me-2"></i> {{ $secretary?->speech_tag ?: "General Secretary's Statement" }}</span>
                                </div>
                                <blockquote>
                                    "{{ $secretary?->speech ?: 'Unwavering transparency, rapid disaster mobilization, and grounded field execution define our operational ethos. Every project is meticulously planned, vetted, and executed with our dedicated volunteer force to ensure immediate and direct relief to those facing hardship.' }}"
                                </blockquote>
                                <div class="speech-footer">
                                    <span class="leader-sign">{{ $secretary?->signature_text ?: ($secretary?->name ?? 'Dr. Kazi Ashraful Alam') }}</span>
                                    <span class="sign-sub">{{ $secretary?->signature_title ?: 'General Secretary • Shanti Nagar Foundation' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 order-lg-2 order-md-2 order-1 text-center leader-profile-col">
                            <span class="role-badge"><i class="fas fa-clipboard-check me-1"></i> {{ $secretary?->badge_title ?: 'General Secretary' }}</span>
                            <div class="avatar-box">
                                <img src="{{ $secretary?->photo_url ?: asset('assets/images/team/team-6.jpg') }}"
                                    alt="{{ $secretary?->name ?? 'General Secretary' }}">
                            </div>
                            <h3>{{ $secretary?->name ?? 'Dr. Kazi Ashraful Alam' }}</h3>
                            <span class="designation-text">{{ $secretary?->designation?->name ?? (is_string($secretary?->designation) ? $secretary->designation : 'General Secretary') }}</span>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                {{ $secretary?->present_address ?: 'Shanti Nagar, Dhaka' }}
                            </div>
                            <ul class="contact-links">
                                <li><a href="tel:{{ $secretary?->phone ?: '+8801712334455' }}" title="Call Secretary"><i
                                            class="fas fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $secretary?->email ?: 'secretary@shantinagarfoundation.org' }}"
                                        title="Email Secretary"><i class="fas fa-envelope"></i></a></li>
                                @if($secretary?->facebook_url)
                                <li><a href="{{ $secretary->facebook_url }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($secretary?->linkedin_url)
                                <li><a href="{{ $secretary->linkedin_url }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 3. Treasurer (Bottom - LTR) -->
                <div class="leader-speech-card treasurer-theme rtl-layout">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-5 text-center leader-profile-col">
                            <span class="role-badge"><i class="fas fa-coins me-1"></i> {{ $treasurer?->badge_title ?: 'Treasurer' }}</span>
                            <div class="avatar-box">
                                <img src="{{ $treasurer?->photo_url ?: asset('assets/images/team/team-7.jpg') }}"
                                    alt="{{ $treasurer?->name ?? 'Treasurer' }}">
                            </div>
                            <h3>{{ $treasurer?->name ?? 'Engr. Shahadat Hossain' }}</h3>
                            <span
                                class="designation-text">{{ $treasurer?->designation?->name ?? (is_string($treasurer?->designation) ? $treasurer->designation : 'Treasurer & Finance Secretary') }}</span>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                {{ $treasurer?->present_address ?: 'Shanti Nagar, Dhaka' }}
                            </div>
                            <ul class="contact-links">
                                <li><a href="tel:{{ $treasurer?->phone ?: '+8801713445566' }}" title="Call Treasurer"><i
                                            class="fas fa-phone"></i></a></li>
                                <li><a href="mailto:{{ $treasurer?->email ?: 'treasurer@shantinagarfoundation.org' }}"
                                        title="Email Treasurer"><i class="fas fa-envelope"></i></a></li>
                                @if($treasurer?->facebook_url)
                                <li><a href="{{ $treasurer->facebook_url }}" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($treasurer?->linkedin_url)
                                <li><a href="{{ $treasurer->linkedin_url }}" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-8 col-md-7 leader-speech-col">
                            <div class="speech-content">
                                <div class="speech-header">
                                    <span class="speech-tag"><i class="fas fa-quote-left me-2"></i> {{ $treasurer?->speech_tag ?: "Treasurer's Financial Assurance" }}</span>
                                </div>
                                <blockquote>
                                    "{{ $treasurer?->speech ?: 'We treat every single Taka as a sacred public trust (Amanah). Through strict auditing, zero-leakage fund tracking, and transparent reporting, we guarantee that your contributions directly uplift real human lives with the highest financial integrity.' }}"
                                </blockquote>
                                <div class="speech-footer">
                                    <span class="leader-sign">{{ $treasurer?->signature_text ?: ($treasurer?->name ?? 'Engr. Shahadat Hossain') }}</span>
                                    <span class="sign-sub">{{ $treasurer?->signature_title ?: 'Treasurer • Shanti Nagar Foundation' }}</span>
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
    <section class="team-section centred">
        <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-23.png') }});"></div>
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="top-text">Board of Directors (BOD)</span>
                <h2>Esteemed Directors Guiding Our Strategic Initiatives</h2>
                <p>Dedicated community leaders and professionals stewarding specific humanitarian relief portfolios.</p>
            </div>

            <div class="bod-ltr-carousel owl-carousel owl-theme owl-dots-none">
                @php
                    $rawBod = (isset($bodMembers) && $bodMembers->count() > 0) ? $bodMembers : [
                        (object) [
                            'name' => 'Mohammad Anwarul Kabir',
                            'designation' => 'Director (Relief Operations)',
                            'photo_url' => asset('assets/images/team/team-8.jpg'),
                            'phone' => '+8801715556677',
                            'email' => 'anwar.bod@shantinagarfoundation.org'
                        ],
                        (object) [
                            'name' => 'Begum Rashida Akhtar',
                            'designation' => 'Director (Social Welfare)',
                            'photo_url' => asset('assets/images/team/team-2.jpg'),
                            'phone' => '+8801817778899',
                            'email' => 'rashida.bod@shantinagarfoundation.org'
                        ],
                        (object) [
                            'name' => 'Dr. Tariqul Islam',
                            'designation' => 'Director (Medical Aid)',
                            'photo_url' => asset('assets/images/team/team-3.jpg'),
                            'phone' => '+8801918889900',
                            'email' => 'tariqul.bod@shantinagarfoundation.org'
                        ],
                        (object) [
                            'name' => 'Farhana Yasmin',
                            'designation' => 'Director (Women & Education)',
                            'photo_url' => asset('assets/images/team/team-4.jpg'),
                            'phone' => '+8801519990011',
                            'email' => 'farhana.bod@shantinagarfoundation.org'
                        ],
                    ];
                    $bodCollection = collect($rawBod);
                    $renderBod = $bodCollection->count() < 6 ? $bodCollection->concat($bodCollection) : $bodCollection;
                @endphp

                @foreach($renderBod as $bod)
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ is_object($bod) && isset($bod->photo_url) ? $bod->photo_url : asset('assets/images/team/team-1.jpg') }}"
                                    alt="{{ $bod->name }}">
                            </figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">{{ is_object($bod->designation) ? $bod->designation->name : $bod->designation }}</span>
                                    <h3>{{ $bod->name }}</h3>
                                </div>
                                <figure class="thumb-box"><img
                                        src="{{ is_object($bod) && isset($bod->photo_url) ? $bod->photo_url : asset('assets/images/team/team-1.jpg') }}"
                                        alt="{{ $bod->name }}"></figure>
                                <div class="text">
                                    <p>{{ is_object($bod->designation) ? ($bod->designation->category ?? 'Board Member') : 'Board of Directors' }}</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                @if(!empty($bod->phone))
                                    <li>
                                        <a href="tel:{{ $bod->phone }}" title="Call {{ $bod->name }}"><i
                                                class="fas fa-phone"></i></a>
                                    </li>
                                @endif
                                @if(!empty($bod->email))
                                    <li>
                                        <a href="mailto:{{ $bod->email }}" title="Email {{ $bod->name }}"><i
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
    @php
        $rawOthers = (isset($otherMembers) && $otherMembers->count() > 0) ? $otherMembers : [
            (object) [
                'name' => 'Rafiqul Islam',
                'designation' => 'Field Project Coordinator',
                'present_address' => 'Shanti Nagar, Dhaka',
                'photo_url' => asset('assets/images/team/team-1.jpg'),
                'phone' => '+8801712998877',
                'email' => 'rafiq.field@shantinagarfoundation.org'
            ],
            (object) [
                'name' => 'Fatema Begum',
                'designation' => 'Accounts Officer',
                'present_address' => 'Malibagh, Dhaka',
                'photo_url' => asset('assets/images/team/team-2.jpg'),
                'phone' => '+8801815667788',
                'email' => 'fatema.acc@shantinagarfoundation.org'
            ],
            (object) [
                'name' => 'Kamrul Hasan',
                'designation' => 'Volunteer Supervisor',
                'present_address' => 'Shanti Nagar, Dhaka',
                'photo_url' => asset('assets/images/team/team-3.jpg'),
                'phone' => '+8801914332211',
                'email' => 'kamrul.volunteer@shantinagarfoundation.org'
            ],
            (object) [
                'name' => 'Abdul Kader',
                'designation' => 'Office Logistics Assistant',
                'present_address' => 'Staff Quarters, Dhaka',
                'photo_url' => asset('assets/images/team/team-4.jpg'),
                'phone' => '+8801611009988',
                'email' => null
            ],
        ];
        $otherCollection = collect($rawOthers);
        $renderOthers = $otherCollection->count() < 6 ? $otherCollection->concat($otherCollection) : $otherCollection;
    @endphp
    <section class="team-section centred" style="background-color: #f7f9fc; padding-top: 80px; padding-bottom: 80px;">
        <div class="auto-container">
            <div class="sec-title centred">
                <span class="top-text">Foundation Officers & Coordinators</span>
                <h2>Dedicated Ground Officers & Operations Team</h2>
                <p>The passionate on-field coordinators, accountants, and volunteer supervisors executing daily relief
                    drives.</p>
            </div>

            <div class="members-rtl-carousel owl-carousel owl-theme owl-dots-none" dir="rtl">
                @foreach($renderOthers as $om)
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box">
                                <img src="{{ is_object($om) && isset($om->photo_url) ? $om->photo_url : asset('assets/images/team/team-1.jpg') }}"
                                    alt="{{ $om->name }}">
                            </figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">{{ is_object($om->designation) ? $om->designation->name : $om->designation }}</span>
                                    <h3>{{ $om->name }}</h3>
                                </div>
                                <figure class="thumb-box"><img
                                        src="{{ is_object($om) && isset($om->photo_url) ? $om->photo_url : asset('assets/images/team/team-1.jpg') }}"
                                        alt="{{ $om->name }}"></figure>
                                <div class="text">
                                    <p>{{ $om->present_address ?: 'Dhaka, Bangladesh' }}</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                @if(!empty($om->phone))
                                    <li>
                                        <a href="tel:{{ $om->phone }}" title="Call {{ $om->name }}"><i class="fas fa-phone"></i></a>
                                    </li>
                                @endif
                                @if(!empty($om->email))
                                    <li>
                                        <a href="mailto:{{ $om->email }}" title="Email {{ $om->name }}"><i
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


    <!-- 4) Feature Section (Mission, Vision, Goal, Community) -->
    <section class="feature-section centred">
        <div class="fluid-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>M</span>
                            <div class="icon-box"><i class="icon-mission"></i></div>
                            <h3>Our Mission</h3>
                            <p>Delivering urgent medical equipment, healthcare aid, and emergency relief to underserved
                                communities across Bangladesh through direct volunteer field distribution.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>V</span>
                            <div class="icon-box"><i class="icon-medical-report"></i></div>
                            <h3>Our Vision</h3>
                            <p>A self-reliant Bangladesh where every deserving family has access to safe drinking water,
                                essential hospital healthcare, and dignified livelihood support.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>G</span>
                            <div class="icon-box"><i class="icon-goal"></i></div>
                            <h3>Our Goal</h3>
                            <p>Ensuring absolute financial accountability by eliminating middlemen, procuring goods
                                directly, and preserving itemized audit vouchers for every Taka contributed.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one">
                        <div class="inner-box">
                            <span>C</span>
                            <div class="icon-box"><i class="icon-fair-trade"></i></div>
                            <h3>Our Community</h3>
                            <p>Mobilizing passionate youth volunteers, healthcare workers, and local elders to identify,
                                physically verify, and support vulnerable families with empathy.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature Section -->


    <!-- 5) Contribution Section (Core Relief Pillars) -->
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
    <!-- End Contribution Section -->


    <!-- 6) Report Section (Financial Transparency & Allocation) -->
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
                                <p>Every single Taka received is deployed directly to verified ground missions, accompanied
                                    by itemized vendor receipts and money receipts.</p>
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
                                        <div class="piechart" data-fg-color="#005daa" data-value="{{ $pieVal1 }}">
                                        </div>
                                        <span>Fund <br />Utilization</span>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $utilizationRatio }}%</h2>
                                        <h3>Fund Deployment Ratio</h3>
                                        <p>Donations directly translated into active field relief, equipment, and community
                                            welfare.</p>
                                        <a href="{{ route('donations') }}"><i class="far fa-angle-right"></i>View Active
                                            Causes</a>
                                    </div>
                                </div>
                                <div class="single-progress-box">
                                    <div class="box">
                                        <div class="piechart" data-fg-color="#ffb81c" data-value="{{ $pieVal2 }}">
                                        </div>
                                        <span>Direct <br />Field Aid</span>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $directAidRatio }}%</h2>
                                        <h3>Direct Procurement Ratio</h3>
                                        <p>Direct procurement of hospital gear, tube-wells, and food supplies with zero
                                            intermediary cut.</p>
                                        <a href="{{ route('about') }}"><i class="far fa-angle-right"></i>Our Transparency
                                            Policy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Report Section -->

@endsection

@push('custom-script')
    <!-- GSAP & ScrollTrigger Animation Engine -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
                return;
            }

            gsap.registerPlugin(ScrollTrigger);

            // 1. Parallax Scroll on Ambient Decorative Shapes
            gsap.to(".leadership-section .shape-layer .shape-1", {
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

            gsap.to(".leadership-section .shape-layer .shape-2", {
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

            // 2. Step-by-Step Alternating Reveal for Leader Cards with Dedicated IN and OUT Animations
            const leaderCards = document.querySelectorAll('.leadership-section .leader-speech-card');

            leaderCards.forEach((card, index) => {
                // Direction pattern: 1st card -> RTL (enters from right), 2nd card -> LTR (enters from left), 3rd card -> RTL (enters from right)
                const isRtlSlide = (index % 2 === 0);
                const enterX = isRtlSlide ? 120 : -120;
                const exitX = isRtlSlide ? -120 : 120; // Glides out to the other side when leaving top

                const profileCol = card.querySelector('.leader-profile-col');
                const roleBadge = card.querySelector('.role-badge');
                const avatarBox = card.querySelector('.avatar-box');
                const leaderInfo = card.querySelectorAll('.leader-profile-col h3, .leader-profile-col .designation-text, .leader-profile-col .location-info, .leader-profile-col .contact-links');
                const speechTag = card.querySelector('.speech-tag');
                const quoteText = card.querySelector('blockquote');
                const speechFooter = card.querySelector('.speech-footer');

                // Set Initial Hidden State
                gsap.set(card, { opacity: 0, x: enterX, y: 35, scale: 0.95 });
                if (avatarBox) gsap.set(avatarBox, { opacity: 0, scale: 0.7, rotation: isRtlSlide ? 10 : -10 });
                if (roleBadge) gsap.set(roleBadge, { opacity: 0, y: -18 });
                if (leaderInfo && leaderInfo.length > 0) gsap.set(leaderInfo, { opacity: 0, y: 15 });
                if (speechTag) gsap.set(speechTag, { opacity: 0, x: isRtlSlide ? -25 : 25 });
                if (quoteText) gsap.set(quoteText, { opacity: 0, y: 20 });
                if (speechFooter) gsap.set(speechFooter, { opacity: 0, y: 15 });

                // Function: Animate In (Step-by-step reveal)
                function animateIn() {
                    gsap.killTweensOf([card, avatarBox, roleBadge, leaderInfo, speechTag, quoteText, speechFooter]);

                    const tl = gsap.timeline();
                    tl.to(card, {
                        opacity: 1,
                        x: 0,
                        y: 0,
                        scale: 1,
                        duration: 0.8,
                        ease: "power3.out"
                    });

                    if (avatarBox) {
                        tl.to(avatarBox, { opacity: 1, scale: 1, rotation: 0, duration: 0.55, ease: "back.out(1.8)" }, "-=0.5");
                    }
                    if (roleBadge) {
                        tl.to(roleBadge, { opacity: 1, y: 0, duration: 0.4, ease: "power2.out" }, "-=0.4");
                    }
                    if (leaderInfo && leaderInfo.length > 0) {
                        tl.to(leaderInfo, { opacity: 1, y: 0, duration: 0.4, stagger: 0.07, ease: "power2.out" }, "-=0.35");
                    }
                    if (speechTag) {
                        tl.to(speechTag, { opacity: 1, x: 0, duration: 0.45, ease: "power2.out" }, "-=0.35");
                    }
                    if (quoteText) {
                        tl.to(quoteText, { opacity: 1, y: 0, duration: 0.55, ease: "power3.out" }, "-=0.3");
                    }
                    if (speechFooter) {
                        tl.to(speechFooter, { opacity: 1, y: 0, duration: 0.45, ease: "power2.out" }, "-=0.35");
                    }
                }

                // Function: Animate Out To Top (When scrolling past top)
                function animateOutTop() {
                    gsap.killTweensOf([card, avatarBox, roleBadge, leaderInfo, speechTag, quoteText, speechFooter]);
                    gsap.to(card, {
                        opacity: 0,
                        x: exitX,
                        y: -40,
                        scale: 0.94,
                        duration: 0.65,
                        ease: "power2.inOut"
                    });
                }

                // Function: Animate Out To Bottom (When scrolling back up past bottom)
                function animateOutBottom() {
                    gsap.killTweensOf([card, avatarBox, roleBadge, leaderInfo, speechTag, quoteText, speechFooter]);
                    gsap.to(card, {
                        opacity: 0,
                        x: enterX,
                        y: 35,
                        scale: 0.95,
                        duration: 0.65,
                        ease: "power2.inOut"
                    });
                    // Reset child elements for fresh entrance next time
                    if (avatarBox) gsap.set(avatarBox, { opacity: 0, scale: 0.7, rotation: isRtlSlide ? 10 : -10 });
                    if (roleBadge) gsap.set(roleBadge, { opacity: 0, y: -18 });
                    if (leaderInfo && leaderInfo.length > 0) gsap.set(leaderInfo, { opacity: 0, y: 15 });
                    if (speechTag) gsap.set(speechTag, { opacity: 0, x: isRtlSlide ? -25 : 25 });
                    if (quoteText) gsap.set(quoteText, { opacity: 0, y: 20 });
                    if (speechFooter) gsap.set(speechFooter, { opacity: 0, y: 15 });
                }

                // ScrollTrigger attached to each card for bidirectional IN and OUT
                ScrollTrigger.create({
                    trigger: card,
                    start: "top 88%",
                    end: "bottom 15%",
                    onEnter: () => animateIn(),
                    onLeave: () => animateOutTop(),
                    onEnterBack: () => animateIn(),
                    onLeaveBack: () => animateOutBottom()
                });
            });
        });
    </script>
@endpush