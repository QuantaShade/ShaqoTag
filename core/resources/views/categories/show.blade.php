<x-layout :title="$category->name">
    <section class="mx-auto max-w-5xl px-6 py-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('categories.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Categories</a>
            <div class="flex items-center gap-2">
                <a href="{{ route('categories.edit', $category) }}" class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-blue-50">
                    Edit Category
                </a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-50">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 border-b border-gray-200 pb-6">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $category->name }}</h1>
            <p class="mt-1 text-xs text-gray-400 font-mono">slug: {{ $category->slug }}</p>
            <p class="mt-3 text-sm text-gray-600">{{ $category->description ?? 'No description provided.' }}</p>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Jobs in {{ $category->name }} ({{ $category->jobs->count() }})</h2>
            <div class="grid gap-4">
                @forelse ($category->jobs as $job)
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-blue-200 flex justify-between items-center">
                        <div>
                            <a href="{{ route('jobs.show', $job) }}" class="text-base font-semibold text-gray-900 hover:text-blue-600">
                                {{ $job->title }}
                            </a>
                            <p class="mt-1 text-xs text-gray-500">${{ number_format($job->budget, 2) }} · {{ ucfirst($job->type) }} · Posted {{ $job->created_at->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('jobs.show', $job) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">View Job &rarr;</a>
                    </div>
                @empty
                    <div class="rounded-xl border border-dashed border-gray-300 p-8 text-center">
                        <p class="text-sm text-gray-500">No jobs posted in this category yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>
