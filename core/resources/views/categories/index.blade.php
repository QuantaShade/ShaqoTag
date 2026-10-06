<x-layout title="Categories">
    <section class="mx-auto max-w-7xl px-6 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-blue-600">Taxonomy</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Job Categories</h1>
                <p class="mt-1 text-sm text-gray-500">Manage categories used to organize job postings.</p>
            </div>
            <div>
                <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    + Add Category
                </a>
            </div>
        </div>

        <form action="{{ route('categories.index') }}" method="GET" class="mt-6 flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:flex-row">
            <input type="search" name="q" value="{{ request('q') }}"
                   placeholder="Search category name or description..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                Search
            </button>
        </form>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($categories as $cat)
                <div class="flex flex-col justify-between rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:border-blue-200">
                    <div>
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900">
                                <a href="{{ route('categories.show', $cat) }}" class="hover:text-blue-600">{{ $cat->name }}</a>
                            </h3>
                            <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                {{ $cat->jobs_count }} Jobs
                            </span>
                        </div>
                        <p class="mt-1 text-xs text-gray-400 font-mono">slug: {{ $cat->slug }}</p>
                        <p class="mt-3 text-sm text-gray-600 line-clamp-3">
                            {{ $cat->description ?? 'No description provided.' }}
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2 border-t border-gray-100 pt-4">
                        <a href="{{ route('categories.show', $cat) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">View Jobs</a>
                        <a href="{{ route('categories.edit', $cat) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50">Edit</a>
                        <form action="{{ route('categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-xl border border-dashed border-gray-300 p-12 text-center">
                    <h3 class="text-base font-semibold text-gray-900">No categories found</h3>
                    <p class="mt-1 text-sm text-gray-500">Create a category to organize jobs.</p>
                    <a href="{{ route('categories.create') }}" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline">+ Add Category</a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </section>
</x-layout>
