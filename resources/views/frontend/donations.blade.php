@extends('frontend.layouts.app')

@section('title', 'Donation Campaigns & Projects — Shanti Nagar Foundation')

@section('content')

    <!-- Page Title -->
    <section class="page-title page-title-donations">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>Donation Campaigns &amp; Projects</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Donations</li>
                    <li>Active Relief &amp; Welfare Causes</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    @if(isset($sponsoredProjects) && $sponsoredProjects->isNotEmpty())
        <!-- sponsored-projects-section / case-section -->
        <section class="case-section donations-sponsored-section">
            <div class="auto-container">
                <div class="sec-title centred mb-50">
                    <span class="top-text">Flagship Sponsorship</span>
                    <h2>Sponsored &amp; Signature Initiatives</h2>
                </div>
                <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                    @foreach($sponsoredProjects as $sProject)
                        @php
                            $sTarget = (float) $sProject->estimated_cost;
                            $sRaised = (float) $sProject->total_donations_raised;
                            $sPercent = $sTarget > 0 ? min(100, round(($sRaised / $sTarget) * 100)) : 0;
                            $sSupporters = $sProject->donations->where('status', 'completed')->count();
                            $sDaysLeft = $sProject->days_left;
                        @endphp
                        <div class="case-block-four">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        <a href="{{ route('donation.details', $sProject->slug) }}">
                                            <img src="{{ asset($sProject->featured_image) }}" alt="{{ $sProject->name }}">
                                        </a>
                                    </figure>
                                </div>
                                <div class="content-box">
                                    <div class="text">
                                        <div class="category">
                                            <a
                                                href="{{ route('donations', ['type' => $sProject->projectType?->slug]) }}">{{ $sProject->projectType?->name ?? 'Signature Project' }}</a>
                                        </div>
                                        <h3><a href="{{ route('donation.details', $sProject->slug) }}">{{ $sProject->name }}</a>
                                        </h3>
                                        <p>{{ Str::limit($sProject->short_description ?: $sProject->description, 170) }}</p>
                                    </div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="icon-donation-1"></i></div>
                                            <h5>Fund Raised</h5>
                                            <div class="price">৳{{ number_format($sRaised) }} <span>/
                                                    ৳{{ number_format($sTarget) }}</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="{{ $sPercent }}%"></div>
                                            </div>
                                            <div class="count-text">{{ $sPercent }}%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button type="button" class="donate-box-btn"
                                                onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $sProject->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">Donate
                                                Now</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-map-marker-alt"></i>
                                            <h5>Location</h5>
                                            <p>{{ Str::limit($sProject->location ?: 'Dhaka, Bangladesh', 14) }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>Supporters</h5>
                                            <p>{{ $sSupporters }}+ Donors</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-calendar-alt"></i>
                                            <h5>Timeline</h5>
                                            <p>{{ $sDaysLeft !== null ? $sDaysLeft . ' Days Left' : 'Ongoing' }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- sponsored-projects-section end -->
    @endif

    <!-- case-page-section / portfolio-section -->
    <section
        class="case-page-section portfolio-section centred donations-explore-section {{ isset($sponsoredProjects) && $sponsoredProjects->isNotEmpty() ? '' : 'standalone' }}">
        <div class="auto-container">
            <div class="sec-title centred mb-50">
                <span class="top-text">Transparent Welfare</span>
                <h2>Explore All Community Projects</h2>
            </div>

            <div class="sortable-masonry">
                <div class="filters">
                    @php
                        $currentType = request('type');
                    @endphp
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="{{ empty($currentType) || $currentType === 'all' ? 'active ' : '' }}filter">
                            <a href="{{ route('donations') }}">All Causes
                                ({{ $totalCausesCount ?? \App\Models\Project::where('is_published', true)->count() }})</a>
                        </li>
                        @foreach($projectTypes as $pType)
                            @php
                                $typeCount = $pType->projects_count ?? \App\Models\Project::where('is_published', true)->where('project_type_id', $pType->id)->count();
                                $isActive = ($currentType === $pType->slug);
                            @endphp
                            <li class="{{ $isActive ? 'active ' : '' }}filter">
                                <a href="{{ route('donations', ['type' => $pType->slug]) }}">{{ $pType->name }}
                                    ({{ $typeCount }})</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="items-container row clearfix text-start">
                    @forelse($projects as $project)
                        @php
                            $target = (float) $project->estimated_cost;
                            $raised = (float) $project->total_donations_raised;
                            $percent = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
                            $typeSlug = 'type-' . ($project->projectType?->slug ?? 'general');
                        @endphp
                        <div class="col-lg-6 col-md-12 col-sm-12 masonry-item small-column all {{ $typeSlug }}">
                            <div class="case-block-three">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ route('donation.details', $project->slug) }}">
                                                <img src="{{ asset($project->featured_image) }}" alt="{{ $project->name }}">
                                            </a>
                                        </figure>
                                        <div class="text">
                                            <div class="category">
                                                <a
                                                    href="{{ route('donations', ['type' => $project->projectType?->slug]) }}">{{ $project->projectType?->name ?? 'Community Cause' }}</a>
                                            </div>
                                            <h3><a
                                                    href="{{ route('donation.details', $project->slug) }}">{{ $project->name }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="pattern-layer"></div>
                                        <div class="donate-inner clearfix">
                                            <div class="pattern-layer-2"></div>
                                            <div class="amount-box">
                                                <div class="icon-box"><i class="icon-donation-1"></i></div>
                                                <h5>Fund Raised</h5>
                                                <div class="price">৳{{ number_format($raised) }} <span>/
                                                        ৳{{ number_format($target) }}</span></div>
                                            </div>
                                            <div class="percentage-box">
                                                <div class="bar">
                                                    <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                                </div>
                                                <div class="count-text">{{ $percent }}%</div>
                                            </div>
                                            <div class="btn-box">
                                                <button type="button" class="donate-box-btn"
                                                    onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $project->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">Donate
                                                    Now</button>
                                            </div>
                                        </div>
                                        <ul class="info-box clearfix">
                                            <li>
                                                <i class="far fa-map-marker-alt"></i>
                                                <h5>Location</h5>
                                                <p>{{ Str::limit($project->location ?: 'Dhaka, Bangladesh', 16) }}</p>
                                            </li>
                                            <li>
                                                <i class="fas fa-tasks"></i>
                                                <h5>Status</h5>
                                                <p>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
                                            </li>
                                            <li>
                                                <i class="fas fa-calendar-alt"></i>
                                                <h5>Date</h5>
                                                <p>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M Y') : 'Active' }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No donation projects available in this category.</p>
                        </div>
                    @endforelse
                </div>

                @if($projects->hasPages())
                    <div class="pagination-wrapper centred mt-30">
                        {{ $projects->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- case-page-section end -->

@endsection

@push('custom-script')
    <script>
        $(window).on('load', function () {
            if ($('.sortable-masonry').length) {
                var $container = $('.sortable-masonry .items-container');
                $container.isotope('layout');
            }
        });
    </script>
@endpush