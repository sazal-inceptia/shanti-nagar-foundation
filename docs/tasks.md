# Rotary Club of Shantinagar Dhaka — Project Tasks & Progress Tracker

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
  - [x] Create `project_types` table migration (`continuous-project`, `monthly-project`, `signature-project`, `general-campaign`)
  - [x] Create `donors` table migration
  - [x] Create `projects` table migration with `project_type_id` foreign key
  - [x] Create `project_images` table migration
  - [x] Create `donations` table migration
  - [x] Create `expenses` table migration
  - [x] Create `employees` table migration
  - [x] Create `salaries` table migration
- [x] **Eloquent Models & Relationships**
  - [x] Build `ProjectType` model with `hasMany(Project)` and `getBadgeStyleAttribute()`
  - [x] Build `User` model with expense relations
  - [x] Build `Donor` model with `hasMany(Donation)`
  - [x] Build `Project` model with `belongsTo(ProjectType)`, `hasMany(Donation)`, `hasMany(Expense)`, `hasMany(ProjectImage)`
  - [x] Build `ProjectImage` model with `belongsTo(Project)`
  - [x] Build `Donation` model with `belongsTo(Donor)`, `belongsTo(Project)`
  - [x] Build `Expense` model with `belongsTo(Project)`, `belongsTo(User, 'created_by')`
  - [x] Build `Designation` model with `hasMany(Employee)`
  - [x] Build `Employee` model with `belongsTo(Designation)`, `hasMany(Salary)`
  - [x] Build `Salary` model with `belongsTo(Employee)`
- [x] **Database Seeders (Idempotent)**
  - [x] `UserSeeder`: Admin & Staff login credentials
  - [x] `DonorSeeder`: Individual & institutional donors
  - [x] `ProjectSeeder`: 12 real Bangladeshi projects with image galleries
  - [x] `DonationSeeder`: Realistic donation records & receipt vouchers
  - [x] `ExpenseSeeder`: Project procurement & utility expenditures
  - [x] `DesignationSeeder`: Dynamic leadership and organizational staff roles
  - [x] `EmployeeSeeder`: Staff profiles, NID, dynamic designation relationships & base salaries
  - [x] `SalarySeeder`: Monthly salary disbursement logs
  - [x] `ContactMessageSeeder`: Inquiries for relief, hospital aid, tube-wells & bank confirmations
  - [x] `VolunteerSeeder`: Community volunteers across Dhaka & regional divisions
  - [x] `DatabaseSeeder`: Master orchestrator

---

### Phase 2: Public Frontend Pages & UI Localization (Completed)
- [x] **Header & Navigation**
  - [x] Dynamic active link state (`request()->is()`)
  - [x] Update menu names: Home, About Us, Projects & Causes, Activities, Gallery, Contact (Removed unused Blog placeholder to keep focus on core NGO initiatives)
  - [x] Integrate foundation brand title ("Rotary Club of Shantinagar Dhaka") and tagline ("Humanitarian Welfare Initiative") next to header logo
  - [x] Bangladeshi contact info & helpline (`+880 1700-000000`, Shanti Nagar, Dhaka)
