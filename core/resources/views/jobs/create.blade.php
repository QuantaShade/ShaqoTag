<x-layout title="Post New Job">
    <section class="mx-auto max-w-3xl px-6 py-8">
        <a href="{{ route('jobs.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Jobs</a>
        
        <h1 class="mt-4 text-2xl font-bold text-gray-900">Post a New Job</h1>
        <p class="mt-1 text-sm text-gray-500">Fill in the details below to create a new job posting.</p>

        <form action="{{ route('jobs.store') }}" method="POST" class="mt-6 space-y-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Job Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Senior Laravel Developer"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('title') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Category *</label>
                    <select name="category_id" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                        <option value="">Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Budget ($) *</label>
                    <input type="number" step="0.01" name="budget" value="{{ old('budget') }}" required placeholder="1000.00"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('budget') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Type *</label>
                    <select name="type" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                        <option value="fixed" @selected(old('type') === 'fixed')>Fixed Price</option>
                        <option value="hourly" @selected(old('type') === 'hourly')>Hourly Rate</option>
                    </select>
                    @error('type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Workplace Type *</label>
                    <select name="workplace_type" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                        <option value="remote" @selected(old('workplace_type') === 'remote')>Remote</option>
                        <option value="onsite" @selected(old('workplace_type') === 'onsite')>On-site</option>
                        <option value="hybrid" @selected(old('workplace_type') === 'hybrid')>Hybrid</option>
                    </select>
                    @error('workplace_type') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                        <option value="open" @selected(old('status', 'open') === 'open')>Open</option>
                        <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                        <option value="in_progress" @selected(old('status') === 'in_progress')>In Progress</option>
                        <option value="completed" @selected(old('status') === 'completed')>Completed</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. San Francisco, CA or Remote"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                @error('location') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Skills (comma separated)</label>
                <input type="text" name="skills" value="{{ old('skills') }}" placeholder="e.g. PHP, Laravel, Tailwind CSS, Vue.js"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                @error('skills') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Job Description *</label>
                <textarea name="description" rows="6" required placeholder="Describe the responsibilities and requirements..."
                          class="mt-1 w-full rounded-lg border border-gray-300 p-4 text-sm outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('jobs.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Save & Publish Job</button>
            </div>
        </form>
    </section>
</x-layout>
