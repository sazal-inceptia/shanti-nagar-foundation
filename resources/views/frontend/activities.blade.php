@extends('frontend.layouts.app')

@section('title', __('Activities & Events') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/activities-hero-bg.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Activities & Events') }}</h1>
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
            <div class="sec-title centred mb-4">
                <span class="top-text">{{ __('Rotary in Action') }}</span>
                <h2>{{ __('Upcoming Activities & Events') }}</h2>
            </div>

            {{-- Modern Responsive Filter & Search Dashboard --}}
            <div class="causes-filter-dashboard mb-4">
                <form method="GET" action="{{ route('activities') }}" id="activitiesFilterForm">
                    <div class="filter-controls-row">
                        <!-- Search Box -->
                        <div class="filter-search-col">
                            <label for="activitiesSearchInput" class="visually-hidden">{{ __('Search activities:') }}</label>
                            <div class="filter-input-group">
                                <span class="input-icon"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="{{ __('Search activities by title, location, description...') }}"
                                    class="filter-search-field" id="activitiesSearchInput">
                                @if(request('search'))
                                    <a href="{{ route('activities', request()->except(['search', 'page'])) }}" class="btn-clear-input" title="{{ __('Clear search') }}">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
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

                        <!-- Activity Status Filter -->
                        <div class="filter-dropdown-col">
                            <label for="filterStatusSelect" class="visually-hidden">{{ __('Activity Status:') }}</label>
                            <div class="filter-select-box">
                                <span class="select-icon"><i class="fas fa-tasks text-warning"></i></span>
                                <select name="status" id="filterStatusSelect" class="filter-select-field ignore">
                                    <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>{{ __('All Activities') }}</option>
                                    <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>{{ __('Upcoming & Ongoing') }}</option>
                                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="filter-actions-col">
                            <button type="submit" class="btn-filter-apply">
                                <i class="fas fa-filter me-1"></i> {{ __('Apply Filter') }}
                            </button>

                            @if(request('search') || (request('year') && request('year') !== 'all') || (request('status') && request('status') !== 'all'))
                                <a href="{{ route('activities') }}" class="btn-filter-reset" title="{{ __('Reset all filters') }}">
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
                    <i class="fas fa-calendar-check text-primary me-2"></i>
                    <span>{{ __('Showing') }} <strong class="text-dark">{{ localized_number($activities->count()) }}</strong> {{ __('of') }} <strong class="text-dark">{{ localized_number($activities->total()) }}</strong> {{ __('activities') }}</span>
                </div>

                @if(request('search') || (request('year') && request('year') !== 'all') || (request('status') && request('status') !== 'all'))
                    <div class="active-filter-chips d-flex align-items-center gap-2 flex-wrap">
                        <span class="small text-muted me-1">{{ __('Active filters:') }}</span>
                        @if(request('search'))
                            <a href="{{ route('activities', request()->except(['search', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-search me-1"></i>"{{ Str::limit(request('search'), 15) }}" <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        @if(request('year') && request('year') !== 'all')
                            <a href="{{ route('activities', request()->except(['year', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-calendar-alt me-1"></i>RY {{ request('year') }} <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        @if(request('status') && request('status') !== 'all')
                            <a href="{{ route('activities', request()->except(['status', 'page'])) }}" class="filter-chip">
                                <i class="fas fa-tasks me-1"></i>{{ __(ucfirst(str_replace('_', ' ', request('status')))) }} <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        <a href="{{ route('activities') }}" class="clear-all-link text-danger small fw-semibold ms-1">
                            {{ __('Clear All') }}
                        </a>
                    </div>
                @endif
            </div>

            <div class="row clearfix">
                @forelse($activities as $activity)
                    @php
                        $eventDate = $activity->event_date ? \Carbon\Carbon::parse($activity->event_date) : now();
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12 events-block">
                        <div class="events-block-two">
                            <div class="inner-box">
                                <div class="post-date">
                                    <h3>{{ localized_number($eventDate->format('d')) }}<span>{{ is_bengali() ? $eventDate->translatedFormat('M') : $eventDate->format('M') }}</span>
                                    </h3>
                                </div>
                                <figure class="image-box"><img src="{{ $activity->featured_image_url }}"
                                        alt="{{ $activity->localized_title }}"></figure>
                                <div class="content-box">
                                    <ul class="info clearfix">
                                        <li><i class="far fa-clock"></i>{{ $activity->event_time ?: __('10:00 AM') }}</li>
                                        <li><i
                                                class="far fa-map"></i>{{ Str::limit($activity->localized_location ?: __('Dhaka, Bangladesh'), 35) }}
                                        </li>
                                    </ul>
                                    <h3><a
                                            href="{{ route('activity.details', $activity->slug) }}">{{ $activity->localized_title }}</a>
                                    </h3>
                                    <div class="links"><a
                                            href="{{ route('activity.details', $activity->slug) }}">{{ __('View Details') }}</a>
                                    </div>
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
                            <h4 class="fw-bold mb-2">{{ __('No Activities Found') }}</h4>
                            <p class="text-muted mb-4 small">{{ __('We could not find any activities matching your selected filter criteria. Try adjusting your search keyword or clearing the filters.') }}</p>
                            <a href="{{ route('activities') }}" class="btn-filter-apply px-4 py-2 text-decoration-none">
                                <i class="fas fa-undo-alt me-2"></i> {{ __('Reset All Filters') }}
                            </a>
                        </div>
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

@push('custom-style')
<style>
    /* Activities Filter Dashboard */
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