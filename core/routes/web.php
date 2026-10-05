<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('sign_up/', [AuthController::class, "signup"])->name("signup");
Route::post('register/', [AuthController::class, "register"])->name("register");
Route::get('sign_in/', [AuthController::class, 'signin'])->name('signin');
Route::post('login/', [AuthController::class, 'login'])->name('login');
Route::post('logout/', [AuthController::class, 'logout'])->name('logout');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
