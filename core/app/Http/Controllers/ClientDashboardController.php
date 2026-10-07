<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Only this client's job posts
        $myJobs = Job::where('user_id', $user->id)
            ->with('category')
            ->latest()
            ->get();

        $myJobIds = $myJobs->pluck('id');

        // Applications received on this client's jobs
        $recentApplications = JobApplication::whereIn('job_id', $myJobIds)
            ->with('job')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_jobs' => $myJobs->count(),
            'open_jobs' => $myJobs->where('status', 'open')->count(),
            'total_budget' => $myJobs->sum('budget'),
            'total_applications' => JobApplication::whereIn('job_id', $myJobIds)->count(),
            'pending_applications' => JobApplication::whereIn('job_id', $myJobIds)->where('status', 'pending')->count(),
            'accepted_applications' => JobApplication::whereIn('job_id', $myJobIds)->where('status', 'accepted')->count(),
        ];

        return view('dashboard.client', compact('stats', 'myJobs', 'recentApplications'));
    }
}
