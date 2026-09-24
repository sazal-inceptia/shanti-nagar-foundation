<div class="sidebar sidebar-navigation active">
    <div class="logo_content">
        <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
            <div class="logo-icon d-flex align-items-center justify-content-center"
                style="width: 38px; height: 38px; background-color: #ffffff; border-radius: 8px; flex-shrink: 0; padding: 3px; box-shadow: 0 2px 6px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <div class="logo_name">
                <div class="d-flex align-items-center">
                    <div class="d-flex flex-column text-start" style="line-height: 1.15; margin-left: 10px;">
                        <span
                            style="font-size: 14px; font-weight: 800; color: #111A3A; letter-spacing: -0.01em; white-space: nowrap;">SHANTI
                            NAGAR</span>
                        <span
                            style="font-size: 9.5px; font-weight: 700; color: #f65024; text-transform: uppercase; letter-spacing: 0.1em; white-space: nowrap;">Foundation</span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <ul class="nav_list ps-0 scrollbar">
        <!-- 1. Overview -->
        <li class="category-li">
            <span class="link_names">Overview</span>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? ' active-focus' : '' }}">
                <i class="ri-dashboard-3-line"></i>
                <span class="link_names">Dashboard</span>
            </a>
        </li>

        <!-- 2. Beneficiaries & Campaigns -->
        <li class="category-li">
            <span class="link_names">Operations</span>
        </li>
        <li>
            <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active-focus' : '' }}">
                <i class="ri-heart-pulse-line"></i>
                <span class="link_names">Projects & Relief</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.donors.index') }}" class="{{ request()->routeIs('admin.donors.*') ? 'active-focus' : '' }}">
                <i class="ri-user-heart-line"></i>
                <span class="link_names">Donors Directory</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.donations.index') }}" class="{{ request()->routeIs('admin.donations.*') ? 'active-focus' : '' }}">
                <i class="ri-hand-coin-line"></i>
                <span class="link_names">Donations & Funds</span>
            </a>
        </li>

        <!-- 3. Accounts & HR -->
        <li class="category-li">
            <span class="link_names">Finance & HR</span>
        </li>
        <li>
            <a href="{{ route('admin.expenses.index') }}" class="{{ request()->routeIs('admin.expenses.*') ? 'active-focus' : '' }}">
                <i class="ri-money-dollar-circle-line"></i>
                <span class="link_names">Expenses & Vouchers</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.employees.index') }}" class="{{ request()->routeIs('admin.employees.*') ? 'active-focus' : '' }}">
                <i class="ri-team-line"></i>
                <span class="link_names">Staff & Employees</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.salaries.index') }}" class="{{ request()->routeIs('admin.salaries.*') ? 'active-focus' : '' }}">
                <i class="ri-wallet-3-line"></i>
                <span class="link_names">Salary & Payroll</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active-focus' : '' }}">
                <i class="ri-file-chart-line"></i>
                <span class="link_names">Financial Reports</span>
            </a>
        </li>

        <!-- 4. System & Settings -->
        <li class="category-li">
            <span class="link_names">System</span>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active-focus' : '' }}">
                <i class="ri-admin-line"></i>
                <span class="link_names">Admin Users</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active-focus' : '' }}">
                <i class="ri-settings-4-line"></i>
                <span class="link_names">Settings</span>
            </a>
        </li>
    </ul>

    <div class="profile_content">
        <div class="profile">
            <div class="profile_details">
                <div class="profile-avatar d-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; border-radius: 8px; background: #fff3ee; color: #f65024; font-weight: 700; font-size: 13px;">
                    {{ strtoupper(substr(Auth::user()?->name ?? 'A', 0, 2)) }}
                </div>
                <div class="name_job ms-2">
                    <div class="name text-truncate" style="max-width: 110px; font-size: 13px; font-weight: 700;">
                        {{ Auth::user()?->name ?? 'Administrator' }}
                    </div>
                    <div class="job text-truncate" style="max-width: 110px; font-size: 11px; color: #64748b;">
                        {{ Auth::user()?->email ?? 'admin@gmail.com' }}
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="sidebarLogoutForm" class="d-inline">
                @csrf
                <button type="submit" class="border-0 bg-transparent p-0" title="Sign Out" style="cursor: pointer;">
                    <i class="ri-logout-box-r-line" id="log_out" style="color: #64748b; font-size: 20px;"></i>
                </button>
            </form>
        </div>
    </div>
</div>