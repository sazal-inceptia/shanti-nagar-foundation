<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\EditorUploadController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SettingController;
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

// Club Activities & Field Programs
Route::get('/activities', [HomeController::class, 'activities'])->name('activities');
Route::get('/activities/{slug}', [HomeController::class, 'activityDetails'])->name('activity.details');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

Route::get('/volunteer', [HomeController::class, 'volunteer'])->name('volunteer');
Route::post('/volunteer', [HomeController::class, 'submitVolunteer'])->name('volunteer.submit');

Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/donate', [HomeController::class, 'donate'])->name('donate');
Route::post('/donate', [HomeController::class, 'submitDonate'])->name('donate.submit');

Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/gallery/album/{slug}', [HomeController::class, 'albumDetails'])->name('gallery.album');
Route::get('/lang/{locale}', [HomeController::class, 'switchLang'])->name('switch.lang');

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

    // Club Activities & Field Programs
    Route::post('/activities/{activity}/toggle-status', [ActivityController::class, 'toggleStatus'])->name('activities.toggle-status');
    Route::resource('activities', ActivityController::class);

    // Donors Directory
    Route::resource('donors', DonorController::class);

    // Donations & Receipts
    Route::resource('donations', DonationController::class);

    // Expenses & Vouchers (Resource CRUD)
    Route::resource('expenses', ExpenseController::class);

    // Employees & Staff Management
    Route::post('/employees/{employee}/toggle-status', [EmployeeController::class, 'toggleStatus'])->name('employees.toggle-status');
    Route::resource('employees', EmployeeController::class);

    // Salaries & Payroll Disbursement
    Route::resource('salaries', SalaryController::class);

    // Financial Reports & Audit Statements
    Route::get('/reports/statement', [ReportController::class, 'statement'])->name('reports.statement');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Public Inquiries & Contact Messages
    Route::resource('contacts', ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Albums & Photo Gallery Management
    Route::post('/albums/{album}/toggle-status', [AlbumController::class, 'toggleStatus'])->name('albums.toggle-status');
    Route::resource('albums', AlbumController::class);
    Route::post('/gallery-images/{galleryImage}/toggle-status', [GalleryImageController::class, 'toggleStatus'])->name('gallery-images.toggle-status');
    Route::resource('gallery-images', GalleryImageController::class)->parameters(['gallery-images' => 'galleryImage']);

    // Volunteer Applications Management
    Route::post('/volunteers/{volunteer}/toggle-status', [VolunteerController::class, 'toggleStatus'])->name('volunteers.toggle-status');
    Route::resource('volunteers', VolunteerController::class)->only(['index', 'show', 'destroy']);

    // Admin Profile & Account Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Organization & System Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Rich Text Editor Media Upload Endpoint
    Route::post('/editor/upload', [EditorUploadController::class, 'upload'])->name('editor.upload');
});
