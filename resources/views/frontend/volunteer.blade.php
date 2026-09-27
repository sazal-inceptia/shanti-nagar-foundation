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
                                <form action="{{ route('volunteer.submit') }}" method="post" class="volunteer-form">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Your Full Name *</label>
                                                <input type="text" name="name" placeholder="e.g. Tanvir Ahmed" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Email Address *</label>
                                                <input type="email" name="email" placeholder="e.g. tanvir@gmail.com" value="{{ old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Phone Number *</label>
                                                <input type="text" name="phone" placeholder="+880 1700-000000" value="{{ old('phone') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div class="select-box">
                                                    <select class="wide" name="gender">
                                                       <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                       <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                                       <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Age Group</label>
                                                <div class="select-box">
                                                    <select class="wide" name="age_group">
                                                       <option value="20+" {{ old('age_group') == '20+' ? 'selected' : '' }}>20+</option>
                                                       <option value="30+" {{ old('age_group') == '30+' ? 'selected' : '' }}>30+</option>
                                                       <option value="40+" {{ old('age_group') == '40+' ? 'selected' : '' }}>40+</option>
                                                       <option value="60+" {{ old('age_group') == '60+' ? 'selected' : '' }}>60+</option>
                                                       <option value="80+" {{ old('age_group') == '80+' ? 'selected' : '' }}>80+</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <label>Living Address / Location *</label>
                                                <input type="text" name="address" placeholder="e.g. Shanti Nagar, Dhaka" value="{{ old('address') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one w-100">Submit Volunteer Application</button>
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
