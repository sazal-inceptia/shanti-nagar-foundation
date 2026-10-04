@extends('frontend.layouts.app')

@section('title', __('Projects & Causes') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title page-title-donations">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Projects & Causes') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Projects & Causes') }}</li>
                    <li>{{ __('Active Relief Causes') }}</li>
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
                    <span class="top-text">{{ __('Flagship Sponsorship') }}</span>
                    <h2>{{ __('Sponsored & Signature Initiatives') }}</h2>
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
                                            <img src="{{ asset($sProject->featured_image) }}" alt="{{ $sProject->localized_name }}">
                                        </a>
                                    </figure>
                                </div>
                                <div class="content-box">
                                    <div class="text">
                                        <div class="category">
                                            <a
                                                href="{{ route('donations', ['type' => $sProject->projectType?->slug]) }}">{{ $sProject->projectType?->localized_name ?? __('Signature Project') }}</a>
                                        </div>
                                        <h3><a href="{{ route('donation.details', $sProject->slug) }}">{{ $sProject->localized_name }}</a>
                                        </h3>
                                        <p>{{ Str::limit($sProject->localized_short_description ?: $sProject->localized_description, 170) }}</p>
                                    </div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="icon-donation-1"></i></div>
                                            <h5>{{ __('Fund Raised') }}</h5>
                                            <div class="price">৳{{ localized_number($sRaised) }} <span>/
                                                    ৳{{ localized_number($sTarget) }}</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar" data-percent="{{ $sPercent }}%"></div>
                                            </div>
                                            <div class="count-text">{{ localized_number($sPercent) }}%</div>
                                        </div>
                                        <div class="btn-box">
                                            <button type="button" class="donate-box-btn"
                                                onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $sProject->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">{{ __('Donate Now') }}</button>
                                        </div>
                                    </div>
                                    <ul class="info-box clearfix">
                                        <li>
                                            <i class="far fa-map-marker-alt"></i>
                                            <h5>{{ __('Location') }}</h5>
                                            <p>{{ Str::limit($sProject->localized_location ?: __('Dhaka, Bangladesh'), 14) }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-users"></i>
                                            <h5>{{ __('Supporters') }}</h5>
                                            <p>{{ localized_number($sSupporters) }}+ {{ __('Donors') }}</p>
                                        </li>
                                        <li>
                                            <i class="fas fa-calendar-alt"></i>
                                            <h5>{{ __('Timeline') }}</h5>
                                            <p>{{ $sDaysLeft !== null ? localized_number($sDaysLeft) . ' ' . __('Days Left') : __('Ongoing') }}</p>
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
                <span class="top-text">{{ __('Transparency & Governance') }}</span>
                <h2>{{ __('Explore All Causes') }}</h2>
            </div>

            <div class="sortable-masonry">
                <div class="filters">
                    @php
                        $currentType = request('type');
                    @endphp
                    <ul class="filter-tabs filter-btns clearfix">
                        <li class="{{ empty($currentType) || $currentType === 'all' ? 'active ' : '' }}filter">
                            <a href="{{ route('donations') }}">{{ __('All Causes') }}
                                ({{ localized_number($totalCausesCount ?? \App\Models\Project::where('is_published', true)->count()) }})</a>
                        </li>
                        @foreach($projectTypes as $pType)
                            @php
                                $typeCount = $pType->projects_count ?? \App\Models\Project::where('is_published', true)->where('project_type_id', $pType->id)->count();
                                $isActive = ($currentType === $pType->slug);
                            @endphp
                            <li class="{{ $isActive ? 'active ' : '' }}filter">
                                <a href="{{ route('donations', ['type' => $pType->slug]) }}">{{ $pType->localized_name }}
                                    ({{ localized_number($typeCount) }})</a>
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
                            $projDate = $project->start_date ? \Carbon\Carbon::parse($project->start_date) : null;
                        @endphp
                        <div class="col-lg-6 col-md-12 col-sm-12 masonry-item small-column all {{ $typeSlug }}">
                            <div class="case-block-three">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ route('donation.details', $project->slug) }}">
                                                <img src="{{ asset($project->featured_image) }}" alt="{{ $project->localized_name }}">
                                            </a>
                                        </figure>
                                        <div class="text">
                                            <div class="category">
                                                <a
                                                    href="{{ route('donations', ['type' => $project->projectType?->slug]) }}">{{ $project->projectType?->localized_name ?? __('Relief Programs') }}</a>
                                            </div>
                                            <h3><a
                                                    href="{{ route('donation.details', $project->slug) }}">{{ $project->localized_name }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="lower-content">
                                        <div class="pattern-layer"></div>
                                        <div class="donate-inner clearfix">
                                            <div class="pattern-layer-2"></div>
                                            <div class="amount-box">
                                                <div class="icon-box"><i class="icon-donation-1"></i></div>
                                                <h5>{{ __('Fund Raised') }}</h5>
                                                <div class="price">৳{{ localized_number($raised) }} <span>/
                                                        ৳{{ localized_number($target) }}</span></div>
                                            </div>
                                            <div class="percentage-box">
                                                <div class="bar">
                                                    <div class="bar-inner count-bar" data-percent="{{ $percent }}%"></div>
                                                </div>
                                                <div class="count-text">{{ localized_number($percent) }}%</div>
                                            </div>
                                            <div class="btn-box">
                                                <button type="button" class="donate-box-btn"
                                                    onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $project->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">{{ __('Donate Now') }}</button>
                                            </div>
                                        </div>
                                        <ul class="info-box clearfix">
                                            <li>
                                                <i class="far fa-map-marker-alt"></i>
                                                <h5>{{ __('Location') }}</h5>
                                                <p>{{ Str::limit($project->localized_location ?: __('Dhaka, Bangladesh'), 16) }}</p>
                                            </li>
                                            <li>
                                                <i class="fas fa-tasks"></i>
                                                <h5>{{ __('Project Status') }}</h5>
                                                <p>{{ __($project->status == 'completed' ? 'Completed' : ($project->status == 'in_progress' ? 'In Progress' : 'Planned')) }}</p>
                                            </li>
                                            <li>
                                                <i class="fas fa-calendar-alt"></i>
                                                <h5>{{ __('Timeline') }}</h5>
                                                <p>{{ $projDate ? (is_bengali() ? $projDate->translatedFormat('M Y') : $projDate->format('M Y')) : __('Ongoing') }}
                                                </p>
                                            </li>
                                        </ul>
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