@extends('frontend.layouts.app')

@section('content')

        <!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>About Us</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Pages</li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- about-style-three -->
        <section class="about-style-three" style="background-image: url({{ asset('assets/images/background/13.jpg') }});">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_6">
                            <div class="content-box">
                                <div class="sec-title">
                                    <span class="top-text">About Shanti Nagar Foundation</span>
                                    <h2>Help the Society,Donate to the Charity</h2>
                                </div>
                                <ul class="award-list clearfix">
                                    <li><img src="{{ asset('assets/images/icons/award-1.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/award-2.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/award-3.png') }}" alt=""></li>
                                    <li><img src="{{ asset('assets/images/icons/award-4.png') }}" alt=""></li>
                                </ul>
                                <div class="text">
                                    <p>On the other hand, we denounce with righteous indignation & dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire that they cannot foresee the pain trouble that are bound to ensure.</p>
                                </div>
                                <div class="inner-box clearfix">
                                    <div class="author-box">
                                        <div class="icon-box"><i class="icon-hand"></i></div>
                                        <span>Founder</span>
                                        <h3>Benjie Alphonso</h3>
                                    </div>
                                    <ul class="social-links clearfix">
                                        <li><a href="/about"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="/about"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="/about"><i class="fab fa-google-plus-g"></i></a></li>
                                        <li><a href="/about"><i class="fab fa-instagram"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                        <div class="image_block_2">
                            <div class="image-box">
                                <figure class="image image-1"><img src="{{ asset('assets/images/resource/about-2.jpg') }}" alt=""></figure>
                                <figure class="image image-2"><img src="{{ asset('assets/images/resource/about-3.jpg') }}" alt=""></figure>
                                <div class="rotate-text">
                                    <figure class="text-box rotate-me"><img src="{{ asset('assets/images/icons/rotate-text-2.png') }}" alt=""></figure>
                                    <figure class="icon-box"><img src="{{ asset('assets/images/icons/bird-1.png') }}" alt=""></figure>
                                </div>
                                <figure class="icon-box"><img src="{{ asset('assets/images/icons/heart-7.png') }}" alt=""></figure>
                                <div class="text">
                                    <h4><i class="icon-donation-1"></i>16+ Years of Experience</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-style-three end -->


        <!-- history-section -->
        <section class="history-section">
            <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-37.png') }});"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12 col-sm-12 image-column">
                            <div class="image-box">
                                <div class="history-carousel owl-carousel owl-theme owl-dots-none">
                                    <figure class="image"><img src="{{ asset('assets/images/resource/history-1.jpg') }}" alt=""></figure>
                                    <figure class="image"><img src="{{ asset('assets/images/resource/history-1.jpg') }}" alt=""></figure>
                                    <figure class="image"><img src="{{ asset('assets/images/resource/history-1.jpg') }}" alt=""></figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 image-column">
                            <div class="tabs-box">
                                <div class="tab-btn-box">
                                    <ul class="tab-btns tab-buttons clearfix">
                                        <li class="tab-btn active-btn" data-tab="#tab-1"><i class="far fa-calendar-alt"></i>2005</li>
                                        <li class="tab-btn" data-tab="#tab-2"><i class="far fa-calendar-alt"></i>2006</li>
                                        <li class="tab-btn" data-tab="#tab-3"><i class="far fa-calendar-alt"></i>2007</li>
                                        <li class="tab-btn" data-tab="#tab-4"><i class="far fa-calendar-alt"></i>2008</li>
                                    </ul>
                                </div>
                                <div class="tabs-content">
                                    <div class="tab active-tab" id="tab-1">
                                        <div class="text">
                                            <h3>Protect and Advocate for those <br />who are in need</h3>
                                            <p>Denounce with righteous indignation & dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire that they cannot foresee the pain.</p>
                                            <a href="/about"><i class="far fa-angle-right"></i>Read More</a>
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-2">
                                        <div class="text">
                                            <h3>Protect and Advocate for those <br />who are in need</h3>
                                            <p>Denounce with righteous indignation & dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire that they cannot foresee the pain.</p>
                                            <a href="/about"><i class="far fa-angle-right"></i>Read More</a>
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-3">
                                        <div class="text">
                                            <h3>Protect and Advocate for those <br />who are in need</h3>
                                            <p>Denounce with righteous indignation & dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire that they cannot foresee the pain.</p>
                                            <a href="/about"><i class="far fa-angle-right"></i>Read More</a>
                                        </div>
                                    </div>
                                    <div class="tab" id="tab-4">
                                        <div class="text">
                                            <h3>Protect and Advocate for those <br />who are in need</h3>
                                            <p>Denounce with righteous indignation & dislike men who are so beguiled and demoralized by the charms of pleasure of the moment so blinded by desire that they cannot foresee the pain.</p>
                                            <a href="/about"><i class="far fa-angle-right"></i>Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- history-section end -->


        <!-- feature-section -->
        <section class="feature-section centred">
            <div class="fluid-container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <span>M</span>
                                <div class="icon-box"><i class="icon-mission"></i></div>
                                <h3>Our Mission</h3>
                                <p>Beguiled and demoralized by the charms of pleasure of the moment blinded that they cannot foresee.</p>
                                <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <span>V</span>
                                <div class="icon-box"><i class="icon-medical-report"></i></div>
                                <h3>Our Vision</h3>
                                <p>Our power of choice untrammelled and when nothing prevents our being able to do what we like best.</p>
                                <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <span>G</span>
                                <div class="icon-box"><i class="icon-goal"></i></div>
                                <h3>Our Goal</h3>
                                <p>Duty or the obligations of business it will frequently occurs that pleasures have repudiated annoyances.</p>
                                <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one">
                            <div class="inner-box">
                                <span>P</span>
                                <div class="icon-box"><i class="icon-fair-trade"></i></div>
                                <h3>Our Partners</h3>
                                <p>Riighteous indignation and dislike men who are so beguiled and demoralized by the pleasure of the moment.</p>
                                <div class="btn-box"><a href="/about" class="theme-btn btn-one">Read More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature-section end -->


        <!-- team-section -->
        <section class="team-section centred">
            <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-23.png') }});"></div>
            <div class="fluid-container">
                <div class="sec-title centred">
                    <span class="top-text">Meet Our Team</span>
                    <h2>Most Passionate Team Members</h2>
                </div>
                <div class="five-item-carousel owl-carousel owl-theme owl-nav-none">
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-5.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Founder</span>
                                    <h3>Benjie Alphonso</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-1.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-6.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Manager</span>
                                    <h3>Ivor Herbertson</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-2.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-7.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Coordinator</span>
                                    <h3>Rodha Thelma</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-3.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-8.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Valunteer</span>
                                    <h3>Luke Nobert</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-4.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-9.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Partner</span>
                                    <h3>Atulia Satija</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-5.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-5.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Founder</span>
                                    <h3>Benjie Alphonso</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-1.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-6.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Manager</span>
                                    <h3>Ivor Herbertson</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-2.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-7.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Coordinator</span>
                                    <h3>Rodha Thelma</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-3.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-8.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Valunteer</span>
                                    <h3>Luke Nobert</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-4.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-9.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Partner</span>
                                    <h3>Atulia Satija</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-5.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-5.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Founder</span>
                                    <h3>Benjie Alphonso</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-1.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-6.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Manager</span>
                                    <h3>Ivor Herbertson</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-2.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-7.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Coordinator</span>
                                    <h3>Rodha Thelma</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-3.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-8.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Valunteer</span>
                                    <h3>Luke Nobert</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-4.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="team-block-one">
                        <div class="inner-box">
                            <figure class="image-box"><img src="{{ asset('assets/images/team/team-9.jpg') }}" alt=""></figure>
                            <div class="content-box">
                                <div class="info">
                                    <span class="designation">Partner</span>
                                    <h3>Atulia Satija</h3>
                                </div>
                                <figure class="thumb-box"><img src="{{ asset('assets/images/team/team-5.png') }}" alt=""></figure>
                                <div class="text">
                                    <p>He rejects pleasures  to secure other greater pleasures or else he endures.</p>
                                </div>
                            </div>
                            <ul class="social-links clearfix">
                                <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- team-section end -->


        <!-- contribution-section -->
        <section class="contribution-section centred">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-38.png') }});"></div>
                    <div class="sec-title light centred">
                        <span class="top-text">Our Contribution</span>
                        <h2>Our Contribution towards Countries</h2>
                    </div>
                    <div class="four-item-carousel owl-carousel owl-theme owl-nav-none">
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>140k</h5>
                                    <i class="icon-statue-of-liberty"></i>
                                </div>
                                <h3>United States</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>124k</h5>
                                    <i class="icon-london-eye"></i>
                                </div>
                                <h3>United Kingdom</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>85k</h5>
                                    <i class="icon-kangaroo"></i>
                                </div>
                                <h3>Australia</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>78k</h5>
                                    <i class="icon-taj-mahal"></i>
                                </div>
                                <h3>India</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>140k</h5>
                                    <i class="icon-statue-of-liberty"></i>
                                </div>
                                <h3>United States</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>124k</h5>
                                    <i class="icon-london-eye"></i>
                                </div>
                                <h3>United Kingdom</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>85k</h5>
                                    <i class="icon-kangaroo"></i>
                                </div>
                                <h3>Australia</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>78k</h5>
                                    <i class="icon-taj-mahal"></i>
                                </div>
                                <h3>India</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>140k</h5>
                                    <i class="icon-statue-of-liberty"></i>
                                </div>
                                <h3>United States</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>124k</h5>
                                    <i class="icon-london-eye"></i>
                                </div>
                                <h3>United Kingdom</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>85k</h5>
                                    <i class="icon-kangaroo"></i>
                                </div>
                                <h3>Australia</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                        <div class="single-item">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <h5>78k</h5>
                                    <i class="icon-taj-mahal"></i>
                                </div>
                                <h3>India</h3>
                                <a href="/about"><i class="far fa-angle-right"></i>Explore</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contribution-section end -->


        <!-- reports-section -->
        <section class="reports-section sec-pad">
            <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-39.png') }});"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12 col-sm-12 content-column">
                        <div class="content_block_7">
                            <div class="content-box">
                                <div class="sec-title">
                                    <span class="top-text">Annual Reports</span>
                                    <h2>Our Legal & Financial Reports</h2>
                                </div>
                                <div class="text">
                                    <p>The majority have suffered alteration injected gets humours randomises.</p>
                                    <a href="/about" class="theme-btn btn-one">Download</a>
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
                                            <div class="piechart"  data-fg-color="#f65024" data-value=".84">
                                            </div>
                                            <span>Year of <br />2020</span>
                                        </div>
                                        <div class="text">
                                            <h2>84%</h2>
                                            <h3>Income Statement</h3>
                                            <p>It is a long established fact that a reader will be distracted</p>
                                            <a href="/about"><i class="far fa-angle-right"></i>View Details</a>
                                        </div>
                                    </div>
                                    <div class="single-progress-box">
                                        <div class="box">
                                            <div class="piechart"  data-fg-color="#03c0a8" data-value=".55">
                                            </div>
                                            <span>Year of <br />2020</span>
                                        </div>
                                        <div class="text">
                                            <h2>55%</h2>
                                            <h3>Expense Statement</h3>
                                            <p>Equal blame belongs to those who fail their duty hrough weakness</p>
                                            <a href="/about"><i class="far fa-angle-right"></i>View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- reports-section end -->


        <!-- funfact-section -->
        <section class="funfact-section alternat-2 centred" style="background-image: url({{ asset('assets/images/background/10.jpg') }});">
            <div class="auto-container">
                <div class="sec-title light centred">
                    <span class="top-text">Interesting Numbers</span>
                    <h2>Shanti Nagar Foundation Facts & Figures</h2>
                    <p>The master-builder of human happiness no one rejects, dislikes <br />or avoids  pleasure itself pleasure.</p>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one wow slideInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-charity"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="278">0</span>
                                </div>
                                <h4>Volunteers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one wow slideInUp animated animated" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-donation-1"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="6.5">0</span><span>k</span>
                                </div>
                                <h4>Beneficiaries</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one wow slideInUp animated animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-donation"></i></div>
                                <div class="count-outer count-box">
                                    <span>$</span><span class="count-text" data-speed="1500" data-stop="10">0</span><span>m</span>
                                </div>
                                <h4>Worth Donations</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 funfact-block">
                        <div class="funfact-block-one wow slideInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-home"></i></div>
                                <div class="count-outer count-box">
                                    <span class="count-text" data-speed="1500" data-stop="350">0</span><span>+</span>
                                </div>
                                <h4>NGOs Impacted</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- funfact-section end -->
        

@endsection
