# Shanti Nagar Foundation — Project Tasks & Progress Tracker

> **Status Legend:**
> - [x] **Completed** (Done & Verified)
> - [/] **In Progress** (Currently working)
> - [ ] **To Do** (Planned / Upcoming)

---

## 🎯 Task Roadmap & Progress

### Phase 1: Foundation, Relational Database & Seeders (Completed)
- [x] **Client Requirements Analysis & Documentation**
  - [x] Document client specification in [`docs/project_overview.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/project_overview.md)
  - [x] Create complete ERD & schema in [`docs/database_design.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/database_design.md)
  - [x] Document MVC architecture & system flow in [`docs/architecture.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/architecture.md)
  - [x] Create project context & roadmap in [`docs/project_context.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/docs/project_context.md)
  - [x] Set up permanent developer guidelines in [`AGENTS.md`](file:///Users/zesan/Desktop/My-Work/shanti-nagar-foundation/AGENTS.md)
- [x] **Database Migrations**
  - [x] Create `donors` table migration
  - [x] Create `projects` table migration
  - [x] Create `project_images` table migration
  - [x] Create `donations` table migration
  - [x] Create `expenses` table migration
  - [x] Create `employees` table migration
  - [x] Create `salaries` table migration
- [x] **Eloquent Models & Relationships**
  - [x] Build `User` model with expense relations
  - [x] Build `Donor` model with `hasMany(Donation)`
  - [x] Build `Project` model with `hasMany(Donation)`, `hasMany(Expense)`, `hasMany(ProjectImage)`
  - [x] Build `ProjectImage` model with `belongsTo(Project)`
  - [x] Build `Donation` model with `belongsTo(Donor)`, `belongsTo(Project)`
  - [x] Build `Expense` model with `belongsTo(Project)`, `belongsTo(User, 'created_by')`
  - [x] Build `Employee` model with `hasMany(Salary)`
  - [x] Build `Salary` model with `belongsTo(Employee)`
- [x] **Database Seeders (Idempotent)**
  - [x] `UserSeeder`: Admin & Staff login credentials
  - [x] `DonorSeeder`: Individual & institutional donors
  - [x] `ProjectSeeder`: 12 real Bangladeshi projects with image galleries
  - [x] `DonationSeeder`: Realistic donation records & receipt vouchers
  - [x] `ExpenseSeeder`: Project procurement & utility expenditures
  - [x] `EmployeeSeeder`: Staff profiles, NID, designations & base salaries
  - [x] `SalarySeeder`: Monthly salary disbursement logs
  - [x] `DatabaseSeeder`: Master orchestrator

---

### Phase 2: Public Frontend Pages & UI Localization (Completed)
- [x] **Header & Navigation**
  - [x] Dynamic active link state (`request()->is()`)
  - [x] Update menu names: Home, About Us, Projects & Causes, Activities, Gallery, Blog, Contact
  - [x] Bangladeshi contact info & helpline (`+880 1700-000000`, Shanti Nagar, Dhaka)
- [x] **Page Refinements**
  - [x] Remove unrelated "Charity Shops" from `contact.blade.php` and embed responsive Google Maps
  - [x] Remove foreign marathon/skydive placeholders and convert `events.blade.php` to "Social Activities"
  - [x] Remove placeholder trophy badges from `about.blade.php`
  - [x] Add animated Transparency & Fund Summary counter section to `about.blade.php`
  - [x] Connect `gallery.blade.php` directly to `ProjectImage` with isotope filtering
  - [x] Make `donations.blade.php` render dynamic projects with budget progress bars
  - [x] Fix and style "Donate Now" button & Popup modal trigger

---

### Phase 3: Dynamic Features & Interaction (Next Up)
- [ ] **Frontend Interactive Forms**
  - [ ] Connect Contact Form (`contact.blade.php`) to database with validation & flash messages
  - [ ] Connect Volunteer Application Form (`volunteer.blade.php`)
  - [ ] Connect Donate Popup Modal Form to store pending donation records
- [ ] **SEO & Metadata Polish**
  - [ ] Add dynamic meta titles & descriptions for individual project pages

---

### Phase 4: Admin Dashboard & Financial Management (In Progress)
- [x] **Admin Authentication & Role-based Access**
  - [x] Laravel Breeze authentication setup (Login, Forgot Password, Reset Password, Logout)
  - [x] Admin panel layout & architecture (Bootstrap 5, RemixIcon, SCSS, DataTables, Select2)
  - [x] Dashboard KPI Overview (Total Donations, Total Expenses, Projects Completed, Net Balance)
  - [x] Layered Architecture: `app/Http/Controllers/Admin/DashboardController.php`, `app/Services/DashboardService.php`
- [x] **Project & Activity Management (Req #2 & #5)**
  - [x] Project CRUD (Create, Edit, Status update, Target budget tracker)
  - [x] Multi-image uploader for Project Documentation & Gallery
  - [x] Layered Architecture: `app/Http/Controllers/Admin/ProjectController.php`, `app/Services/ProjectService.php`, `app/Http/Requests/Admin/StoreProjectRequest.php`, `app/Http/Requests/Admin/UpdateProjectRequest.php`
- [x] **Donor & Donation Management (Req #1)**
  - [x] Donor list, profile view & lifetime donation history with Yajra DataTables
  - [x] Add offline/online donation entry with quick-add donor support
  - [x] Automatic sequential receipt generator (`REC-YYYY-001`)
  - [x] Official printable Money Receipt view (`admin/donations/show.blade.php`)
  - [x] Layered Architecture: `DonorController.php`, `DonationController.php`, `DonorService.php`, `DonationService.php`, Form Requests
- [x] **Expense Management & Vouchers (Req #3)**
  - [x] Create PHP Enum `App\Enums\ExpenseCategory` with badge styles and labels
  - [x] Build Layered Architecture: `ExpenseController`, `ExpenseService`, `StoreExpenseRequest`, `UpdateExpenseRequest`
  - [x] Expense voucher entry (Category, Vendor, Project allocation, File Attachment upload)
  - [x] Server-side Yajra DataTable with filters (category, project, payment method)
  - [x] Official printable Debit Voucher view (`admin/expenses/show.blade.php`)
  - [x] Feature tests in `tests/Feature/ExpenseTest.php` passing
- [x] **Employee & Salary Management (Req #4)**
  - [x] Create PHP Enum `App\Enums\EmploymentStatus` with badge styles and labels
  - [x] Build Layered Architecture: `EmployeeController`, `SalaryController`, `EmployeeService`, `SalaryService`, Form Requests (`StoreEmployeeRequest`, `UpdateEmployeeRequest`, `StoreSalaryRequest`, `UpdateSalaryRequest`)
  - [x] Employee profile management (Auto sequential ID `EMP-101`, NID, base salary, photo upload via unified image uploader)
  - [x] Staff profile show view with lifetime salary history ledger
  - [x] Monthly salary disbursement voucher generation with dynamic live net calculation (`basic + allow + bonus - deductions`)
  - [x] Server-side Yajra DataTables with custom filters for staff and payroll records
  - [x] Official printable Salary Slip / Payslip view (`admin/salaries/show.blade.php`) with borderless `@media print` layout and 3-column signature block
  - [x] Feature tests in `tests/Feature/EmployeeTest.php` and `tests/Feature/SalaryTest.php` passing
- [x] **Financial Reporting & Statements (Req #6)**
  - [x] Build Layered Architecture: `ReportController.php`, `ReportService.php`
  - [x] Income vs Expense monthly/yearly audit ledger with date range & project filters
  - [x] 4 KPI Financial Summary Cards (Total Inflow, Direct Relief Expenses, Staff Salaries, Net Organization Reserve/Deficit)
  - [x] Project-wise financial performance balance sheet (Target Budget, Raised, Expensed, Balance, Progress %)
  - [x] Official printable Financial Audit Statement (`admin/reports/statement.blade.php`) with borderless print layout & 3-column signature block
  - [x] CSV / Excel export functionality for auditing
  - [x] Feature tests in `tests/Feature/ReportTest.php` passing

---

## 📊 Overall Progress Summary
- **Phase 1 (Database & Models):** 100% Complete ✅
- **Phase 2 (Frontend Localization & Dynamic Binding):** 100% Complete ✅
- **Phase 3 (Frontend Forms & Interactions):** 0% Planned ⏳
- **Phase 4 (Admin Dashboard & Backend Operations):** 90% Complete 🚀
