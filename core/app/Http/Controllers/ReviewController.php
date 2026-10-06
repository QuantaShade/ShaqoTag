<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::with('job');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('reviewer_name', 'like', "%{$search}%")
                    ->orWhere('comment', 'like', "%{$search}%");
            });
        }

        if ($request->filled('rating')) {
            $query->where('rating', $request->input('rating'));
        }

        $reviews = $query->latest()->paginate(10)->withQueryString();

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jobs = Job::orderBy('title')->get();
        $selectedJobId = $request->input('job_id');

        return view('reviews.create', compact('jobs', 'selectedJobId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:job_posts,id',
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review = Review::create($validated);

        return redirect()->route('reviews.show', $review)->with('success', 'Review added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load('job');

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $jobs = Job::orderBy('title')->get();

        return view('reviews.edit', compact('review', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'job_id' => 'required|exists:job_posts,id',
            'reviewer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $review->update($validated);

        return redirect()->route('reviews.show', $review)->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
    }
}
