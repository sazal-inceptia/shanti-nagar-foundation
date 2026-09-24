@extends('admin.app')

@php
    $currentGroupMeta = $groupMeta[$activeGroup] ?? [
        'title' => ucwords(str_replace(['_', '-'], ' ', $activeGroup)),
        'icon' => 'ri-settings-4-line text-primary'
    ];
    $isSuperadmin = Auth::check() && (Auth::user()->hasRole('superadmin') || Auth::user()->can('website-setting-create'));
@endphp

@section('title')
    {{ $currentGroupMeta['title'] }} - Website Settings
@endsection

@push('custom-style')
    <style>

        .settings-section-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #ffffff;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }

        .settings-section-header {
            padding: 14px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-section-body {
            padding: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid my-3">
        <div class="row g-3">
            <div class="col-12">
                <div class="card table-card mb-4">
                    <div class="card-header table-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="title-with-breadcrumb">
                            <div class="table-title">{{ $currentGroupMeta['title'] }}</div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item">Website Settings</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $currentGroupMeta['title'] }}</li>
                                </ol>
                            </nav>
                        </div>
                        
                    </div>

                    <div class="card-body custom-form">
                        <form id="websiteSettingsForm" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="active_group" value="{{ $activeGroup }}">

                            @php
                                $settingsInActiveGroup = $groupedSettings[$activeGroup] ?? [];
                            @endphp

                            <div class="settings-section-card" id="section-{{ $activeGroup }}">
                                <div class="settings-section-header justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="{{ $currentGroupMeta['icon'] ?? 'ri-settings-4-line text-primary' }}" style="font-size: 18px;"></i>
                                        <span>{{ $currentGroupMeta['title'] }}</span>
                                    </div>
                                    <span class="badge bg-light text-dark border" style="font-size: 11px;">
                                        {{ count($settingsInActiveGroup) }} Fields
                                    </span>
                                </div>
                                <div class="settings-section-body">
                                    <div class="row g-3">
                                        @forelse($settingsInActiveGroup as $setting)
                                            @php
                                                $val = old($setting->key, $setting->value ?? '');
                                                $isRequired = $setting->key === 'company_name';
                                                $colClass = $setting->col_class;
                                            @endphp

                                            <div class="{{ $colClass }}">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <label for="{{ $setting->key }}" class="form-label custom-label mb-0">
                                                        {{ $setting->label }}
                                                        @if($isRequired)
                                                            <span class="text-danger">*</span>
                                                        @endif
                                                    </label>
                                                </div>

                                                {{-- 1. Image Type Field --}}
                                                @if($setting->type === 'image')
                                                    @include('admin.includes.image-uploader', [
                                                        'name'         => $setting->key,
                                                        'id'           => $setting->key,
                                                        'modalTitle'   => 'Upload ' . $setting->label,
                                                        'currentImage' => !empty($setting->value) ? asset($setting->value) : null,
                                                        'currentName'  => $setting->label,
                                                        'accept'       => 'image/png,image/jpeg,image/webp,image/svg+xml,image/x-icon',
                                                        'shape'        => 'rectangle',
                                                        'height'       => '80px',
                                                    ])

                                                {{-- 2. Textarea Type Field --}}
                                                @elseif($setting->type === 'textarea')
                                                    <textarea class="form-control custom-input @error($setting->key) is-invalid @enderror"
                                                        id="{{ $setting->key }}" name="{{ $setting->key }}" rows="2" placeholder="{{ $setting->placeholder }}">{{ $val }}</textarea>

                                                {{-- 3. Email Type Field --}}
                                                @elseif($setting->type === 'email')
                                                    <input type="email" class="form-control custom-input @error($setting->key) is-invalid @enderror"
                                                        id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $val }}" placeholder="{{ $setting->placeholder }}" {{ $isRequired ? 'required' : '' }}>

                                                {{-- 4. URL Type Field --}}
                                                @elseif($setting->type === 'url')
                                                    <input type="url" class="form-control custom-input @error($setting->key) is-invalid @enderror"
                                                        id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $val }}" placeholder="{{ $setting->placeholder }}" {{ $isRequired ? 'required' : '' }}>

                                                {{-- 5. Number Type Field --}}
                                                @elseif($setting->type === 'number')
                                                    <input type="number" step="any" class="form-control custom-input @error($setting->key) is-invalid @enderror"
                                                        id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $val }}" placeholder="{{ $setting->placeholder }}" {{ $isRequired ? 'required' : '' }}>

                                                {{-- 6. Text / Phone / Default Field --}}
                                                @else
                                                    <input type="text" class="form-control custom-input @error($setting->key) is-invalid @enderror"
                                                        id="{{ $setting->key }}" name="{{ $setting->key }}" value="{{ $val }}" placeholder="{{ $setting->placeholder }}" {{ $isRequired ? 'required' : '' }}>
                                                @endif

                                                @error($setting->key)
                                                    <div class="error_msg">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="alert alert-light border text-center py-4 text-muted mb-0">
                                                    No settings defined for this group.
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="row mt-4 pt-3 border-top">
                                <div class="col-12 d-flex align-items-center">
                                    <button type="submit" class="btn submit-button me-2" id="btn_save_settings">
                                        <i class="ri-check-line me-1"></i> Save {{ $currentGroupMeta['title'] }}
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn leave-button">
                                        <i class="ri-arrow-left-line me-1"></i> Dashboard
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
