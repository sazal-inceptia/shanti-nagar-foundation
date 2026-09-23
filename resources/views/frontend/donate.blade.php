@extends('frontend.layouts.app')

@section('content')

<!-- donation-page-section -->
        <section class="donation-page-section">
            <div class="outer-container">
                <div class="donate-content">
                    <div class="sec-title centred">
                        <span class="top-text">Make Your Donation</span>
                        <h2>Creating a Brighter Tomorrow</h2>
                    </div>
                    <form action="index.html" method="post" class="default-form">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12 col-sm-12 donate-column">
                                <div class="donate-box">
                                    <div class="donate-option">
                                        <h3>How Much?</h3>
                                        <ul class="donate-list clearfix">
                                            <li>
                                                <input type="radio" id="donate-amount-1" name="donate-amount" checked="checked" />
                                                <label for="donate-amount-1" data-amount="1000" >$10</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-amount-2" name="donate-amount" />
                                                <label for="donate-amount-2" data-amount="2000">$20</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-amount-3" name="donate-amount" />
                                                <label for="donate-amount-3" data-amount="3000">$50</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-amount-4" name="donate-amount" />
                                                <label for="donate-amount-4" data-amount="4000">$100</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-amount-5" name="donate-amount" />
                                                <label for="donate-amount-5" data-amount="5000">$500</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="donate-amount-6" name="donate-amount" />
                                                <label for="donate-amount-6" data-amount="5000">$1000</label>
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
                                                <input type="radio" id="payment-method-1" name="payment-method" checked="checked" />
                                                <label for="payment-method-1" >Net Banking</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="payment-method-2" name="payment-method" />
                                                <label for="payment-method-2">Credit - Debit Card</label>
                                            </li>
                                            <li>
                                                <input type="radio" id="payment-method-3" name="payment-method" />
                                                <label for="payment-method-3">Offline Payment</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 donate-form">
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
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Donate Now</button>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- donation-page-section end -->

@endsection
