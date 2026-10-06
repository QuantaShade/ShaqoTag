<x-layout title="Job Applications">
    <section class="mx-auto max-w-7xl px-6 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-sm font-semibold text-blue-600">Submissions</p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-gray-900">Job Applications</h1>
                <p class="mt-1 text-sm text-gray-500">Track and review applications submitted by job candidates.</p>
            </div>
            <div>
                <a href="{{ route('applications.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    + Submit Application
                </a>
            </div>
        </div>

        <form action="{{ route('applications.index') }}" method="GET" class="mt-6 flex flex-col gap-3 rounded-xl border border-gray-200 bg-white p-4 shadow-sm md:flex-row">
            <input type="search" name="q" value="{{ request('q') }}"
                   placeholder="Search applicant name, email, cover letter..."
                   class="min-w-0 flex-1 rounded-lg border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

            <select name="status" class="rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-700 outline-none focus:border-blue-500">
                <option value="">All Statuses</option>
                <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                <option value="reviewed" @selected(request('status') === 'reviewed')>Reviewed</option>
                <option value="accepted" @selected(request('status') === 'accepted')>Accepted</option>
                <option value="rejected" @selected(request('status') === 'rejected')>Rejected</option>
            </select>

            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                Search
            </button>
        </form>

        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-3">Applicant</th>
                        <th class="px-6 py-3">Applied Job</th>
                        <th class="px-6 py-3">Expected Salary</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($applications as $app)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $app->applicant_name }}</div>
                                <div class="text-xs text-gray-500">{{ $app->applicant_email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($app->job)
                                    <a href="{{ route('jobs.show', $app->job) }}" class="font-medium text-blue-600 hover:underline">
                                        {{ $app->job->title }}
                                    </a>
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                ${{ number_format($app->expected_salary ?? 0, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $badgeClasses = match($app->status) {
                                        'accepted' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'reviewed' => 'bg-blue-100 text-blue-800',
                                        default => 'bg-amber-100 text-amber-800',
                                    };
                                @endphp
                                <span class="rounded px-2.5 py-1 text-xs font-bold capitalize {{ $badgeClasses }}">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('applications.show', $app) }}" class="rounded border border-gray-200 px-2.5 py-1 text-xs font-medium text-gray-700 hover:bg-gray-50">View</a>
                                    <a href="{{ route('applications.edit', $app) }}" class="rounded border border-gray-200 px-2.5 py-1 text-xs font-medium text-blue-600 hover:bg-blue-50">Edit</a>
                                    <form action="{{ route('applications.destroy', $app) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded border border-gray-200 px-2.5 py-1 text-xs font-medium text-red-600 hover:bg-red-50">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                No job applications submitted yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $applications->links() }}
        </div>
    </section>
</x-layout>
