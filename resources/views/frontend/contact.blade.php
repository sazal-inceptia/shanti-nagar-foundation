@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Get In Touch</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- contact-section -->
        <section class="contact-section sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 inner-column">
                        <div class="contact-info-inner">
                            <div class="sec-title">
                                <span class="top-text">Connecting Always</span>
                                <h2>Hear by our Heart</h2>
                                <p>Our team is available to help with your enquiries on email & phone, or visit our place.</p>
                            </div>
                            <div class="info-box">
                                <div class="single-item">
                                    <h4>Quick Contact</h4>
                                    <div class="text">
                                        <div class="icon-box"><i class="icon-phone-call"></i></div>
                                        <p>Main Office<br /><a href="tel:23345678901">(+233) 456-789-01</a></p>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <h4>Email Address</h4>
                                    <div class="text">
                                        <div class="icon-box"><i class="icon-letter"></i></div>
                                        <p>Mail to<br /><a href="mailto:info@example.com">info@example.com</a></p>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <h4>Mailing Address</h4>
                                    <div class="text">
                                        <div class="icon-box"><i class="icon-location"></i></div>
                                        <p>54 Berrick Street, Boston <br />MA 02115.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 image-column">
                        <figure class="image-box"><img src="{{ asset('assets/images/resource/contact-1.png') }}" alt=""></figure>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 inner-column">
                        <div class="contact-form-inner">
                            <div class="sec-title">
                                <span class="top-text">Drop a Line</span>
                                <h2>Leave us Message</h2>
                                <p>Please feel free to get in touch using the form below. We'd love to hear for you.</p>
                            </div>
                            <div class="form-inner">
                                <form method="post" action="sendemail.php" id="contact-form" class="default-form"> 
                                    <div class="form-group">
                                        <i class="far fa-user"></i>
                                        <input type="text" name="username" placeholder="Your Name" required="">
                                    </div>
                                    <div class="form-group">
                                        <i class="far fa-envelope"></i>
                                        <input type="email" name="email" placeholder="Email Address" required="">
                                    </div>
                                    <div class="form-group">
                                        <i class="far fa-phone"></i>
                                        <input type="text" name="phone" required="" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <i class="far fa-sticky-note"></i>
                                        <input type="text" name="subject" required="" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <i class="far fa-text-height"></i>
                                        <textarea name="message" placeholder="Massage"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button class="theme-btn btn-one" type="submit" name="submit-form">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->


        <!-- essentials-section -->
        <section class="essentials-section centred">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                            <div class="single-item">
                                <div class="bg-layer" style="background-image: url({{ asset('assets/images/resource/contact-1.jpg') }});"></div>
                                <div class="icon-box">
                                    <div class="shape" style="background-image: url({{ asset('assets/images/shape/shape-13.png') }});"></div>
                                    <div class="shape-2" style="background-image: url({{ asset('assets/images/shape/shape-14.png') }});"></div>
                                    <i class="icon-chatting"></i>
                                </div>
                                <h3>Chat with a Live</h3>
                                <p>Let’s chat with our live experts to get answer your questions.</p>
                                <a href="/contact" class="theme-btn btn-one">Live Chat</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                            <div class="single-item">
                                <div class="bg-layer" style="background-image: url({{ asset('assets/images/resource/contact-1.jpg') }});"></div>
                                <div class="icon-box">
                                    <div class="shape" style="background-image: url({{ asset('assets/images/shape/shape-13.png') }});"></div>
                                    <div class="shape-2" style="background-image: url({{ asset('assets/images/shape/shape-14.png') }});"></div>
                                    <i class="icon-loyalty"></i>
                                </div>
                                <h3>Become a Partner</h3>
                                <p>Become a business partner with us and get an opportunity to grow.</p>
                                <a href="/contact" class="theme-btn btn-one">Join With Us</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                            <div class="single-item">
                                <div class="bg-layer" style="background-image: url({{ asset('assets/images/resource/contact-1.jpg') }});"></div>
                                <div class="icon-box"><div class="shape" style="background-image: url({{ asset('assets/images/shape/shape-13.png') }});"></div>
                                    <div class="shape-2" style="background-image: url({{ asset('assets/images/shape/shape-14.png') }});"></div>
                                    <i class="icon-search-1"></i>
                                </div>
                                <h3>Charity FAQ’s</h3>
                                <p>You can find the answers in our list of frequently asked questions.</p>
                                <a href="/contact" class="theme-btn btn-one">Get Answer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- essentials-section end -->


        <!-- google-map-section -->
        <section class="google-map-section">
            <div class="map-inner">
                <div 
                    class="google-map" 
                    id="contact-google-map" 
                    data-map-lat="40.712776" 
                    data-map-lng="-74.005974" 
                    data-icon-path="assets/images/icons/map-marker.png"  
                    data-map-title="Brooklyn, New York, United Kingdom" 
                    data-map-zoom="12" 
                    data-markers='{
                        "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","assets/images/icons/map-marker.png"]
                    }'>

                </div>
            </div>
        </section>
        <!-- google-map-section -->


        <!-- charity-shops -->
        <section class="charity-shops centred">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="top-text">Charity Shops</span>
                    <h2>Another Way to Donate</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-1.jpg') }}" alt=""></figure>
                            <h4>United States</h4>
                            <p>24/7, Global Factory Street, 2nd Cross, SF 94112.</p>
                            <div class="phone"><a href="tel:625075206644">(625) 07520-6644</a></div>
                            <div class="mail"><a href="mailto:mailus@example.com">mailus@example.com</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-2.jpg') }}" alt=""></figure>
                            <h4>Australia</h4>
                            <p>PO Box 515381, Los Angeles CA 90051, US</p>
                            <div class="phone"><a href="tel:8885206644">+888-520-6644</a></div>
                            <div class="mail"><a href="mailto:mailus@example.com">mailus@example.com</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-3.jpg') }}" alt=""></figure>
                            <h4>United Kingdom</h4>
                            <p>7220 Dean Martin Drive Suite, LV 89044</p>
                            <div class="phone"><a href="tel:0752066445">07520-664-45</a></div>
                            <div class="mail"><a href="mailto:mailus@example.com">mailus@example.com</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-4.jpg') }}" alt=""></figure>
                            <h4>India</h4>
                            <p>148, Global Factory Street Cleveland 44113.</p>
                            <div class="phone"><a href="tel:3214567890">+321.45.67890</a></div>
                            <div class="mail"><a href="mailto:mailus@example.com">mailus@example.com</a></div>
                        </div>
                    </div>
                </div>
                <div class="more-text"><span>Our 14 charity shops around the world with clothing, toys & other items.</span></div>
            </div>
        </section>
        <!-- charity-shops end -->

@endsection
