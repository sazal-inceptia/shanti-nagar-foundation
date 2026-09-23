<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/donations', [HomeController::class, 'donations']);
Route::get('/donation-details', [HomeController::class, 'donationDetails']);
Route::get('/events', [HomeController::class, 'events']);
Route::get('/event-details', [HomeController::class, 'eventDetails']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/blog-details', [HomeController::class, 'blogDetails']);
