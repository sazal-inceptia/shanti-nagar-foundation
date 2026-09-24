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
                <i class="ri-global-line" style="font-size: 17px; color: #f65024;"></i>
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
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            {{-- 3. Add New + Dropdown Button --}}
            <div class="dropdown position-relative">
                <button type="button" class="btn btn-sm header-add-new-btn dropdown-toggle" 
                    id="headerAddNewDropdownBtn" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                    style="background-color: #f65024; color: #fff; border-radius: 6px; font-weight: 600; padding: 6px 14px; font-size: 13px;">
                    <span>Add New</span>
                    <i class="ri-add-line ms-1" style="font-size: 15px;"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-end border-0 header-add-dropdown shadow-lg" id="headerAddNewDropdownMenu" aria-labelledby="headerAddNewDropdownBtn" style="border-radius: 8px;">
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.donations.create') }}">
                        <span class="add-plus-symbol me-2 text-primary font-monospace font-bold">+</span>
                        <span>Record Donation</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.projects.create') }}">
                        <span class="add-plus-symbol me-2 text-primary font-monospace font-bold">+</span>
                        <span>New Project</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.expenses.create') }}">
                        <span class="add-plus-symbol me-2 text-primary font-monospace font-bold">+</span>
                        <span>Record Expense</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.donors.create') }}">
                        <span class="add-plus-symbol me-2 text-primary font-monospace font-bold">+</span>
                        <span>Register Donor</span>
                    </a>
                </div>
            </div>

            {{-- 4. User Profile Dropdown --}}
            <div class="dropdown user-profile-dropdown position-relative">
                <button type="button" class="btn border-0 p-0 d-flex align-items-center gap-2" id="profileDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-avatar-circle d-flex align-items-center justify-content-center"
                        style="width: 36px; height: 36px; border-radius: 50%; background-color: #fff3ee; color: #f65024; font-weight: 700; font-size: 13px; border: 2px solid #fed7aa;">
                        {{ strtoupper(substr(Auth::user()?->name ?? 'A', 0, 2)) }}
                    </div>
                    <div class="d-none d-md-flex flex-column text-start" style="line-height: 1.2;">
                        <span style="font-size: 13px; font-weight: 700; color: #0f172a;">{{ Auth::user()?->name ?? 'Administrator' }}</span>
                        <span style="font-size: 11px; color: #64748b;">{{ Auth::user()?->role ?? 'Management' }}</span>
                    </div>
                    <i class="ri-arrow-down-s-line text-muted" style="font-size: 16px;"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end main-header-dropdown shadow-lg border-0 mt-2" aria-labelledby="profileDropdownBtn" style="min-width: 200px; border-radius: 8px;">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold text-dark" style="font-size: 13px;">{{ Auth::user()?->name ?? 'Admin User' }}</div>
                        <div class="text-muted text-truncate" style="font-size: 11.5px;">{{ Auth::user()?->email ?? 'admin@gmail.com' }}</div>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                            <i class="ri-dashboard-line text-muted"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.settings.index') }}">
                            <i class="ri-settings-3-line text-muted"></i> NGO Settings
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger d-flex align-items-center gap-2">
                                <i class="ri-logout-box-line"></i> Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
