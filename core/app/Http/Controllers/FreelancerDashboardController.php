<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Review;

class FreelancerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Freelancer's submitted applications (by email match)
        $myApplications = JobApplication::where('applicant_email', $user->email)
            ->with('job')
            ->latest()
            ->get();

        // Reviews submitted by this freelancer
        $myReviews = Review::where('reviewer_name', $user->name)
            ->with('job')
            ->latest()
            ->get();

        // Latest open jobs available to apply for
        $availableJobs = Job::with('category')
            ->where('status', 'open')
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'total_applications' => $myApplications->count(),
            'pending_applications' => $myApplications->where('status', 'pending')->count(),
            'accepted_applications' => $myApplications->where('status', 'accepted')->count(),
            'rejected_applications' => $myApplications->where('status', 'rejected')->count(),
            'total_reviews' => $myReviews->count(),
            'avg_rating' => $myReviews->count() > 0 ? round($myReviews->avg('rating'), 1) : 0,
            'open_jobs' => Job::where('status', 'open')->count(),
        ];

        return view('dashboard.freelancer', compact('stats', 'myApplications', 'myReviews', 'availableJobs'));
    }
}
