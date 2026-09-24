# Shanti Nagar Foundation — Standard Module Architecture & UI Blueprint

This document defines the standard blueprint based on the completed **Projects & Relief** module. **Every upcoming module** (Donors, Donations, Expenses, Employees, Salaries, Reports, Users, Settings) MUST adhere strictly to these architectural, design, and coding patterns.

---

## 🏛️ 1. Architectural Pattern (3-Tier Layered Architecture)

Each module consists of 4 core application layers:

```
├── app/
│   ├── Http/
│   │   ├── Controllers/Admin/{Model}Controller.php  (Thin controller, DataTables & Views)
│   │   └── Requests/Admin/
│   │       ├── Store{Model}Request.php              (Validation rules & authorization)
│   │       └── Update{Model}Request.php
│   ├── Services/
│   │   └── {Model}Service.php                       (DB Transactions, Business Logic & Uploads)
│   └── Models/
│       └── {Model}.php                              (Strict casts, Fillable, Relationships & SoftDeletes)
└── resources/views/admin/{module_plural}/
    ├── index.blade.php                              (Server-Side Yajra DataTable with Compact Filters)
    ├── create.blade.php                             (Standard Layout & Modern Image Uploader)
    ├── edit.blade.php                               (Edit form with pre-filled preview & Active badge)
    └── show.blade.php                               (Detailed overview & related transaction audit)
```

---

## 🎨 2. Design System & UI Specifications

### A. List View (`index.blade.php`) & Yajra DataTable
1. **Card Header**:
   - Title + Breadcrumb (`Dashboard > Module Name`).
   - "Create [Entity] <i class='ri-add-line'></i>" button (`.add-new`).
2. **Compact Filter Bar (`background-color: #f8fafc; padding: 14px 20px;`)**:
   - Filter dropdowns sized at `col-md-2 col-sm-4` with `height: 32px; font-size: 13px;` and uppercase `11.5px` label headers.
   - Compact **Reset Filters** button (`width: 32px; height: 32px; padding: 0;`) with `<i class="ri-refresh-line"></i>`, Bootstrap tooltip (`title="Reset Filters"`), and immediate `table.draw()` without full-page reload.
3. **Table Columns**:
   - `SL` (`DT_RowIndex`): `width: 45px;`
   - `Thumbnail / Avatar`: `width: 65px;` with fallback to `asset('assets/images/logo.png')` or initials avatar badge.
   - `Title / Name & Subtitle Details`: Link to detail page, bold text, badge tags, and location/metadata.
   - `Amounts / Currency`: Styled with Bangladeshi Taka symbol `৳` and `number_format($amount, 2)`.
   - `Status Badge`: Custom badge styling matching status types.
   - `Switch Toggles`: Real-time AJAX status toggles (`.form-check.form-switch`).
   - `Action Buttons`: View (`btn-view`), Edit (`btn-edit`), and Delete Modal trigger (`btn-delete btn-delete-modal`).
4. **Delete Modal**:
   - Standard modal `#delete{Model}Modal` populated dynamically via jQuery on `.btn-delete-modal` click.

---

### B. Form Views (`create.blade.php` & `edit.blade.php`)
1. **Two-Column Grid**:
   - `col-lg-8 col-12`: Main details card (inputs, textareas, Select2 dropdowns, budget groups).
   - `col-lg-4 col-12`: Sidebar card (Publish/Active status switches, Save/Cancel buttons, Cover photo uploader, and multi-file gallery/attachments).
2. **Currency Inputs**:
   - Input group with `<span class="input-group-text bg-light text-muted">৳</span>`.
3. **Image & File Uploaders**:
   - **Single Image / Cover**: `@include('admin.includes.image-uploader', [...])` with `btn-upload-trigger` and unified modal dropzone.
   - **Multi-File Gallery / Documents**: `@include('admin.includes.multi-image-uploader', [...])` with multi-file staging and deletion.

---

### C. Details View (`show.blade.php`)
1. **Summary Cards**:
   - Header with status badge, print button, and edit shortcut.
   - Financial breakdown with spent/allocated progress bars.
2. **Related History Tabs / Tables**:
   - Donor contributions, expense vouchers, or gallery carousels.

---

## ⚡ 3. Controller & Service Standards

1. **Thin Controller**:
   - `index()` handles standard Blade render and returns `DataTables::of($query)->make(true)` for AJAX requests.
   - `store()` and `update()` pass `$request->validated()`, file uploads, and model instance into `{Model}Service`.
   - `toggleStatus()` handles quick boolean and status changes via AJAX with toastr feedback.
2. **Idempotent & Transaction-Safe Service**:
   - Wrap DB operations in `DB::transaction()`.
   - Automatic unique slug generation (if applicable).
   - Safe file uploads to public directories with cleanup of old files on update/delete.

---

## 📋 4. Next Modules to Apply This Pattern

1. **Donors Module** (`admin/donors`):
   - Server-side DataTable, donor avatars, type filter (`Individual` / `Organization`), contribution stats.
2. **Donations Module** (`admin/donations`):
   - Server-side DataTable, auto receipt numbering, project allocation, payment method badges (bKash/Nagad/Bank/Cash), printable money receipts.
3. **Expenses & Vouchers Module** (`admin/expenses`):
   - Server-side DataTable, project budget deduction, voucher file attachment, expense categories.
4. **Employees & Salaries Module** (`admin/employees`, `admin/salaries`):
   - Staff directory, monthly payroll generation, payslips.
5. **Financial Reports & Statements** (`admin/reports`):
   - Income vs Expense monthly/yearly audit summary and exports.
