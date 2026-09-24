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
                    @forelse($activities as $activity)
                    @php
                        $eventDate = $activity->start_date ? \Carbon\Carbon::parse($activity->start_date) : now();
                        $categoryName = $activity->category ?? 'Social Welfare';
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date"><h3>{{ $eventDate->format('d') }}<span>{{ $eventDate->format('M') }}</span></h3></div>
                                <figure class="image-box"><img src="{{ asset($activity->featured_image ?: 'assets/images/events/events-4.jpg') }}" alt="{{ $activity->name }}"></figure>
                                <div class="content-box">
                                    <div class="category"><a href="/event-details/{{ $activity->slug }}"># {{ $categoryName }}</a></div>
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>10.00 am</li>
                                        <li><i class="far fa-map"></i>{{ Str::limit($activity->location ?? 'Shanti Nagar', 16) }}</li>
                                    </ul>
                                    <h3><a href="/event-details/{{ $activity->slug }}">{{ $activity->name }}</a></h3>
                                    <div class="links"><a href="/event-details/{{ $activity->slug }}">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No active activities found at the moment.</p>
                    </div>
                    @endforelse
                </div>
                <div class="pagination-wrapper centred" style="margin-top: 30px;">
                    {{ $activities->links() }}
                </div>
            </div>
        </section>
        <!-- events-page-section -->

@endsection
