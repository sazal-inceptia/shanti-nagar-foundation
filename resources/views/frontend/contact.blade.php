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
                    <div class="col-lg-5 col-md-12 col-sm-12 inner-column">
                        <div class="contact-info-inner">
                            <div class="sec-title">
                                <span class="top-text">Connecting Always</span>
                                <h2>Hear by our Heart</h2>
                                <p>Our team is available to help with your enquiries on email & phone, or visit our central office.</p>
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
                    <div class="col-lg-7 col-md-12 col-sm-12 inner-column">
                        <div class="contact-form-inner">
                            <div class="sec-title">
                                <span class="top-text">Drop a Line</span>
                                <h2>Leave us a Message</h2>
                                <p>Please feel free to get in touch using the form below. We'd love to hear from you.</p>
                            </div>
                            <div class="form-inner">
                                <form method="post" action="#" id="contact-form" class="default-form"> 
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <i class="far fa-user"></i>
                                            <input type="text" name="username" placeholder="Your Name" required="">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <i class="far fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email Address" required="">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <i class="far fa-phone"></i>
                                            <input type="text" name="phone" required="" placeholder="Phone">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                            <i class="far fa-sticky-note"></i>
                                            <input type="text" name="subject" required="" placeholder="Subject">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <i class="far fa-text-height"></i>
                                            <textarea name="message" placeholder="Message"></textarea>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                            <button class="theme-btn btn-one" type="submit" name="submit-form">Send Message</button>
                                        </div>
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
            <div class="map-inner" style="width: 100%; height: 500px;">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.285806660613!2d90.4103113154316!3d23.737194695200388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b85e054238e5%3A0x6a0f69a9b736b772!2sShantinagar%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1695546000000!5m2!1sen!2sbd" 
                    width="100%" 
                    height="500" 
                    style="border:0; display:block;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </section>
        <!-- google-map-section -->

@endsection
