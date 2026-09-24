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
                                        <p>Main Office<br /><a href="tel:+8801700000000">+880 1700-000000</a></p>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <h4>Email Address</h4>
                                    <div class="text">
                                        <div class="icon-box"><i class="icon-letter"></i></div>
                                        <p>Mail to<br /><a href="mailto:info@shantinagarfoundation.org">info@shantinagarfoundation.org</a></p>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <h4>Mailing Address</h4>
                                    <div class="text">
                                        <div class="icon-box"><i class="icon-location"></i></div>
                                        <p>House 14, Road 3, Shanti Nagar, <br />Dhaka - 1217, Bangladesh.</p>
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
                                <p>Please feel free to get in touch using the form below. We'd love to hear from you.</p>
                            </div>
                            <div class="form-inner">
                                <form method="post" action="#" id="contact-form" class="default-form"> 
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
                                        <textarea name="message" placeholder="Message"></textarea>
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
                                <h3>Direct Support</h3>
                                <p>Get in touch with our team for quick help and information.</p>
                                <a href="/contact" class="theme-btn btn-one">Contact Helpline</a>
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
                                <h3>Become a Volunteer</h3>
                                <p>Join our volunteer network and create a lasting impact in society.</p>
                                <a href="/volunteer" class="theme-btn btn-one">Join With Us</a>
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
                                <p>Find clear answers to commonly asked questions about our causes.</p>
                                <a href="/faq" class="theme-btn btn-one">View FAQs</a>
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
                    data-map-lat="23.7381" 
                    data-map-lng="90.4125" 
                    data-icon-path="{{ asset('assets/images/icons/map-marker.png') }}"  
                    data-map-title="Shanti Nagar, Dhaka, Bangladesh" 
                    data-map-zoom="15" 
                    data-markers='{
                        "marker-1": [23.7381, 90.4125, "<h4>Shanti Nagar Foundation</h4><p>Shanti Nagar, Dhaka - 1217, Bangladesh</p>","{{ asset('assets/images/icons/map-marker.png') }}"]
                    }'>

                </div>
            </div>
        </section>
        <!-- google-map-section -->


        <!-- charity-shops -->
        <section class="charity-shops centred">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span class="top-text">Regional Distribution & Centers</span>
                    <h2>Our Relief Centers in Bangladesh</h2>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-1.jpg') }}" alt=""></figure>
                            <h4>Dhaka (Central)</h4>
                            <p>House 14, Road 3, Shanti Nagar, Dhaka - 1217.</p>
                            <div class="phone"><a href="tel:+8801700000001">+880 1700-000001</a></div>
                            <div class="mail"><a href="mailto:dhaka@shantinagarfoundation.org">dhaka@shantinagarfoundation.org</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-2.jpg') }}" alt=""></figure>
                            <h4>Chattogram</h4>
                            <p>Agrabad Commercial Area, Chattogram - 4100.</p>
                            <div class="phone"><a href="tel:+8801700000002">+880 1700-000002</a></div>
                            <div class="mail"><a href="mailto:ctg@shantinagarfoundation.org">ctg@shantinagarfoundation.org</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-3.jpg') }}" alt=""></figure>
                            <h4>Sylhet</h4>
                            <p>Zindabazar Point, Sylhet Sadar, Sylhet - 3100.</p>
                            <div class="phone"><a href="tel:+8801700000003">+880 1700-000003</a></div>
                            <div class="mail"><a href="mailto:sylhet@shantinagarfoundation.org">sylhet@shantinagarfoundation.org</a></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 single-column">
                        <div class="single-item wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <figure class="flag"><img src="{{ asset('assets/images/resource/flag-4.jpg') }}" alt=""></figure>
                            <h4>Rajshahi</h4>
                            <p>Saheb Bazar, Boalia, Rajshahi - 6000.</p>
                            <div class="phone"><a href="tel:+8801700000004">+880 1700-000004</a></div>
                            <div class="mail"><a href="mailto:rajshahi@shantinagarfoundation.org">rajshahi@shantinagarfoundation.org</a></div>
                        </div>
                    </div>
                </div>
                <div class="more-text"><span>Dedicated humanitarian and relief distribution networks operating across divisions in Bangladesh.</span></div>
            </div>
        </section>
        <!-- charity-shops end -->

@endsection
