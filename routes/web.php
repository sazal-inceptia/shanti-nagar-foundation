<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/donations', [HomeController::class, 'donations'])->name('donations');
Route::get('/donation-details/{slug?}', [HomeController::class, 'donationDetails'])->name('donation.details');
Route::get('/events', [HomeController::class, 'events'])->name('events');
Route::get('/event-details/{slug?}', [HomeController::class, 'eventDetails'])->name('event.details');
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/blog-details', [HomeController::class, 'blogDetails']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/volunteer', [HomeController::class, 'volunteer']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/donate', [HomeController::class, 'donate']);
Route::get('/gallery', [HomeController::class, 'gallery']);
