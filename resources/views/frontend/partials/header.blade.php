<header class="main-header snf-header">
    <div class="header-inner-wrap">
        <div class="auto-container">
            <div class="header-content-box">
                <!-- 1. Logo (In Flow / Not Absolute) -->
                <div class="logo-box">
                    <a href="{{ route('home') }}"
                        class="d-inline-flex align-items-center text-decoration-none logo-interactive-anchor">
                        <img src="{{ asset('assets/images/logo.png') }}"
                            alt="{{ $siteSettings['org_name'] ?? 'Rotary Club of Shantinagar Dhaka' }}"
                            class="header-main-logo rotary-rotating-logo">
                        <div class="header-brand-wrap d-none d-md-flex">
                            <span class="header-brand-eyebrow">
                                Rotary International
                            </span>
                            <span class="header-brand-title">Rotary Club of Shantinagar</span>
                            <span class="header-brand-subtitle">
                                <span class="badge-city">Dhaka</span>
                                <span class="badge-sep">•</span>
                                <span class="badge-country">Bangladesh</span>
                            </span>
                        </div>
                    </a>
                </div>

                <!-- 2. Navigation Menu -->
                <div class="menu-area clearfix">
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>

                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ request()->is('/') ? 'current' : '' }}"><a
                                        href="{{ route('home') }}">Home</a></li>
                                <li class="{{ request()->is('about*') ? 'current' : '' }}"><a
                                        href="{{ route('about') }}">About Us</a></li>
                                <li class="{{ request()->is('donation*') ? 'current' : '' }}"><a
                                        href="{{ route('donations') }}">Projects &amp; Causes</a></li>
                                <li class="{{ request()->is('event*') ? 'current' : '' }}"><a
                                        href="{{ route('events') }}">Activities</a></li>
                                <li class="{{ request()->is('gallery*') ? 'current' : '' }}"><a
                                        href="{{ route('gallery') }}">Gallery</a></li>
                                <li class="{{ request()->is('contact*') ? 'current' : '' }}"><a
                                        href="{{ route('contact') }}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- 3. Donate Now Button -->
                <div class="header-action-box">
                    <a href="{{ route('donate') }}" class="theme-btn btn-one header-donate-btn">
                        <span>Donate Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo p-3 text-center">
            <a href="{{ route('home') }}" class="d-inline-flex flex-column align-items-center text-decoration-none">
                <img src="{{ asset('assets/images/logo.png') }}"
                    alt="{{ $siteSettings['org_name'] ?? 'Rotary Club of Shantinagar Dhaka' }}"
                    title="{{ $siteSettings['org_name'] ?? 'Rotary Club of Shantinagar Dhaka' }}"
                    style="max-height: 65px; width: auto;">
                <span class="mt-2" style="font-size: 14px; font-weight: 800; color: #111A3A; line-height: 1.2;">Rotary
                    Club of Shantinagar Dhaka</span>
            </a>
        </div>
        <div class="menu-outer"><!-- Cloned via Javascript --></div>
        <div class="p-3 text-center">
            <a href="{{ route('donate') }}"
                class="theme-btn btn-one w-100 justify-content-center d-inline-flex align-items-center">
                <i class="fas fa-heart me-2"></i> Donate Now
            </a>
        </div>
        <div class="contact-info mt-2">
            <h4>Contact Info</h4>
            <ul>
                <li>{{ $siteSettings['address'] ?? 'Shanti Nagar, Dhaka - 1217, Bangladesh' }}</li>
                <li><a
                        href="tel:{{ preg_replace('/[^0-9+]/', '', $siteSettings['hotline'] ?? '+8801711000000') }}">{{ $siteSettings['hotline'] ?? '+880 1711-000000' }}</a>
                </li>
                <li><a href="mailto:{{ $siteSettings['email'] ?? 'contact@rotaryshantinagardhaka.org' }}">{{
                        $siteSettings['email'] ?? 'contact@rotaryshantinagardhaka.org' }}</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="{{ $siteSettings['facebook'] ?? 'https://facebook.com' }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="{{ $siteSettings['twitter'] ?? 'https://twitter.com' }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-twitter"></span></a></li>
                <li><a href="{{ $siteSettings['linkedin'] ?? 'https://linkedin.com' }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-linkedin-in"></span></a></li>
                <li><a href="{{ $siteSettings['youtube'] ?? 'https://youtube.com' }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->