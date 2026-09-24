# Shanti Nagar Foundation — Project Architecture

## 1. System Architecture Overview

The application is structured as a robust **Laravel 12 / PHP 8.2+ MVC Web Application** supporting localized humanitarian welfare operations, transparent fund management, project documentation, and employee compensation tracking.

```
┌─────────────────────────────────────────────────────────────┐
│                    Frontend Client (Blade)                  │
│    - Responsive Modern Theme (Vanilla CSS / Custom JS)      │
│    - Dynamic Routes: Home, About, Projects, Activities,     │
│      Gallery, Blog, Contact, Donate Modal                   │
└──────────────────────────────┬──────────────────────────────┘
                               │ HTTP Requests (Web.php)
┌──────────────────────────────▼──────────────────────────────┐
│                    Routing & Controllers                    │
│    - HomeController (Public pages & Dynamic Queries)         │
│    - Admin / Resource Controllers (CRUD & Reports)          │
└──────────────────────────────┬──────────────────────────────┘
                               │ Eloquent ORM
┌──────────────────────────────▼──────────────────────────────┐
│                 Models & Domain Logic                       │
│    - User, Donor, Project, ProjectImage, Donation,          │
│      Expense, Employee, Salary                              │
└──────────────────────────────┬──────────────────────────────┘
                               │ Database Queries
┌──────────────────────────────▼──────────────────────────────┐
│                 MySQL Database (Relational)                 │
│    - Financial Audit Trail (Income, Expense, Salary)        │
│    - Project Field Documentation & Galleries                │
└─────────────────────────────────────────────────────────────┘
```

---

## 2. Core Business Workflows

### A. Donation & Fund Allocation Flow
1. **Donor Contribution:** Donor submits a contribution (online via bKash/Nagad/Card or offline via Bank/Cash).
2. **Receipt Generation:** A unique `receipt_number` is assigned.
3. **Allocation:** The donation is allocated either to the *General Fund* or to a specific *Project* (`project_id`).
4. **Impact Metric:** Total donations dynamically reflect on the project card and the public Transparency Dashboard.

### B. Project & Field Activity Lifecycle
1. **Planning:** An initiative (e.g. *Hospital Equipment Distribution*, *Winter Blanket Drive*) is registered with an `estimated_cost` and `status = 'planned'`.
2. **Execution & Expenses:** Expenditures (goods purchase, transport, labor) are recorded under `expenses` table with `voucher_number`.
3. **Documentation:** On-ground photos and proof of handover are stored in `project_images`.
4. **Completion:** When executed, status transitions to `completed`, and photos automatically populate the filterable `/gallery` page.

### C. Human Resource & Salary Disbursement
1. **Employee Registry:** Staff details, NID, department, and `base_salary` are tracked in `employees`.
2. **Monthly Payroll:** Automated or manual salary vouchers are logged in `salaries` with unique slip codes (`salary_slip_number`).
3. **Balance Reconciliation:** Staff salaries are linked with overall organization operational expense reports.

---

## 3. Directory Layout

```
shanti-nagar-foundation/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── HomeController.php       # Frontend views & data binding
│   └── Models/
│       ├── User.php                     # Auth user model
│       ├── Donor.php                    # Donors & organizations
│       ├── Project.php                  # Social initiatives & campaigns
│       ├── ProjectImage.php             # Documentation photos
│       ├── Donation.php                 # Contributions & receipt audit
│       ├── Expense.php                  # Voucher expenses & procurement
│       ├── Employee.php                 # Staff & personnel
│       └── Salary.php                   # Monthly disbursements
├── database/
│   ├── migrations/                      # 7 relational schema migrations
│   └── seeders/
│       ├── DatabaseSeeder.php           # Orchestrator seeder
│       ├── UserSeeder.php               # Admin & staff users
│       ├── DonorSeeder.php              # Donor profiles
│       ├── ProjectSeeder.php            # 12 social projects & gallery photos
│       ├── DonationSeeder.php           # Realistic donation records
│       ├── ExpenseSeeder.php            # Project & operational vouchers
│       ├── EmployeeSeeder.php           # Employee profiles
│       └── SalarySeeder.php             # Salary disbursement logs
├── resources/
│   └── views/
│       └── frontend/
│           ├── layouts/app.blade.php    # Base layout & donation popup modal
│           ├── partials/                # header.blade.php & footer.blade.php
│           ├── index.blade.php          # Homepage
│           ├── about.blade.php          # About us & Transparency metrics
│           ├── donations.blade.php      # Projects & causes listing
│           ├── donation-details.blade.php # Single project details
│           ├── events.blade.php         # Upcoming activities
│           ├── event-details.blade.php  # Activity description
│           ├── gallery.blade.php        # Project documentation photos
│           ├── contact.blade.php        # Contact info & Google Map
│           └── ...                      # Blog, volunteer, faq, donate
├── routes/
│   └── web.php                          # Web route definitions
└── docs/
    ├── project_overview.md              # Client specification document
    ├── database_design.md               # Complete ERD & schema specs
    └── architecture.md                  # This architecture document
```
