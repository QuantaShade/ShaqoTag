<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JobApplication::with('job');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('applicant_name', 'like', "%{$search}%")
                    ->orWhere('applicant_email', 'like', "%{$search}%")
                    ->orWhere('cover_letter', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $applications = $query->latest()->paginate(10)->withQueryString();

        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jobs = Job::orderBy('title')->get();
        $selectedJobId = $request->input('job_id');

        return view('applications.create', compact('jobs', 'selectedJobId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:job_posts,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'cover_letter' => 'required|string',
            'expected_salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $application = JobApplication::create($validated);

        return redirect()->route('applications.show', $application)->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $application)
    {
        $application->load('job');

        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $application)
    {
        $jobs = Job::orderBy('title')->get();

        return view('applications.edit', compact('application', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:job_posts,id',
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email|max:255',
            'cover_letter' => 'required|string',
            'expected_salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $application->update($validated);

        return redirect()->route('applications.show', $application)->with('success', 'Application updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $application)
    {
        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application deleted successfully!');
    }
}
