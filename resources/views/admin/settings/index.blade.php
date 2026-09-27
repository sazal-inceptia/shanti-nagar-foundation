@extends('admin.app')
@section('title')
    Foundation &amp; System Settings
@endsection

@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12">
                <div class="card table-card">
                    <div class="card-header table-header">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">System &amp; Organization Settings</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="card-body" style="padding: 24px;">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                style="font-size: 13.5px;">
                                <i class="ri-checkbox-circle-line me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.settings.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                {{-- 1. General Organization Information --}}
                                <div class="col-lg-6 col-12">
                                    <div class="card border h-100" style="border-radius: 12px;">
                                        <div class="card-header border-bottom py-3" style="background-color: transparent;">
                                            <h6 class="fw-bold text-dark mb-0" style="font-size: 15px;">
                                                <i class="ri-building-line text-primary me-1"></i> Organization Profile
                                            </h6>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="mb-3">
                                                <label class="form-label text-dark fw-semibold"
                                                    style="font-size: 13px;">Foundation Name</label>
                                                <input type="text" name="org_name" class="form-control form-control-sm"
                                                    value="{{ $settings['org_name'] }}" required
                                                    style="font-size: 13px; height: 38px;">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label text-dark fw-semibold"
                                                    style="font-size: 13px;">Mission / Tagline</label>
                                                <textarea name="tagline" class="form-control form-control-sm" rows="2"
                                                    style="font-size: 13px;">{{ $settings['tagline'] }}</textarea>
                                            </div>

                                            <div class="row g-2 mb-3">
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Hotline Number</label>
                                                    <input type="text" name="hotline" class="form-control form-control-sm"
                                                        value="{{ $settings['hotline'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Official Email</label>
                                                    <input type="email" name="email" class="form-control form-control-sm"
                                                        value="{{ $settings['email'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label text-dark fw-semibold"
                                                    style="font-size: 13px;">Headquarter Address</label>
                                                <input type="text" name="address" class="form-control form-control-sm"
                                                    value="{{ $settings['address'] }}"
                                                    style="font-size: 13px; height: 38px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 2. Official Payment Accounts & Currency --}}
                                <div class="col-lg-6 col-12">
                                    <div class="card border h-100" style="border-radius: 12px;">
                                        <div class="card-header border-bottom py-3" style="background-color: transparent;">
                                            <h6 class="fw-bold text-dark mb-0" style="font-size: 15px;">
                                                <i class="ri-bank-card-line text-success me-1"></i> Donation Gateways &amp;
                                                Currency
                                            </h6>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row g-2 mb-3">
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">bKash Merchant Account</label>
                                                    <input type="text" name="bkash_number"
                                                        class="form-control form-control-sm"
                                                        value="{{ $settings['bkash_number'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Nagad Merchant Account</label>
                                                    <input type="text" name="nagad_number"
                                                        class="form-control form-control-sm"
                                                        value="{{ $settings['nagad_number'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label text-dark fw-semibold"
                                                    style="font-size: 13px;">Bank Name</label>
                                                <input type="text" name="bank_name" class="form-control form-control-sm"
                                                    value="{{ $settings['bank_name'] }}"
                                                    style="font-size: 13px; height: 38px;">
                                            </div>

                                            <div class="row g-2 mb-3">
                                                <div class="col-md-7 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Bank Account Title</label>
                                                    <input type="text" name="bank_account_name"
                                                        class="form-control form-control-sm"
                                                        value="{{ $settings['bank_account_name'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                                <div class="col-md-5 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Account Number</label>
                                                    <input type="text" name="bank_account_number"
                                                        class="form-control form-control-sm"
                                                        value="{{ $settings['bank_account_number'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                            </div>

                                            <div class="row g-2 mb-0">
                                                <div class="col-md-7 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Bank Branch</label>
                                                    <input type="text" name="bank_branch"
                                                        class="form-control form-control-sm"
                                                        value="{{ $settings['bank_branch'] }}"
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                                <div class="col-md-5 col-12">
                                                    <label class="form-label text-dark fw-semibold"
                                                        style="font-size: 13px;">Base Currency</label>
                                                    <input type="text" name="currency"
                                                        class="form-control form-control-sm bg-light"
                                                        value="{{ $settings['currency'] }}" readonly
                                                        style="font-size: 13px; height: 38px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4"
                                    style="height: 40px; font-size: 14px; border-radius: 6px; font-weight: 600;">
                                    <i class="ri-save-line me-1"></i> Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection