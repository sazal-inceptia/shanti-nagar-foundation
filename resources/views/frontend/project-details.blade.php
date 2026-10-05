@extends('frontend.layouts.app')

@section('title', $project->localized_name . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))
@section('meta_description', Str::limit($project->localized_short_description ?: $project->localized_description, 160))
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
                                {{ $project->projectType->localized_name }}
                            </span>
                        @endif
                    </div>
                    <h1>{{ $project->localized_name }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('projects') }}">{{ __('Projects') }}</a></li>
                    <li>{{ Str::limit($project->localized_name, 35) }}</li>
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
                                <h5>{{ __('Fund Raised') }}</h5>
                                <div class="price">৳{{ localized_number($raised) }} <span>/ ৳{{ localized_number($target) }}</span></div>
                            </div>
                            <div class="percentage-box">
                                <div class="bar"><span class="fill-bar" style="height: {{ $percent }}%;"></span></div>
                                <h5>{{ localized_number($percent) }}%</h5>
                            </div>
                            <div class="btn-box">
                                <button type="button" class="donate-box-btn" onclick="if(document.querySelector('#donate-popup select[name=\'project_id\']')){ document.querySelector('#donate-popup select[name=\'project_id\']').value = '{{ $project->id }}'; if(window.jQuery && $.fn.niceSelect){ $('#donate-popup select[name=\'project_id\']').niceSelect('update'); } }">{{ __('Donate Now') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 right-column">
                        <ul class="info-box clearfix">
                            <li>
                                <i class="far fa-map-marker-alt"></i>
                                <h5>{{ __('Location') }}</h5>
                                <p title="{{ $project->localized_location }}">{{ Str::limit($project->localized_location ?: __('Dhaka, Bangladesh'), 16) }}</p>
                            </li>
                            <li>
                                <i class="fas fa-users"></i>
                                <h5>{{ localized_number($supportersCount) }}+</h5>
                                <p>{{ __('Supporters') }}</p>
                            </li>
                            <li>
                                <i class="fas fa-tasks"></i>
                                <h5>{{ __('Project Status') }}</h5>
                                <p>{{ __($project->status == 'completed' ? 'Completed' : ($project->status == 'in_progress' ? 'In Progress' : 'Planned')) }}</p>
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
                                        alt="{{ $project->localized_name }}">
                                </figure>
                                <div class="text">
                                    <h3 class="project-heading">{{ $project->localized_name }}</h3>
                                    @if($project->localized_short_description)
                                        <p class="lead project-lead">{{ $project->localized_short_description }}</p>
                                    @endif
                                    <div class="project-desc ck-content">
                                        @if($project->localized_description)
                                            {!! $project->localized_description !!}
                                        @else
                                            <p>{{ __('Rotary Club of Shantinagar Dhaka is dedicated to delivering transparent humanitarian relief, healthcare support, and social empowerment across Bangladesh. Every contribution directly funds verified on-the-ground initiatives without intermediaries.') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Project Gallery Photos --}}
                            @if($project->images && $project->images->count() > 0)
                                <div class="content-two mt-4 pt-3">
                                    <h3 class="section-title-sub-2">{{ __('Field Documentation') }}</h3>
                                    <div class="row clearfix g-3">
                                        @foreach($project->images as $img)
                                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                                <div class="image-box gallery-card-box">
                                                    <img src="{{ asset($img->image_path) }}"
                                                        alt="{{ $img->localized_caption ?: $project->localized_name }}">
                                                </div>
                                                @if($img->localized_caption)
                                                    <p class="small text-muted mt-1"><i class="fas fa-camera me-1 text-primary"></i>
                                                        {{ $img->localized_caption }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Make Donation Form Section --}}
                            <div class="donate-content mt-5 pt-3" id="make-donation-section">
                                <div class="title mb-4">
                                    <h3 class="section-title-sub">{{ __('Make Your Donation') }}</h3>
                                    <p class="text-muted">{{ __('Support Our Humanity Causes') }}: <strong>{{ $project->localized_name }}</strong>. {{ __('Every single Taka you contribute reaches genuine underprivileged families across Bangladesh.') }}</p>
                                </div>

                                <form action="{{ route('donate.submit') }}" method="post" class="default-form">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">

                                    <div class="donate-box">
                                        <div class="donate-option">
                                            <h3>{{ __('Select Contribution (BDT)') }}</h3>
                                            <ul class="donate-list clearfix">
                                                <li>
                                                    <input type="radio" id="damt-500" name="preset_amount" value="500">
                                                    <label for="damt-500" onclick="setDetailsAmount(500);">৳ {{ localized_number(500) }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-1000" name="preset_amount" value="1000" checked="checked">
                                                    <label for="damt-1000" onclick="setDetailsAmount(1000);">৳ {{ localized_number(1000) }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-2500" name="preset_amount" value="2500">
                                                    <label for="damt-2500" onclick="setDetailsAmount(2500);">৳ {{ localized_number(2500) }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-5000" name="preset_amount" value="5000">
                                                    <label for="damt-5000" onclick="setDetailsAmount(5000);">৳ {{ localized_number(5000) }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-10000" name="preset_amount" value="10000">
                                                    <label for="damt-10000" onclick="setDetailsAmount(10000);">৳ {{ localized_number(10000) }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="damt-25000" name="preset_amount" value="25000">
                                                    <label for="damt-25000" onclick="setDetailsAmount(25000);">৳ {{ localized_number(25000) }}</label>
                                                </li>
                                            </ul>
                                            <div class="other-amount mt-3">
                                                <div class="text">
                                                    <h4>{{ __('Enter Custom Amount (৳)') }}</h4>
                                                    <p>{{ __('Enter any specific amount in BDT') }}</p>
                                                </div>
                                                <div class="amount-box custom-amount-input-box">
                                                    <input type="number" id="custom_amt_input" name="amount" value="1000"
                                                        min="10" step="1" required class="custom-donate-input">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="payment-option mt-4">
                                            <h3>{{ __('Choose Payment Channel') }}</h3>
                                            <ul class="payment-list clearfix">
                                                <li>
                                                    <input type="radio" id="pm_b" name="payment_method" value="bkash"
                                                        checked="checked">
                                                    <label for="pm_b">{{ __('bKash') }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="pm_n" name="payment_method" value="nagad">
                                                    <label for="pm_n">{{ __('Nagad') }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="pm_bank" name="payment_method"
                                                        value="bank_transfer">
                                                    <label for="pm_bank">{{ __('Bank Transfer') }}</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="pm_c" name="payment_method" value="cash">
                                                    <label for="pm_c">{{ __('Cash / Direct') }}</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="form-inner">
                                        <h3>{{ __('Donor Information') }}</h3>
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>{{ __('Your Name') }} <span>*</span></label>
                                                    <input type="text" name="name" placeholder="{{ __('Enter your full name') }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>{{ __('Email Address') }} <span>*</span></label>
                                                    <input type="email" name="email" placeholder="example@gmail.com"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>{{ __('Phone Number') }} <span>*</span></label>
                                                    <input type="text" name="phone" placeholder="+880 1700-000000" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>{{ __('Transaction ID / Reference') }}</label>
                                                    <input type="text" name="transaction_id" placeholder="e.g. TR-9X8Y7Z">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>{{ __('Head Office') }} / {{ __('Location') }}</label>
                                                    <input type="text" name="address"
                                                        placeholder="{{ __('Shanti Nagar, Dhaka') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>{{ __('Additional Notes / Dedication') }}</label>
                                                    <textarea name="notes"
                                                        placeholder="{{ __('Write any message or dedication for this cause...') }}"
                                                        rows="2" class="form-control donor-notes-textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 column mt-3">
                                                <div class="form-group message-btn">
                                                    <button type="submit" class="theme-btn btn-one submit-pledge-btn">{{ __('Complete Donation') }}</button>
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
                                        <h3 class="section-title-sub-2">{{ __('Supporters') }}</h3>
                                        <p class="text-muted">{{ __('Honoring compassionate donors who supported this mission.') }}</p>
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
                                                            {{ $dn->donor?->is_anonymous ? __('Well-wisher (Anonymous)') : ($dn->donor?->name ?? __('Donors')) }}</h6>
                                                        <span class="text-success fw-bold donor-amount-text">৳{{ localized_number((float) $dn->amount) }}</span>
                                                        <div class="text-muted small donor-date-text">
                                                            {{ is_bengali() ? \Carbon\Carbon::parse($dn->donation_date)->translatedFormat('d M, Y') : \Carbon\Carbon::parse($dn->donation_date)->format('d M, Y') }}</div>
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
                                        <h3>{{ __('Active Relief Causes') }}</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list clearfix">
                                            @foreach($recentProjects as $rp)
                                                <li>
                                                    <a href="{{ route('project.details', $rp->slug) }}">
                                                        {{ Str::limit($rp->localized_name, 22) }}
                                                        <span>৳{{ localized_number($rp->estimated_cost > 0 ? $rp->estimated_cost : 100000) }}</span>
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
                                        <h3>{{ __('Relief Programs') }}</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list clearfix">
                                            @foreach($projectTypes as $type)
                                                <li>
                                                    <a href="{{ route('projects', ['type' => $type->slug]) }}">
                                                        {{ $type->localized_name }}
                                                        <span>{{ localized_number($type->projects_count) }}</span>
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
                                        <h3>{{ __('Need Assistance?') }}</h3>
                                        <p>{{ __('Have questions about donations, relief projects, or volunteering? Leave your details below and our team will contact you.') }}
                                        </p>
                                    </div>
                                    <div class="lower-content p-4 bg-white">
                                        <h4 class="fw-bold text-dark mb-1 sidebar-help-phone">{{ site_setting('hotline', '+880 1711-000000') }}</h4>
                                        <p class="small text-muted mb-3">{{ site_setting('address', 'Shanti Nagar, Dhaka - 1217, Bangladesh') }}</p>
                                        <a href="{{ route('contact') }}" class="theme-btn btn-one w-100 sidebar-contact-btn">{{ __('Contact Us') }}</a>
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

@push('custom-script')
<script>
    function setDetailsAmount(val) {
        var input = document.getElementById('custom_amt_input');
        if (input) {
            input.value = val;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var customInput = document.getElementById('custom_amt_input');
        if (customInput) {
            customInput.addEventListener('input', function () {
                var currentVal = this.value;
                var radios = document.querySelectorAll('input[name="preset_amount"]');
                radios.forEach(function (radio) {
                    if (radio.value === currentVal) {
                        radio.checked = true;
                    } else {
                        radio.checked = false;
                    }
                });
            });
        }
    });
</script>
@endpush
