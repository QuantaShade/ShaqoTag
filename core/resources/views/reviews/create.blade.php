<x-layout title="Add Review">
    <section class="mx-auto max-w-2xl px-6 py-8">
        <a href="{{ route('reviews.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Reviews</a>
        
        <h1 class="mt-4 text-2xl font-bold text-gray-900">Add New Review</h1>
        <p class="mt-1 text-sm text-gray-500">Provide feedback for a job post.</p>

        <form action="{{ route('reviews.store') }}" method="POST" class="mt-6 space-y-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Select Job Post *</label>
                <select name="job_id" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                    <option value="">Select a Job</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job->id }}" @selected(old('job_id', $selectedJobId ?? '') == $job->id)>
                            {{ $job->title }}
                        </option>
                    @endforeach
                </select>
                @error('job_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Reviewer Name *</label>
                    <input type="text" name="reviewer_name" value="{{ old('reviewer_name') }}" required placeholder="e.g. Jane Smith"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('reviewer_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Rating (1 to 5) *</label>
                    <select name="rating" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                        <option value="5" @selected(old('rating', 5) == 5)>5 Stars - Excellent</option>
                        <option value="4" @selected(old('rating') == 4)>4 Stars - Very Good</option>
                        <option value="3" @selected(old('rating') == 3)>3 Stars - Average</option>
                        <option value="2" @selected(old('rating') == 2)>2 Stars - Poor</option>
                        <option value="1" @selected(old('rating') == 1)>1 Star - Terrible</option>
                    </select>
                    @error('rating') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Review Comments *</label>
                <textarea name="comment" rows="4" required placeholder="Describe your experience working on this job..."
                          class="mt-1 w-full rounded-lg border border-gray-300 p-4 text-sm outline-none focus:border-blue-500">{{ old('comment') }}</textarea>
                @error('comment') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('reviews.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Save Review</button>
            </div>
        </form>
    </section>
</x-layout>
