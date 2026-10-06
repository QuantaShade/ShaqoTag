<x-layout title="Submit Job Application">
    <section class="mx-auto max-w-2xl px-6 py-8">
        <a href="{{ route('applications.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Applications</a>
        
        <h1 class="mt-4 text-2xl font-bold text-gray-900">Submit Job Application</h1>
        <p class="mt-1 text-sm text-gray-500">Apply for an open job post.</p>

        <form action="{{ route('applications.store') }}" method="POST" class="mt-6 space-y-6 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Select Job Post *</label>
                <select name="job_id" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                    <option value="">Select a Job</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job->id }}" @selected(old('job_id', $selectedJobId ?? '') == $job->id)>
                            {{ $job->title }} (${{ number_format($job->budget, 2) }})
                        </option>
                    @endforeach
                </select>
                @error('job_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Applicant Name *</label>
                    <input type="text" name="applicant_name" value="{{ old('applicant_name') }}" required placeholder="e.g. John Doe"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('applicant_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Applicant Email *</label>
                    <input type="email" name="applicant_email" value="{{ old('applicant_email') }}" required placeholder="john@example.com"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                    @error('applicant_email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Expected Salary ($)</label>
                    <input type="number" step="0.01" name="expected_salary" value="{{ old('expected_salary') }}" placeholder="1000.00"
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                    @error('expected_salary') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Status *</label>
                    <select name="status" required class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm outline-none focus:border-blue-500">
                        <option value="pending" @selected(old('status', 'pending') === 'pending')>Pending</option>
                        <option value="reviewed" @selected(old('status') === 'reviewed')>Reviewed</option>
                        <option value="accepted" @selected(old('status') === 'accepted')>Accepted</option>
                        <option value="rejected" @selected(old('status') === 'rejected')>Rejected</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cover Letter *</label>
                <textarea name="cover_letter" rows="5" required placeholder="Explain why you are a great fit for this job post..."
                          class="mt-1 w-full rounded-lg border border-gray-300 p-4 text-sm outline-none focus:border-blue-500">{{ old('cover_letter') }}</textarea>
                @error('cover_letter') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-4">
                <a href="{{ route('applications.index') }}" class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">Submit Application</button>
            </div>
        </form>
    </section>
</x-layout>
