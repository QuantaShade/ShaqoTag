<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Public Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Authentication routes (accessible to guests)
Route::middleware('guest')->group(function () {
    Route::get('sign_up/', [AuthController::class, 'signup'])->name('signup');
    Route::post('register/', [AuthController::class, 'register'])->name('register');
    Route::get('sign_in/', [AuthController::class, 'signin'])->name('signin');
    Route::get('login/', [AuthController::class, 'signin'])->name('login');
    Route::post('login/', [AuthController::class, 'login']);
});

// Logout route (requires auth)
Route::post('logout/', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected CRUD & Dashboard routes (Requires Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('jobs', JobController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('applications', JobApplicationController::class);
    Route::resource('reviews', ReviewController::class);
});