- [x] **Page Refinements**
  - [x] Remove unrelated "Charity Shops" from `contact.blade.php` and embed responsive Google Maps
  - [x] Refine Verified Contributors section with right-side humanitarian artwork background (`background/1.jpg`) and textured white background image on donor cards (`background/13.jpg`)
  - [x] Restructure `about.blade.php` to exact leadership hierarchy: (0) Best President Ever highlight, (1) President, Secretary & Treasurer executive triad with tailored speeches and role badges, (2) Board of Directors (BOD via signature `team-block-one` LTR carousel), (3) Other members (via `team-block-one` RTL carousel), (4) Feature section (Mission/Vision), (5) Contribution section, and (6) Report & Fund Summary section
  - [x] Make `donations.blade.php` render a sponsored projects carousel (1 item at a time) with signature initiative branding, followed by gallery-style dynamic Isotope project type filtering, budget progress bars, and custom pagination
  - [x] Connect `events.blade.php` and `event-details.blade.php` to dynamic project activities with dates, location, volunteer team, registration, and details links
  - [x] Connect `gallery.blade.php` directly to `ProjectImage` with eager-loaded queries, precomputed category counts, dynamic category isotope filtering, pagination, and lightbox popups
  - [x] Connect `contact.blade.php` with direct hotline/email integration, feedback submission, and 100% bilingual English/Bangla localization
  - [x] Update `volunteer.blade.php` and `faq.blade.php` with authentic Bangladeshi boy volunteer/student imagery (`volunteer-boy.png` and `faq-boy.png`)
  - [x] **Hero Sections & Page Titles Design Upgrade**
  - [x] Clean, authentic styling for `.page-title` using theme primary (`#005daa`) linear-gradient and secondary (`#f7a81b` / `#ffb81c`) accents, centered hierarchy, and breadcrumb layout without AI slop across all pages
- [x] **Dynamic Project Details & Live Counters**
  - [x] Connect `/donation-details/{slug}` with full dynamic project data, target funding progress, photos, and direct pledge form
  - [x] Connect `/event-details/{slug}` with dynamic activity overview, field team details, and volunteer registration
  - [x] Refactor all frontend blade templates to strictly eliminate inline styles and migrate all layout, component, and typography styling to `public/assets/css/style.css`
  - [x] Make all homepage counters (Active Volunteers, Beneficiaries Reached, Relief Initiatives, Verified Donors) 100% dynamic from database models via `HomeController@getImpactStats` and animated jQuery countTo triggers
  - [x] Convert "Our Active Initiatives" to the authentic tabbed 2-column carousel design ("Our Global Causes" layout) with category tabs and navigation controls
  - [x] Make "Verified Contributors" donor pictures & names 100% dynamic from database records with infinite loop carousel
  - [x] Transform "Verified Contributors" into a textured section inspired by the About section background (13.jpg), with minimalist white donor cards and 3-item carousel navigation
- [x] **SEO & Metadata Polish**
  - [x] Add dynamic meta titles, descriptions & OpenGraph tags for individual project pages and main layout
  - [x] Create bespoke, page-aligned Hero / Banner sections with unique background imagery, themed mood gradients, localized badges, mission headlines, lead text, trust meta pills, and breadcrumbs across all individual frontend pages (`about`, `projects`, `project-details`, `activities`, `activity-details`, `gallery`, `album-details`, `volunteer`, `contact`, `faq`, `donate`)

---

### Phase 4: Admin Dashboard & Financial Management (Completed)
- [x] **Admin Authentication & Role-based Access**
  - [x] Laravel Breeze authentication setup (Login, Forgot Password, Reset Password, Logout)
  - [x] Admin panel layout & architecture (Bootstrap 5, RemixIcon, SCSS, DataTables, Select2)
  - [x] Dashboard KPI Overview (Total Donations, Total Expenses, Projects Completed, Net Balance)
  - [x] Layered Architecture: `app/Http/Controllers/Admin/DashboardController.php`, `app/Services/DashboardService.php`
