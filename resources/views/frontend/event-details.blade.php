@extends('frontend.layouts.app')

@section('title')
    {{ $activity->name ?? 'Social Welfare Activity' }} — Shanti Nagar Foundation
@endsection

@section('content')

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>{{ $activity->name ?? 'Social Welfare Activity' }}</h1>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('events') }}">Activities & Events</a></li>
                <li>{{ Str::limit($activity->name ?? 'Activity', 28) }}</li>
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
                <h2>{{ $activity->name ?? 'Social Welfare Activity' }}</h2>
                <ul class="events-info clearfix">
                    <li><i class="far fa-calendar"></i>{{ $activity->start_date ? \Carbon\Carbon::parse($activity->start_date)->format('d M, Y') : now()->format('d M, Y') }}</li>
                    <li><i class="far fa-clock"></i>10:00 AM - 04:00 PM</li>
                    <li><i class="far fa-map"></i>{{ $activity->location ?? 'Shanti Nagar, Dhaka' }}</li>
                </ul>
                <figure class="image-box hero-image-box"><img src="{{ asset($activity->featured_image ?: 'assets/images/events/events-4.jpg') }}" alt="{{ $activity->name ?? 'Activity' }}"></figure>
            </div>
            
            <div class="tabs-box">
                <div class="tab-btn-box">
                    <ul class="tab-btns tab-buttons clearfix">
                        <li class="tab-btn active-btn" data-tab="#tab-1"><i class="icon-right-arrow"></i>Activity Overview</li>
                        <li class="tab-btn" data-tab="#tab-2"><i class="icon-right-arrow"></i>Beneficiary & Objectives</li>
                        <li class="tab-btn" data-tab="#tab-3"><i class="icon-right-arrow"></i>Join as Volunteer</li>
                    </ul>
                </div>
                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">
                        <div class="overview-inner">
                            <div class="content-one">
                                <h3>Activity Description</h3>
                                <div class="event-desc-text">
                                    {!! nl2br(e($activity->description ?: ($activity->short_description ?: 'Shanti Nagar Foundation conducts regular field visits, health camps, winter relief distributions, and community welfare initiatives across Bangladesh.'))) !!}
                                </div>
                                <p class="mt-3">Under this initiative, our local committee coordinates direct procurement and distribution to ensure 100% transparency and accurate beneficiary reach without intermediaries.</p>
                            </div>
                            <div class="content-two mt-4">
                                <h3>Key Objectives</h3>
                                <ul class="list clearfix">
                                    <li>Direct doorstep support for underprivileged families and communities</li>
                                    <li>Complete project cost audit and transparent fund allocation</li>
                                    <li>Documentation through field photographs and beneficiary verification</li>
                                    <li>Collaborative partnership with local community leaders and volunteers</li>
                                </ul>
                            </div>
                            <div class="lower-box clearfix mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="btn-box">
                                    <a href="{{ route('volunteer') }}" class="theme-btn btn-one">Join as Volunteer</a>
                                </div>
                                <div>
                                    <a href="{{ route('donate') }}" class="theme-btn btn-one btn-support-cause">Support This Cause</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab" id="tab-2">
                        <div class="participants-inner">
                            <h3>Field Coordination Team</h3>
                            <p class="mb-4">Our dedicated local coordinators and volunteers oversee the distribution and logistics for this event on-ground.</p>
                            <div class="row clearfix g-3">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="p-3 border rounded text-center bg-white shadow-sm">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 team-avatar-orange">
                                            S
                                        </div>
                                        <h5 class="fw-bold mb-1">Shanti Nagar Field Unit</h5>
                                        <span class="text-muted small">Dhaka Central Division</span>
                                        <p class="small text-muted mt-2">Logistics & Relief Kit Packing</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="p-3 border rounded text-center bg-white shadow-sm">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 team-avatar-teal">
                                            M
                                        </div>
                                        <h5 class="fw-bold mb-1">Medical Aid Cell</h5>
                                        <span class="text-muted small">Health & Hygiene Volunteer Wing</span>
                                        <p class="small text-muted mt-2">Beneficiary Health Checkups</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="p-3 border rounded text-center bg-white shadow-sm">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 team-avatar-dark">
                                            V
                                        </div>
                                        <h5 class="fw-bold mb-1">Youth Volunteers</h5>
                                        <span class="text-muted small">Community Engagement</span>
                                        <p class="small text-muted mt-2">Ground Survey & Verification</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab" id="tab-3">
                        <div class="contact-inner">
                            <h3>Participate & Volunteer</h3>
                            <div class="row clearfix">
                                <div class="col-lg-8 col-md-12 col-sm-12 form-column">
                                    <div class="form-inner">
                                        <form action="{{ route('volunteer.submit') }}" method="post" class="default-form">
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Your Full Name <span>*</span></label>
                                                        <input type="text" name="name" placeholder="Enter name" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Email Address <span>*</span></label>
                                                        <input type="email" name="email" placeholder="Enter email" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Phone / WhatsApp Number <span>*</span></label>
                                                        <input type="text" name="phone" placeholder="+880 1700-000000" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>City / Location</label>
                                                        <input type="text" name="address" placeholder="e.g. Dhaka">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>Volunteer Experience / Message</label>
                                                        <textarea name="experience" placeholder="Tell us how you would like to contribute..." rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                    <div class="form-group message-btn">
                                                        <button type="submit" class="theme-btn btn-one">Register as Volunteer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-column">
                                    <div class="sidebar-inner">
                                        <div class="event-organizer p-4 border rounded bg-white shadow-sm">
                                            <h4 class="fw-bold mb-3">Event Office</h4>
                                            <ul class="list-unstyled mb-0 event-office-list">
                                                <li><strong>NGO:</strong> Shanti Nagar Foundation</li>
                                                <li><strong>Phone:</strong> <a href="tel:+8801700000000" class="text-decoration-none text-muted">+880 1700-000000</a></li>
                                                <li><strong>Email:</strong> <a href="mailto:info@shantinagarfoundation.org" class="text-decoration-none text-muted">info@shantinagarfoundation.org</a></li>
                                                <li><strong>Address:</strong> Shanti Nagar, Dhaka - 1217, Bangladesh</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- event-details end -->

@endsection
