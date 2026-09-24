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
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all healthcare">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-7.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Healthcare Project</span>
                                            <h3><a href="/gallery">Hospital Ceiling Fan Supply</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all orphan">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-8.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Orphan Care</span>
                                            <h3><a href="/gallery">Education Kit & Books for Orphans</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all relief">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-9.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Winter Relief</span>
                                            <h3><a href="/gallery">Warm Blanket Distribution in Kurigram</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all water">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-10.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Clean Water</span>
                                            <h3><a href="/gallery">Deep Tube-well Installation</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all healthcare">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-11.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Medical Support</span>
                                            <h3><a href="/gallery">Essential Medicines for Poor Patients</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all relief">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-12.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Flood Relief</span>
                                            <h3><a href="/gallery">Emergency Food Rations Distribution</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all orphan">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-13.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Orphan Care</span>
                                            <h3><a href="/gallery">Orphanage Nutritious Meal Support</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all healthcare">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-14.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Hospital Support</span>
                                            <h3><a href="/gallery">Wheelchairs & Medical Equipment Handover</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all relief">
                            <div class="portfolio-block-one">
                                <div class="inner-box">
                                    <figure class="image"><img src="{{ asset('assets/images/gallery/portfolio-15.jpg') }}" alt=""></figure>
                                    <div class="content-box">
                                        <ul class="links-list clearfix">
                                            <li><a href="/gallery"><i class="fas fa-expand-alt"></i></a></li>
                                            <li><a href="/donations"><i class="far fa-file-alt"></i></a></li>
                                        </ul>
                                        <div class="text">
                                            <span>Community Welfare</span>
                                            <h3><a href="/gallery">Financial Aid to Destitute Families</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- portfolio-section end -->

@endsection
