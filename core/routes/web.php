<?php

use App\Http\Controllers\AuthController;
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

Route::get('/jobs', function () {
    $query = Job::with('category')
        ->where('status', 'open');

    if (request('q')) {
        $search = request('q');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if (request('category')) {
        $query->whereHas('category', function ($q) {
            $q->where('name', request('category'));
        });
    }

    $jobs = $query->latest()->paginate(10)->withQueryString();
    $categories = Category::orderBy('name')->pluck('name');

    return view('jobs.index', compact('jobs', 'categories'));
})->name('jobs.index');

Route::get('/jobs/{job}', function (Job $job) {
    abort_unless($job->status === 'open', 404);

    $job->load(['category', 'client']);

    return view('jobs.show', compact('job'));
})->name('jobs.show');
