<x-layout title="Companies">
    <section class="mx-auto max-w-7xl px-6 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-blue-600">Employers</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Companies</h1>
                <p class="mt-1 text-sm text-gray-500">Discover and manage registered employer profiles.</p>
            </div>
            <div>
                <a href="{{ route('companies.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    + Add Company
                </a>
            </div>
        </div>

        <form action="{{ route('companies.index') }}" method="GET" class="mt-6 flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-4 shadow-sm sm:flex-row">
            <input type="search" name="q" value="{{ request('q') }}"
                   placeholder="Search company name, location, description..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                Search
            </button>
        </form>

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($companies as $company)
                <div class="flex flex-col justify-between rounded-xl border border-gray-200 bg-white p-6 shadow-sm hover:border-blue-200">
                    <div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600 font-bold text-white text-sm">
                                {{ strtoupper(substr($company->name, 0, 2)) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    <a href="{{ route('companies.show', $company) }}" class="hover:text-blue-600">{{ $company->name }}</a>
                                </h3>
                                <p class="text-xs text-gray-500">{{ $company->location ?? 'Location N/A' }}</p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-600 line-clamp-3">
                            {{ $company->description ?? 'No company overview available.' }}
                        </p>
                        @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="mt-3 inline-block text-xs font-medium text-blue-600 hover:underline">
                                {{ $company->website }} &nearr;
                            </a>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2 border-t border-gray-100 pt-4">
                        <a href="{{ route('companies.show', $company) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">View</a>
                        <a href="{{ route('companies.edit', $company) }}" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-blue-600 hover:bg-blue-50">Edit</a>
                        <form action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                            @csrf
                            @method('DELETE')
                            <button class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full rounded-xl border border-dashed border-gray-300 p-12 text-center">
                    <h3 class="text-base font-semibold text-gray-900">No companies found</h3>
                    <p class="mt-1 text-sm text-gray-500">Add a new company profile to get started.</p>
                    <a href="{{ route('companies.create') }}" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:underline">+ Add Company</a>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $companies->links() }}
        </div>
    </section>
</x-layout>
