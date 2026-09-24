---
name: laravel-best-practices
description: Core standards, rules, and best practices for developing Laravel applications with clean architecture and maintainability.
---

# Laravel Best Practices & Guidelines

This skill defines the coding standards, architectural rules, and operational guidelines for the **Shanti Nagar Foundation** Laravel application.

## 1. Routing & Controllers
- **Resourceful & Explicit Naming:** Always name routes (e.g. `->name('projects.index')`).
- **Thin Controllers:** Keep controllers lightweight. Delegate complex queries and data manipulations to Eloquent Models, Query Scopes, or Dedicated Action/Service classes.
- **Route Model Binding:** Prefer Route Model Binding (e.g. `Project $project`) over manual ID lookups.

## 2. Eloquent Models & Database
- **Eager Loading (Prevent N+1):** Always eager load relations using `with()` when accessing child records in Blade (e.g. `Project::with('images')->get()`).
- **Strict Mass Assignment:** Define `$fillable` or `$guarded` explicitly on every Model.
- **Data Integrity with Casts:** Always cast dates (`'date'`, `'datetime'`), decimals (`'decimal:2'`), and booleans (`'boolean'`).
- **Use Database Transactions:** Wrap multi-table financial operations (Donation + Account Balance + Expense) inside `DB::transaction()`.
- **Soft Deletes:** Apply `SoftDeletes` to critical financial and donor records (`donors`, `projects`, `donations`, `expenses`, `employees`).

## 3. Blade Templates & Frontend
- **Reusable Partials:** Keep header, footer, mobile navigation, and modal components modular under `partials/` or `components/`.
- **Active Navigation State:** Use `request()->is('route*')` for reliable active class indicators.
- **No Hardcoded Values:** Pull dynamic content, currency symbols (`৳`), organization phone, and emails from database or configuration files.
- **Asset Helper:** Always use `asset('path/to/file')` for local assets.

## 4. Seeding & Migrations
- **Safe Migrations:** Ensure all migrations have properly defined `up()` and `down()` methods with foreign key cascading and indices on frequently searched columns (`email`, `phone`, `slug`).
- **Idempotent Seeders:** Write seeders using `updateOrCreate` or `firstOrCreate` so `db:seed` can run repeatedly without duplicating data or throwing unique constraint violations.
- **Maintain Alignment:** When database columns or models change, immediately update the relevant Seeders and documentation (`docs/database_design.md` and `docs/architecture.md`).

## 5. Security Standards
- **CSRF Protection:** Always include `@csrf` on all forms.
- **Password Hashing:** Always use `Hash::make()` or `bcrypt()` when storing credentials.
- **Validation:** Always validate incoming HTTP requests using Form Request classes or `$request->validate()`.
