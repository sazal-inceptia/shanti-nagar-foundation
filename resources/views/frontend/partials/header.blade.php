<header class="main-header header-style-one">
    <!-- logo-box -->
    <div class="logo-box">
        <div class="shape" style="background-image: url({{ asset('assets/images/shape/shape-1.png') }});">
        </div>
        <figure class="logo"><a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a></figure>
    </div>
    <!-- header-top -->
    <div class="header-top">
        <div class="outer-container">
            <div class="top-inner clearfix">
                <div class="left-column pull-left">
                    <ul class="info-list clearfix">
                        <li>
                            <i class="icon-chat"></i>
                            <span>Helpline:</span>
                            <a href="tel:+8801700000000">+880 1700-000000</a>
                        </li>
                        <li>
                            <a href="mailto:info@shantinagarfoundation.org">info@shantinagarfoundation.org</a>
                        </li>
                        <li>
                            Shanti Nagar, Dhaka - 1217, Bangladesh.
                        </li>
                    </ul>
                </div>
                <div class="right-column pull-right">
                    <div class="update-news">
                        <p><i class="icon-megaphone"></i><span>Updates:</span> Providing education, healthcare & relief across Bangladesh . . .</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- donate-btn -->
        <div class="donate-btn">
            <a href="/donate" class="theme-btn btn-one">Donate Now</a>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-container">
            <div class="outer-box">
                <div class="text">
                    <figure class="icon-box"><img src="{{ asset('assets/images/icons/heart-1.png') }}" alt=""></figure>
                    <a href="/volunteer" style="color: inherit;"><span>Become a Volunteer</span></a>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ request()->is('/') ? 'current' : '' }}"><a href="/">Home</a></li>
                                <li class="{{ request()->is('about*') ? 'current' : '' }}"><a href="/about">About Us</a></li>
                                <li class="{{ request()->is('donation*') ? 'current' : '' }}"><a href="/donations">Projects & Causes</a></li>
                                <li class="{{ request()->is('event*') ? 'current' : '' }}"><a href="/events">Activities</a></li>
                                <li class="{{ request()->is('gallery*') ? 'current' : '' }}"><a href="/gallery">Gallery</a></li>
                                <li class="{{ request()->is('blog*') ? 'current' : '' }}"><a href="/blog">Blog</a></li>
                                <li class="{{ request()->is('contact*') ? 'current' : '' }}"><a href="/contact">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="nav-right-content clearfix">
                    <ul class="social-style-one clearfix">
                        <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="/"><i class="fab fa-youtube"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="auto-container">
            <div class="outer-box">
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="nav-right-content clearfix">
                    <ul class="social-style-one clearfix">
                        <li><a href="/"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="/"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="/"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="/"><i class="fab fa-youtube"></i></a></li>
                    </ul>

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
        <div class="nav-logo"><a href="/"><img src="{{ asset('assets/images/logo.png') }}" alt="" title=""></a>
        </div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>Shanti Nagar, Dhaka - 1217, Bangladesh</li>
                <li><a href="tel:+8801700000000">+880 1700-000000</a></li>
                <li><a href="mailto:info@shantinagarfoundation.org">info@shantinagarfoundation.org</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                <li><a href="/"><span class="fab fa-twitter"></span></a></li>
                <li><a href="/"><span class="fab fa-facebook-square"></span></a></li>
                <li><a href="/"><span class="fab fa-pinterest-p"></span></a></li>
                <li><a href="/"><span class="fab fa-instagram"></span></a></li>
                <li><a href="/"><span class="fab fa-youtube"></span></a></li>
            </ul>
        </div>
    </nav>
</div><!-- End Mobile Menu -->