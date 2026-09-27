<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/donations', [HomeController::class, 'donations'])->name('donations');
Route::get('/donation-details/{slug?}', [HomeController::class, 'donationDetails'])->name('donation.details');
Route::get('/events', [HomeController::class, 'events'])->name('events');
Route::get('/event-details/{slug?}', [HomeController::class, 'eventDetails'])->name('event.details');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
Route::post('/volunteer', [HomeController::class, 'submitVolunteer'])->name('volunteer.submit');

Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/donate', [HomeController::class, 'donate'])->name('donate');
Route::post('/donate', [HomeController::class, 'submitDonate'])->name('donate.submit');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated Dashboard Shortcut
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by auth middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects & Relief Causes Management (Resource CRUD)
    Route::post('/projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('projects.toggle-status');
    Route::resource('projects', ProjectController::class);

    // Donors Directory
    Route::resource('donors', DonorController::class);

    // Donations & Receipts
    Route::resource('donations', DonationController::class);

    // Expenses & Vouchers (Resource CRUD)
    Route::resource('expenses', ExpenseController::class);

    // Employees & Staff Management
    Route::resource('employees', EmployeeController::class);

    // Salaries & Payroll Disbursement
    Route::resource('salaries', SalaryController::class);

    // Financial Reports & Audit Statements
    Route::get('/reports/statement', [ReportController::class, 'statement'])->name('reports.statement');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Public Inquiries & Contact Messages
    Route::resource('contacts', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Volunteer Applications Management
    Route::post('/volunteers/{volunteer}/toggle-status', [VolunteerController::class, 'toggleStatus'])->name('volunteers.toggle-status');
    Route::resource('volunteers', VolunteerController::class)->only(['index', 'destroy']);
});
