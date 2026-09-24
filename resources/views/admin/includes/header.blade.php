<header>
    <div id="top-navbar" class="container-fluid d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-2">
            <i class="ri-menu-2-line" id="btn" style="font-size: 22px; cursor: pointer; color: #1e293b; margin-right: 6px;"></i>

            {{-- 1. View Live Website Button (Icon Only) --}}
            <a href="{{ url('/') }}" target="_blank" 
               class="btn btn-sm text-decoration-none d-inline-flex align-items-center justify-content-center header-action-btn" 
               title="View Live Website"
               data-bs-toggle="tooltip" data-bs-placement="bottom"
               style="width: 34px; height: 34px; background-color: #f8fafc; border: 1px solid #e2e8f0; color: #334155; border-radius: 8px; transition: all 0.2s ease; padding: 0;">
                <i class="ri-global-line" style="font-size: 17px; color: #f95716;"></i>
            </a>

            {{-- 2. Header Quicklinks --}}
            <div class="d-none d-xl-flex align-items-center gap-1 ms-3 header-quicklinks">
                <a href="{{ route('admin.projects.index') }}" class="header-quicklink {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    Projects
                </a>
                <a href="{{ route('admin.donations.index') }}" class="header-quicklink {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
                    Donations
                </a>
                <a href="{{ route('admin.donors.index') }}" class="header-quicklink {{ request()->routeIs('admin.donors.*') ? 'active' : '' }}">
                    Donors
                </a>
                <a href="{{ route('admin.expenses.index') }}" class="header-quicklink {{ request()->routeIs('admin.expenses.*') ? 'active' : '' }}">
                    Expenses
                </a>
                <a href="{{ route('admin.reports.index') }}" class="header-quicklink {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    Reports
                </a>
                <a href="{{ route('admin.settings.index') }}" class="header-quicklink {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    Settings
                </a>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            {{-- 3. Add New + Dropdown Button --}}
            <div class="dropdown position-relative">
                <button type="button" class="btn btn-sm header-add-new-btn dropdown-toggle" 
                    id="headerAddNewDropdownBtn" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                    <span>Add New</span>
                    <i class="ri-add-line ms-1" style="font-size: 15px;"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end border-0 header-add-dropdown shadow-lg" id="headerAddNewDropdownMenu" aria-labelledby="headerAddNewDropdownBtn">
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.donations.create') }}">
                        <span class="add-plus-symbol">+</span>
                        <span>Record Donation</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.projects.create') }}">
                        <span class="add-plus-symbol">+</span>
                        <span>New Project</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.expenses.create') }}">
                        <span class="add-plus-symbol">+</span>
                        <span>Record Expense</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.donors.create') }}">
                        <span class="add-plus-symbol">+</span>
                        <span>Register Donor</span>
                    </a>
                </div>
            </div>

            <ul class="mb-0 d-flex align-items-center" style="list-style: none; padding-left: 0;">
                <!-- User Profile Dropdown -->
                <li class="dropdown position-relative">
                    <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" id="profileDropdownBtn" role="button" aria-expanded="false" style="cursor: pointer; padding: 4px 10px; border-radius: 8px; transition: all 0.2s ease; display: inline-flex; align-items: center; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center"> 
                            <div class="me-2">
                                @if(Auth::check() && !empty(Auth::user()->image) && file_exists(public_path(Auth::user()->image)))
                                    <img id="profileImageDB" src="{{ asset(Auth::user()->image) }}" alt="img" width="32" height="32" class="rounded-circle object-fit-cover" style="border: 2px solid #f95716;"> 
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 32px; height: 32px; background-color: #f95716; font-weight: 700; font-size: 13px; box-shadow: 0 2px 6px rgba(249, 87, 22, 0.3);">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                    </div>
                                @endif
                            </div> 
                            <div class="d-none d-sm-block text-start me-1"> 
                                <p class="fw-semibold mb-0 lh-1" style="font-size: 13px; color: #111a3a;">{{ Auth::user()->name ?? 'Admin User' }}</p>
                                <span class="op-7 fw-normal d-block" style="font-size: 11px; color: #718096; margin-top: 2px;">{{ Auth::user()->role ?? 'Site Administrator' }}</span>
                            </div>
                            <i class="ri-arrow-down-s-line text-muted ms-1" style="font-size: 14px;"></i>
                        </div>
                    </a>

                    <div class="main-header-dropdown dropdown-menu dropdown-menu-end border-0" style="min-width: 250px; border-radius: 12px; overflow: hidden; padding: 0; box-shadow: 0 10px 25px -3px rgba(15, 23, 42, 0.12), 0 4px 6px -2px rgba(15, 23, 42, 0.05), 0 0 0 1px #e2e8f0; margin-top: 6px !important;">
                        {{-- Centered User Profile Header Strip --}}
                        <div class="px-3 py-3 border-bottom text-center d-flex flex-column align-items-center" style="background-color: #f8fafc;">
                            <div class="mb-2">
                                @if(Auth::check() && !empty(Auth::user()->image) && file_exists(public_path(Auth::user()->image)))
                                    <img src="{{ asset(Auth::user()->image) }}" alt="img" width="48" height="48" class="rounded-circle object-fit-cover shadow-sm" style="border: 2px solid #f95716;"> 
                                @else
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 48px; height: 48px; background-color: #f95716; font-weight: 700; font-size: 18px;">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <span class="text-muted d-block text-truncate mb-2" style="font-size: 12px; font-weight: 500; max-width: 220px;">
                                {{ Auth::user()->email ?? '' }}
                            </span>

                            @php
                                $roleName = Auth::user()?->role ?? 'Administrator';
                                $roleBadgeStyle = match($roleName) {
                                    'superadmin' => 'background-color: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;',
                                    'admin' => 'background-color: #fff3ee; color: #f95716; border: 1px solid rgba(249, 87, 22, 0.3);',
                                    'accounts' => 'background-color: #e0f2fe; color: #075985; border: 1px solid #7dd3fc;',
                                    default => 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;',
                                };
                            @endphp
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <span class="badge" style="{{ $roleBadgeStyle }} font-size: 10.5px; padding: 3px 8px; border-radius: 4px; font-weight: 600;">
                                    {{ ucwords(str_replace('-', ' ', $roleName)) }}
                                </span>
                                <span class="text-muted" style="font-size: 11px;">
                                    <i class="ri-checkbox-circle-fill text-success me-1"></i>Online
                                </span>
                            </div>
                        </div>

                        {{-- Navigation Links: Profile & Settings and Logout --}}
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between py-2 px-2 rounded mb-1" href="{{ route('admin.settings.index') }}" style="font-size: 13px; font-weight: 500; color: #334155;">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center justify-content-center rounded me-2" style="width: 28px; height: 28px; background-color: #fff3ee; color: #f95716;">
                                        <i class="ri-user-settings-line" style="font-size: 15px;"></i>
                                    </div>
                                    <span>Profile &amp; Settings</span>
                                </div>
                                <i class="ri-arrow-right-s-line text-muted" style="font-size: 14px;"></i>
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center justify-content-between py-2 px-2 rounded text-danger w-100 border-0 bg-transparent" style="font-size: 13px; font-weight: 600; cursor: pointer;">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center rounded me-2" style="width: 28px; height: 28px; background-color: #fee2e2; color: #ef4444;">
                                            <i class="ri-logout-box-r-line" style="font-size: 15px;"></i>
                                        </div>
                                        <span>Logout</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>

