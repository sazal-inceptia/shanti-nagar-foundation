@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Upcoming Events & Activities</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Events</li>
                        <li>Community Outreach & Relief Drives</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- events-page-section -->
        <section class="events-page-section">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>31<span>Feb</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-4.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details">For Free</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>11.30 am</li>
                                        <li><i class="far fa-map"></i>Newyork</li>
                                    </ul>
                                    <h3><a href="/event-details">Royal Parks Half Marathon</a></h3>
                                    <div class="links"><a href="/event-details">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>05<span>Mar</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-5.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details">For Free</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>10.00 am</li>
                                        <li><i class="far fa-map"></i>California</li>
                                    </ul>
                                    <h3><a href="/event-details">Shanti Nagar Foundation Present Virtual Brain Game for Youth</a></h3>
                                    <div class="links"><a href="/event-details">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>22<span>Mar</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-6.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details">For Free</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>11.30 am</li>
                                        <li><i class="far fa-map"></i>Newyork</li>
                                    </ul>
                                    <h3><a href="/event-details">USA Walks, Treks and Hikes</a></h3>
                                    <div class="links"><a href="/event-details">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>06<span>May</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-7.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details">For Free</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>10.00 am</li>
                                        <li><i class="far fa-map"></i>California</li>
                                    </ul>
                                    <h3><a href="/event-details">One-Day Online Fundraiser</a></h3>
                                    <div class="links"><a href="/event-details">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>14<span>Apr</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-8.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details">For Free</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>10.00 am</li>
                                        <li><i class="far fa-map"></i>California</li>
                                    </ul>
                                    <h3><a href="/event-details">Personal Fitness Challenge</a></h3>
                                    <div class="links"><a href="/event-details">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>05<span>May</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-9.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details">For Free</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>11.30 am</li>
                                        <li><i class="far fa-map"></i>Newyork</li>
                                    </ul>
                                    <h3><a href="/event-details">Skydive For Our Volunteers</a></h3>
                                    <div class="links"><a href="/event-details">More Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more-btn centred"><a href="/events" class="theme-btn btn-one">Load More</a></div>
            </div>
        </section>
        <!-- events-page-section -->

@endsection
