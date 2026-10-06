<x-layout title="Add Company">
    <section class="mx-auto max-w-2xl px-6 py-8">
        <a href="{{ route('companies.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Companies</a>
        
        <h1 class="mt-4 text-2xl font-bold text-gray-900">Add New Company</h1>
        <p class="mt-1 text-sm text-gray-500">Create a company profile.</p>

        <form action="{{ route('companies.store') }}" method="POST" class="mt-6 space-y-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Company Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Acme Corporation"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="contact@acme.com"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                    @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Website URL</label>
                    <input type="url" name="website" value="{{ old('website') }}" placeholder="https://acme.com"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                    @error('website') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. San Francisco, CA"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                @error('location') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" placeholder="Overview of company services and culture..."
                          class="mt-1 w-full rounded-lg border border-gray-300 p-4 text-sm outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('companies.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Save Company</button>
            </div>
        </form>
    </section>
</x-layout>
