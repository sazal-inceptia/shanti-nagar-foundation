@extends('frontend.layouts.app')

@section('title', __('Upcoming Activities & Events') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Upcoming Activities & Events') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Activities') }}</li>
                    <li>{{ __('Field Activities & Drives') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- events-page-section -->
    <section class="events-page-section">
        <div class="auto-container">
            <div class="row clearfix">
                @forelse($activities as $activity)
                    @php
                        $eventDate = $activity->start_date ? \Carbon\Carbon::parse($activity->start_date) : now();
                        $typeName = $activity->projectType?->localized_name;
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date">
                                    <h3>{{ localized_number($eventDate->format('d')) }}<span>{{ is_bengali() ? $eventDate->translatedFormat('M') : $eventDate->format('M') }}</span></h3>
                                </div>
                                <figure class="image-box"><img src="{{ asset($activity->featured_image) }}" alt="{{ $activity->localized_name }}"></figure>
                                <div class="content-box">
                                    @if($typeName)
                                        <div class="category"><a href="{{ route('event.details', $activity->slug) }}"># {{ $typeName }}</a></div>
                                    @endif
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>{{ __('10:00 AM') }}</li>
                                        <li><i class="far fa-map"></i>{{ Str::limit($activity->localized_location ?: __('Dhaka, Bangladesh'), 16) }}</li>
                                    </ul>
                                    <h3><a href="{{ route('event.details', $activity->slug) }}">{{ $activity->localized_name }}</a></h3>
                                    <div class="links"><a href="{{ route('event.details', $activity->slug) }}">{{ __('View Details') }}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">{{ __('No projects found in this category.') }}</p>
                    </div>
                @endforelse
            </div>
            @if($activities->hasPages())
                <div class="pagination-wrapper centred mt-30">
                    {{ $activities->links('vendor.pagination.custom') }}
                </div>
            @endif
        </div>
    </section>
    <!-- events-page-section end -->

@endsection
