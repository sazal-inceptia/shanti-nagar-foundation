@extends('frontend.layouts.app')

@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <h1>{{ $album->localized_title }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('gallery') }}">{{ __('Photo Gallery') }}</a></li>
                    <li>{{ $album->localized_title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->


    <!-- Album Details & Header Section -->
    <section class="event-details" style="padding-top: 60px; padding-bottom: 30px;">
        <div class="auto-container">
            <div class="event-details-content">
                <div class="inner-box" style="background: #ffffff; border: 1px solid #edf2f7; border-radius: 12px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.04); margin-bottom: 40px;">
                    <div class="row align-items-center">
                        <div class="col-lg-8 col-md-12">
                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                <span class="badge" style="background: #005daa; color: #ffffff; font-size: 13px; font-weight: 600; padding: 6px 14px; border-radius: 20px;">
                                    <i class="far fa-images me-1"></i> {{ localized_number($album->activeImages->count()) }} {{ __('Photos') }}
                                </span>
                                @if($album->event_date)
                                    <span class="badge" style="background: #f1f5f9; color: #334155; font-size: 13px; font-weight: 600; padding: 6px 14px; border-radius: 20px; border: 1px solid #cbd5e1;">
                                        <i class="far fa-calendar-alt text-primary me-1"></i> {{ $album->event_date->format('d F, Y') }}
                                    </span>
                                @endif
                            </div>
                            <h2 style="font-size: 28px; font-weight: 800; color: #111a3a; margin-bottom: 12px; line-height: 1.3;">
                                {{ $album->localized_title }}
                            </h2>
                            @if($album->localized_description)
                                <p style="font-size: 15px; color: #475569; line-height: 1.7; margin-bottom: 0;">
                                    {{ $album->localized_description }}
                                </p>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-12 text-lg-end mt-3 mt-lg-0">
                            <a href="{{ route('gallery') }}" class="theme-btn btn-style-two" style="padding: 10px 24px; font-size: 14px; border-radius: 6px; display: inline-flex; align-items: center;">
                                <i class="fas fa-arrow-left me-2"></i> {{ __('Back to All Albums') }}
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Album Photos Grid --}}
                <div class="sec-title mb-30">
                    <span class="top-text">{{ __('Full Gallery') }}</span>
                    <h3>{{ __('Album Photographs') }} ({{ localized_number($album->activeImages->count()) }})</h3>
                </div>

                @if($album->activeImages->isNotEmpty())
                    <div class="row clearfix">
                        @foreach($album->activeImages as $image)
                            @php
                                $caption = $image->localized_caption ?: ($image->localized_title ?: $album->localized_title);
                                $imgTitle = $image->localized_title ?: ($album->localized_title . ' - ' . __('Photo') . ' #' . ($loop->iteration));
                            @endphp
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                                <div class="portfolio-block-one">
                                    <div class="inner-box" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); height: 100%;">
                                        <figure class="image" style="height: 260px; overflow: hidden; margin: 0; position: relative;">
                                            <img src="{{ $image->image_url }}" alt="{{ $imgTitle }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;">
                                        </figure>
                                        <div class="content-box">
                                            <ul class="links-list clearfix">
                                                <li>
                                                    <a href="{{ $image->image_url }}" class="lightbox-image" data-fancybox="album-gallery-set" data-caption="{{ $caption }}">
                                                        <i class="fas fa-expand-alt"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="text">
                                                <span>{{ $album->localized_title }}</span>
                                                <h3>
                                                    <a href="{{ $image->image_url }}" data-fancybox="album-gallery-set-title" data-caption="{{ $caption }}">
                                                        {{ $imgTitle }}
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5" style="background: #f8fafc; border-radius: 12px; border: 1px dashed #cbd5e1;">
                        <i class="far fa-images display-4 text-muted mb-3 d-block"></i>
                        <h5>{{ __('No photos currently available in this album.') }}</h5>
                        <p class="text-muted">{{ __('Please check back shortly as our field coordinators update recent activity photos.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>


    <!-- Other Photo Albums Section -->
    @if($otherAlbums->isNotEmpty())
        <section class="events-section sec-pad" style="background: #f8fafc; padding-top: 60px;">
            <div class="auto-container">
                <div class="sec-title centred mb-40">
                    <span class="top-text">{{ __('Explore More') }}</span>
                    <h2>{{ __('Other Photo Albums') }}</h2>
                </div>

                <div class="row clearfix">
                    @foreach($otherAlbums as $other)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                            <div class="news-block-one" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); background: #fff; height: 100%; display: flex; flex-direction: column;">
                                <figure class="image-box" style="height: 170px; overflow: hidden; margin: 0; position: relative;">
                                    <a href="{{ route('gallery.album', $other->slug) }}">
                                        <img src="{{ $other->cover_image_url }}" alt="{{ $other->localized_title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                    <div style="position: absolute; top: 10px; left: 10px; background: rgba(0, 93, 170, 0.9); color: #fff; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 700;">
                                        <i class="far fa-images me-1"></i> {{ localized_number($other->active_images_count) }} {{ __('Photos') }}
                                    </div>
                                </figure>
                                <div class="lower-content p-3 d-flex flex-column justify-content-between" style="flex-grow: 1;">
                                    <h5 style="font-size: 15px; font-weight: 700; line-height: 1.4; margin-bottom: 8px;">
                                        <a href="{{ route('gallery.album', $other->slug) }}" style="color: #111a3a; text-decoration: none;">
                                            {{ $other->localized_title }}
                                        </a>
                                    </h5>
                                    @if($other->event_date)
                                        <div class="text-muted" style="font-size: 12px;">
                                            <i class="far fa-calendar-alt text-primary me-1"></i> {{ $other->event_date->format('d M, Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
