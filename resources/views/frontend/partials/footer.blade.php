<section class="main-footer">
    <div class="footer-top">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Column 1: Organization Brand & Tagline -->
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget about-widget pe-lg-3">
                        <div class="footer-brand-wrap">
                            <a href="{{ route('home') }}" class="d-inline-flex align-items-center text-decoration-none">
                                <img src="{{ asset('assets/images/logo.png') }}"
                                    alt="{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}"
                                    class="footer-main-logo rotary-rotating-logo">
                                <div class="footer-brand-info">
                                    <span class="footer-brand-eyebrow">{{ __('Rotary International') }}</span>
                                    <h4 class="footer-brand-title">{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}</h4>
                                </div>
                            </a>
                        </div>
                        <div class="text">
                            <p style="color: #a0aec0; font-size: 14.5px; line-height: 1.6; margin-bottom: 22px;">
                                {{ site_setting('tagline', __('Dedicated to grassroots humanitarian relief, healthcare aid, and community empowerment in Bangladesh.')) }}
                            </p>
                            <div class="d-flex flex-wrap align-items-center gap-3">
                                <a href="{{ route('volunteer') }}" class="theme-btn btn-one" style="padding: 10px 22px; font-size: 14px;">
                                    <i class="fas fa-hands-helping me-1"></i> {{ __('Join As Volunteer') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml-30">
                        <div class="widget-title">
                            <h3>{{ __('Quick Links') }}</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                                <li><a href="{{ route('donations') }}">{{ __('Projects & Causes') }}</a></li>
                                <li><a href="{{ route('events') }}">{{ __('Activities') }}</a></li>
                                <li><a href="{{ route('gallery') }}">{{ __('Gallery') }}</a></li>
                                <li><a href="{{ route('volunteer') }}">{{ __('Volunteer Registration') }}</a></li>
                                <li><a href="{{ route('faq') }}">{{ __('FAQ & Transparency') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 3: Humanitarian Causes -->
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml-30">
                        <div class="widget-title">
                            <h3>{{ __('Humanitarian Causes') }}</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ route('donations') }}">{{ __('Healthcare & Hospital Gear') }}</a></li>
                                <li><a href="{{ route('donations') }}">{{ __('Orphan Kits & Education') }}</a></li>
                                <li><a href="{{ route('donations') }}">{{ __('Arsenic-Free Deep Tube-Wells') }}</a></li>
                                <li><a href="{{ route('donations') }}">{{ __('Emergency Seasonal Food Relief') }}</a></li>
                                <li><a href="{{ route('donations') }}">{{ __('Zakat & Sadaqah Fund') }}</a></li>
                                <li><a href="{{ route('donate') }}">{{ __('Direct bKash / Bank Donation') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 4: Contact & Coordination -->
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget contact-widget ml-30">
                        <div class="title-box">
                            <div class="icon-box"><i class="fas fa-hand-holding-heart text-warning"></i></div>
                            <span>{{ __('Central Coordination') }}</span>
                            <h3>{{ __('Giving / Enquiry') }}</h3>
                        </div>
                        <div class="widget-content">
                            <div class="single-item">
                                <h3><a
                                        href="tel:{{ preg_replace('/[^0-9+]/', '', site_setting('hotline', '+8801711000000')) }}">{{ site_setting('hotline', '+880 1711-000000') }}</a>
                                </h3>
                                <p><a
                                        href="mailto:{{ site_setting('email', 'contact@rotaryshantinagardhaka.org') }}">{{
                                        site_setting('email', 'contact@rotaryshantinagardhaka.org') }}</a>
                                </p>
                            </div>
                            <div class="single-item">
                                <h5>{{ __('Head Office') }}</h5>
                                <p>{{ site_setting('address', 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh.') }}
                                </p>
                            </div>

                            <!-- Social Links -->
                            <div class="footer-social-links">
                                <a href="{{ site_setting('facebook', 'https://facebook.com') }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ site_setting('twitter', 'https://twitter.com') }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ site_setting('linkedin', 'https://linkedin.com') }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" title="LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="{{ site_setting('youtube', 'https://youtube.com') }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" title="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-box clearfix">
                <div class="copyright text-center">
                    <p>&copy; {{ date('Y') }} <a
                            href="{{ route('home') }}">{{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}</a>.
                        {{ __('Developed by') }} <strong style="color: var(--theme-secondary);">Inceptia</strong>. {{ __('All Rights Reserved.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>