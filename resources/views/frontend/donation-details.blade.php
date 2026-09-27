@extends('frontend.layouts.app')

@section('title')
    {{ $project->name }} — Shanti Nagar Foundation
@endsection

@section('content')

    @php
        $target = $project->estimated_cost > 0 ? (float) $project->estimated_cost : 100000;
        $raised = $project->total_donations_raised > 0 ? (float) $project->total_donations_raised : ($project->total_expense > 0 ? (float) $project->total_expense : 45000);
        $percent = min(100, round(($raised / $target) * 100));
        $supportersCount = $project->donations->where('status', 'completed')->count();
        if ($supportersCount <= 0) {
            $supportersCount = max(5, (int) round($raised / 2500));
        }
    @endphp

    <!-- Page Title -->
    <section class="page-title"
        style="background-image: url({{ asset('assets/images/background/12.jpg') }}); padding: 120px 0 60px 0;">
        <div class="auto-container">
            <div class="content-box">
                <div class="title" style="margin-bottom: 20px;">
                    <h6
                        style="color: #ffffff; font-weight: 700; border-bottom: 2px solid #ffffff; display: inline-block; padding-bottom: 4px; margin-bottom: 12px; font-size: 14px; text-transform: uppercase;">
                        # {{ $project->category ?? 'Relief & Social Cause' }}
                    </h6>
                    <h1 style="font-size: 38px; line-height: 48px; color: #ffffff; font-weight: 700;">{{ $project->name }}
                    </h1>
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
            <div class="upper-box" style="margin-top: -35px; position: relative; z-index: 2;">
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
                                <div class="bar"><span style="position: absolute; left: 0; bottom: 0; width: 100%; height: {{ $percent }}%; background-color: #03c0a8;"></span></div>
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
                                <p title="{{ $project->location ?? 'Shanti Nagar, Dhaka' }}">{{ Str::limit($project->location ?? 'Shanti Nagar, Dhaka', 16) }}</p>
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
            <div class="lower-box" style="padding: 70px 0 100px 0;">
                <div class="row clearfix">

                    <!-- Main Content Side -->
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="case-details-content">

                            <div class="content-one">
                                <figure class="image-box"
                                    style="margin-bottom: 30px; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.06);">
                                    <img src="{{ asset($project->featured_image ?: 'assets/images/case/case-21.jpg') }}"
                                        alt="{{ $project->name }}"
                                        style="width: 100%; max-height: 460px; object-fit: cover;">
                                </figure>
                                <div class="text">
                                    <h3 style="font-size: 28px; font-weight: 700; margin-bottom: 15px; color: #1e1e1e;">
                                        {{ $project->name }}</h3>
                                    @if($project->short_description)
                                        <p class="lead"
                                            style="font-size: 16px; font-weight: 600; color: #444; line-height: 1.8; margin-bottom: 15px;">
                                            {{ $project->short_description }}</p>
                                    @endif
                                    <div style="font-size: 15px; line-height: 1.9; color: #555;">
                                        {!! nl2br(e($project->description ?: 'Shanti Nagar Foundation is dedicated to delivering transparent humanitarian relief, healthcare support, and social empowerment across Bangladesh. Every contribution directly funds verified on-the-ground initiatives without intermediaries.')) !!}
                                    </div>
                                </div>
                            </div>

                            {{-- Project Gallery Photos --}}
                            @if($project->images && $project->images->count() > 0)
                                <div class="content-two mt-4 pt-3">
                                    <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 20px;">Field Documentation &
                                        Photos</h3>
                                    <div class="row clearfix g-3">
                                        @foreach($project->images as $img)
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="image-box"
                                                    style="border-radius: 10px; overflow: hidden; height: 210px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                                                    <img src="{{ asset($img->image_path) }}"
                                                        alt="{{ $img->caption ?: $project->name }}"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
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
                                    <h3 style="font-size: 24px; font-weight: 700; color: #1e1e1e;">Make Your Contribution
                                    </h3>
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
                                                <div class="amount-box" style="max-width: 200px;">
                                                    <input type="number" id="custom_amt_input" name="amount" value="1000"
                                                        min="10" step="1" required class="form-control"
                                                        style="height: 48px; font-weight: 700; font-size: 17px; border: 1px solid #d1d5db; border-radius: 8px; padding-left: 15px;">
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
                                                        rows="2" class="form-control"
                                                        style="border: 1px solid #e0e0e0; border-radius: 6px; padding: 12px;"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column mt-3">
                                                <div class="form-group message-btn">
                                                    <button type="submit" class="theme-btn btn-one"
                                                        style="padding: 14px 35px; font-weight: 700; border-radius: 8px;">Complete
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
                                        <h3 style="font-size: 22px; font-weight: 700;">Recent Verified Contributors</h3>
                                        <p class="text-muted">Honoring compassionate donors who supported this mission.</p>
                                    </div>
                                    <div class="row clearfix g-3">
                                        @foreach($recentDonors as $dn)
                                            <div class="col-md-4 col-sm-6 mb-3">
                                                <div class="p-3 border rounded bg-white shadow-sm d-flex align-items-center gap-3"
                                                    style="border-radius: 10px;">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                                        style="width: 44px; height: 44px; background: #f65024; font-size: 16px; flex-shrink: 0;">
                                                        {{ strtoupper(substr($dn->donor?->name ?? 'A', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold text-dark" style="font-size: 14px;">
                                                            {{ $dn->donor?->name ?? 'Anonymous Donor' }}</h6>
                                                        <span class="text-success fw-bold"
                                                            style="font-size: 13px;">৳{{ number_format((float) $dn->amount) }}</span>
                                                        <div class="text-muted small" style="font-size: 11px;">
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

                            <!-- Relief Categories Widget -->
                            @if(isset($categories) && $categories->count() > 0)
                                <div class="sidebar-widget category-widget">
                                    <div class="widget-title">
                                        <h3>Relief Categories</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list clearfix">
                                            @foreach($categories as $cat)
                                                <li>
                                                    <a href="{{ route('donations') }}">
                                                        {{ $cat->category ?: 'Social Welfare' }}
                                                        <span>{{ str_pad($cat->count, 2, '0', STR_PAD_LEFT) }}</span>
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
                                    <div class="upper-content"
                                        style="background-image: url({{ asset('assets/images/case/case-30.jpg') }}); padding: 35px 20px;">
                                        <div class="icon-box"><i class="fas fa-phone-alt"></i></div>
                                        <h3>Need Assistance?</h3>
                                        <p>For direct bank transfer confirmation or offline receipts, call our Dhaka desk.
                                        </p>
                                    </div>
                                    <div class="lower-content p-4 bg-white">
                                        <h4 class="fw-bold text-dark mb-1" style="color: #f65024 !important;">+880
                                            1700-000000</h4>
                                        <p class="small text-muted mb-3">House 14, Road 3, Shanti Nagar, Dhaka - 1217</p>
                                        <a href="{{ route('contact') }}" class="theme-btn btn-one w-100"
                                            style="padding: 10px 20px; font-size: 13px;">Contact Foundation</a>
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