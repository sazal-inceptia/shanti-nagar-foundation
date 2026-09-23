@extends('frontend.layouts.app')

@section('content')

<!-- volunteer-section -->
        <section class="volunteer-section">
            <figure class="image-layer wow slideInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="{{ asset('assets/images/resource/volunteer-1.png') }}" alt=""></figure>
            <div class="icon-layer">
                <div class="icon-1"><img src="{{ asset('assets/images/icons/heart-6.png') }}" alt=""></div>
                <div class="icon-2"><img src="{{ asset('assets/images/icons/heart-8.png') }}" alt=""></div>
                <div class="icon-3"><img src="{{ asset('assets/images/icons/heart-9.png') }}" alt=""></div>
            </div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-xl-6 col-lg-12 col-md-12 offset-xl-6 content-column">
                        <div class="content_block_9">
                            <div class="content-box">
                                <div class="sec-title">
                                    <span class="top-text">Become a Volunteer</span>
                                    <h2>To Make a Difference</h2>
                                </div>
                                <form action="volunteer.html" method="post" class="volunteer-form">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Your Name *</label>
                                                <input type="text" name="name" placeholder="example name" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Email Address *</label>
                                                <input type="email" name="email" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Phone Num *</label>
                                                <input type="email" name="phone" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="select-box">
                                                    <select class="wide">
                                                       <option data-display="Male">Male</option>
                                                       <option value="1">Female</option>
                                                       <option value="2">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <div class="select-box">
                                                    <select class="wide">
                                                       <option data-display="20+">20+</option>
                                                       <option value="1">30+</option>
                                                       <option value="2">40+</option>
                                                       <option value="3">60+</option>
                                                       <option value="4">80+</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Address *</label>
                                                <input type="email" name="address" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- volunteer-section end -->

@endsection
