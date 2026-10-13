@extends('frontend.layouts.app')

@section('title', __('Photo Gallery & Activity Albums') . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url('{{ asset('assets/images/background/gallery-hero-bg.jpg') }}');">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Photo Gallery & Activity Albums') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Media') }}</li>
                    <li>{{ __('Photo Gallery & Activity Albums') }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- Section 1: Photo Albums Showcase -->
    <section class="events-section sec-pad" style="padding-bottom: 50px;">
        <div class="auto-container">
            <div class="sec-title centred mb-50">
                <span class="top-text">{{ __('Visual Archives') }}</span>
                <h2>{{ __('Activity & Field Photo Albums') }}</h2>
                <p class="text-muted mt-2" style="max-width: 650px; margin: 0 auto; font-size: 15px;">
                    {{ __('Explore categorized photo albums documenting our medical aid camps, relief drives, orphan kits, and community initiatives.') }}
                </p>
            </div>

            {{-- Modern Responsive Filter & Search Dashboard --}}
            <div class="causes-filter-dashboard mb-4">
                <form method="GET" action="{{ route('gallery') }}" id="galleryFilterForm">
                    <div class="filter-controls-row">
                        <!-- Search Box -->
                        <div class="filter-search-col">
                            <label for="gallerySearchInput" class="visually-hidden">{{ __('Search albums:') }}</label>
                            <div class="filter-input-group">
                                <span class="input-icon"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="{{ __('Search albums by title or description...') }}"
                                    class="filter-search-field" id="gallerySearchInput">
                                @if(request('search'))
                                    <a href="{{ route('gallery', request()->except(['search', 'photos_page'])) }}" class="btn-clear-input" title="{{ __('Clear search') }}">
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

                        <!-- Action Buttons -->
                        <div class="filter-actions-col">
                            <button type="submit" class="btn-filter-apply">
                                <i class="fas fa-filter me-1"></i> {{ __('Apply Filter') }}
                            </button>

                            @if(request('search') || (request('year') && request('year') !== 'all'))
                                <a href="{{ route('gallery') }}" class="btn-filter-reset" title="{{ __('Reset all filters') }}">
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
                    <i class="fas fa-images text-primary me-2"></i>
                    <span>{{ __('Showing') }} <strong class="text-dark">{{ localized_number($albums->count()) }}</strong> {{ __('of') }} <strong class="text-dark">{{ localized_number($totalAlbumsCount) }}</strong> {{ __('albums') }}</span>
                </div>

                @if(request('search') || (request('year') && request('year') !== 'all'))
                    <div class="active-filter-chips d-flex align-items-center gap-2 flex-wrap">
                        <span class="small text-muted me-1">{{ __('Active filters:') }}</span>
                        @if(request('search'))
                            <a href="{{ route('gallery', request()->except(['search', 'photos_page'])) }}" class="filter-chip">
                                <i class="fas fa-search me-1"></i>"{{ Str::limit(request('search'), 15) }}" <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        @if(request('year') && request('year') !== 'all')
                            <a href="{{ route('gallery', request()->except(['year', 'photos_page'])) }}" class="filter-chip">
                                <i class="fas fa-calendar-alt me-1"></i>RY {{ request('year') }} <i class="fas fa-times ms-1 chip-remove"></i>
                            </a>
                        @endif
                        <a href="{{ route('gallery') }}" class="clear-all-link text-danger small fw-semibold ms-1">
                            {{ __('Clear All') }}
                        </a>
                    </div>
                @endif
            </div>

            @if($albums->isNotEmpty())
                <div class="row clearfix">
                    @foreach($albums as $album)
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block mb-30">
                            <div class="news-block-one"
                                style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid #edf2f7; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div class="inner-box" style="display: flex; flex-direction: column; height: 100%;">
                                    <figure class="image-box"
                                        style="position: relative; height: 230px; overflow: hidden; margin-bottom: 0;">
                                        <a href="{{ route('gallery.album', $album->slug) }}">
                                            <img src="{{ $album->cover_image_url }}" alt="{{ $album->localized_title }}"
                                                style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                        </a>
                                        <div
                                            style="position: absolute; top: 15px; left: 15px; background: rgba(0, 93, 170, 0.9); color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; backdrop-filter: blur(4px); box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                            <i class="far fa-images me-1"></i> {{ localized_number($album->active_images_count) }}
                                            {{ __('Photos') }}
                                        </div>
                                        @if($album->event_date)
                                            <div
                                                style="position: absolute; bottom: 15px; right: 15px; background: rgba(17, 26, 58, 0.85); color: #fff; padding: 3px 10px; border-radius: 6px; font-size: 11.5px; font-weight: 600;">
                                                <i class="far fa-calendar-alt me-1"></i> {{ $album->event_date->format('d M, Y') }}
                                            </div>
                                        @endif
                                    </figure>
                                    <div class="lower-content"
                                        style="padding: 24px 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                        <div>
                                            <h4 style="font-size: 18px; font-weight: 700; line-height: 1.4; margin-bottom: 10px;">
                                                <a href="{{ route('gallery.album', $album->slug) }}"
                                                    style="color: #111a3a; text-decoration: none; transition: color 0.3s;">
                                                    {{ $album->localized_title }}
                                                </a>
                                            </h4>
                                            @if($album->localized_description)
                                                <p style="font-size: 13.5px; color: #64748b; line-height: 1.6; margin-bottom: 15px;">
                                                    {{ Str::limit($album->localized_description, 110) }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="btn-box pt-3" style="border-top: 1px solid #f1f5f9;">
                                            <a href="{{ route('gallery.album', $album->slug) }}" class="theme-btn btn-style-one"
                                                style="padding: 8px 20px; font-size: 13px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; width: 100%;">
                                                <span>{{ __('View Photo Album') }} <i class="fas fa-arrow-right ms-2"
                                                        style="font-size: 11px;"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12 text-center py-5">
                    <div class="empty-causes-box p-4 my-3 bg-white rounded-4 shadow-sm border text-center" style="max-width: 540px; margin: 0 auto;">
                        <div class="mb-3">
                            <span class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: #f0f7ff; color: #005daa; font-size: 28px;">
                                <i class="fas fa-images"></i>
                            </span>
                        </div>
                        <h4 class="fw-bold mb-2 text-dark">{{ __('No Albums Found') }}</h4>
                        <p class="text-muted mb-4 small">
                            {{ __('No photo albums matched your current filter selection. Try adjusting your search query or selecting a different Rotary Year.') }}
                        </p>
                        <a href="{{ route('gallery') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill fw-semibold" style="font-size: 14px;">
                            <i class="fas fa-undo-alt me-1"></i> {{ __('Reset All Filters') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>


    <!-- Section 2: Standalone Photos (Images without Album) -->
    @if($standaloneImages->isNotEmpty())
        <section class="portfolio-section centred sec-pad" style="background-color: #f8fafc; padding-top: 60px;">
            <div class="auto-container">
                <div class="sec-title centred mb-40">
                    <span class="top-text">{{ __('Field Memories') }}</span>
                    <h2>{{ __('General Field Moments & Memories') }}</h2>
                    <p class="text-muted mt-2" style="max-width: 600px; margin: 0 auto; font-size: 14.5px;">
                        {{ __('Spontaneous humanitarian moments and grassroots volunteer activities captured on camera across Bangladesh.') }}
                    </p>
                </div>

                <div class="items-container row clearfix">
                    @foreach($standaloneImages as $photo)
                        @php
                            $photoCaption = $photo->localized_caption ?: ($photo->localized_title ?: site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'));
                            $photoTitle = $photo->localized_title ?: __('Humanitarian Moment');
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all mb-30">
                            <div class="portfolio-block-one">
                                <div class="inner-box" style="border-radius: 10px; overflow: hidden;">
                                    <figure class="image" style="height: 250px; overflow: hidden; margin: 0;">
                                        <img src="{{ $photo->image_url }}" alt="{{ $photoTitle }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li>
                                                <a href="{{ $photo->image_url }}" class="lightbox-image"
                                                    data-fancybox="standalone-gallery" data-caption="{{ $photoCaption }}">
                                                    <i class="fas fa-expand-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="text">
                                            <span>{{ __('General Gallery') }}</span>
                                            <h3>
                                                <a href="{{ $photo->image_url }}" data-fancybox="standalone-gallery-title"
                                                    data-caption="{{ $photoCaption }}">{{ $photoTitle }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($standaloneImages->hasPages())
                    <div class="pagination-wrapper centred mt-40">
                        {{ $standaloneImages->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
        </section>
    @endif

@endsection

@push('custom-style')
<style>
    /* Filter Dashboard Styling */
    .causes-filter-dashboard {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
    }
    .filter-controls-row {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .filter-search-col {
        flex: 2 1 280px;
    }
    .filter-dropdown-col {
        flex: 1.2 1 200px;
    }
    .filter-actions-col {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .filter-input-group {
        position: relative;
        display: flex;
        align-items: center;
    }
    .filter-input-group .input-icon {
        position: absolute;
        left: 16px;
        color: #94a3b8;
        font-size: 14px;
        pointer-events: none;
    }
    .filter-search-field {
        width: 100%;
        height: 48px;
        padding: 0 42px 0 44px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        background: #f8fafc;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.2s ease;
    }
    .filter-search-field:focus {
        border-color: #005daa;
        background: #ffffff;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 93, 170, 0.12);
    }
    .btn-clear-input {
        position: absolute;
        right: 14px;
        color: #94a3b8;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #e2e8f0;
        transition: all 0.15s ease;
    }
    .btn-clear-input:hover {
        background: #cbd5e1;
        color: #475569;
    }
    .filter-select-box {
        position: relative;
        display: flex;
        align-items: center;
    }
    .filter-select-box .select-icon {
        position: absolute;
        left: 14px;
        font-size: 13px;
        pointer-events: none;
        z-index: 2;
    }
    .filter-select-field {
        width: 100%;
        height: 48px;
        padding: 0 36px 0 38px !important;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        background-color: #f8fafc !important;
        font-size: 13.5px;
        font-weight: 500;
        color: #1e293b;
        cursor: pointer;
        transition: all 0.2s ease;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 14px center !important;
        background-size: 14px !important;
    }
    .filter-select-field:focus {
        border-color: #005daa;
        background-color: #ffffff !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 93, 170, 0.12);
    }
    .btn-filter-apply {
        height: 48px;
        padding: 0 22px;
        background: #005daa;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
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