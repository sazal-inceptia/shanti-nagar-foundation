@extends('frontend.layouts.app')

@section('title', __('Projects & Causes') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/projects-hero-bg.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Projects & Causes') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('projects') }}">{{ __('Projects') }}</a></li>
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
                                        <a href="{{ route('project.details', $sProject->slug) }}">
                                            <img src="{{ asset($sProject->featured_image) }}" alt="{{ $sProject->localized_name }}">
                                        </a>
                                    </figure>
                                </div>
                                <div class="content-box">
                                    <div class="text">
                                        <div class="category">
                                            <a
                                                href="{{ route('projects', ['type' => $sProject->projectType?->slug]) }}">{{ $sProject->projectType?->localized_name ?? __('Signature Project') }}</a>
                                        </div>
                                        <h3><a href="{{ route('project.details', $sProject->slug) }}">{{ $sProject->localized_name }}</a>
                                        </h3>
                                        <p>{{ Str::limit($sProject->localized_short_description ?: $sProject->localized_description, 170) }}</p>
                                    </div>
                                    <div class="donate-inner clearfix">
                                        <div class="pattern-layer-2"></div>
                                        <div class="amount-box">
                                            <div class="icon-box"><i class="icon-donation-1"></i></div>
                                            <h5>{{ __('Fund Raised') }}</h5>
                                            <div class="price">৳{{ localized_number($sRaised) }} <span>/
                                                    ৳{{ localized_number($sTarget) }}</span></div>
                                        </div>
                                        <div class="percentage-box">
                                            <div class="bar">
                                                <div class="bar-inner count-bar counted" data-percent="{{ $sPercent }}%" style="width: {{ $sPercent }}%;"></div>
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
            <div class="sec-title centred mb-4">
                <span class="top-text">{{ __('Transparency & Governance') }}</span>
                <h2>{{ __('Explore All Causes') }}</h2>
            </div>

            {{-- Modern Responsive Unified Filter & Search Dashboard --}}
            <div class="causes-filter-dashboard mb-4">
                <form method="GET" action="{{ route('projects') }}" id="causesFilterForm">
                    <div class="filter-controls-row">
                        <!-- Search Box -->
                        <div class="filter-search-col">
                            <label for="causesSearchInput" class="visually-hidden">{{ __('Search causes:') }}</label>
                            <div class="filter-input-group">
                                <span class="input-icon"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="{{ __('Search causes by title, keyword, location...') }}"
                                    class="filter-search-field" id="causesSearchInput">
                                @if(request('search'))
                                    <a href="{{ route('projects', request()->except(['search', 'page'])) }}" class="btn-clear-input" title="{{ __('Clear search') }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Cause Category Filter -->
                        <div class="filter-dropdown-col">
                            <label for="filterTypeSelect" class="visually-hidden">{{ __('Cause Category:') }}</label>
                            <div class="filter-select-box">
                                <span class="select-icon"><i class="fas fa-layer-group text-success"></i></span>
                                <select name="type" id="filterTypeSelect" class="filter-select-field ignore">
                                    <option value="all" {{ empty($selectedType) || $selectedType === 'all' ? 'selected' : '' }}>
                                        {{ __('All Categories') }} ({{ localized_number($totalCausesCount) }})
                                    </option>
                                    @foreach($projectTypes as $pType)
                                        <option value="{{ $pType->slug }}" {{ ($selectedType ?? '') === $pType->slug ? 'selected' : '' }}>
                                            {{ $pType->localized_name }} ({{ localized_number($pType->projects_count) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Rotary Year Filter -->
                        <div class="filter-dropdown-col">
                            <label for="filterYearSelect" class="visually-hidden">Rotary Year:</label>
                            <div class="filter-select-box">
                                <span class="select-icon"><i class="fas fa-calendar-alt text-primary"></i></span>
                                <select name="year" id="filterYearSelect" class="filter-select-field ignore">
                                    <option value="all" {{ request('year', 'all') === 'all' ? 'selected' : '' }}>{{ __('All Rotary Years') }}</option>
                                    <option value="2026" {{ request('year') === '2026' ? 'selected' : '' }}>{{ __('RY 2026–2027 (Current Term)') }}</option>
                                    <option value="2025" {{ request('year') === '2025' ? 'selected' : '' }}>{{ __('RY 2025–2026 (Past Term)') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Project Status Filter -->
                        <div class="filter-dropdown-col">
                            <label for="filterStatusSelect" class="visually-hidden">{{ __('Project Status:') }}</label>
                            <div class="filter-select-box">
                                <span class="select-icon"><i class="fas fa-tasks text-warning"></i></span>
                                <select name="status" id="filterStatusSelect" class="filter-select-field ignore">
                                    <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>{{ __('All Statuses') }}</option>
                                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                    <option value="planned" {{ request('status') === 'planned' ? 'selected' : '' }}>{{ __('Planned') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="filter-actions-col">
                            <button type="submit" class="btn-filter-apply">
                                <i class="fas fa-filter me-1"></i> {{ __('Apply Filter') }}
                            </button>

                            @if(request('search') || (request('year') && request('year') !== 'all') || (request('type') && request('type') !== 'all') || (request('status') && request('status') !== 'all'))
                                <a href="{{ route('projects') }}" class="btn-filter-reset" title="{{ __('Reset all filters') }}">
                                    <i class="fas fa-undo-alt me-1"></i> {{ __('Reset') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Active Filter Chips & Results Count Bar -->
            <div class="filter-results-bar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="results-count-text">
                    <i class="fas fa-layer-group text-primary me-2"></i>
                    <span>{{ __('Showing') }} <strong class="text-dark">{{ localized_number($projects->count()) }}</strong> {{ __('of') }} <strong class="text-dark">{{ localized_number($projects->total()) }}</strong> {{ __('causes') }}</span>
                </div>

                @if(request('search') || (request('year') && request('year') !== 'all') || (request('type') && request('type') !== 'all') || (request('status') && request('status') !== 'all'))
                    <div class="active-filter-chips d-flex align-items-center gap-2 flex-wrap">
                        <span class="small text-muted me-1">{{ __('Active filters:') }}</span>
                        @if(request('search'))
                            <a href="{{ route('projects', request()->except(['search', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-search me-1"></i>"{{ Str::limit(request('search'), 15) }}" <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        @if(request('year') && request('year') !== 'all')
                            <a href="{{ route('projects', request()->except(['year', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-calendar-alt me-1"></i>RY {{ request('year') }} <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        @if(request('type') && request('type') !== 'all')
                            @php
                                $activeTypeName = $projectTypes->firstWhere('slug', request('type'))?->localized_name ?? request('type');
                            @endphp
                            <a href="{{ route('projects', request()->except(['type', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-tag me-1"></i>{{ $activeTypeName }} <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        @if(request('status') && request('status') !== 'all')
                            <a href="{{ route('projects', request()->except(['status', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-tasks me-1"></i>{{ __(ucfirst(str_replace('_', ' ', request('status')))) }} <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        <a href="{{ route('projects') }}" class="clear-all-link text-danger small fw-semibold ms-1">
                            {{ __('Clear All') }}
                        </a>
                    </div>
                @endif
            </div>

            <div class="sortable-masonry">
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
                                            <a href="{{ route('project.details', $project->slug) }}">
                                                <img src="{{ asset($project->featured_image) }}" alt="{{ $project->localized_name }}">
                                            </a>
                                        </figure>
                                        <div class="text">
                                            <div class="category">
                                                <a
                                                    href="{{ route('projects', ['type' => $project->projectType?->slug]) }}">{{ $project->projectType?->localized_name ?? __('Relief Programs') }}</a>
                                            </div>
                                            <h3><a
                                                    href="{{ route('project.details', $project->slug) }}">{{ $project->localized_name }}</a>
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
                                                    <div class="bar-inner count-bar counted" data-percent="{{ $percent }}%" style="width: {{ $percent }}%;"></div>
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
                            <div class="empty-causes-box p-4 my-3 bg-white rounded-4 shadow-sm border text-center" style="max-width: 540px; margin: 0 auto;">
                                <div class="mb-3">
                                    <i class="fas fa-search-minus fa-3x text-muted opacity-50"></i>
                                </div>
                                <h4 class="fw-bold mb-2">{{ __('No Causes Found') }}</h4>
                                <p class="text-muted mb-4 small">{{ __('We could not find any humanitarian causes matching your selected filter criteria. Try adjusting your search keyword or clearing the filters.') }}</p>
                                <a href="{{ route('projects') }}" class="btn-filter-apply px-4 py-2 text-decoration-none">
                                    <i class="fas fa-undo-alt me-2"></i> {{ __('Reset All Filters') }}
                                </a>
                            </div>
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

@push('custom-style')
<style>
    /* Causes Filter Dashboard */
    .causes-filter-dashboard {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0, 45, 98, 0.06);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
        text-align: left;
    }
    .filter-controls-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: flex-end;
    }
    .filter-search-col {
        flex: 1 1 280px;
    }
    .filter-dropdown-col {
        flex: 0 1 220px;
    }
    .filter-actions-col {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    .filter-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }
    .filter-input-group .input-icon {
        position: absolute;
        left: 16px;
        color: #64748b;
        font-size: 14px;
        pointer-events: none;
        z-index: 2;
    }
    .filter-search-field {
        width: 100%;
        height: 48px;
        padding: 10px 36px 10px 42px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        background: #f8fafc;
        color: #1e293b;
        transition: all 0.25s ease;
    }
    .filter-search-field:focus {
        outline: none;
        border-color: #005daa;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(0, 93, 170, 0.12);
    }
    .btn-clear-input {
        position: absolute;
        right: 14px;
        color: #94a3b8;
        cursor: pointer;
        font-size: 14px;
        z-index: 2;
        transition: color 0.15s ease;
    }
    .btn-clear-input:hover {
        color: #dc2626;
    }
    .filter-select-box {
        position: relative;
        display: flex;
        align-items: center;
    }
    .filter-select-box .select-icon {
        position: absolute;
        left: 14px;
        font-size: 14px;
        pointer-events: none;
        z-index: 2;
    }
    .filter-select-field {
        width: 100%;
        height: 48px;
        padding: 10px 32px 10px 38px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 500;
        background: #f8fafc url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%2364748b'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E") no-repeat right 12px center/16px 16px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        color: #1e293b;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .filter-select-field:focus {
        outline: none;
        border-color: #005daa;
        background-color: #ffffff;
        box-shadow: 0 0 0 3px rgba(0, 93, 170, 0.12);
    }
    .btn-filter-apply {
        height: 48px;
        padding: 0 20px;
        background: #005daa;
        color: #ffffff !important;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
    }
    .btn-filter-apply:hover {
        background: #004885;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 93, 170, 0.25);
    }
    .btn-filter-reset {
        height: 48px;
        padding: 0 16px;
        background: #f1f5f9;
        color: #64748b;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13.5px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-filter-reset:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #dc2626;
    }
    .filter-results-bar {
        padding: 0 4px;
    }
    .results-count-text {
        font-size: 14px;
        color: #64748b;
    }
    .active-filter-chips {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 6px;
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        color: #005daa;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    .filter-chip:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #dc2626;
    }
    .filter-chip .chip-remove {
        font-size: 10px;
        margin-left: 4px;
    }
    .clear-all-link {
        text-decoration: underline;
    }
    .clear-all-link:hover {
        color: #b91c1c !important;
    }
    @media (max-width: 991px) {
        .filter-controls-row {
            gap: 10px;
        }
        .filter-search-col {
            flex: 1 1 100%;
        }
        .filter-dropdown-col {
            flex: 1 1 calc(50% - 5px);
        }
        .filter-actions-col {
            flex: 1 1 100%;
            justify-content: flex-end;
        }
    }
    @media (max-width: 576px) {
        .causes-filter-dashboard {
            padding: 16px;
        }
        .filter-dropdown-col {
            flex: 1 1 100%;
        }
        .filter-actions-col {
            flex-direction: row;
            width: 100%;
        }
        .btn-filter-apply,
        .btn-filter-reset {
            flex: 1;
            justify-content: center;
        }
    }
</style>
@endpush

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
