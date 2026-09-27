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
                    <h3><i class="icon-email-open-sketched-envelope"></i>Stay <br /> Connected </h3>
                </div>
            </div>
            <div class="right-column pull-right clearfix">
                <div class="form-inner">
                    <form action="{{ route('contact.submit') }}" method="post" class="subscribe-form">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter your email address..." required="">
                            <input type="hidden" name="name" value="Newsletter Subscriber">
                            <input type="hidden" name="subject" value="Newsletter Subscription">
                            <input type="hidden" name="message"
                                value="Subscribed to Shanti Nagar Foundation relief and humanitarian updates.">
                            <button type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
                <ul class="social-style-one clearfix">
                    <li><a href="https://facebook.com" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-twitter"></i></a></li>
                    <li><a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"><i
                                class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="https://youtube.com" target="_blank" rel="noopener noreferrer"><i
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
                    <li><a href="{{ route('donate') }}" title="bKash / Nagad / Bank"><img
                                src="{{ asset('assets/images/resource/card-1.png') }}" alt="Donation Gateway 1"></a>
                    </li>
                    <li><a href="{{ route('donate') }}" title="Visa / Mastercard"><img
                                src="{{ asset('assets/images/resource/card-2.png') }}" alt="Donation Gateway 2"></a>
                    </li>
                    <li><a href="{{ route('donate') }}" title="Bank Transfer"><img
                                src="{{ asset('assets/images/resource/card-3.png') }}" alt="Donation Gateway 3"></a>
                    </li>
                    <li><a href="{{ route('donate') }}" title="Money Receipt Voucher"><img
                                src="{{ asset('assets/images/resource/card-4.png') }}" alt="Donation Gateway 4"></a>
                    </li>
                    <li><a href="{{ route('donate') }}" title="Secure Gateway"><img
                                src="{{ asset('assets/images/resource/card-5.png') }}" alt="Donation Gateway 5"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>