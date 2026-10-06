<x-layout title="Edit Category">
    <section class="mx-auto max-w-2xl px-6 py-8">
        <a href="{{ route('categories.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Categories</a>
        
        <h1 class="mt-4 text-2xl font-bold text-gray-900">Edit Category: {{ $category->name }}</h1>
        <p class="mt-1 text-sm text-gray-500">Update category details.</p>

        <form action="{{ route('categories.update', $category) }}" method="POST" class="mt-6 space-y-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                @error('slug') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                          class="mt-1 w-full rounded-lg border border-gray-300 p-4 text-sm outline-none focus:border-blue-500">{{ old('description', $category->description) }}</textarea>
                @error('description') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('categories.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Update Category</button>
            </div>
        </form>
    </section>
</x-layout>
