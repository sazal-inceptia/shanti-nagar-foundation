<!-- subscribe-section -->
<section class="subscribe-section">
    <div class="bg-layer"></div>
    <div class="auto-container">
        <div class="inner-box clearfix">
            <div class="left-column pull-left">
                <div class="logo-box">
                    <div class="shape" style="background-image: url({{ asset('assets/images/shape/shape-1.png') }});">
                    </div>
                    <figure class="logo"><a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}"
                                alt="Shanti Nagar Foundation"></a>
                    </figure>
                </div>
                <div class="text">
                    <h3><i class="icon-donation"></i>Together For <br />Humanity</h3>
                </div>
            </div>
            <div class="right-column pull-right clearfix">
                <div class="callout-text">
                    <p>Empowering distressed families, hospital wards, and orphan children across Bangladesh with 100% direct relief and zero intermediaries.</p>
                </div>
                <ul class="social-style-one clearfix">
                    <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer" title="Facebook"><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer" title="Twitter"><i
                                class="fab fa-twitter"></i></a></li>
                    <li><a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" title="LinkedIn"><i
                                class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="https://youtube.com" target="_blank" rel="noopener noreferrer" title="YouTube"><i
                                class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- subscribe-section end -->


<section class="main-footer">
    <div class="footer-top">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget about-widget">
                        <div class="title-box">
                            <div class="icon-box"><i class="icon-hand"></i></div>
                            <span>Grassroots Initiative</span>
                            <h3>Shanti Nagar Foundation</h3>
                        </div>
                        <div class="text">
                            <p>Connecting compassionate donors directly with verified humanitarian relief, hospital
                                equipment aid, pure water wells, and orphan welfare across Bangladesh with 100%
                                financial transparency.</p>
                            <a href="{{ route('volunteer') }}" class="theme-btn btn-one">Join As Volunteer</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml-30">
                        <div class="widget-title">
                            <h3>Quick Links</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ route('about') }}">About Our Mission</a></li>
                                <li><a href="{{ route('donations') }}">Active Relief Causes</a></li>
                                <li><a href="{{ route('events') }}">Upcoming Activities</a></li>
                                <li><a href="{{ route('gallery') }}">Field Documentation</a></li>
                                <li><a href="{{ route('volunteer') }}">Volunteer Registration</a></li>
                                <li><a href="{{ route('faq') }}">FAQ & Transparency</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml-30">
                        <div class="widget-title">
                            <h3>Humanitarian Causes</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ route('donations') }}">Healthcare & Hospital Gear</a></li>
                                <li><a href="{{ route('donations') }}">Orphan Kits & Education</a></li>
                                <li><a href="{{ route('donations') }}">Arsenic-Free Deep Tube-Wells</a></li>
                                <li><a href="{{ route('donations') }}">Emergency Seasonal Food Relief</a></li>
                                <li><a href="{{ route('donations') }}">Zakat & Sadaqah Fund</a></li>
                                <li><a href="{{ route('donate') }}">Direct bKash / Bank Donation</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget contact-widget ml-30">
                        <div class="title-box">
                            <div class="icon-box"><i class="icon-donation-2"></i></div>
                            <span>Central Coordination</span>
                            <h3>Giving / Enquiry</h3>
                        </div>
                        <div class="widget-content">
                            <div class="single-item">
                                <h3><a href="tel:+8801700000000">+880 1700-000000</a></h3>
                                <p><a href="mailto:info@shantinagarfoundation.org">info@shantinagarfoundation.org</a>
                                </p>
                            </div>
                            <div class="single-item">
                                <h5>Head Office</h5>
                                <p>House 14, Road 3, Shanti Nagar, Dhaka - 1217, Bangladesh.</p>
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
                <div class="copyright pull-left">
                    <p>&copy; {{ date('Y') }} <a href="{{ route('home') }}">Shanti Nagar Foundation</a>. All Rights
                        Reserved.</p>
                </div>
                <ul class="footer-card pull-right clearfix">
                    <li><span>Direct Donation Methods:</span></li>
                    <li><a href="{{ route('donate') }}" class="donation-badge" title="bKash Merchant & Personal Donation">bKash</a></li>
                    <li><a href="{{ route('donate') }}" class="donation-badge" title="Nagad Donation">Nagad</a></li>
                    <li><a href="{{ route('donate') }}" class="donation-badge" title="Rocket Donation">Rocket</a></li>
                    <li><a href="{{ route('donate') }}" class="donation-badge" title="Direct Bank Wire / Online Deposit">Bank Deposit</a></li>
                    <li><a href="{{ route('donate') }}" class="donation-badge" title="Official Money Receipt Voucher">Cash Voucher</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>