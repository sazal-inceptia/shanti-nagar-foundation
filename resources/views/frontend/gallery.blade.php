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
                        <li><a href="/">Home</a></li>
                        <li>Documentation</li>
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
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="active filter" data-role="button" data-filter=".all">All Projects</li>
                            <li class="filter" data-role="button" data-filter=".healthcare">Healthcare & Hospital</li>
                            <li class="filter" data-role="button" data-filter=".orphan">Orphan Support</li>
                            <li class="filter" data-role="button" data-filter=".relief">Winter & Flood Relief</li>
                            <li class="filter" data-role="button" data-filter=".water">Safe Water</li>
                        </ul>
                    </div>
                    <div class="items-container row clearfix">
                        @forelse($galleryImages as $item)
                        @php
                            $cat = strtolower($item->project->category ?? '');
                            $filterClass = 'all';
                            if (str_contains($cat, 'health') || str_contains($cat, 'hospital')) {
                                $filterClass .= ' healthcare';
                            } elseif (str_contains($cat, 'orphan')) {
                                $filterClass .= ' orphan';
                            } elseif (str_contains($cat, 'relief') || str_contains($cat, 'winter') || str_contains($cat, 'flood')) {
                                $filterClass .= ' relief';
                            } elseif (str_contains($cat, 'water')) {
                                $filterClass .= ' water';
                            } else {
                                $filterClass .= ' healthcare';
                            }
                        @endphp
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column {{ $filterClass }}">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset($item->image_path) }}" alt="{{ $item->caption }}"></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="{{ asset($item->image_path) }}" class="lightbox-image" data-fancybox="gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donation-details/{{ $item->project->slug ?? '' }}"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>{{ $item->project->category ?? 'Social Project' }}</span>
                                            <h3><a href="/donation-details/{{ $item->project->slug ?? '' }}">{{ $item->project->name ?? 'Project Documentation' }}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center">
                            <p>No project documentation photos available at this moment.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        <!-- portfolio-section end -->

@endsection
