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

        // Keep showing legacy applications while using user relationships for new submissions.
        $myApplications = JobApplication::where('user_id', $user->id)
            ->orWhere(function ($query) use ($user) {
                $query->whereNull('user_id')
                    ->where('applicant_email', $user->email);
            })
            ->with('job')
            ->latest()
            ->get();

        // Reviews received by this freelancer
        $myReviews = Review::where('user_id', $user->id)
            ->with(['job', 'reviewer'])
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
