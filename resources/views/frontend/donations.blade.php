@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Donation Campaigns & Projects</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Donations</li>
                        <li>Active Relief & Welfare Causes</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- case-page-section -->
        <section class="case-page-section">
            <div class="auto-container">
                <div class="row clearfix">
                    @forelse($projects as $project)
                    @php
                        $target = $project->estimated_cost > 0 ? $project->estimated_cost : 100000;
                        $raised = $project->total_donations_raised > 0 ? $project->total_donations_raised : ($project->total_expense > 0 ? $project->total_expense : 45000);
                        $percent = min(100, round(($raised / $target) * 100));
                    @endphp
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset($project->featured_image ?: 'assets/images/case/case-7.jpg') }}" alt="{{ $project->name }}"></figure>
                                    <div class="text">
                                        <div class="category"><a href="/donation-details/{{ $project->slug }}"># {{ $project->category ?? 'Social Welfare' }}</a></div>
                                        <h3><a href="/donation-details/{{ $project->slug }}">{{ $project->name }}</a></h3>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="pattern-layer" style="background-image: url({{ asset('assets/images/shape/shape-7.png') }});"></div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="icon-donation-1"></i></div>
                                            <h5>Fund Raised</h5>
                                            <div class="price">৳{{ number_format($raised) }} <span>/ ৳{{ number_format($target) }}</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                            </div>
                                            <div class="count-text">{{ $percent }}%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button class="donate-box-btn">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-map-marker-alt"></i>
                                            <h5>Location</h5>
                                            <p>{{ Str::limit($project->location ?? 'Shanti Nagar', 18) }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-tasks"></i>
                                            <h5>Status</h5>
                                            <p>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
                                        </li>
                                        <li class="share">
                                            <i class="fas fa-calendar-alt"></i>
                                            <h5>Date</h5>
                                            <p>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : 'Active' }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p>No donation projects available at this moment.</p>
                    </div>
                    @endforelse
                </div>
                <div class="pagination-wrapper centred" style="margin-top: 30px;">
                    {{ $projects->links() }}
                </div>
            </div>
        </section>
        <!-- case-page-section end -->

@endsection
