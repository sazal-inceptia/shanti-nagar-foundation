<header class="main-header snf-header">
    <div class="header-inner-wrap">
        <div class="auto-container">
            <div class="header-content-box">
                <!-- 1. Logo (In Flow / Not Absolute) -->
                <div class="logo-box">
                    <a href="{{ route('home') }}"
                        class="d-inline-flex align-items-center text-decoration-none logo-interactive-anchor">
                        <img src="{{ asset('assets/images/logo.png') }}"
                            alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}"
                            class="header-main-logo rotary-rotating-logo">
                        <div class="header-brand-wrap d-none d-md-flex">
                            <span class="header-brand-eyebrow">
                                {{ __('Rotary International') }}
                            </span>
                            <span class="header-brand-title">{{ __('Rotary Club of Shantinagar') }}</span>
                            <span class="header-brand-subtitle">
                                <span class="badge-city">{{ __('Dhaka') }}</span>
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
                                        href="{{ route('home') }}">{{ __('Home') }}</a></li>
                                <li class="{{ request()->is('about*') ? 'current' : '' }}"><a
                                        href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                                <li class="{{ request()->is('donation*') ? 'current' : '' }}"><a
                                        href="{{ route('donations') }}">{{ __('Projects & Causes') }}</a></li>
                                <li class="{{ request()->is('event*') ? 'current' : '' }}"><a
                                        href="{{ route('events') }}">{{ __('Activities') }}</a></li>
                                <li class="{{ request()->is('gallery*') ? 'current' : '' }}"><a
                                        href="{{ route('gallery') }}">{{ __('Gallery') }}</a></li>
                                <li class="{{ request()->is('contact*') ? 'current' : '' }}"><a
                                        href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- 3. Language Switcher & Donate Now Button -->
                <div class="header-action-box d-flex align-items-center gap-3">
                    <div class="snf-lang-toggle">
                        <a href="{{ route('switch.lang', 'en') }}"
                            class="snf-lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}"
                            title="English">EN</a>
                        <span class="snf-lang-divider"></span>
                        <a href="{{ route('switch.lang', 'bn') }}"
                            class="snf-lang-btn {{ app()->getLocale() === 'bn' ? 'active' : '' }}" title="বাংলা">বাং</a>
                    </div>
                    <a href="{{ route('donate') }}" class="theme-btn btn-one header-donate-btn">
                        <span>{{ __('Donate Now') }}</span>
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
                    alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}"
                    title="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}"
                    style="max-height: 65px; width: auto;">
                <span class="mt-2"
                    style="font-size: 14px; font-weight: 800; color: #111A3A; line-height: 1.2;">{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}</span>
            </a>
        </div>

        <!-- Mobile Language Selector -->
        <div class="px-4 py-2 text-center">
            <div class="snf-lang-toggle d-inline-flex justify-content-center w-100"
                style="padding: 4px 10px; background: rgba(0, 93, 170, 0.08); border-radius: 30px;">
                <a href="{{ route('switch.lang', 'en') }}"
                    class="snf-lang-btn flex-fill {{ app()->getLocale() === 'en' ? 'active' : '' }}">English</a>
                <span class="snf-lang-divider"></span>
                <a href="{{ route('switch.lang', 'bn') }}"
                    class="snf-lang-btn flex-fill {{ app()->getLocale() === 'bn' ? 'active' : '' }}">বাংলা</a>
            </div>
        </div>

        <div class="menu-outer"><!-- Cloned via Javascript --></div>
        <div class="p-3 text-center">
            <a href="{{ route('donate') }}"
                class="theme-btn btn-one w-100 justify-content-center d-inline-flex align-items-center">
                <i class="fas fa-heart me-2"></i> {{ __('Donate Now') }}
            </a>
        </div>
        <div class="contact-info mt-2">
            <h4>{{ __('Contact Info') }}</h4>
            <ul>
                <li>{{ site_setting('address', 'Shanti Nagar, Dhaka - 1217, Bangladesh') }}</li>
                <li><a
                        href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('hotline', '+8801711000000')) }}">{{ site_setting('hotline', '+880 1711-000000') }}</a>
                </li>
                <li><a href="mailto:{{ site_setting('email', 'contact@rotaryshantinagardhaka.org') }}">{{
                        site_setting('email', 'contact@rotaryshantinagardhaka.org') }}</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="{{ site_setting('facebook', 'https://facebook.com') }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="{{ site_setting('twitter', 'https://twitter.com') }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-twitter"></span></a></li>
                <li><a href="{{ site_setting('linkedin', 'https://linkedin.com') }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-linkedin-in"></span></a></li>
                <li><a href="{{ site_setting('youtube', 'https://youtube.com') }}" target="_blank"
                        rel="noopener noreferrer"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->