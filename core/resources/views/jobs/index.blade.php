<x-layout title="Browse Jobs">

    <section class="mx-auto max-w-7xl px-6 py-12">
        <div>
            <p class="text-sm font-medium text-blue-600">Opportunities</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight">Find your next project</h1>
            <p class="mt-2 text-sm text-gray-500">
                Discover freelance jobs that match your skills.
            </p>
        </div>

        <form action="{{ route('jobs.index') }}" method="GET"
              class="mt-8 flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-4 shadow-sm md:flex-row">
            <input type="search" name="q" value="{{ request('q') }}"
                   placeholder="Search jobs, skills, or keywords..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-200 px-4 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

            <select name="category"
                    class="rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm text-gray-700 outline-none focus:border-blue-500">
                <option value="">All categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}" @selected(request('category') === $category)>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <button class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                Search
            </button>
        </form>

        <div class="mt-8 flex items-center justify-between">
            <h2 class="font-semibold">Available jobs</h2>
            <span class="text-sm text-gray-500">{{ $jobs->total() }} results</span>
        </div>

        <div class="mt-5 grid gap-4">
            @forelse ($jobs as $job)
                <article class="rounded-xl border border-gray-200 bg-white p-5 transition hover:border-gray-300 hover:shadow-sm sm:p-6">
                    <div class="flex flex-col justify-between gap-5 sm:flex-row">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gray-950 text-sm font-bold text-white">
                                {{ strtoupper(substr($job->title, 0, 2)) }}
                            </div>

                            <div class="min-w-0">
                                <a href="{{ route('jobs.show', $job->id) }}"
                                   class="font-semibold text-gray-950 hover:text-blue-600">
                                    {{ $job->title }}
                                </a>

                                <div class="mt-2 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                                    <span class="rounded-md bg-blue-50 px-2.5 py-1 font-medium text-blue-700">
                                        {{ $job->category->name }}
                                    </span>
                                    <span>•</span>
                                    <span>Remote</span>
                                    <span>•</span>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>

                                <p class="mt-3 max-w-2xl text-sm leading-6 text-gray-600">
                                    {{ Str::limit($job->description, 160) }}
                                </p>

                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach (collect($job->skills)->take(4) as $skill)
                                        <span class="rounded-md border border-gray-200 px-2.5 py-1 text-xs text-gray-600">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex shrink-0 items-center justify-between gap-4 border-t border-gray-100 pt-4 sm:flex-col sm:items-end sm:border-0 sm:pt-0">
                            <div class="sm:text-right">
                                <p class="text-xs text-gray-500">Budget</p>
                                <p class="mt-1 font-bold">${{ number_format($job->budget, 2) }}</p>
                            </div>
                            <a href="{{ route('jobs.show', $job->id) }}"
                               class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">
                                View details →
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-dashed border-gray-300 px-6 py-16 text-center">
                    <h3 class="font-semibold">No jobs found</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Try changing your search or category.
                    </p>
                    <a href="{{ route('jobs.index') }}"
                       class="mt-5 inline-block text-sm font-semibold text-blue-600">
                        Clear filters
                    </a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </section>

</x-layout>