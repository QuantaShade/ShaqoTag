<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'jobs' => Job::count(),
            'open_jobs' => Job::where('status', 'open')->count(),
            'categories' => Category::count(),
            'companies' => Company::count(),
            'applications' => JobApplication::count(),
            'pending_applications' => JobApplication::where('status', 'pending')->count(),
            'reviews' => Review::count(),
            'avg_rating' => round(Review::avg('rating') ?? 0, 1),
            'total_budget' => Job::where('status', 'open')->sum('budget'),
        ];

        $recentJobs = Job::with('category')->latest()->take(5)->get();
        $recentApplications = JobApplication::with('job')->latest()->take(5)->get();
        $recentReviews = Review::with(['job', 'reviewer', 'user'])->latest()->take(4)->get();
        $topCategories = Category::withCount('jobs')->orderByDesc('jobs_count')->take(4)->get();

        return view('dashboard', compact(
            'stats',
            'recentJobs',
            'recentApplications',
            'recentReviews',
            'topCategories'
        ));
    }
}
