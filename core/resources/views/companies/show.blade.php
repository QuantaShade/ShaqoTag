<x-layout :title="$company->name">
    <section class="mx-auto max-w-4xl px-6 py-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('companies.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Companies</a>
            <div class="flex items-center gap-2">
                <a href="{{ route('companies.edit', $company) }}" class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-blue-50">
                    Edit Company
                </a>
                <form action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this company?');">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-50">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-xl bg-blue-600 text-2xl font-bold text-white">
                    {{ strtoupper(substr($company->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
                    <p class="mt-1 text-sm text-gray-500">{{ $company->location ?? 'Location not specified' }}</p>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 border-t border-b border-gray-100 py-4 text-sm">
                <div>
                    <span class="text-xs text-gray-500">Email Address</span>
                    <p class="font-medium text-gray-900">{{ $company->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-xs text-gray-500">Website URL</span>
                    @if($company->website)
                        <p><a href="{{ $company->website }}" target="_blank" class="font-medium text-blue-600 hover:underline">{{ $company->website }} &nearr;</a></p>
                    @else
                        <p class="font-medium text-gray-900">N/A</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-base font-bold text-gray-900">About {{ $company->name }}</h3>
                <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">{{ $company->description ?? 'No detailed description available.' }}</p>
            </div>
        </div>
    </section>
</x-layout>
