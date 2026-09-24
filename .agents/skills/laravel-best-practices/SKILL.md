---
name: laravel-best-practices
description: Core standards, rules, and best practices for developing Laravel applications with clean architecture and maintainability.
---

# Laravel Best Practices & Guidelines

This skill defines the coding standards, architectural rules, and operational guidelines for the **Shanti Nagar Foundation** Laravel application.

## 1. Routing & Controllers Layer
- **Admin Controllers Subfolder:** ALL Admin panel controllers MUST reside in `app/Http/Controllers/Admin/` namespace.
- **Resourceful & Explicit Naming:** Always name routes (e.g. `->name('admin.projects.index')`).
- **Thin Controllers:** Keep controllers lightweight. Controllers must strictly:
  1. Inject the validated **FormRequest** class.
  2. Call the corresponding **Service** method.
  3. Return the Blade view, redirect, or JSON response.
- **Route Model Binding:** Prefer Route Model Binding (e.g. `Project $project`) over manual ID lookups.

## 2. Form Request Validation Layer
- **Dedicated Request Classes:** All store and update actions MUST have dedicated FormRequest classes in `app/Http/Requests/Admin/` (e.g. `StoreDonationRequest`, `UpdateProjectRequest`).
- **No Controller Validation:** Never write `$request->validate([...])` inside controller methods; encapsulate rules in FormRequests.
- **Strict Rules & Messages:** Include data type validation, unique constraints, file format checks, and user-friendly error messages.

## 3. Dedicated Service Layer
- **Dedicated Business Services:** All core business logic, calculations, multi-table operations, and external API calls MUST reside in `app/Services/` (e.g. `DonationService`, `ProjectService`, `ExpenseService`, `SalaryService`, `ReportService`).
- **Database Transactions:** Always wrap multi-table financial operations (Donation + Account Balance + Expense + Salaries) inside `DB::transaction()`.
- **Reusability & Testability:** Services should return Eloquent models, collections, or DTOs to keep them reusable across web, API, or scheduled console commands.

## 4. Eloquent Models & Database
- **Eager Loading (Prevent N+1):** Always eager load relations using `with()` when accessing child records in Blade (e.g. `Project::with('images')->get()`).
- **Strict Mass Assignment:** Define `$fillable` or `$guarded` explicitly on every Model.
- **Data Integrity with Casts:** Always cast dates (`'date'`, `'datetime'`), decimals (`'decimal:2'`), and booleans (`'boolean'`).
- **Soft Deletes:** Apply `SoftDeletes` to critical financial and donor records (`donors`, `projects`, `donations`, `expenses`, `employees`).

## 5. Blade Templates & Frontend
- **Reusable Partials:** Keep header, footer, mobile navigation, and modal components modular under `partials/` or `components/`.
- **Active Navigation State:** Use `request()->is('route*')` for reliable active class indicators.
- **No Hardcoded Values:** Pull dynamic content, currency symbols (`৳`), organization phone, and emails from database or configuration files.
- **Asset Helper:** Always use `asset('path/to/file')` for local assets.

## 6. Seeding & Migrations
- **Safe Migrations:** Ensure all migrations have properly defined `up()` and `down()` methods with foreign key cascading and indices on frequently searched columns (`email`, `phone`, `slug`).
- **Idempotent Seeders:** Write seeders using `updateOrCreate` or `firstOrCreate` so `db:seed` can run repeatedly without duplicating data or throwing unique constraint violations.
- **Maintain Alignment:** When database columns or models change, immediately update the relevant Seeders and documentation (`docs/database_design.md`, `docs/architecture.md`, `docs/tasks.md`).

## 7. Security Standards
- **CSRF Protection:** Always include `@csrf` on all forms.
- **Password Hashing:** Always use `Hash::make()` or `bcrypt()` when storing credentials.
- **Authorization:** Protect admin routes with auth middleware (`middleware(['auth'])`).
