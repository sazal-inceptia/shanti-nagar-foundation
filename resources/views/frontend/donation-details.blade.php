@extends('frontend.layouts.app')

@section('title', $project->name . ' — Shanti Nagar Foundation')
@section('meta_description', Str::limit($project->short_description ?: $project->description, 160))
@section('meta_image', asset($project->featured_image ?: 'assets/images/logo.png'))

@section('content')

    @php
        $target = (float) $project->estimated_cost;
        $raised = (float) $project->total_donations_raised;
        $percent = $target > 0 ? min(100, round(($raised / $target) * 100)) : 0;
        $supportersCount = $project->donations->where('status', 'completed')->count();
    @endphp

    <!-- Page Title -->
    <section class="page-title donation-title"
        style="background-image: url({{ asset('assets/images/background/12.jpg') }});">
        <div class="auto-container">
            <div class="content-box">
                <div class="title">
                    <div class="d-flex align-items-center justify-content-center gap-2 mb-2 flex-wrap">
                        @if($project->projectType)
                            <span class="badge" style="{{ $project->projectType->badge_style }} font-size: 12px; padding: 4px 10px; border-radius: 4px;">
                                {{ $project->projectType->name }}
                            </span>
                        @endif
                    </div>
                    <h1>{{ $project->name }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('donations') }}">Projects & Causes</a></li>
                    <li>{{ Str::limit($project->name, 35) }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- case-details -->
    <section class="case-details">
        <div class="auto-container">

            <!-- Upper KPI Box -->
            <div class="upper-box kpi-row">
                <div class="row clearfix align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 left-column">
                        <div class="donate-inner clearfix">
                            <div class="pattern-layer-2" style="background-image: url({{ asset('assets/images/shape/shape-8.png') }});"></div>
                            <div class="amount-box">
                                <div class="icon-box"><i class="fas fa-hand-holding-heart"></i></div>
                                <h5>Fund Raised</h5>
                                <div class="price">৳{{ number_format($raised) }} <span>/ ৳{{ number_format($target) }}</span></div>
                            </div>
                            <div class="percentage-box">
                                <div class="bar"><span class="fill-bar" style="height: {{ $percent }}%;"></span></div>
                                <h5>{{ $percent }}%</h5>
                            </div>
                            <div class="btn-box">
                                <button type="button" class="donate-box-btn" onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $project->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">Donate Now</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                        <ul class="info-box clearfix">
                            <li>
                                <i class="far fa-map-marker-alt"></i>
                                <h5>Location</h5>
                                <p title="{{ $project->location }}">{{ Str::limit($project->location, 16) }}</p>
                            </li>
                            <li>
                                <i class="fas fa-users"></i>
                                <h5>{{ $supportersCount }}+</h5>
                                <p>Supporters</p>
                            </li>
                            <li>
                                <i class="fas fa-tasks"></i>
                                <h5>Status</h5>
                                <p>{{ ucfirst(str_replace('_', ' ', $project->status)) }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Lower Details Box -->
            <div class="lower-box details-lower">
                <div class="row clearfix">

                    <!-- Main Content Side -->
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="case-details-content">

                            <div class="content-one">
                                <figure class="image-box main-image-box">
                                    <img src="{{ asset($project->featured_image ?: 'assets/images/case/case-21.jpg') }}"
                                        alt="{{ $project->name }}">
                                </figure>
                                <div class="text">
                                    <h3 class="project-heading">{{ $project->name }}</h3>
                                    @if($project->short_description)
                                        <p class="lead project-lead">{{ $project->short_description }}</p>
                                    @endif
                                    <div class="project-desc">
                                        {!! nl2br(e($project->description ?: 'Shanti Nagar Foundation is dedicated to delivering transparent humanitarian relief, healthcare support, and social empowerment across Bangladesh. Every contribution directly funds verified on-the-ground initiatives without intermediaries.')) !!}
                                    </div>
                                </div>
                            </div>

                            {{-- Project Gallery Photos --}}
                            @if($project->images && $project->images->count() > 0)
                                <div class="content-two mt-4 pt-3">
                                    <h3 class="section-title-sub-2">Field Documentation & Photos</h3>
                                    <div class="row clearfix g-3">
                                        @foreach($project->images as $img)
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="image-box gallery-card-box">
                                                    <img src="{{ asset($img->image_path) }}"
                                                        alt="{{ $img->caption ?: $project->name }}">
                                                </div>
                                                @if($img->caption)
                                                    <p class="small text-muted mt-1"><i class="fas fa-camera me-1 text-primary"></i>
                                                        {{ $img->caption }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Make Donation Form Section --}}
                            <div class="donate-content mt-5 pt-3" id="make-donation-section">
                                <div class="title mb-4">
                                    <h3 class="section-title-sub">Make Your Contribution</h3>
                                    <p class="text-muted">Support <strong>{{ $project->name }}</strong> directly. We ensure
                                        100% financial transparency and official receipt vouchers.</p>
                                </div>

                                <form action="{{ route('donate.submit') }}" method="post" class="default-form">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                                    <div class="donate-box">
                                        <div class="donate-option">
                                            <h3>Select Amount (৳ BDT)</h3>
                                            <ul class="donate-list clearfix">
                                                <li>
                                                    <input type="radio" id="damt-500" name="preset_amount" value="500"
                                                        onclick="document.getElementById('custom_amt_input').value='500'">
                                                    <label for="damt-500">৳ 500</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-1000" name="preset_amount" value="1000"
                                                        checked="checked"
                                                        onclick="document.getElementById('custom_amt_input').value='1000'">
                                                    <label for="damt-1000">৳ 1,000</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-2500" name="preset_amount" value="2500"
                                                        onclick="document.getElementById('custom_amt_input').value='2500'">
                                                    <label for="damt-2500">৳ 2,500</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-5000" name="preset_amount" value="5000"
                                                        onclick="document.getElementById('custom_amt_input').value='5000'">
                                                    <label for="damt-5000">৳ 5,000</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-10000" name="preset_amount" value="10000"
                                                        onclick="document.getElementById('custom_amt_input').value='10000'">
                                                    <label for="damt-10000">৳ 10,000</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-25000" name="preset_amount" value="25000"
                                                        onclick="document.getElementById('custom_amt_input').value='25000'">
                                                    <label for="damt-25000">৳ 25,000</label>
                                                </li>
                                            </ul>
                                            <div class="other-amount mt-3">
                                                <div class="text">
                                                    <h4>Or Enter Custom Amount (৳)</h4>
                                                    <p>Enter any specific amount in BDT</p>
                                                </div>
                                                <div class="amount-box custom-amount-input-box">
                                                    <input type="number" id="custom_amt_input" name="amount" value="1000"
                                                        min="10" step="1" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="payment-option mt-4">
                                            <h3>Payment Method</h3>
                                            <ul class="payment-list clearfix">
                                                <li>
                                                    <input type="radio" id="pm_b" name="payment_method" value="bkash"
                                                        checked="checked">
                                                    <label for="pm_b">bKash</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="pm_n" name="payment_method" value="nagad">
                                                    <label for="pm_n">Nagad</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="pm_bank" name="payment_method"
                                                        value="bank_transfer">
                                                    <label for="pm_bank">Bank Transfer</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="pm_c" name="payment_method" value="cash">
                                                    <label for="pm_c">Cash / Counter</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="form-inner">
                                        <h3>Donor Information</h3>
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Your Name <span>*</span></label>
                                                    <input type="text" name="name" placeholder="Enter your full name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Email Address <span>*</span></label>
                                                    <input type="email" name="email" placeholder="example@gmail.com"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Phone / WhatsApp Number <span>*</span></label>
                                                    <input type="text" name="phone" placeholder="+880 1700-000000" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Transaction ID / Reference (Optional)</label>
                                                    <input type="text" name="transaction_id" placeholder="e.g. TR-9X8Y7Z">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Address / District</label>
                                                    <input type="text" name="address"
                                                        placeholder="e.g. Shanti Nagar, Dhaka">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Notes / Prayer Request (Optional)</label>
                                                    <textarea name="notes"
                                                        placeholder="Write any message or dedication for this cause..."
                                                        rows="2" class="form-control donor-notes-textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column mt-3">
                                                <div class="form-group message-btn">
                                                    <button type="submit" class="theme-btn btn-one submit-pledge-btn">Complete
                                                        Donation Pledge</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            {{-- Recent Donors List --}}
                            @if(isset($recentDonors) && $recentDonors->count() > 0)
                                <div class="content-four mt-5 pt-3">
                                    <div class="text mb-4">
                                        <h3 class="section-title-sub-2">Recent Verified Contributors</h3>
                                        <p class="text-muted">Honoring compassionate donors who supported this mission.</p>
                                    </div>
                                    <div class="row clearfix g-3">
                                        @foreach($recentDonors as $dn)
                                            <div class="col-md-4 col-sm-6 mb-3">
                                                <div class="p-3 border rounded bg-white shadow-sm d-flex align-items-center gap-3 donor-card-item">
                                                    @if($dn->donor?->avatar_url)
                                                        <img src="{{ $dn->donor->avatar_url }}"
                                                             class="rounded-circle object-fit-cover donor-avatar-circle"
                                                             alt="{{ $dn->donor->name }}">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 fw-bold text-dark donor-name-text">
                                                            {{ $dn->donor?->name }}</h6>
                                                        <span class="text-success fw-bold donor-amount-text">৳{{ number_format((float) $dn->amount) }}</span>
                                                        <div class="text-muted small donor-date-text">
                                                            {{ \Carbon\Carbon::parse($dn->donation_date)->format('d M, Y') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Sidebar Side -->
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="case-sidebar default-sidebar">

                            <!-- Other Causes Widget -->
                            @if(isset($recentProjects) && $recentProjects->count() > 0)
                                <div class="sidebar-widget category-widget">
                                    <div class="widget-title">
                                        <h3>Other Active Causes</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list clearfix">
                                            @foreach($recentProjects as $rp)
                                                <li>
                                                    <a href="{{ route('donation.details', $rp->slug) }}">
                                                        {{ Str::limit($rp->name, 22) }}
                                                        <span>৳{{ number_format($rp->estimated_cost > 0 ? $rp->estimated_cost : 100000) }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Initiative Types Widget -->
                            @if(isset($projectTypes) && $projectTypes->count() > 0)
                                <div class="sidebar-widget category-widget">
                                    <div class="widget-title">
                                        <h3>Initiative Types</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list clearfix">
                                            @foreach($projectTypes as $type)
                                                <li>
                                                    <a href="{{ route('donations', ['type' => $type->slug]) }}">
                                                        {{ $type->name }}
                                                        <span>{{ str_pad($type->projects_count, 2, '0', STR_PAD_LEFT) }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Quick Help / Office Card -->
                            <div class="sidebar-widget subscribe-widget centred">
                                <div class="widget-content">
                                    <div class="upper-content sidebar-help-upper"
                                        style="background-image: url({{ asset('assets/images/case/case-30.jpg') }});">
                                        <div class="icon-box"><i class="fas fa-phone"></i></div>
                                        <h3>Need Assistance?</h3>
                                        <p>For direct bank transfer confirmation or offline receipts, call our Dhaka desk.
                                        </p>
                                    </div>
                                    <div class="lower-content p-4 bg-white">
                                        <h4 class="fw-bold text-dark mb-1 sidebar-help-phone">+880 1700-000000</h4>
                                        <p class="small text-muted mb-3">House 14, Road 3, Shanti Nagar, Dhaka - 1217</p>
                                        <a href="{{ route('contact') }}" class="theme-btn btn-one w-100 sidebar-contact-btn">Contact Foundation</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- case-details end -->

@endsection