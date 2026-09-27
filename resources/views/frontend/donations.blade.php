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
                        <li><a href="{{ route('home') }}">Home</a></li>
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
                        $target = (float) $project->estimated_cost;
                        $raised = (float) $project->total_donations_raised;
                        $percent = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
                    @endphp
                    <div class="col-lg-6 col-md-12 col-sm-12 case-block">
                        <div class="case-block-three">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset($project->featured_image) }}" alt="{{ $project->name }}"></figure>
                                    <div class="text">
                                        <div class="category"><a href="{{ route('donation.details', $project->slug) }}"># {{ $project->category }}</a></div>
                                        <h3><a href="{{ route('donation.details', $project->slug) }}">{{ $project->name }}</a></h3>
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
                                            <button type="button" class="donate-box-btn" onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $project->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">Donate Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-map-marker-alt"></i>
                                            <h5>Location</h5>
                                            <p>{{ Str::limit($project->location, 16) }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-tasks"></i>
                                            <h5>Status</h5>
                                            <p>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
                                        </li>
                                        <li>
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
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No donation projects available at this moment.</p>
                    </div>
                    @endforelse
                </div>
                <div class="pagination-wrapper centred mt-30">
                    {{ $projects->links('vendor.pagination.custom') }}
                </div>
            </div>
        </section>
        <!-- case-page-section end -->

@endsection
