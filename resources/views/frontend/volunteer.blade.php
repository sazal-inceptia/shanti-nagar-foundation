@extends('frontend.layouts.app')

@section('title', __('Become a Volunteer') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/2.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Become a Volunteer') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Become a Volunteer') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- volunteer-section -->
    <section class="volunteer-section">
        <figure class="image-layer wow slideInLeft animated animated" data-wow-delay="00ms" data-wow-duration="1500ms"><img
                src="{{ asset('assets/images/resource/volunteer-1.png') }}" alt="{{ __('Become a Volunteer') }}"></figure>
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
                                <span class="top-text">{{ __('Become a Volunteer') }}</span>
                                <h2>{{ __('To Make a Difference') }}</h2>
                            </div>
                            <form action="{{ route('volunteer.submit') }}" method="post" class="volunteer-form">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <label>{{ __('Your Full Name') }} *</label>
                                            <input type="text" name="name" placeholder="{{ __('e.g. Tanvir Ahmed') }}"
                                                value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <label>{{ __('Email Address') }} *</label>
                                            <input type="email" name="email" placeholder="{{ __('e.g. tanvir@gmail.com') }}"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <label>{{ __('Phone Number') }} *</label>
                                            <input type="text" name="phone"
                                                placeholder="{{ site_setting('hotline', '+880 1711-000000') }}"
                                                value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 column">
                                        <div class="form-group">
                                            <label>{{ __('Gender') }}</label>
                                            <div class="select-box">
                                                <select class="wide" name="gender">
                                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>
                                                        {{ __('Male') }}</option>
                                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                        {{ __('Female') }}</option>
                                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>
                                                        {{ __('Other') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 column">
                                        <div class="form-group">
                                            <label>{{ __('Age Group') }}</label>
                                            <div class="select-box">
                                                <select class="wide" name="age_group">
                                                    <option value="20+" {{ old('age_group') == '20+' ? 'selected' : '' }}>
                                                        {{ localized_number(20) }}+</option>
                                                    <option value="30+" {{ old('age_group') == '30+' ? 'selected' : '' }}>
                                                        {{ localized_number(30) }}+</option>
                                                    <option value="40+" {{ old('age_group') == '40+' ? 'selected' : '' }}>
                                                        {{ localized_number(40) }}+</option>
                                                    <option value="60+" {{ old('age_group') == '60+' ? 'selected' : '' }}>
                                                        {{ localized_number(60) }}+</option>
                                                    <option value="80+" {{ old('age_group') == '80+' ? 'selected' : '' }}>
                                                        {{ localized_number(80) }}+</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <label>{{ __('Living Address / Location') }} *</label>
                                            <input type="text" name="address"
                                                placeholder="{{ __('e.g. Shanti Nagar, Dhaka') }}"
                                                value="{{ old('address') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group message-btn">
                                            <button type="submit"
                                                class="theme-btn btn-one w-100">{{ __('Join As Volunteer') }}</button>
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