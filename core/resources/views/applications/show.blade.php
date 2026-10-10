<x-layout title="Application Details">
    <section class="mx-auto max-w-4xl px-6 py-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('applications.index') }}" class="text-sm font-medium text-blue-600 hover:underline">&larr; Back to Applications</a>
            <div class="flex items-center gap-2">
                <a href="{{ route('applications.edit', $application) }}" class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-blue-50">
                    Edit Application
                </a>
                <form action="{{ route('applications.destroy', $application) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-red-600 shadow-sm hover:bg-red-50">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-6 rounded-xl border border-gray-200 bg-white p-8 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-100 pb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $application->applicant_name }}</h1>
                    <p class="text-sm text-gray-500">{{ $application->applicant_email }} · Applied {{ $application->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    @php
                        $badgeClasses = match($application->status) {
                            'accepted' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                            'reviewed' => 'bg-blue-100 text-blue-800',
                            default => 'bg-amber-100 text-amber-800',
                        };
                    @endphp
                    <span class="rounded px-3 py-1 text-xs font-bold capitalize {{ $badgeClasses }}">
                        Status: {{ $application->status }}
                    </span>
                </div>
            </div>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 border-b border-gray-100 pb-6 text-sm">
                <div>
                    <span class="text-xs text-gray-500">Applied Job Post</span>
                    @if($application->job)
                        <p class="mt-1"><a href="{{ route('jobs.show', $application->job) }}" class="font-semibold text-blue-600 hover:underline">{{ $application->job->title }} &rarr;</a></p>
                    @else
                        <p class="mt-1 font-semibold text-gray-400">N/A</p>
                    @endif
                </div>
                <div>
                    <span class="text-xs text-gray-500">Expected Salary / Bid</span>
                    <p class="mt-1 font-semibold text-gray-900">${{ number_format($application->expected_salary ?? 0, 2) }}</p>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-base font-bold text-gray-900">Cover Letter</h3>
                <div class="mt-3 rounded-lg bg-gray-50 p-4 text-sm leading-6 text-gray-700 whitespace-pre-line border border-gray-100">
                    {{ $application->cover_letter }}
                </div>
            </div>
        </div>
    </section>
</x-layout>
