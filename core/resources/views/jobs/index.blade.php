<x-layout title="Browse Jobs">
    <section class="mx-auto max-w-7xl px-6 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-blue-600">Opportunities</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Job Posts</h1>
                <p class="mt-1 text-sm text-gray-500">Explore or publish freelance and full-time job openings.</p>
            </div>
            <div>
                <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    + Post New Job
                </a>
            </div>
        </div>

        <form action="{{ route('jobs.index') }}" method="GET" class="mt-6 flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-4 shadow-sm md:flex-row">
            <input type="search" name="q" value="{{ request('q') }}"
                   placeholder="Search job title or description..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

            <select name="category" class="rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500">
                <option value="">All Statuses</option>
                <option value="open" @selected(request('status') === 'open')>Open</option>
                <option value="in_progress" @selected(request('status') === 'in_progress')>In Progress</option>
                <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                <option value="closed" @selected(request('status') === 'closed')>Closed</option>
            </select>

            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                Search
            </button>
        </form>

        <div class="mt-6 flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700">Showing {{ $jobs->total() }} Job Posts</span>
        </div>

        <div class="mt-4 grid gap-4">
            @forelse ($jobs as $job)
                <article class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow">
                    <div class="flex flex-col justify-between gap-4 sm:flex-row">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 font-bold text-blue-600">
                                {{ strtoupper(substr($job->title, 0, 2)) }}
                            </div>
                            <div>
                                <a href="{{ route('jobs.show', $job) }}" class="text-lg font-semibold text-gray-900 hover:text-blue-600">
                                    {{ $job->title }}
                                </a>
                                <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                                    <span class="rounded bg-blue-50 px-2 py-0.5 font-medium text-blue-700">
                                        {{ $job->category?->name ?? 'Uncategorized' }}
                                    </span>
                                    <span>•</span>
                                    <span class="capitalize">{{ $job->type }} Contract</span>
                                    <span>•</span>
                                    <span class="rounded px-2 py-0.5 text-xs font-semibold {{ $job->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                    <span>•</span>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit($job->description, 180) }}
                                </p>
                            </div>
                        </div>
                        <div class="flex sm:flex-col items-end justify-between gap-2 border-t border-gray-100 pt-3 sm:border-0 sm:pt-0">
                            <p class="text-lg font-bold text-gray-900">${{ number_format($job->budget, 2) }}</p>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('jobs.show', $job) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">View</a>
                                @if (auth()->user()->isClient() && auth()->id() === $job->user_id)
                                    <a href="{{ route('jobs.edit', $job) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50">Edit</a>
                                    <form action="{{ route('jobs.destroy', $job) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-xl border border-dashed border-gray-300 p-12 text-center">
                    <h3 class="text-base font-semibold text-gray-900">No jobs found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new job post.</p>
                    <a href="{{ route('jobs.create') }}" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline">+ Post New Job</a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $jobs->links() }}
        </div>
    </section>
</x-layout>