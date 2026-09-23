@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title details-page" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h6># Hunger & Nutrition</h6>
                        <h1>Feed Nutritious Meals to a Poor <br />Rural Child</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- case-details -->
        <section class="case-details">
            <div class="auto-container">
                <div class="upper-box">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                            <div class="donate-inner clearfix">
                                <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                <div class="amount-box">
                                    <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                    <h5>Charity Raised</h5>
                                    <div class="price">$42,000 <span>/ $80,000</span></div>
                                </div>
                                <div class="percentage-box">
                                    <div class="bar"></div>
                                    <h5>53%</h5>
                                </div>
                                <div class="btn-box">
                                    <button class="donate-box-btn">Donate Now</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 right-column">
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
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="lower-box">
                    <div class="row clearfix">
                        <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                            <div class="case-details-content">
                                <div class="content-one">
                                    <figure class="image-box"><img src="{{ asset('assets/images/case/case-21.jpg') }}" alt=""></figure>
                                    <div class="text">
                                        <h3>Project for Poor Rural Child</h3>
                                        <p>Dharms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and on the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment.</p>
                                    </div>
                                </div>
                                <div class="content-two">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6 col-sm-12 video-column">
                                            <div class="video-inner">
                                                <figure class="image-box"><img src="{{ asset('assets/images/case/case-22.jpg') }}" alt=""></figure>
                                                <div class="video-box">
                                                    <div class="video-btn">
                                                        <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption=""><i class="icon-play-arrow"></i></a>
                                                        <span>Campaign Video</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                                            <div class="text">
                                                <p>There are many variations passages like lorem ipsums available but that majority.</p>
                                                <ul class="list clearfix">
                                                    <li>
                                                        <h4>Sponsor Meals</h4>
                                                        <p>to grow strong and fight malnutrition</p>
                                                    </li>
                                                    <li>
                                                        <h4>Food Material</h4>
                                                        <p>Trouble that are bound to ensure</p>
                                                    </li>
                                                    <li>
                                                        <h4>Donate Clothes</h4>
                                                        <p>Being able to do what we like very best</p>
                                                    </li>
                                                    <li>
                                                        <h4>Education Material</h4>
                                                        <p>to build a better future for themselves</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="donate-content">
                                    <div class="title">
                                        <h3>Make Your Donation</h3>
                                        <p>You have the power to save lives. Help us create the change today!</p>
                                    </div>
                                    <form action="index.html" method="post" class="default-form">
                                        <div class="donate-box">
                                            <div class="donate-option">
                                                <h3>How Much?</h3>
                                                <ul class="donate-list clearfix">
                                                    <li>
                                                        <input type="radio" id="donate-amount-7" name="donate-amount" checked="checked" />
                                                        <label for="donate-amount-7" data-amount="1000" >$10</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="donate-amount-8" name="donate-amount" />
                                                        <label for="donate-amount-8" data-amount="2000">$20</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="donate-amount-9" name="donate-amount" />
                                                        <label for="donate-amount-9" data-amount="3000">$50</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="donate-amount-10" name="donate-amount" />
                                                        <label for="donate-amount-10" data-amount="4000">$100</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="donate-amount-11" name="donate-amount" />
                                                        <label for="donate-amount-11" data-amount="5000">$500</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="donate-amount-12" name="donate-amount" />
                                                        <label for="donate-amount-12" data-amount="5000">$1000</label>
                                                    </li>
                                                </ul>
                                                <div class="other-amount">
                                                    <div class="text">
                                                        <h4>Like to Donate</h4>
                                                        <p>Enter your custom amount</p>
                                                    </div>
                                                    <div class="amount-box">
                                                        <div class="item-quantity"><input class="quantity-spinner" type="text" value="750" name="quantity"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="payment-option">
                                                <h3>Choose Payment Option</h3>
                                                <ul class="payment-list clearfix">
                                                    <li>
                                                        <input type="radio" id="payment-method-4" name="payment-method" checked="checked" />
                                                        <label for="payment-method-4" >Net Banking</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="payment-method-5" name="payment-method" />
                                                        <label for="payment-method-5">Credit - Debit Card</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="payment-method-6" name="payment-method" />
                                                        <label for="payment-method-6">Offline Payment</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-inner">
                                            <h3>Donar Information</h3>
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Your Name <span>*</span></label>
                                                        <input type="text" name="name" placeholder="example name" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Email Address <span>*</span></label>
                                                        <input type="email" name="email" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" name="phone" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="address" required="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label class="custom-control material-checkbox">
                                                            <input type="checkbox" class="material-control-input">
                                                            <span class="material-control-indicator"></span>
                                                            <span class="description">I would like to donate automatically repeat each month</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                    <div class="form-group message-btn">
                                                        <button type="submit" class="theme-btn btn-one">Donate Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="content-three">
                                    <div class="text">
                                        <h3>How Can You Contribute?</h3>
                                        <p>You don’t have to donate money to make a difference, Here are some imaginative ways.</p>
                                    </div>
                                    <div class="inner-box">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                                                <div class="single-item">
                                                    <figure class="image-box"><img src="{{ asset('assets/images/case/case-23.jpg') }}" alt=""></figure>
                                                    <div class="content-box">
                                                        <div class="icon-box"><i class="icon-charity"></i></div>
                                                        <h3>Volunteer</h3>
                                                        <h6><a href="volunteer.html">Join as Volunteer</a></h6>
                                                    </div>
                                                    <div class="overlay-content">
                                                        <p>He rejects pleasures secure other great pleasure or else endures.</p>
                                                        <h6><a href="volunteer.html">Join as Volunteer</a></h6>
                                                        <div class="icon-box"><i class="icon-charity"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                                                <div class="single-item">
                                                    <figure class="image-box"><img src="{{ asset('assets/images/case/case-24.jpg') }}" alt=""></figure>
                                                    <div class="content-box">
                                                        <div class="icon-box"><i class="icon-mall"></i></div>
                                                        <h3>By Shopping</h3>
                                                        <h6><a href="products.html">Our products</a></h6>
                                                    </div>
                                                    <div class="overlay-content">
                                                        <p>He rejects pleasures secure other great pleasure or else endures.</p>
                                                        <h6><a href="products.html">Our products</a></h6>
                                                        <div class="icon-box"><i class="icon-mall"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 single-column">
                                                <div class="single-item">
                                                    <figure class="image-box"><img src="{{ asset('assets/images/case/case-25.jpg') }}" alt=""></figure>
                                                    <div class="content-box">
                                                        <div class="icon-box"><i class="icon-donation-3"></i></div>
                                                        <h3>Raise Funds</h3>
                                                        <h6><a href="contact.html">Get in touch</a></h6>
                                                    </div>
                                                    <div class="overlay-content">
                                                        <p>He rejects pleasures secure other great pleasure or else endures.</p>
                                                        <h6><a href="contact.html">Get in touch</a></h6>
                                                        <div class="icon-box"><i class="icon-donation-3"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-four">
                                    <div class="text">
                                        <h3>Our Recent Donars</h3>
                                        <p>Charms of pleasure of the moment, so blinded by desire, that they cannot</p>
                                    </div>
                                    <div class="four-item-carousel owl-carousel owl-theme owl-dots-none">
                                        <div class="single-item">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('assets/images/case/case-26.jpg') }}" alt=""></figure>
                                                <span>Donated <br />$250</span>
                                            </div>
                                            <div class="lower-content">
                                                <span>Donated <br />$250</span>
                                                <div class="text-box">
                                                    <span class="designation">Los Angeles</span>
                                                    <h4>Rodha Thelma</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-item">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('assets/images/case/case-27.jpg') }}" alt=""></figure>
                                                <span>Donated <br />$100</span>
                                            </div>
                                            <div class="lower-content">
                                                <span>Donated <br />$100</span>
                                                <div class="text-box">
                                                    <span class="designation">Los Angeles</span>
                                                    <h4>Rodha Thelma</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-item">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('assets/images/case/case-28.jpg') }}" alt=""></figure>
                                                <span>Donated <br />$50</span>
                                            </div>
                                            <div class="lower-content">
                                                <span>Donated <br />$50</span>
                                                <div class="text-box">
                                                    <span class="designation">Los Angeles</span>
                                                    <h4>Rodha Thelma</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-item">
                                            <div class="image-box">
                                                <figure class="image"><img src="{{ asset('assets/images/case/case-28.jpg') }}" alt=""></figure>
                                                <span>Donated <br />$500</span>
                                            </div>
                                            <div class="lower-content">
                                                <span>Donated <br />$500</span>
                                                <div class="text-box">
                                                    <span class="designation">Los Angeles</span>
                                                    <h4>Rodha Thelma</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                            <div class="case-sidebar default-sidebar">
                                <div class="sidebar-widget search-widget">
                                    <form action="donation-details.html" method="post" class="search-form">
                                        <div class="form-group">
                                            <input type="search" name="search-field" placeholder="Your Keyword . . ." required="">
                                            <button type="submit"><i class="icon-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="sidebar-widget category-widget">
                                    <div class="widget-title">
                                        <h3>Categories</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list clearfix">
                                            <li><a href="/donation-details">CONTRIBUTIONS<span>06</span></a></li>
                                            <li><a href="/donation-details">Environment<span>08</span></a></li>
                                            <li><a href="/donation-details">Heath & Food<span>03</span></a></li>
                                            <li><a href="/donation-details">Treatment<span>14</span></a></li>
                                            <li><a href="/donation-details">National Day<span>12</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-widget gallery-widget">
                                    <div class="widget-title">
                                        <h3>Gallery</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="image-list clearfix">
                                            <li>
                                                <figure class="image">
                                                    <img src="{{ asset('assets/images/case/gallery-1.jpg') }}" alt="">
                                                    <a href="/donation-details"><i class="fas fa-expand-alt"></i></a>
                                                </figure>
                                            </li>
                                            <li>
                                                <figure class="image">
                                                    <img src="{{ asset('assets/images/case/gallery-2.jpg') }}" alt="">
                                                    <a href="/donation-details"><i class="fas fa-expand-alt"></i></a>
                                                </figure>
                                            </li>
                                            <li>
                                                <figure class="image">
                                                    <img src="{{ asset('assets/images/case/gallery-3.jpg') }}" alt="">
                                                    <a href="/donation-details"><i class="fas fa-expand-alt"></i></a>
                                                </figure>
                                            </li>
                                            <li>
                                                <figure class="image">
                                                    <img src="{{ asset('assets/images/case/gallery-4.jpg') }}" alt="">
                                                    <a href="/donation-details"><i class="fas fa-expand-alt"></i></a>
                                                </figure>
                                            </li>
                                            <li>
                                                <figure class="image">
                                                    <img src="{{ asset('assets/images/case/gallery-5.jpg') }}" alt="">
                                                    <a href="/donation-details"><i class="fas fa-expand-alt"></i></a>
                                                </figure>
                                            </li>
                                            <li>
                                                <figure class="image">
                                                    <img src="{{ asset('assets/images/case/gallery-6.jpg') }}" alt="">
                                                    <a href="/donation-details"><i class="fas fa-expand-alt"></i></a>
                                                </figure>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sidebar-widget subscribe-widget centred">
                                    <div class="widget-content">
                                        <div class="upper-content" style="background-image: url({{ asset('assets/images/case/case-30.jpg') }});">
                                            <div class="icon-box"><i class="icon-email-open-sketched-envelope"></i></div>
                                            <h3>Subscribe Us</h3>
                                            <p>Subscribe us and get latest news and upcoming events.</p>
                                        </div>
                                        <div class="lower-content">
                                            <form action="contact.html" method="post" class="subscribe-form">
                                                <div class="form-group">
                                                    <input type="email" name="email" placeholder="Enter email address" required="">
                                                    <button type="submit" class="theme-btn btn-one">Subscribe</button>
                                                </div>
                                            </form>
                                            <p><span>*</span>Never share your email with others.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- case-details end -->

@endsection
