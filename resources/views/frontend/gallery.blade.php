@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Project Documentation & Gallery</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Gallery</li>
                        <li>Completed Social Welfare Projects & Field Photos</li>
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
                            $currentCat = request('category');
                        @endphp
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="{{ empty($currentCat) || $currentCat === 'all' ? 'active ' : '' }}filter">
                                <a href="{{ route('gallery') }}" style="color: inherit; text-decoration: none; display: block;">All Causes ({{ \App\Models\ProjectImage::whereHas('project', fn($q) => $q->where('is_published', true))->count() }})</a>
                            </li>
                            @foreach($categories as $category)
                                @php
                                    $catCount = \App\Models\ProjectImage::whereHas('project', fn($q) => $q->where('is_published', true)->where('category', $category))->count();
                                    $catSlug = Str::slug($category);
                                    $isActive = ($currentCat === $catSlug || $currentCat === $category);
                                @endphp
                                <li class="{{ $isActive ? 'active ' : '' }}filter">
                                    <a href="{{ route('gallery', ['category' => $catSlug]) }}" style="color: inherit; text-decoration: none; display: block;">{{ $category }} ({{ $catCount }})</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="items-container row clearfix">
                        @forelse($galleryImages as $item)
                        @php
                            $catSlug = 'cat-' . Str::slug($item->project->category ?? 'general');
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all {{ $catSlug }}">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset($item->image_path) }}" alt="{{ $item->caption ?: ($item->project->name ?? 'Project Image') }}"></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="{{ asset($item->image_path) }}" class="lightbox-image" data-fancybox="gallery" data-caption="{{ $item->caption ?: ($item->project->name ?? '') }}"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="{{ $item->project ? route('donation.details', $item->project->slug) : 'javascript:void(0);' }}" title="View Project Details"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>{{ $item->project->category ?? 'Social Welfare' }}</span>
                                            <h3><a href="{{ $item->project ? route('donation.details', $item->project->slug) : 'javascript:void(0);' }}">{{ $item->project->name ?? ($item->caption ?: 'Field Documentation') }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No project documentation photos available in this category.</p>
                        </div>
                        @endforelse
                    </div>

                    @if($galleryImages->hasPages())
                    <div class="pagination-wrapper centred" style="margin-top: 50px;">
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
