<x-layout :title="$job->title">
    <article class="mx-auto max-w-5xl px-6 py-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('jobs.index') }}" class="text-sm font-medium text-blue-600 hover:underline">
                &larr; Back to jobs
            </a>
            @if (auth()->user()->isClient() && auth()->id() === $job->user_id)
                <div class="flex items-center gap-2">
                    <a href="{{ route('jobs.edit', $job) }}" class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-blue-50">
                        Edit Job
                    </a>
                    <form action="{{ route('jobs.destroy', $job) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-50">
                            Delete Job
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="mt-6 border-b border-gray-200 pb-6">
            <div class="flex items-center gap-3">
                <span class="rounded bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    {{ $job->category?->name ?? 'Uncategorized' }}
                </span>
                <span class="rounded bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 capitalize">
                    {{ $job->status }}
                </span>
            </div>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-gray-900">{{ $job->title }}</h1>
            <p class="mt-2 text-sm text-gray-500">
                Posted by {{ $job->client?->name ?? 'Anonymous Client' }} · {{ $job->created_at->diffForHumans() }}
            </p>
        </div>

        <div class="grid gap-10 py-8 md:grid-cols-[minmax(0,1fr)_18rem]">
            <section class="space-y-8">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Job Description</h2>
                    <p class="mt-3 whitespace-pre-line text-sm leading-7 text-gray-700">{{ $job->description }}</p>
                </div>

                @if(!empty($job->skills) && is_array($job->skills))
                    <div>
                        <h2 class="text-sm font-bold text-gray-900">Required Skills</h2>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($job->skills as $skill)
                                <span class="rounded-md border border-gray-200 bg-white px-3 py-1 text-xs font-medium text-gray-700">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Job Applications Section -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900">Applications ({{ $job->applications->count() }})</h2>
                        <a href="{{ route('applications.create', ['job_id' => $job->id]) }}" class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700">
                            Apply for Job
                        </a>
                    </div>
                    <div class="mt-4 space-y-3">
                        @forelse ($job->applications as $app)
                            <div class="rounded-lg border border-gray-200 bg-white p-4 text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-900">{{ $app->applicant_name }}</span>
                                    <span class="rounded px-2 py-0.5 text-xs font-semibold bg-gray-100 text-gray-700 capitalize">{{ $app->status }}</span>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">{{ $app->applicant_email }} · Expected: ${{ number_format($app->expected_salary ?? 0, 2) }}</p>
                                <p class="mt-2 text-gray-600 text-xs italic">"{{ Str::limit($app->cover_letter, 120) }}"</p>
                            </div>
                        @empty
                            <p class="text-xs text-gray-500 italic">No applications submitted yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900">Reviews & Ratings ({{ $job->reviews->count() }})</h2>
                        @if (auth()->user()->isClient() && auth()->id() === $job->user_id)
                            <a href="{{ route('reviews.create', ['job_id' => $job->id]) }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                + Review an Applicant
                            </a>
                        @endif
                    </div>
                    <div class="mt-4 space-y-3">
                        @forelse ($job->reviews as $rev)
                            <div class="rounded-lg border border-gray-200 bg-white p-4 text-sm">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-900">{{ $rev->reviewer?->name ?? $rev->reviewer_name }}</span>
                                    <span class="font-bold text-amber-500">★ {{ $rev->rating }}/5</span>
                                </div>
                                @if ($rev->user)
                                    <p class="mt-1 text-xs text-gray-500">Freelancer: {{ $rev->user->name }}</p>
                                @endif
                                <p class="mt-2 text-xs text-gray-600">{{ $rev->comment }}</p>
                            </div>
                        @empty
                            <p class="text-xs text-gray-500 italic">No reviews added yet.</p>
                        @endforelse
                    </div>
                </div>
            </section>

            <aside class="h-fit rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Budget</p>
                <p class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($job->budget, 2) }}</p>
                
                <hr class="my-4 border-gray-100">

                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-xs text-gray-500">Contract Type</span>
                        <p class="font-medium text-gray-900 capitalize">{{ $job->type }} Contract</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Workplace</span>
                        <p class="font-medium text-gray-900 capitalize">{{ $job->workplace_type ?? 'Remote' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-gray-500">Location</span>
                        <p class="font-medium text-gray-900">{{ $job->location ?? 'Not specified' }}</p>
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    <a href="{{ route('applications.create', ['job_id' => $job->id]) }}" class="block w-full text-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                        Apply Now
                    </a>
                </div>
            </aside>
        </div>
    </article>
</x-layout>