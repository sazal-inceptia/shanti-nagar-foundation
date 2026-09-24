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

### Phase 4: Admin Dashboard & Financial Management (Planned)
- [ ] **Admin Authentication & Role-based Access**
  - [ ] Admin login & secure session management
  - [ ] Dashboard KPI Overview (Total Donations, Total Expenses, Projects Completed, Net Balance)
- [ ] **Donor & Donation Management (Req #1)**
  - [ ] Donor list, profile view & donation history
  - [ ] Add new offline/online donation entry & automatic receipt generator
- [ ] **Project & Activity Management (Req #2 & #5)**
  - [ ] Project CRUD (Create, Edit, Status update, Budget tracker)
  - [ ] Multi-image uploader for Project Documentation & Gallery
- [ ] **Expense Management & Vouchers (Req #3)**
  - [ ] Expense voucher entry (Category, Vendor, Project allocation, Attachment)
  - [ ] Real-time project cost calculation vs estimated budget
- [ ] **Employee & Salary Management (Req #4)**
  - [ ] Employee profiles & salary configuration
  - [ ] Monthly salary disbursement voucher generation & payslips
- [ ] **Financial Reporting & Statements (Req #6)**
  - [ ] Income vs Expense monthly/yearly audit report
  - [ ] PDF & Excel export for audit statements

---

## 📊 Overall Progress Summary
- **Phase 1 (Database & Models):** 100% Complete ✅
- **Phase 2 (Frontend Localization & Dynamic Binding):** 100% Complete ✅
- **Phase 3 (Frontend Forms & Interactions):** 0% Planned ⏳
- **Phase 4 (Admin Dashboard & Backend Operations):** 0% Planned ⏳
