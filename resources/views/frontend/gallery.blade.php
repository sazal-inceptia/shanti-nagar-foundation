@extends('frontend.layouts.app')

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ __('Photo Gallery & Activity Albums') }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li>{{ __('Media') }}</li>
                    <li>{{ __('Photo Albums & Gallery') }}</li>
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

            @if($albums->isNotEmpty())
                <div class="row clearfix">
                    @foreach($albums as $album)
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block mb-30">
                            <div class="news-block-one" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.06); height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid #edf2f7; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                <div class="inner-box" style="display: flex; flex-direction: column; height: 100%;">
                                    <figure class="image-box" style="position: relative; height: 230px; overflow: hidden; margin-bottom: 0;">
                                        <a href="{{ route('gallery.album', $album->slug) }}">
                                            <img src="{{ $album->cover_image_url }}" alt="{{ $album->localized_title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                        </a>
                                        <div style="position: absolute; top: 15px; left: 15px; background: rgba(0, 93, 170, 0.9); color: #fff; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; backdrop-filter: blur(4px); box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                                            <i class="far fa-images me-1"></i> {{ localized_number($album->active_images_count) }} {{ __('Photos') }}
                                        </div>
                                        @if($album->event_date)
                                            <div style="position: absolute; bottom: 15px; right: 15px; background: rgba(17, 26, 58, 0.85); color: #fff; padding: 3px 10px; border-radius: 6px; font-size: 11.5px; font-weight: 600;">
                                                <i class="far fa-calendar-alt me-1"></i> {{ $album->event_date->format('d M, Y') }}
                                            </div>
                                        @endif
                                    </figure>
                                    <div class="lower-content" style="padding: 24px 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                        <div>
                                            <h4 style="font-size: 18px; font-weight: 700; line-height: 1.4; margin-bottom: 10px;">
                                                <a href="{{ route('gallery.album', $album->slug) }}" style="color: #111a3a; text-decoration: none; transition: color 0.3s;">
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
                                            <a href="{{ route('gallery.album', $album->slug) }}" class="theme-btn btn-style-one" style="padding: 8px 20px; font-size: 13px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; width: 100%;">
                                                <span>{{ __('View Photo Album') }} <i class="fas fa-arrow-right ms-2" style="font-size: 11px;"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4">
                    <p class="text-muted">{{ __('No photo albums published yet.') }}</p>
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
                                        <img src="{{ $photo->image_url }}" alt="{{ $photoTitle }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li>
                                                <a href="{{ $photo->image_url }}" class="lightbox-image" data-fancybox="standalone-gallery" data-caption="{{ $photoCaption }}">
                                                    <i class="fas fa-expand-alt"></i>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="text">
                                            <span>{{ __('General Gallery') }}</span>
                                            <h3>
                                                <a href="{{ $photo->image_url }}" data-fancybox="standalone-gallery-title" data-caption="{{ $photoCaption }}">{{ $photoTitle }}</a>
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
