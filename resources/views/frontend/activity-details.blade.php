@extends('frontend.layouts.app')

@section('title', $activity->localized_title . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))
@section('meta_description', Str::limit($activity->localized_short_description ?: $activity->localized_description, 160))
@section('meta_image', $activity->featured_image_url)

@section('content')

@php
    $eventDate = $activity->event_date ? \Carbon\Carbon::parse($activity->event_date) : now();
@endphp

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>{{ $activity->localized_title }}</h1>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('activities') }}">{{ __('Activities') }}</a></li>
                <li>{{ Str::limit($activity->localized_title, 28) }}</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- event-details -->
<section class="event-details">
    <div class="auto-container">
        <div class="event-details-content">
            <div class="upper-box centred">
                <h2>{{ $activity->localized_title }}</h2>
                <ul class="events-info clearfix">
                    <li>
                        <i class="far fa-calendar"></i>
                        {{ is_bengali() ? $eventDate->translatedFormat('d M, Y') : $eventDate->format('d M, Y') }}
                    </li>
                    @if($activity->event_time)
                        <li><i class="far fa-clock"></i>{{ $activity->event_time }}</li>
                    @endif
                    @if($activity->location)
                        <li><i class="far fa-map"></i>{{ $activity->localized_location ?: __('Dhaka, Bangladesh') }}</li>
                    @endif
                    <li><i class="fas fa-tag"></i>{{ $activity->status_label }}</li>
                </ul>
                <figure class="image-box hero-image-box">
                    <img src="{{ $activity->featured_image_url }}" alt="{{ $activity->localized_title }}">
                </figure>
            </div>
            
            <div class="tabs-box">
                <div class="tab-btn-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><i class="icon-right-arrow"></i>{{ __('Campaign Overview') }}</li>
                        <li class="tab-btn" data-tab="#tab-2"><i class="icon-right-arrow"></i>{{ __('Leadership & Members') }}</li>
                        <li class="tab-btn" data-tab="#tab-3"><i class="icon-right-arrow"></i>{{ __('Become a Volunteer') }}</li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="overview-inner clearfix" style="display: flow-root;">
                            <div class="content-one clearfix" style="display: flow-root;">
                                <h3>{{ __('Campaign Overview') }}</h3>
                                @if($activity->short_description)
                                    <p class="lead fw-semibold text-dark mb-3">{{ $activity->localized_short_description }}</p>
                                @endif
                                <div class="event-desc-text ck-content clearfix" style="display: flow-root;">
                                    @if($activity->localized_description)
                                        {!! $activity->localized_description !!}
                                    @else
                                        <p>{{ __('Rotary Club of Shantinagar Dhaka is dedicated to delivering transparent humanitarian relief, healthcare support, and social empowerment across Bangladesh. Every contribution directly funds verified on-the-ground initiatives without intermediaries.') }}</p>
                                    @endif
                                </div>
                                <div class="clearfix" style="clear: both;"></div>
                                <p class="mt-3" style="clear: both;">{{ __('Under this initiative, our local committee coordinates direct procurement and distribution to ensure 100% transparency and accurate beneficiary reach without intermediaries.') }}</p>
                            </div>

                            
                        </div>
                    </div>
                    
                    <div class="tab" id="tab-2">
                        <div class="participants-inner">
                            <h3>{{ __('Field Coordination Team & Volunteers') }}</h3>
                            <p class="mb-4">{{ __('Our dedicated local coordinators and volunteers oversee the distribution and logistics for this event on-ground.') }}</p>
                            <div class="row clearfix g-3">
                                @if(isset($recentVolunteers) && $recentVolunteers->count() > 0)
                                    @foreach($recentVolunteers as $idx => $vol)
                                        @php
                                            $avatarClasses = ['team-avatar-orange', 'team-avatar-teal', 'team-avatar-dark'];
                                            $avatarClass = $avatarClasses[$idx % 3];
                                        @endphp
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="p-3 border rounded text-center bg-white shadow-sm h-100">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 {{ $avatarClass }}">
                                                    {{ strtoupper(substr($vol->name, 0, 1)) }}
                                                </div>
                                                <h5 class="fw-bold mb-1">{{ $vol->name }}</h5>
                                                <span class="text-muted small">{{ $vol->address ?: __('Dhaka, Bangladesh') }}</span>
                                                <p class="small text-muted mt-2">{{ Str::limit($vol->experience ?: __('Field Logistics & Volunteer Wing'), 40) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="p-3 border rounded text-center bg-white shadow-sm">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 team-avatar-orange">
                                                S
                                            </div>
                                            <h5 class="fw-bold mb-1">{{ __('Shanti Nagar Field Unit') }}</h5>
                                            <span class="text-muted small">{{ __('Dhaka, Bangladesh') }}</span>
                                            <p class="small text-muted mt-2">{{ __('Active Youth & Volunteer Wing') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab" id="tab-3">
                        <div class="booking-inner">
                            <h3>{{ __('Volunteer Registration for this Event') }}</h3>
                            <p class="mb-4">{{ __('Join hands with Rotary Club of Shantinagar Dhaka to deliver relief directly to the underserved community.') }}</p>
                            
                            <div class="row clearfix">
                                <div class="col-lg-7 col-md-12 col-sm-12">
                                    <form action="{{ route('volunteer.submit') }}" method="POST" class="default-form">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Your Full Name') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="name" placeholder="{{ __('Your Full Name') }}" required value="{{ old('name') }}">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                                <input type="text" name="phone" placeholder="{{ __('e.g. 01700-000000') }}" required value="{{ old('phone') }}">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                                <input type="email" name="email" placeholder="{{ __('Email Address') }}" required value="{{ old('email') }}">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Gender') }}</label>
                                                <select name="gender" class="form-select custom-select-box">
                                                    <option value="Male">{{ __('Male') }}</option>
                                                    <option value="Female">{{ __('Female') }}</option>
                                                    <option value="Other">{{ __('Other') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Age Group') }}</label>
                                                <select name="age_group" class="form-select custom-select-box">
                                                    <option value="18-25">18-25 {{ __('Years') }}</option>
                                                    <option value="26-35">26-35 {{ __('Years') }}</option>
                                                    <option value="36-50">36-50 {{ __('Years') }}</option>
                                                    <option value="50+">50+ {{ __('Years') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Address / Location') }}</label>
                                                <input type="text" name="address" placeholder="{{ __('Shantinagar / Area, Dhaka') }}" value="{{ old('address') }}">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <label class="form-label text-dark fw-bold">{{ __('Relevant Experience / Special Skills') }}</label>
                                                <textarea name="experience" placeholder="{{ __('Why do you want to volunteer for this specific activity?') }}" rows="4">{{ old('experience') }}</textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one w-100">{{ __('Submit Application') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <div class="p-4 bg-light rounded border h-100">
                                        <h4 class="fw-bold mb-3">{{ __('Why Volunteer with Us?') }}</h4>
                                        <ul class="list-unstyled mb-4">
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('Hands-on grassroots impact') }}</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('Certificate of Appreciation') }}</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('Verified NGO community network') }}</li>
                                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{ __('Rotary leadership & skill growth') }}</li>
                                        </ul>
                                        <hr>
                                        <div class="helpline-box mt-3">
                                            <span class="text-muted small d-block">{{ __('Direct Volunteer Hotline:') }}</span>
                                            <h5 class="fw-bold text-primary mb-0">+880 1700-000000</h5>
                                            <span class="text-muted small">{{ site_setting('org_email', 'info@rotaryshantinagar.org') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related / Upcoming Activities Section -->
            @if(isset($upcomingActivities) && $upcomingActivities->count() > 0)
                <div class="related-events mt-60 pt-5 border-top clearfix" style="clear: both;">
                    <div class="sec-title centred mb-40">
                        <span class="top-text">{{ __('Community Drives') }}</span>
                        <h2>{{ __('Other Upcoming Initiatives') }}</h2>
                    </div>
                    <div class="row clearfix">
                        @foreach($upcomingActivities as $upcoming)
                            @php
                                $upDate = $upcoming->event_date ? \Carbon\Carbon::parse($upcoming->event_date) : now();
                            @endphp
                            <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                                <div class="events-block-two">
                                    <div class="inner-box">
                                        <div class="post-date">
                                            <h3>{{ localized_number($upDate->format('d')) }}<span>{{ is_bengali() ? $upDate->translatedFormat('M') : $upDate->format('M') }}</span></h3>
                                        </div>
                                        <figure class="image-box"><img src="{{ $upcoming->featured_image_url }}" alt="{{ $upcoming->localized_title }}"></figure>
                                        <div class="content-box">
                                            <ul class="info clearfix">
                                                <li><i class="far fa-clock"></i>{{ $upcoming->event_time ?: __('10:00 AM') }}</li>
                                                <li><i class="far fa-map"></i>{{ Str::limit($upcoming->localized_location ?: __('Dhaka, Bangladesh'), 35) }}</li>
                                            </ul>
                                            <h3><a href="{{ route('activity.details', $upcoming->slug) }}">{{ $upcoming->localized_title }}</a></h3>
                                            <div class="links"><a href="{{ route('activity.details', $upcoming->slug) }}">{{ __('View Details') }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
<!-- event-details end -->

@endsection
