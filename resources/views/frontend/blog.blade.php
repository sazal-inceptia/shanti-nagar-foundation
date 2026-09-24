@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Stories & Latest Updates</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Blog</li>
                        <li>News, Articles & Impact Stories</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- blog-grid -->
        <section class="blog-grid">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="/blog-details"><img src="{{ asset('assets/images/news/news-1.jpg') }}" alt=""></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date">03.03.2021</span>
                                        <div class="category"><a href="/blog-details"># National Day</a></div>
                                        <h3><a href="/blog-details">This is World Cancer Day, We Provide Care</a></h3>
                                        <p>Our being able do what we like best pleasure is to welcomed. . .</p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="/blog-details">More Details</a></div>
                                        <div class="comment-box pull-right"><a href="/blog-details"><i class="far fa-comment"></i>08 Cmts</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="/blog-details"><img src="{{ asset('assets/images/news/news-2.jpg') }}" alt=""></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date">24.02.2021</span>
                                        <div class="category"><a href="/blog-details"># Treatment</a></div>
                                        <h3><a href="/blog-details">I Want to Get Every People Volunteering</a></h3>
                                        <p>Our being able do what we like best pleasure is to welcomed. . .</p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="/blog-details">More Details</a></div>
                                        <div class="comment-box pull-right"><a href="/blog-details"><i class="far fa-comment"></i>03 Cmts</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="/blog-details"><img src="{{ asset('assets/images/news/news-3.jpg') }}" alt=""></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date">08.01.2021</span>
                                        <div class="category"><a href="/blog-details"># Health & Food</a></div>
                                        <h3><a href="/blog-details">The Last Day of World Hunger Month</a></h3>
                                        <p>Our being able do what we like best pleasure is to welcomed. . .</p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="/blog-details">More Details</a></div>
                                        <div class="comment-box pull-right"><a href="/blog-details"><i class="far fa-comment"></i>08 Cmts</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="/blog-details"><img src="{{ asset('assets/images/news/news-6.jpg') }}" alt=""></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date">08.01.2021</span>
                                        <div class="category"><a href="/blog-details"># Health & Food</a></div>
                                        <h3><a href="/blog-details">How Much Can Someone Afford To Give?</a></h3>
                                        <p>Our being able do what we like best pleasure is to welcomed. . .</p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="/blog-details">More Details</a></div>
                                        <div class="comment-box pull-right"><a href="/blog-details"><i class="far fa-comment"></i>0 Cmts</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="/blog-details"><img src="{{ asset('assets/images/news/news-7.jpg') }}" alt=""></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date">03.03.2021</span>
                                        <div class="category"><a href="/blog-details"># National Day</a></div>
                                        <h3><a href="/blog-details">This is World Cancer Day, We Provide Care</a></h3>
                                        <p>Our being able do what we like best pleasure is to welcomed. . .</p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="/blog-details">More Details</a></div>
                                        <div class="comment-box pull-right"><a href="/blog-details"><i class="far fa-comment"></i>08 Cmts</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <figure class="image-box"><a href="/blog-details"><img src="{{ asset('assets/images/news/news-8.jpg') }}" alt=""></a></figure>
                                <div class="content-box">
                                    <div class="text">
                                        <span class="post-date">24.02.2021</span>
                                        <div class="category"><a href="/blog-details"># Treatment</a></div>
                                        <h3><a href="/blog-details">Six Benefits Earned From Charitable Donations</a></h3>
                                        <p>Our being able do what we like best pleasure is to welcomed. . .</p>
                                    </div>
                                    <div class="info clearfix">
                                        <div class="link-box pull-left"><a href="/blog-details">More Details</a></div>
                                        <div class="comment-box pull-right"><a href="/blog-details"><i class="far fa-comment"></i>03 Cmts</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="more-btn centred"><a href="/blog" class="theme-btn btn-one">Load More</a></div>
            </div>
        </section>
        <!-- blog-grid end -->

@endsection
