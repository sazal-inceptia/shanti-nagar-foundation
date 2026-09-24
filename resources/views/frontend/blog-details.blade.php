@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
        <section class="page-title" style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
            <div class="auto-container">
                <div class="content-box">
                    <div class="title">
                        <h1>Single Post</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="/">Home</a></li>
                        <li>Blog</li>
                        <li>Aid for Country: The Charity for Orphans</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- sidebar-page-container -->
        <section class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="blog-details-content">
                            <div class="content-one">
                                <div class="upper-box">
                                    <span># National Day</span>
                                    <h2>Aid for Country: The Charity for Orphans</h2>
                                    <ul class="post-info clearfix">
                                        <li><i class="far fa-user"></i>By Richardson</li>
                                        <li><i class="far fa-comment"></i>08 Cmts</li>
                                        <li><i class="far fa-eye"></i>25 Views</li>
                                    </ul>
                                </div>
                                <figure class="image-box">
                                    <img src="{{ asset('assets/images/news/news-14.jpg') }}" alt="">
                                    <span class="post-date">03.03.2021</span>
                                </figure>
                                <div class="text">
                                    <p>No one rejects, dislikes, or avoids pleasure itself, because it is pleasure but because those who do not know how to pursue pleasure on the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain these cases are perfectly.</p>
                                    <h3>Different Charity Causes</h3>
                                    <p>When our power of choice is untrammelled and when nothing prevents our being able to dowhat we like best every pleasures  to be welcomed every pain avoided but in certain circumstances and owing to the claims of duty or the obligation.</p>
                                    <h4>01. COVID 19 Relief</h4>
                                    <p>Indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the all moment, so blinded by desire, that they cannot foresee the pain and trouble.</p>
                                    <h4>02. Elderly Care Health</h4>
                                    <p>Untrammelled and when nothing prevents work being able to do what we like best every pleasure is to be  but in certain duty one who avoids a pain that produces.</p>
                                </div>
                            </div>
                            <div class="content-two">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                                        <figure class="image-box"><img src="{{ asset('assets/images/news/news-15.jpg') }}" alt=""></figure>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 quote-column">
                                        <blockquote>
                                            <div class="icon-box"><i class="fas fa-quote-left"></i></div>
                                            <h3>There are no secrets to success. It is the result of preparation, hard work & learning failure.</h3>
                                            <h4>Dertram Irvin, <span>Journalist</span></h4>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="content-three">
                                <div class="text">
                                    <h3>Donate Books to Orphanage</h3>
                                    <p>Best we denounce with righteous indignation and dislikes men who are beguiled demoralized by the charms of pleasure of the moment, so that they cannot foresee.</p>
                                    <h5>Our charity causes includes:</h5>
                                    <ul class="list clearfix">
                                        <li>An effort made for the happiness of others</li>
                                        <li>Doing nothing for others is the undoing of ourselves</li>
                                        <li>It is more agreeable to have the power to give than receive.</li>
                                    </ul>
                                    <p>Every pain avoided. But in certain circumstances and owing to the claims of duty or the obligation of business it will frequently occur that pleasures have to be repudiated and accepted. The therefore always holds in these matters this principle one rejects dislikes or avoids pleasure itself, because it is pleasure but because those who do not know how.</p>
                                </div>
                            </div>
                            <div class="post-share-option clearfix">
                                <ul class="tags-list pull-left clearfix">
                                    <li><h5>Tags:</h5></li>
                                    <li><a href="/blog-details">activities</a></li>
                                    <li><a href="/blog-details">benefits</a></li>
                                    <li><a href="/blog-details">education</a></li>
                                </ul>
                                <ul class="social-links pull-right clearfix">
                                    <li><a href="/blog-details"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="/blog-details"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="/blog-details"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="/blog-details"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                            <div class="author-box">
                                <figure class="author-thumb"><img src="{{ asset('assets/images/news/author-1.jpg') }}" alt=""></figure>
                                <div class="content-box">
                                    <h3>About Richardson</h3>
                                    <h6>Visit Blog Page: <a href="/blog-details">http://my.blog.com</a></h6>
                                    <p>Denouncing pleasure and praising pain was born and I will give complete all account of the system & expound.</p>
                                    <ul class="social-links clearfix">
                                        <li><a href="/blog-details"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="/blog-details"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="/blog-details"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nav-btn-box clearfix">
                                <div class="single-item text-left pull-left">
                                    <figure class="thumb-box"><img src="{{ asset('assets/images/gallery/btn-1.jpg') }}" alt=""></figure>
                                    <h5><a href="/blog-details">Aid for Country: <br />The Charity for Orphans</a></h5>
                                    <span>03.03.2021</span>
                                </div>
                                <div class="single-item text-right pull-right">
                                    <figure class="thumb-box"><img src="{{ asset('assets/images/gallery/btn-2.jpg') }}" alt=""></figure>
                                    <h5><a href="/blog-details">I Want to Get <br />Every People Volunteer...</a></h5>
                                    <span>24.02.2021</span>
                                </div>
                            </div>
                            <div class="comment-box">
                                <div class="group-title">
                                    <h3>Comments (02)</h3>
                                </div>
                                <div class="comment">
                                    <figure class="thumb-box">
                                        <img src="{{ asset('assets/images/news/comment-1.jpg') }}" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h3>Isaac Herman</h3>
                                            <span class="post-date">05.03.2021 [11.00am]</span>
                                        </div>
                                        <p>How all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>
                                        <a href="/blog-details" class="reply-btn"><i class="icon-reply"></i>Reply</a>
                                    </div>
                                </div>
                                <div class="comment replay-comment">
                                    <figure class="thumb-box">
                                        <img src="{{ asset('assets/images/news/comment-2.jpg') }}" alt="">
                                    </figure>
                                    <div class="comment-inner">
                                        <div class="comment-info clearfix">
                                            <h3>William Cobus</h3>
                                            <span class="post-date">04.03.2021 [10.00am]</span>
                                        </div>
                                        <p>Undertakes laborious physical exercise, except to obtain some advantage from it but who has any right to find fault.</p>
                                        <a href="/blog-details" class="reply-btn"><i class="icon-reply"></i>Reply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="comments-form-area">
                                <div class="group-title">
                                    <h3>Leave a Reply</h3>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                </div>
                                <div class="form-inner">
                                    <form method="post" action="/blog-details" class="comment-form"> 
                                        <div class="row clearfix">
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <textarea name="message" placeholder="Your Comment *"></textarea>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="text" name="name" placeholder="Your Name *" required="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                                <input type="email" name="email" placeholder="Email *" required="">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                <div class="form-group">
                                                    <label class="custom-control material-checkbox">
                                                        <input type="checkbox" class="material-control-input">
                                                        <span class="material-control-indicator"></span>
                                                        <span class="description">Save my name, email & website in this browser for the next time I comment.</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="blog-sidebar default-sidebar">
                            <div class="sidebar-widget search-widget">
                                <form action="/blog-details" method="post" class="search-form">
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Your Keyword . . ." required="">
                                        <button type="submit"><i class="icon-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="sidebar-widget category-widget">
                                <div class="widget-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list clearfix">
                                        <li><a href="/blog-details">CONTRIBUTIONS<span>06</span></a></li>
                                        <li><a href="/blog-details">Environment<span>08</span></a></li>
                                        <li><a href="/blog-details">Heath & Food<span>03</span></a></li>
                                        <li><a href="/blog-details">Treatment<span>14</span></a></li>
                                        <li><a href="/blog-details">National Day<span>12</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget post-widget">
                                <div class="widget-title">
                                    <h3>Popular Post</h3>
                                </div>
                                <div class="post-inner">
                                    <div class="post">
                                        <figure class="post-thumb"><a href="/blog-details"><img src="{{ asset('assets/images/news/post-4.jpg') }}" alt=""></a></figure>
                                        <h5><a href="/blog-details">Aid for Country: The Charity for Orphans</a></h5>
                                        <span class="post-date">03.03.2021</span>
                                    </div>
                                    <div class="post">
                                        <figure class="post-thumb"><a href="/blog-details"><img src="{{ asset('assets/images/news/post-5.jpg') }}" alt=""></a></figure>
                                        <h5><a href="/blog-details">I Want to Get Every People Volunteer...</a></h5>
                                        <span class="post-date">24.02.2021</span>
                                    </div>
                                    <div class="post">
                                        <figure class="post-thumb"><a href="/blog-details"><img src="{{ asset('assets/images/news/post-6.jpg') }}" alt=""></a></figure>
                                        <h5><a href="/blog-details">The Last Day of World Hunger Month</a></h5>
                                        <span class="post-date">08.01.2021</span>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget tags-widget">
                                <div class="widget-title">
                                    <h3>Tag Cloud</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="tags-list clearfix">
                                        <li><a href="/blog-details">activities</a></li>
                                        <li><a href="/blog-details">awareness</a></li>
                                        <li><a href="/blog-details">benefits</a></li>
                                        <li><a href="/blog-details">education</a></li>
                                        <li><a href="/blog-details">environment</a></li>
                                        <li><a href="/blog-details">gift card</a></li>
                                        <li><a href="/blog-details">heath</a></li>
                                        <li><a href="/blog-details">protection</a></li>
                                        <li><a href="/blog-details">women care</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget gallery-widget">
                                <div class="widget-title">
                                    <h3>Gallery</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="image-list clearfix">
                                        <li>
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/case/gallery-1.jpg') }}" alt="">
                                                <a href="/blog-details"><i class="fas fa-expand-alt"></i></a>
                                            </figure>
                                        </li>
                                        <li>
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/case/gallery-2.jpg') }}" alt="">
                                                <a href="/blog-details"><i class="fas fa-expand-alt"></i></a>
                                            </figure>
                                        </li>
                                        <li>
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/case/gallery-3.jpg') }}" alt="">
                                                <a href="/blog-details"><i class="fas fa-expand-alt"></i></a>
                                            </figure>
                                        </li>
                                        <li>
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/case/gallery-4.jpg') }}" alt="">
                                                <a href="/blog-details"><i class="fas fa-expand-alt"></i></a>
                                            </figure>
                                        </li>
                                        <li>
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/case/gallery-5.jpg') }}" alt="">
                                                <a href="/blog-details"><i class="fas fa-expand-alt"></i></a>
                                            </figure>
                                        </li>
                                        <li>
                                            <figure class="image">
                                                <img src="{{ asset('assets/images/case/gallery-6.jpg') }}" alt="">
                                                <a href="/blog-details"><i class="fas fa-expand-alt"></i></a>
                                            </figure>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar-widget subscribe-widget centred">
                                <div class="widget-content">
                                    <div class="upper-content" style="background-image: url({{ asset('assets/images/case/case-30.jpg') }});">
                                        <div class="icon-box"><i class="icon-email-open-sketched-envelope"></i></div>
                                        <h3>Subscribe Us</h3>
                                        <p>Subscribe us and get latest news and upcoming events.</p>
                                    </div>
                                    <div class="lower-content">
                                        <form action="/contact" method="post" class="subscribe-form">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Enter email address" required="">
                                                <button type="submit" class="theme-btn btn-one">Subscribe</button>
                                            </div>
                                        </form>
                                        <p><span>*</span>Never share your email with others.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sidebar-page-container end -->

@endsection