- [x] **Project Management (Req #2 & #5)**
  - [x] Project CRUD (Create, Edit, Status update, Target budget tracker)
  - [x] Automatic unique slug generation (`booted()` saving lifecycle) without requiring manual input
  - [x] CKEditor 5 SuperBuild with HTML Source Editing, Image upload endpoint, YouTube/Vimeo video embed, Tables, Links and Typography formatting
  - [x] Multi-image uploader for Project Documentation & Gallery
  - [x] Layered Architecture: `app/Http/Controllers/Admin/ProjectController.php`, `app/Services/ProjectService.php`, `app/Http/Requests/Admin/StoreProjectRequest.php`, `app/Http/Requests/Admin/UpdateProjectRequest.php`
- [x] **Dedicated Club Activities Module**
  - [x] Dedicated `activities` database table with bilingual attributes (`title`, `title_bn`, `location`, `location_bn`, `event_date`, `event_time`, `short_description`, `description`, `featured_image`, `status`, `is_featured`, `is_published`)
  - [x] Dedicated `Activity` model with auto unique slug generation, scopes (`scopeUpcoming`, `scopeCompleted`, `scopePublished`, `scopeFeatured`), and bilingual accessors
  - [x] CKEditor 5 SuperBuild integrated for English and Bengali activity full descriptions
  - [x] Dedicated `ActivityService.php`, `StoreActivityRequest.php`, `UpdateActivityRequest.php` for layered architecture
  - [x] Dedicated `EditorUploadController.php` at `POST /admin/editor/upload` for server-side file and image uploads
  - [x] Admin Activities CRUD (`admin/activities/index`, `create`, `edit`, `show`) with Yajra DataTables, instant published toggle, live filter, and preview
  - [x] Frontend routes `/activities` and `/activities/{slug}`, complete removal of legacy `/events` code
  - [x] Seeded authentic field initiatives in `ActivitySeeder`
- [x] **Donor & Donation Management (Req #1)**
  - [x] Donor list, profile view & lifetime donation history with Yajra DataTables
  - [x] Unified interactive image uploader modal with cropper and removal support on Donor create/edit views
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
  - [x] Active / Inactive boolean status (`is_active`) with instant AJAX toggle switch on DataTables list and auto-active true on registration
  - [x] Build Layered Architecture: `EmployeeController`, `SalaryController`, `EmployeeService`, `SalaryService`, Form Requests (`StoreEmployeeRequest`, `UpdateEmployeeRequest`, `StoreSalaryRequest`, `UpdateSalaryRequest`)
  - [x] Employee profile management (Auto sequential ID `EMP-101`, NID, base salary, photo upload via unified image uploader, dynamic leadership speech, speech tag, bio, signature text/title, badge title, and social links)
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
- [x] **Admin Theme & Visual Identity Harmonization**
  - [x] Synchronized admin panel & dashboard theme palette with website primary identity (`#005daa` Royal Blue, `#004c8c` hover, `#e8f1f8` tint, and `#003366` dark) across SCSS variables, DataTables, Select2, modals, auth pages, and UI components
- [x] **Admin Profile & System Settings Management**
  - [x] Profile Management with photo upload, NID/phone info, and password change security
  - [x] Organization & System Settings view for hotline, emails, merchant accounts, bank info
  - [x] Header dropdown navigation links with icons and active states
  - [x] Feature tests in `tests/Feature/ProfileAndSettingTest.php` passing

---

### Phase 5: Universal Multilingual Support (English & Bangla) (Completed)
- [x] **Localization Architecture & Routing**
  - [x] Configured default locale `en` with fallback `en` and alternate `bn` in `config/app.php`
  - [x] Built middleware `app/Http/Middleware/SetLocale.php` attached to the `web` middleware group
  - [x] Created route `GET /lang/{locale}` (`switch.lang`) for session-persistent language switching
  - [x] Added interactive language switch toggle (`EN` | `বাংলা`) in header bar and mobile menu (`.snf-lang-toggle`)
- [x] **Multilingual Database Schema & Model Localized Accessors**
  - [x] Created migration `2026_10_04_100923_add_multilingual_bn_columns_to_all_tables.php` with `name_bn`, `short_description_bn`, `description_bn`, `location_bn`, `caption_bn`, `bio_bn`, `speech_bn`, `notes_bn`, `value_bn`
  - [x] Updated Eloquent models (`Project`, `ProjectType`, `ProjectImage`, `Designation`, `Employee`, `Setting`) with localized fallback accessors (`localized_name`, `localized_short_description`, `localized_description`, `localized_location`, `localized_bio`, `localized_speech`, `localized_caption`)
  - [x] Created helper functions in `app/helpers.php`: `site_setting()`, `is_bengali()`, `bengali_number()`, `localized_number()`
- [x] **Universal Static UI Translations**
  - [x] Created comprehensive JSON translation dictionaries in `lang/en.json` and `lang/bn.json`
  - [x] Localized all public Blade views:
    - Master layout & modals: `app.blade.php`, `header.blade.php`, `footer.blade.php`, `help-drawer.blade.php`
    - Pages: `index.blade.php`, `about.blade.php`, `donate.blade.php`, `donations.blade.php`, `donation-details.blade.php`, `events.blade.php`, `event-details.blade.php`, `gallery.blade.php`, `volunteer.blade.php`, `contact.blade.php`, `faq.blade.php`
- [x] **Admin Bilingual Input Support**
  - [x] Added bilingual form inputs (English + Bangla tabs/fields) across Project CRUD (`admin/projects/create.blade.php`, `edit.blade.php`), Staff Profiles (`admin/employees/create.blade.php`, `edit.blade.php`), and Organization Settings (`admin/settings/index.blade.php`)
- [x] **Database Seeders with Authentic Bangla Content**
  - [x] Seeded rich, authentic Bengali translations for Project Types, Projects, Designations, Staff bios/speeches, and Organization Settings
- [x] **Automated Testing Suite**
  - [x] Feature tests in `tests/Feature/LocalizationTest.php` verifying session switching, model fallback accessors, and localized frontend rendering passing across all public views (4/4 tests, 36 assertions)

---

### Phase 6: Photo Albums & Dynamic Gallery Module (Completed)
- [x] **Relational Schema & Models**
  - [x] Created `albums` table migration (`title`, `title_bn`, `slug`, `description`, `description_bn`, `cover_image`, `event_date`, `is_active`, `sort_order`)
  - [x] Created `gallery_images` table migration (`album_id` nullable for standalone photos, `title`, `title_bn`, `caption`, `caption_bn`, `image_path`, `is_featured`, `is_active`, `sort_order`)
  - [x] Eloquent models `Album` and `GalleryImage` with localized accessors and eager-loading scopes
- [x] **Admin Panel Management**
  - [x] Full Album CRUD (`Admin\AlbumController`) with cover upload, date, status toggle, and in-album photo manager
  - [x] Gallery Images manager (`Admin\GalleryImageController`) with bulk/single upload, album selector, status toggle, and delete
  - [x] Added Photo Albums & Gallery navigation to admin sidebar
- [x] **Public Frontend Experience**
  - [x] `/gallery`: Renders active Album Cards first with cover, localized title, photo count badge, and event date; renders Standalone Photos below with lightbox
  - [x] `/gallery/album/{slug}`: Dedicated Album Details page with album summary banner, full-resolution FancyBox lightbox grid, and other recent albums
- [x] **Seeding & Automated Testing**
  - [x] `GallerySeeder`: Seeded 4 realistic humanitarian photo albums and standalone field moments for Rotary Club of Shantinagar Dhaka
  - [x] `tests/Feature/GalleryAlbumTest.php`: 6 comprehensive feature tests covering public rendering, album routing, bilingual display, and admin CRUD (46/46 total tests passing)

---

## 📊 Overall Progress Summary
- **Phase 1 (Database & Models):** 100% Complete ✅
- **Phase 2 (Frontend Localization & Dynamic Binding):** 100% Complete ✅
- **Phase 3 (Frontend Forms & Interactions):** 100% Complete ✅
- **Phase 4 (Admin Dashboard & Financial Management):** 100% Complete ✅
- **Phase 5 (Universal Multilingual Support - EN & BN):** 100% Complete ✅
- **Phase 6 (Photo Albums & Dynamic Gallery Module):** 100% Complete ✅
