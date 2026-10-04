@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>{{ __('Project Documentation & Gallery') }}</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Gallery') }}</li>
                        <li>{{ __('Completed Social Welfare Projects & Field Photos') }}</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- portfolio-section -->
        <section class="portfolio-section centred">
            <div class="auto-container">
                <div class="sortable-masonry">
                    <div class="filters">
                        @php
                            $currentType = request('type');
                        @endphp
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="{{ empty($currentType) || $currentType === 'all' ? 'active ' : '' }}filter">
                                <a href="{{ route('gallery') }}">{{ __('All Causes') }} ({{ localized_number($totalImagesCount ?? 0) }})</a>
                            </li>
                            @foreach($projectTypes as $pType)
                                @php
                                    $typeCount = $pType->gallery_images_count ?? 0;
                                    $isActive = ($currentType === $pType->slug);
                                @endphp
                                <li class="{{ $isActive ? 'active ' : '' }}filter">
                                    <a href="{{ route('gallery', ['type' => $pType->slug]) }}">{{ $pType->localized_name }} ({{ localized_number($typeCount) }})</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="items-container row clearfix">
                        @forelse($galleryImages as $item)
                        @php
                            $typeSlug = 'type-' . ($item->project?->projectType?->slug ?? 'general');
                            $itemCaption = $item->localized_caption ?: ($item->project?->localized_name ?? '');
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all {{ $typeSlug }}">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset($item->image_path) }}" alt="{{ $itemCaption }}"></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="{{ asset($item->image_path) }}" class="lightbox-image" data-fancybox="gallery" data-caption="{{ $itemCaption }}"><i class="fas fa-expand-alt"></i></a></li>
                                            @if($item->project)
                                            <li><a href="{{ route('donation.details', $item->project->slug) }}" title="{{ __('View Project Details') }}"><i class="far fa-file-alt"></i></a></li>
                                            @endif
                                        </ul>
                                        <div class="text">
                                            @if($item->project?->projectType)
                                                <span>{{ $item->project->projectType->localized_name }}</span>
                                            @endif
                                            <h3>
                                                @if($item->project)
                                                    <a href="{{ route('donation.details', $item->project->slug) }}">{{ $itemCaption }}</a>
                                                @else
                                                    <span>{{ $itemCaption }}</span>
                                                @endif
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">{{ __('No project documentation photos available in this type.') }}</p>
                        </div>
                        @endforelse
                    </div>

                    @if($galleryImages->hasPages())
                    <div class="pagination-wrapper centred mt-50">
                        {{ $galleryImages->links('vendor.pagination.custom') }}
                    </div>
                    @endif
                </div>
            </div>
        </section>
        <!-- portfolio-section end -->

@endsection

@push('custom-script')
<script>
    $(window).on('load', function() {
        if ($('.sortable-masonry').length) {
            var $container = $('.sortable-masonry .items-container');
            $container.isotope('layout');
        }
    });
</script>
@endpush
