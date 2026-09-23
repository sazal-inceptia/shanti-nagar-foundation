@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>2 Columns Grid</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Donations</li>
                        <li>2 Columns Grid</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- case-page-section -->
        <section class="case-page-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/case/case-7.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details"># Hunger & Nutrition</a></div>
                                        <h3><a href="/donation-details">Feed Nutritious Meals to a Poor Rural Child</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">$42,000 <span>/ $80,000</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="53%"></div>
                                            </div>
                                            <div class="count-text">53%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <h5>Days</h5>
                                            <p>28 Days Left</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>40+</h5>
                                            <p>Suppoters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-share-alt"></i>
                                            <h5><a href="/">Share</a></h5>
                                            <ul class="social-links clearfix">
                                                <li><a href="/donations"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-google-plus-g"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/case/case-8.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details"># Treatment</a></div>
                                        <h3><a href="/donation-details">Help Differently Abled Person to Feel Confident</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">$38,000 <span>/ $50,000</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="76%"></div>
                                            </div>
                                            <div class="count-text">76%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <h5>Days</h5>
                                            <p>65 Days Left</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>67+</h5>
                                            <p>Suppoters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-share-alt"></i>
                                            <h5><a href="/">Share</a></h5>
                                            <ul class="social-links clearfix">
                                                <li><a href="/donations"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-google-plus-g"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/case/case-9.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details"># Health & Food</a></div>
                                        <h3><a href="/donation-details">Potable Water for Villages In Mozambique</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">$15,000 <span>/ $65,000</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="24%"></div>
                                            </div>
                                            <div class="count-text">24%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <h5>Days</h5>
                                            <p>60 Days Left</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>08+</h5>
                                            <p>Suppoters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-share-alt"></i>
                                            <h5><a href="/">Share</a></h5>
                                            <ul class="social-links clearfix">
                                                <li><a href="/donations"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-google-plus-g"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/case/case-10.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details"># Treatment</a></div>
                                        <h3><a href="/donation-details">Fundraise for COVID-19 Relief</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">$42,000 <span>/ $80,000</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="53%"></div>
                                            </div>
                                            <div class="count-text">53%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <h5>Days</h5>
                                            <p>40 Days Left</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>120+</h5>
                                            <p>Suppoters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-share-alt"></i>
                                            <h5><a href="/">Share</a></h5>
                                            <ul class="social-links clearfix">
                                                <li><a href="/donations"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-google-plus-g"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/case/case-11.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details"># Education</a></div>
                                        <h3><a href="/donation-details">Education Kit for Poor Girls</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">$38,000 <span>/ $50,000</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="76%"></div>
                                            </div>
                                            <div class="count-text">76%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <h5>Days</h5>
                                            <p>65 Days Left</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>67+</h5>
                                            <p>Suppoters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-share-alt"></i>
                                            <h5><a href="/">Share</a></h5>
                                            <ul class="social-links clearfix">
                                                <li><a href="/donations"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-google-plus-g"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset('assets/images/case/case-12.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details"># Hunger & Nutrition</a></div>
                                        <h3><a href="/donation-details">Sponsor Milk & Bread to 200 Poor People in GH</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                            <h5>Charity Raised</h5>
                                            <div class="price">$42,000 <span>/ $80,000</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="53%"></div>
                                            </div>
                                            <div class="count-text">53%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-calendar-alt"></i>
                                            <h5>Days</h5>
                                            <p>28 Days Left</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>40+</h5>
                                            <p>Suppoters</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-share-alt"></i>
                                            <h5><a href="/">Share</a></h5>
                                            <ul class="social-links clearfix">
                                                <li><a href="/donations"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="/donations"><i class="fab fa-google-plus-g"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-wrapper centred">
                    <ul class="pagination clearfix">
                        <li><a href="/donations"><i class="fas fa-arrow-left"></i></a></li>
                        <li><a href="/donations" class="current">1</a></li>
                        <li><a href="/donations">2</a></li>
                        <li><a href="/donations">3</a></li>
                        <li><a href="/donations"><i class="fas fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- case-page-section end -->

@endsection
