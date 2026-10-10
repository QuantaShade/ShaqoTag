<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::with(['job', 'reviewer', 'user']);

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('reviewer_name', 'like', "%{$search}%")
                    ->orWhereHas('reviewer', fn ($reviewer) => $reviewer->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('user', fn ($user) => $user->where('name', 'like', "%{$search}%"))
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
        $this->authorizeClient();

        $selectedJobId = $request->input('job_id');
        $applications = $this->reviewableApplications(null, $selectedJobId);
        $selectedApplicationId = $request->input('application_id');
        if (! $selectedApplicationId && $applications->count() === 1) {
            $selectedApplicationId = $applications->first()->id;
        }

        return view('reviews.create', compact('applications', 'selectedJobId', 'selectedApplicationId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeClient();

        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                Rule::exists('job_applications', 'id'),
                Rule::unique('reviews', 'application_id'),
            ],
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $application = $this->reviewableApplications()
            ->firstWhere('id', $validated['application_id']);

        abort_unless($application, 403);

        $review = Review::create([
            'application_id' => $application->id,
            'job_id' => $application->job_id,
            'reviewer_id' => auth()->id(),
            'user_id' => $application->user_id,
            'reviewer_name' => auth()->user()->name,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('reviews.show', $review)->with('success', 'Review added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['job', 'application', 'reviewer', 'user']);

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $this->authorizeReviewManagement($review);

        $applications = $this->reviewableApplications($review);

        return view('reviews.edit', compact('review', 'applications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $this->authorizeReviewManagement($review);

        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                Rule::exists('job_applications', 'id'),
                Rule::unique('reviews', 'application_id')->ignore($review->id),
            ],
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $application = $this->reviewableApplications($review)
            ->firstWhere('id', $validated['application_id']);

        abort_unless($application, 403);

        $review->update([
            'application_id' => $application->id,
            'job_id' => $application->job_id,
            'user_id' => $application->user_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('reviews.show', $review)->with('success', 'Review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $this->authorizeReviewManagement($review);

        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
    }

    private function authorizeClient(): void
    {
        abort_unless(auth()->user()->isClient(), 403);
    }

    private function authorizeReviewManagement(Review $review): void
    {
        abort_unless(
            auth()->user()->isClient() && $review->reviewer_id === auth()->id(),
            403
        );
    }

    private function reviewableApplications(?Review $currentReview = null, ?int $jobId = null)
    {
        return JobApplication::query()
            ->with(['job', 'user'])
            ->whereNotNull('user_id')
            ->whereHas('job', fn ($job) => $job->where('user_id', auth()->id()))
            ->when($jobId, fn ($query) => $query->where('job_id', $jobId))
            ->where(function ($query) use ($currentReview) {
                $query->whereDoesntHave('review');

                if ($currentReview) {
                    $query->orWhere('id', $currentReview->application_id);
                }
            })
            ->orderBy('job_id')
            ->get();
    }
}
