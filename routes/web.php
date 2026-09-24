<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;

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
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog-details', [HomeController::class, 'blogDetails'])->name('blog.details');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/donate', [HomeController::class, 'donate'])->name('donate');
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

    // Projects / Relief
    Route::get('/projects', function() { return view('admin.projects.index'); })->name('projects.index');
    Route::get('/projects/create', function() { return view('admin.projects.create'); })->name('projects.create');

    // Donors Directory
    Route::get('/donors', function() { return view('admin.home.index'); })->name('donors.index');
    Route::get('/donors/create', function() { return redirect()->route('admin.donors.index'); })->name('donors.create');

    // Donations & Receipts
    Route::get('/donations', function() { return view('admin.home.index'); })->name('donations.index');
    Route::get('/donations/create', function() { return redirect()->route('admin.donations.index'); })->name('donations.create');

    // Expenses & Vouchers
    Route::get('/expenses', function() { return view('admin.home.index'); })->name('expenses.index');
    Route::get('/expenses/create', function() { return redirect()->route('admin.expenses.index'); })->name('expenses.create');

    // Employees & Staff
    Route::get('/employees', function() { return view('admin.home.index'); })->name('employees.index');

    // Salaries & Payroll
    Route::get('/salaries', function() { return view('admin.home.index'); })->name('salaries.index');

    // Financial Reports
    Route::get('/reports', function() { return view('admin.home.index'); })->name('reports.index');

    // Admin Users
    Route::get('/users', function() { return view('admin.users.index'); })->name('users.index');

    // Settings
    Route::get('/settings', function() { return view('admin.settings.index'); })->name('settings.index');
});
