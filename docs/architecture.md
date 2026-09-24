# Shanti Nagar Foundation — Project Architecture

## 1. System Architecture Overview

The application is structured as a robust **Laravel 12 / PHP 8.2+ Clean MVC & Service-Layer Application** supporting localized humanitarian welfare operations, transparent fund management, project documentation, and employee compensation tracking.

```
┌─────────────────────────────────────────────────────────────────────────┐
│                    Frontend (Blade) & Admin Panel UI                    │
│    - Public Website: Home, About, Projects, Activities, Gallery, etc.   │
│    - Admin Dashboard: Financial KPI Overview, Management Modules        │
└────────────────────────────────────┬────────────────────────────────────┘
                                     │ HTTP Requests
┌────────────────────────────────────▼────────────────────────────────────┐
│                    Routing & Form Request Layer                         │
│    - Form Request Validation (e.g. StoreDonationRequest, ExpenseRequest)│
│    - Routing (routes/web.php with auth/admin middleware grouping)       │
└────────────────────────────────────┬────────────────────────────────────┘
                                     │ Validated Data ($request->validated())
┌────────────────────────────────────▼────────────────────────────────────┐
│                    Admin Controllers Layer                              │
│    - app/Http/Controllers/Admin/*                                       │
│    - Thin Controllers: Handles HTTP response, redirects & JSON status   │
└────────────────────────────────────┬────────────────────────────────────┘
                                     │ Delegates Business Logic
┌────────────────────────────────────▼────────────────────────────────────┐
│                    Dedicated Service Layer                              │
│    - app/Services/* (DonationService, ProjectService, ExpenseService,   │
│      SalaryService, ReportService)                                      │
│    - Handles DB Transactions, Business Rules, File Uploads & Auditing   │
└────────────────────────────────────┬────────────────────────────────────┘
                                     │ Eloquent ORM
┌────────────────────────────────────▼────────────────────────────────────┐
│                 Models & Domain Logic (app/Models/*)                    │
│    - User, Donor, Project, ProjectImage, Donation, Expense,             │
│      Employee, Salary                                                   │
└────────────────────────────────────┬────────────────────────────────────┘
                                     │ Database Queries
┌────────────────────────────────────▼────────────────────────────────────┐
│                 MySQL Database (Relational)                             │
│    - Financial Audit Trail (Income, Expense, Salary)                    │
│    - Project Field Documentation & Media Galleries                      │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## 2. Core Business Workflows & Architecture Principles

### A. Strict Layer Separation
1. **Controllers (`app/Http/Controllers/Admin/`):**
   - Controllers must remain **thin** and never contain raw SQL, multi-step business calculations, or file manipulation logic.
   - Controllers only inject Form Requests and call respective Services.

2. **Form Requests (`app/Http/Requests/Admin/`):**
   - Every store and update action must have a dedicated FormRequest class.
   - Handles authorization rules, input sanitization, custom messages, and validation rules.

3. **Service Layer (`app/Services/`):**
   - All complex business workflows, multi-table updates, database transactions (`DB::transaction`), and receipt/voucher generation logic reside here.
   - Services are modular, testable, and reusable.

---

## 3. Directory Layout

```
shanti-nagar-foundation/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php               # Public frontend controller
│   │   │   └── Admin/                           # ALL ADMIN CONTROLLERS MUST RESIDE HERE
│   │   │       ├── DashboardController.php      # Overview KPIs & financial summary
│   │   │       ├── DonorController.php          # Donor CRM & history
│   │   │       ├── DonationController.php       # Donation entries & receipt generator
│   │   │       ├── ProjectController.php        # Project & Activity lifecycle
│   │   │       ├── ExpenseController.php        # Voucher expenses & procurement
│   │   │       ├── EmployeeController.php       # Staff & personnel registry
│   │   │       ├── SalaryController.php         # Salary disbursement & payslips
│   │   │       └── ReportController.php         # Financial audit & exports
│   │   └── Requests/
│   │       └── Admin/                           # FORM REQUEST VALIDATION LAYER
│   │           ├── Donor/ (StoreDonorRequest, UpdateDonorRequest)
│   │           ├── Donation/ (StoreDonationRequest, UpdateDonationRequest)
│   │           ├── Project/ (StoreProjectRequest, UpdateProjectRequest)
│   │           ├── Expense/ (StoreExpenseRequest, UpdateExpenseRequest)
│   │           ├── Employee/ (StoreEmployeeRequest, UpdateEmployeeRequest)
│   │           └── Salary/ (DisburseSalaryRequest, UpdateSalaryRequest)
│   ├── Services/                                # DEDICATED BUSINESS SERVICE LAYER
│   │   ├── DonorService.php                     # Donor creation, stats & history
│   │   ├── DonationService.php                  # Donation processing & receipt logic
│   │   ├── ProjectService.php                   # Project CRUD, budget tracking & photo upload
│   │   ├── ExpenseService.php                   # Expense voucher recording & balance checks
│   │   ├── EmployeeService.php                  # Staff management & salary profiles
│   │   ├── SalaryService.php                    # Monthly payroll processing & slip generator
│   │   └── ReportService.php                    # Financial summary statements & export data
│   └── Models/                                  # ELOQUENT MODELS
│       ├── User.php
│       ├── Donor.php
│       ├── Project.php
│       ├── ProjectImage.php
│       ├── Donation.php
│       ├── Expense.php
│       ├── Employee.php
│       └── Salary.php
├── database/
│   ├── migrations/                              # 7 relational schema migrations
│   └── seeders/                                 # 8 relational idempotent seeders
├── resources/
│   └── views/
│       ├── frontend/                            # Public website views & partials
│       └── admin/                               # Admin panel views & partials
├── routes/
│   └── web.php                                  # Public & admin route groups
└── docs/
    ├── project_overview.md                      # Client specification document
    ├── database_design.md                       # Complete ERD, schema & model relations
    ├── architecture.md                          # This 3-tier architecture document
    ├── project_context.md                       # Business rules, branding & roadmap
    └── tasks.md                                 # Task list & progress tracker
```
