<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Category;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        abort_unless($job->status === 'open', 404);

    $job->load(['category', 'client']);

    return view('jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
