<x-layout title="Dashboard Overview">
    <style>
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 15px rgba(59, 130, 246, 0.25); }
            50% { box-shadow: 0 0 25px rgba(59, 130, 246, 0.45); }
        }
        @keyframes floatEffect {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
        }
        .animate-slide-up {
            animation: slideUpFade 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .animate-float {
            animation: floatEffect 4s ease-in-out infinite;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(229, 231, 235, 0.8);
        }
        .stat-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card-hover:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.08);
        }
    </style>

    <div class="mx-auto max-w-7xl px-6 py-8">
        <!-- Hero Header -->
        <div class="animate-slide-up relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-900 via-indigo-900 to-slate-900 p-8 text-white shadow-xl">
            <div class="absolute -right-10 -top-10 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl"></div>
            <div class="absolute -bottom-10 right-20 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-blue-200 backdrop-blur-md">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Platform Overview & Analytics
                    </div>
                    <h1 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">
                        Welcome to ShaqoTag Dashboard
                    </h1>
                    <p class="mt-2 text-sm text-blue-100/80 max-w-xl">
                        Manage your job marketplace operations, candidate applications, company profiles, and client feedback seamlessly.
                    </p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:bg-blue-500 hover:scale-105 active:scale-95">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Post New Job
                    </a>
                    <a href="{{ route('applications.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/20 hover:scale-105 active:scale-95">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Submit Application
                    </a>
                </div>
            </div>
        </div>

        <!-- Metric Stat Cards -->
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Jobs Stat Card -->
            <div class="stat-card-hover glass-card rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Active Jobs</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <p class="text-3xl font-black text-gray-900">{{ $stats['jobs'] }}</p>
                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">
                        {{ $stats['open_jobs'] }} Open
                    </span>
                </div>
                <div class="mt-3 border-t border-gray-100 pt-3">
                    <a href="{{ route('jobs.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View all jobs &rarr;</a>
                </div>
            </div>

            <!-- Categories Stat Card -->
            <div class="stat-card-hover glass-card rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Job Categories</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <p class="text-3xl font-black text-gray-900">{{ $stats['categories'] }}</p>
                    <span class="text-xs text-gray-500 font-medium">Classifications</span>
                </div>
                <div class="mt-3 border-t border-gray-100 pt-3">
                    <a href="{{ route('categories.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">Manage categories &rarr;</a>
                </div>
            </div>

            <!-- Applications Stat Card -->
            <div class="stat-card-hover glass-card rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Applications</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <p class="text-3xl font-black text-gray-900">{{ $stats['applications'] }}</p>
                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">
                        {{ $stats['pending_applications'] }} Pending
                    </span>
                </div>
                <div class="mt-3 border-t border-gray-100 pt-3">
                    <a href="{{ route('applications.index') }}" class="text-xs font-semibold text-purple-600 hover:text-purple-700">Review applications &rarr;</a>
                </div>
            </div>

            @if (auth()->user()->isClient())
                <!-- Companies & Reviews Stat Card -->
                <div class="stat-card-hover glass-card rounded-2xl p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Companies & Reviews</span>
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-baseline justify-between">
                        <div>
                            <p class="text-3xl font-black text-gray-900">{{ $stats['companies'] }}</p>
                            <span class="text-xs text-gray-500 font-medium">Companies</span>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-amber-500">★ {{ $stats['avg_rating'] }}</p>
                            <span class="text-xs text-gray-500 font-medium">{{ $stats['reviews'] }} Reviews</span>
                        </div>
                    </div>
                    <div class="mt-3 border-t border-gray-100 pt-3 flex justify-between text-xs font-semibold">
                        <a href="{{ route('companies.index') }}" class="text-blue-600 hover:underline">Companies</a>
                        <a href="{{ route('reviews.index') }}" class="text-amber-600 hover:underline">Reviews &rarr;</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Action Shortcut Cards Bar -->
        <div class="mt-8 rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm">
            <h2 class="text-xs font-extrabold uppercase tracking-wider text-gray-400">Quick Resource Management</h2>
            <div class="mt-4 grid gap-3 sm:grid-cols-2 md:grid-cols-5">
                <a href="{{ route('jobs.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5 transition hover:border-blue-300 hover:bg-blue-50/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-white shadow-sm transition group-hover:scale-110">
                        +
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900 group-hover:text-blue-600">Post Job</p>
                        <p class="text-[11px] text-gray-500">New job listing</p>
                    </div>
                </a>

                <a href="{{ route('categories.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5 transition hover:border-indigo-300 hover:bg-indigo-50/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white shadow-sm transition group-hover:scale-110">
                        +
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900 group-hover:text-indigo-600">Add Category</p>
                        <p class="text-[11px] text-gray-500">Taxonomy item</p>
                    </div>
                </a>

                @if (auth()->user()->isClient())
                    <a href="{{ route('companies.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5 transition hover:border-sky-300 hover:bg-sky-50/50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-600 text-white shadow-sm transition group-hover:scale-110">
                            +
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-sky-600">Add Company</p>
                            <p class="text-[11px] text-gray-500">Employer profile</p>
                        </div>
                    </a>
                @endif

                <a href="{{ route('applications.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5 transition hover:border-purple-300 hover:bg-purple-50/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-600 text-white shadow-sm transition group-hover:scale-110">
                        +
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900 group-hover:text-purple-600">Apply for Job</p>
                        <p class="text-[11px] text-gray-500">Candidate proposal</p>
                    </div>
                </a>

                <a href="{{ route('reviews.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50/60 p-3.5 transition hover:border-amber-300 hover:bg-amber-50/50">
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500 text-white shadow-sm transition group-hover:scale-110">
                        +
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-900 group-hover:text-amber-600">Write Review</p>
                        <p class="text-[11px] text-gray-500">Feedback entry</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Main Dashboard Content Grid -->
        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            <!-- Left Column (2 cols wide on desktop) -->
            <div class="space-y-8 lg:col-span-2">
                <!-- Recent Job Postings -->
                <div class="rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Recent Job Posts</h2>
                            <p class="text-xs text-gray-500">Latest active postings on ShaqoTag</p>
                        </div>
                        <a href="{{ route('jobs.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">View All Jobs &rarr;</a>
                    </div>

                    <div class="mt-4 divide-y divide-gray-100">
                        @forelse ($recentJobs as $job)
                            <div class="flex items-center justify-between py-4 transition hover:bg-gray-50/50 px-2 rounded-xl">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 font-bold text-blue-600 text-xs">
                                        {{ strtoupper(substr($job->title, 0, 2)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('jobs.show', $job) }}" class="font-semibold text-gray-900 text-sm hover:text-blue-600">
                                            {{ $job->title }}
                                        </a>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 mt-0.5">
                                            <span class="text-blue-600 font-medium">{{ $job->category?->name }}</span>
                                            <span>•</span>
                                            <span class="capitalize">{{ $job->type }}</span>
                                            <span>•</span>
                                            <span>{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900 text-sm">${{ number_format($job->budget, 2) }}</p>
                                    <span class="rounded bg-green-50 px-2 py-0.5 text-[11px] font-semibold text-green-700 capitalize">
                                        {{ $job->status }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="py-6 text-center text-xs text-gray-500">No jobs posted yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Applications Table -->
                <div class="rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Recent Candidate Applications</h2>
                            <p class="text-xs text-gray-500">Latest proposals submitted for review</p>
                        </div>
                        <a href="{{ route('applications.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">View All &rarr;</a>
                    </div>

                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-left text-xs">
                            <thead class="bg-gray-50/50 text-gray-500 uppercase font-semibold">
                                <tr>
                                    <th class="px-3 py-2.5">Candidate</th>
                                    <th class="px-3 py-2.5">Job Title</th>
                                    <th class="px-3 py-2.5">Salary Bid</th>
                                    <th class="px-3 py-2.5 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($recentApplications as $app)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-3 py-3">
                                            <a href="{{ route('applications.show', $app) }}" class="font-semibold text-gray-900 hover:text-blue-600">
                                                {{ $app->applicant_name }}
                                            </a>
                                            <div class="text-[11px] text-gray-400">{{ $app->applicant_email }}</div>
                                        </td>
                                        <td class="px-3 py-3 font-medium text-gray-700">
                                            {{ Str::limit($app->job?->title ?? 'N/A', 25) }}
                                        </td>
                                        <td class="px-3 py-3 font-bold text-gray-900">
                                            ${{ number_format($app->expected_salary ?? 0, 2) }}
                                        </td>
                                        <td class="px-3 py-3 text-right">
                                            @php
                                                $statusClass = match($app->status) {
                                                    'accepted' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'reviewed' => 'bg-blue-100 text-blue-800',
                                                    default => 'bg-amber-100 text-amber-800',
                                                };
                                            @endphp
                                            <span class="rounded px-2 py-0.5 text-[11px] font-bold capitalize {{ $statusClass }}">
                                                {{ $app->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-xs text-gray-500">No applications received yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-8">
                <!-- Top Job Categories Card -->
                <div class="rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <h2 class="text-base font-bold text-gray-900">Top Categories</h2>
                        <a href="{{ route('categories.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">All &rarr;</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse ($topCategories as $cat)
                            <div>
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-gray-900">{{ $cat->name }}</span>
                                    <span class="text-gray-500">{{ $cat->jobs_count }} Jobs</span>
                                </div>
                                <div class="mt-1.5 h-2 w-full overflow-hidden rounded-full bg-gray-100">
                                    @php
                                        $percent = $stats['jobs'] > 0 ? min(100, round(($cat->jobs_count / $stats['jobs']) * 100)) : 0;
                                    @endphp
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-500" style="width: {{ max(10, $percent) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <p class="py-4 text-center text-xs text-gray-500">No categories added yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Reviews Feed Card -->
                <div class="rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <h2 class="text-base font-bold text-gray-900">Client & Freelancer Reviews</h2>
                        <a href="{{ route('reviews.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">All &rarr;</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse ($recentReviews as $rev)
                            <div class="rounded-xl border border-gray-100 bg-gray-50/50 p-3.5 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-gray-900">{{ $rev->reviewer?->name ?? $rev->reviewer_name }}</span>
                                    <span class="font-bold text-amber-500">★ {{ $rev->rating }}/5</span>
                                </div>
                                <p class="mt-2 text-gray-600 italic line-clamp-2">"{{ $rev->comment }}"</p>
                            </div>
                        @empty
                            <p class="py-4 text-center text-xs text-gray-500">No reviews submitted yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
