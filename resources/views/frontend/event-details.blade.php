@extends('frontend.layouts.app')

@section('title', $activity->localized_name . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))
@section('meta_description', Str::limit($activity->localized_short_description ?: $activity->localized_description, 160))
@section('meta_image', asset($activity->featured_image))

@section('content')

@php
    $eventDate = $activity->start_date ? \Carbon\Carbon::parse($activity->start_date) : now();
    $endDate = $activity->end_date ? \Carbon\Carbon::parse($activity->end_date) : null;
    $typeName = $activity->projectType?->localized_name;
@endphp

<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
    <div class="auto-container">
        <div class="content-box">
            <div class="title">
                <h1>{{ $activity->localized_name }}</h1>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('events') }}">{{ __('Activities') }}</a></li>
                <li>{{ Str::limit($activity->localized_name, 28) }}</li>
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
                <h2>{{ $activity->localized_name }}</h2>
                <ul class="events-info clearfix">
                    <li>
                        <i class="far fa-calendar"></i>
                        {{ is_bengali() ? $eventDate->translatedFormat('d M, Y') : $eventDate->format('d M, Y') }}
                        @if($endDate && $endDate->ne($eventDate))
                            — {{ is_bengali() ? $endDate->translatedFormat('d M, Y') : $endDate->format('d M, Y') }}
                        @endif
                    </li>
                    <li><i class="far fa-clock"></i>{{ __('10:00 AM - 04:00 PM') }}</li>
                    @if($activity->location)
                        <li><i class="far fa-map"></i>{{ $activity->localized_location ?: __('Dhaka, Bangladesh') }}</li>
                    @endif
                    @if($typeName)
                        <li><i class="fas fa-tag"></i>{{ $typeName }}</li>
                    @endif
                </ul>
                <figure class="image-box hero-image-box">
                    <img src="{{ asset($activity->featured_image) }}" alt="{{ $activity->localized_name }}">
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
                        <div class="overview-inner">
                            <div class="content-one">
                                <h3>{{ __('Campaign Overview') }}</h3>
                                @if($activity->short_description)
                                    <p class="lead fw-semibold text-dark mb-3">{{ $activity->localized_short_description }}</p>
                                @endif
                                <div class="event-desc-text">
                                    {!! nl2br(e($activity->localized_description ?: __('Rotary Club of Shantinagar Dhaka is dedicated to delivering transparent humanitarian relief, healthcare support, and social empowerment across Bangladesh. Every contribution directly funds verified on-the-ground initiatives without intermediaries.'))) !!}
                                </div>
                                <p class="mt-3">{{ __('Under this initiative, our local committee coordinates direct procurement and distribution to ensure 100% transparency and accurate beneficiary reach without intermediaries.') }}</p>
                            </div>

                            {{-- Project Gallery Images if present --}}
                            @if($activity->images && $activity->images->count() > 0)
                                <div class="content-two mt-4 pt-2">
                                    <h3>{{ __('Field Documentation') }}</h3>
                                    <div class="row clearfix g-3 mt-2">
                                        @foreach($activity->images as $img)
                                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                                <div class="image-box gallery-card-box">
                                                    <img src="{{ asset($img->image_path) }}" alt="{{ $img->localized_caption ?: $activity->localized_name }}">
                                                </div>
                                                @if($img->caption)
                                                    <p class="small text-muted mt-1"><i class="fas fa-camera me-1 text-primary"></i> {{ $img->localized_caption }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="lower-box clearfix mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div class="btn-box">
                                    <a href="#tab-3" class="theme-btn btn-one" onclick="if(window.jQuery){ $('.tab-btns li[data-tab=\'#tab-3\']').trigger('click'); }">{{ __('Join as Volunteer') }}</a>
                                </div>
                                <div>
                                    <a href="{{ route('donation.details', $activity->slug) }}" class="theme-btn btn-one btn-support-cause">{{ __('Support This Cause') }}</a>
                                </div>
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
                                            <p class="small text-muted mt-2">{{ __('Logistics & Relief Kit Packing') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="p-3 border rounded text-center bg-white shadow-sm">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 team-avatar-teal">
                                                M
                                            </div>
                                            <h5 class="fw-bold mb-1">{{ __('Medical Aid Cell') }}</h5>
                                            <span class="text-muted small">{{ __('Health & Hygiene Volunteer Wing') }}</span>
                                            <p class="small text-muted mt-2">{{ __('Beneficiary Health Checkups') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="p-3 border rounded text-center bg-white shadow-sm">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold mx-auto mb-2 team-avatar-dark">
                                                V
                                            </div>
                                            <h5 class="fw-bold mb-1">{{ __('Youth Volunteers') }}</h5>
                                            <span class="text-muted small">{{ __('Community Engagement') }}</span>
                                            <p class="small text-muted mt-2">{{ __('Ground Survey & Verification') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab" id="tab-3">
                        <div class="contact-inner">
                            <h3>{{ __('Participate & Volunteer for') }} {{ $activity->localized_name }}</h3>
                            <p class="text-muted mb-4">{{ __('Register your interest to join our on-ground volunteer team for') }} <strong>{{ $activity->localized_name }}</strong>.</p>
                            <div class="row clearfix">
                                <div class="col-lg-8 col-md-12 col-sm-12 form-column">
                                    <div class="form-inner">
                                        <form action="{{ route('volunteer.submit') }}" method="post" class="default-form">
                                            @csrf
                                            <input type="hidden" name="event_name" value="{{ $activity->name }}">

                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>{{ __('Your Name') }} <span>*</span></label>
                                                        <input type="text" name="name" placeholder="{{ __('Enter your full name') }}" value="{{ old('name') }}" required>
                                                        @error('name')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>{{ __('Email Address') }} <span>*</span></label>
                                                        <input type="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" required>
                                                        @error('email')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>{{ __('Phone / WhatsApp Number') }} <span>*</span></label>
                                                        <input type="text" name="phone" placeholder="+880 1700-000000" value="{{ old('phone') }}" required>
                                                        @error('phone')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>{{ __('City / Location') }}</label>
                                                        <input type="text" name="address" placeholder="{{ __('Shanti Nagar, Dhaka') }}" value="{{ old('address') }}">
                                                        @error('address')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                    <div class="form-group">
                                                        <label>{{ __('Volunteer Experience / Notes for This Event') }}</label>
                                                        <textarea name="experience" placeholder="{{ __('Tell us how you would like to participate in') }} {{ $activity->localized_name }}..." rows="3">{{ old('experience') }}</textarea>
                                                        @error('experience')
                                                            <span class="text-danger small">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                    <div class="form-group message-btn">
                                                        <button type="submit" class="theme-btn btn-one">{{ __('Register as Volunteer') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-column">
                                    <div class="sidebar-inner">
                                        <div class="event-organizer p-4 border rounded bg-white shadow-sm">
                                            <h4 class="fw-bold mb-3">{{ __('Event Coordination Office') }}</h4>
                                            <ul class="list-unstyled mb-0 event-office-list">
                                                <li><strong>{{ __('Organization:') }}</strong> {{ site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') }}</li>
                                                <li><strong>{{ __('Phone:') }}</strong> <a href="tel:{{ site_setting('hotline', '+8801700000000') }}" class="text-decoration-none text-muted">{{ site_setting('hotline', '+880 1700-000000') }}</a></li>
                                                <li><strong>{{ __('Email:') }}</strong> <a href="mailto:{{ site_setting('email', 'info@shantinagarfoundation.org') }}" class="text-decoration-none text-muted">{{ site_setting('email', 'info@shantinagarfoundation.org') }}</a></li>
                                                <li><strong>{{ __('Location:') }}</strong> {{ site_setting('address', 'Shanti Nagar, Dhaka - 1217, Bangladesh') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Other Upcoming Activities --}}
            @if(isset($upcomingActivities) && $upcomingActivities->count() > 0)
                <div class="related-events mt-5 pt-4">
                    <div class="sec-title centred mb-4">
                        <span class="top-text">{{ __('Explore More') }}</span>
                        <h2>{{ __('Other Active Initiatives & Drives') }}</h2>
                    </div>
                    <div class="row clearfix">
                        @foreach($upcomingActivities as $otherAct)
                            @php
                                $otherDate = $otherAct->start_date ? \Carbon\Carbon::parse($otherAct->start_date) : now();
                            @endphp
                            <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                                <div class="events-block-two">
                                    <div class="inner-box">
                                        <div class="post-date">
                                            <h3>{{ localized_number($otherDate->format('d')) }}<span>{{ is_bengali() ? $otherDate->translatedFormat('M') : $otherDate->format('M') }}</span></h3>
                                        </div>
                                        <figure class="image-box"><img src="{{ asset($otherAct->featured_image) }}" alt="{{ $otherAct->localized_name }}"></figure>
                                        <div class="content-box">
                                            @if($otherAct->projectType)
                                                <div class="category"><a href="{{ route('event.details', $otherAct->slug) }}"># {{ $otherAct->projectType->localized_name }}</a></div>
                                            @endif
                                            <ul class="info clearfix">
                                                <li><i class="far fa-clock"></i>{{ __('10:00 AM') }}</li>
                                                <li><i class="far fa-map"></i>{{ Str::limit($otherAct->localized_location ?: __('Dhaka, Bangladesh'), 16) }}</li>
                                            </ul>
                                            <h3><a href="{{ route('event.details', $otherAct->slug) }}">{{ Str::limit($otherAct->localized_name, 45) }}</a></h3>
                                            <div class="links"><a href="{{ route('event.details', $otherAct->slug) }}">{{ __('View Details') }}</a></div>
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

@push('custom-script')
<script>
    $(document).ready(function() {
        if (window.location.hash === '#tab-3' || {{ $errors->any() && old('event_name') ? 'true' : 'false' }}) {
            var targetBtn = $('.tab-btns li[data-tab="#tab-3"]');
            if (targetBtn.length) {
                targetBtn.trigger('click');
            }
        }
    });
</script>
@endpush
