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
                                <div class="post-date"><h3>15<span>Oct</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-4.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details"># Healthcare</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>10.00 am</li>
                                        <li><i class="far fa-map"></i>Dhaka Medical</li>
                                    </ul>
                                    <h3><a href="/event-details">Hospital Equipment & Ceiling Fan Donation Drive</a></h3>
                                    <div class="links"><a href="/event-details">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>28<span>Oct</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-5.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details"># Orphan Support</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>11.00 am</li>
                                        <li><i class="far fa-map"></i>Shanti Nagar</li>
                                    </ul>
                                    <h3><a href="/event-details">Nutritious Food & Education Kit for Orphan Children</a></h3>
                                    <div class="links"><a href="/event-details">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>10<span>Nov</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-6.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details"># Winter Aid</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>09.30 am</li>
                                        <li><i class="far fa-map"></i>Kurigram & North</li>
                                    </ul>
                                    <h3><a href="/event-details">Warm Blankets & Winter Clothes Distribution</a></h3>
                                    <div class="links"><a href="/event-details">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>20<span>Nov</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-7.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details"># Clean Water</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>10.00 am</li>
                                        <li><i class="far fa-map"></i>Sunamganj</li>
                                    </ul>
                                    <h3><a href="/event-details">Tube-well & Clean Drinking Water Installation</a></h3>
                                    <div class="links"><a href="/event-details">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>05<span>Dec</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-8.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details"># Free Treatment</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>08.30 am</li>
                                        <li><i class="far fa-map"></i>Dhaka Slums</li>
                                    </ul>
                                    <h3><a href="/event-details">Free Medical Consultation & Essential Medicines Camp</a></h3>
                                    <div class="links"><a href="/event-details">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>18<span>Dec</span></h3></div>
                                <figure class="image-box"><img src="{{ asset('assets/images/events/events-9.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details"># Emergency Aid</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>11.30 am</li>
                                        <li><i class="far fa-map"></i>Feni & Noakhali</li>
                                    </ul>
                                    <h3><a href="/event-details">Emergency Food Packages for Flood-Affected Families</a></h3>
                                    <div class="links"><a href="/event-details">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- events-page-section -->

@endsection
