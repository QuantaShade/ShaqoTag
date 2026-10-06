<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::with('category');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->input('category'))
                    ->orWhere('id', $request->input('category'));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('jobs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'type' => 'required|in:fixed,hourly',
            'status' => 'required|in:draft,open,in_progress,completed,cancelled,closed',
            'skills' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'workplace_type' => 'required|in:remote,onsite,hybrid',
            'deadline' => 'nullable|date',
        ]);

        $userId = auth()->id() ?? User::first()?->id ?? 1;

        // Process skills string to array
        $skillsArray = [];
        if (! empty($validated['skills'])) {
            $skillsArray = array_map('trim', explode(',', $validated['skills']));
        }

        $job = Job::create([
            'user_id' => $userId,
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'budget' => $validated['budget'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'skills' => $skillsArray,
            'location' => $validated['location'] ?? null,
            'workplace_type' => $validated['workplace_type'] ?? 'remote',
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Job post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load(['category', 'client', 'applications', 'reviews']);

        return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $categories = Category::orderBy('name')->get();

        return view('jobs.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'type' => 'required|in:fixed,hourly',
            'status' => 'required|in:draft,open,in_progress,completed,cancelled,closed',
            'skills' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'workplace_type' => 'required|in:remote,onsite,hybrid',
            'deadline' => 'nullable|date',
        ]);

        $skillsArray = [];
        if (! empty($validated['skills'])) {
            $skillsArray = array_map('trim', explode(',', $validated['skills']));
        }

        $job->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'budget' => $validated['budget'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'skills' => $skillsArray,
            'location' => $validated['location'] ?? null,
            'workplace_type' => $validated['workplace_type'] ?? 'remote',
            'deadline' => $validated['deadline'] ?? null,
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Job post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job post deleted successfully!');
    }
}
