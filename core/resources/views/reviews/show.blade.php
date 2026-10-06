<x-layout title="Review Details">
    <section class="mx-auto max-w-4xl px-6 py-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('reviews.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Reviews</a>
            <div class="flex items-center gap-2">
                <a href="{{ route('reviews.edit', $review) }}" class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-blue-50">
                    Edit Review
                </a>
                <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-50">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-100 pb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $review->reviewer_name }}</h1>
                    <p class="text-sm text-gray-500">Submitted {{ $review->created_at->diffForHumans() }}</p>
                </div>
                <div class="rounded-lg bg-amber-50 px-4 py-2 text-amber-600 font-bold text-lg">
                    ★ {{ $review->rating }} / 5 Stars
                </div>
            </div>

            <div class="mt-6 border-b border-gray-100 pb-6 text-sm">
                <span class="text-xs text-gray-500">Reviewed Job Post</span>
                @if($review->job)
                    <p class="mt-1"><a href="{{ route('jobs.show', $review->job) }}" class="font-semibold text-blue-600 hover:underline">{{ $review->job->title }} &rarr;</a></p>
                @else
                    <p class="mt-1 font-semibold text-gray-400">N/A</p>
                @endif
            </div>

            <div class="mt-6">
                <h3 class="text-base font-bold text-gray-900">Reviewer Comments</h3>
                <div class="mt-3 rounded-lg bg-gray-50 p-4 text-sm leading-6 text-gray-700 whitespace-pre-line border border-gray-100 italic">
                    "{{ $review->comment }}"
                </div>
            </div>
        </div>
    </section>
</x-layout>
