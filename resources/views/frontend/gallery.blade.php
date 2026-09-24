@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>3 Columns Grid</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Pages</li>
                        <li>Portfolio</li>
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
                            <li class="active filter" data-role="button" data-filter=".all">View All</li>
                            <li class="filter" data-role="button" data-filter=".activities">Activities</li>
                            <li class="filter" data-role="button" data-filter=".awareness">Awareness</li>
                            <li class="filter" data-role="button" data-filter=".education">Education</li>
                            <li class="filter" data-role="button" data-filter=".health">Health</li>
                            <li class="filter" data-role="button" data-filter=".helping">Helping</li>
                        </ul>
                    </div>
                    <div class="items-container row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all education activities awareness helping">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-7.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all activities education health helping">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-8.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all education awareness">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-9.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all activities awareness health helping">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-10.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all education awareness">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-11.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all activities awareness health helping">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-12.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all activities awareness health helping">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-13.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all education awareness">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-14.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all activities awareness health helping">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-15.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/gallery"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Activities</span>
                                            <h3><a href="/gallery">Educate Children</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more-btn"><a href="/gallery" class="theme-btn btn-one">Load More</a></div>
            </div>
        </section>
        <!-- portfolio-section end -->

@endsection
