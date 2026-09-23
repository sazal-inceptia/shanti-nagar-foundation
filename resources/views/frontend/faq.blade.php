@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>FAQ’s</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Pages</li>
                        <li>FAQ’s</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- faq-page-section -->
        <section class="faq-page-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                        <div class="content_block_10">
                            <div class="content-box">
                                <figure class="image"><img src="{{ asset('assets/images/resource/faq-1.png') }}" alt=""></figure>
                                <div class="text wow fadeInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                    <div class="icon-box"><i class="icon-search-1"></i></div>
                                    <h3>Don't See Your Question?</h3>
                                    <p>Send your question to our team, they’ll help you.</p>
                                    <a href="/faq">Send Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 inner-column">
                        <ul class="accordion-box">
                            <li class="accordion block active-block">
                                <div class="acc-btn active">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h5><i class="icon-question"></i>What is Save the Shanti Nagar Foundation?</h5>
                                </div>
                                <div class="acc-content current">
                                    <div class="text">
                                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alterationform injected humours randomises don't look even slightly.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion block">
                                <div class="acc-btn">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h5><i class="icon-question"></i>How do I make a matching gift?</h5>
                                </div>
                                <div class="acc-content">
                                    <div class="text">
                                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alterationform injected humours randomises don't look even slightly.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion block">
                                 <div class="acc-btn">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h5><i class="icon-question"></i>What is Save the Tax ID Number?</h5>
                                </div>
                                <div class="acc-content">
                                    <div class="text">
                                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alterationform injected humours randomises don't look even slightly.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion block">
                                 <div class="acc-btn">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h5><i class="icon-question"></i>What is an Anti-Charity?</h5>
                                </div>
                                <div class="acc-content">
                                    <div class="text">
                                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alterationform injected humours randomises don't look even slightly.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion block">
                                 <div class="acc-btn">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h5><i class="icon-question"></i>Who can access Shanti Nagar Foundation's research?</h5>
                                </div>
                                <div class="acc-content">
                                    <div class="text">
                                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alterationform injected humours randomises don't look even slightly.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="accordion block">
                                 <div class="acc-btn">
                                    <div class="icon-outer"><i class="icon-right-arrow"></i></div>
                                    <h5><i class="icon-question"></i>How is Shanti Nagar Foundation different from others?</h5>
                                </div>
                                <div class="acc-content">
                                    <div class="text">
                                        <p>There are many variations of passages of lorem ipsum available, but the majority have suffered alterationform injected humours randomises don't look even slightly.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq-page-section end -->

@endsection