<style>
.header-action-btn:hover {
    background-color: #f1f5f9 !important;
    border-color: #cbd5e1 !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.header-quicklink {
    font-size: 13.5px;
    font-weight: 600;
    color: #334155;
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    transition: all 0.2s ease;
}
.header-quicklink:hover {
    color: #0f172a;
    background-color: #f1f5f9;
}
.header-quicklink.active {
    color: #f95716;
    background-color: #fff3ee;
}

.header-add-new-btn {
    background-color: #e0f2fe;
    color: #0284c7;
    border: 1px solid #bae6fd;
    border-radius: 8px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.2s ease;
    height: 36px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.header-add-new-btn::after {
    display: none !important;
}
.header-add-new-btn:hover,
.header-add-new-btn:focus,
.header-add-new-btn[aria-expanded="true"] {
    background-color: #bae6fd;
    color: #0369a1;
    border-color: #7dd3fc;
}

.header-add-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 100%;
    z-index: 1050;
    min-width: 190px;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 6px 0;
    box-shadow: 0 10px 25px -3px rgba(15, 23, 42, 0.12), 0 4px 6px -2px rgba(15, 23, 42, 0.05), 0 0 0 1px #e2e8f0 !important;
    margin-top: 6px !important;
}
.header-add-dropdown.show {
    display: block !important;
}
.header-add-dropdown .dropdown-item {
    font-size: 13px;
    color: #475569;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    transition: all 0.15s ease;
    text-decoration: none;
}
.header-add-dropdown .dropdown-item:hover {
    background-color: #f8fafc;
    color: #0f172a;
}
.header-add-dropdown .add-plus-symbol {
    font-size: 14px;
    color: #94a3b8;
    margin-right: 8px;
    font-weight: 500;
}
</style>

<script>
$(document).ready(function() {
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>
