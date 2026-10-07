<x-layout title="Client Dashboard">
    <style>
        @keyframes slideUpFade {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes countUp {
            from { opacity: 0; transform: scale(0.8); }
            to   { opacity: 1; transform: scale(1); }
        }
        .anim-1 { animation: slideUpFade .45s ease both; }
        .anim-2 { animation: slideUpFade .55s ease both; }
        .anim-3 { animation: slideUpFade .65s ease both; }
        .anim-4 { animation: slideUpFade .75s ease both; }
        .anim-5 { animation: slideUpFade .85s ease both; }
        .stat-num { animation: countUp .6s cubic-bezier(.16,1,.3,1) both; }
        .card-hover {
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px -8px rgba(0,0,0,.09);
            border-color: #bfdbfe;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/40 to-indigo-50/40">
        <div class="mx-auto max-w-7xl px-6 py-8">

            <!-- Hero Header - Client -->
            <div class="anim-1 relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-900 p-8 text-white shadow-2xl">
                <!-- Decorative glows -->
                <div class="absolute -right-16 -top-16 h-72 w-72 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-10 left-1/3 h-56 w-56 rounded-full bg-blue-400/20 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-blue-100 backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Client Dashboard
                        </div>
                        <h1 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">
                            Welcome, {{ auth()->user()->name }}!
                        </h1>
                        <p class="mt-2 max-w-xl text-sm text-blue-100/80">
                            Manage your job postings, review candidate applications, and track your hiring progress — all in one place.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-blue-700 shadow-lg transition hover:scale-105 hover:shadow-xl active:scale-95">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Post a Job
                        </a>
                        <a href="{{ route('applications.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/20 hover:scale-105 active:scale-95">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            View Applications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="anim-2 mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <!-- My Posted Jobs -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">My Job Posts</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['total_jobs'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        <span class="font-semibold text-emerald-600">{{ $stats['open_jobs'] }} open</span> positions
                    </p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <a href="{{ route('jobs.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">Manage jobs &rarr;</a>
                    </div>
                </div>

                <!-- Total Budget -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Total Budget Posted</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">${{ number_format($stats['total_budget'], 0) }}</p>
                    <p class="mt-1 text-xs text-gray-500">Across all job posts</p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <span class="text-xs text-gray-400">Total value of posted work</span>
                    </div>
                </div>

                <!-- Applications Received -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Applications Received</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50">
                            <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['total_applications'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        <span class="font-semibold text-amber-600">{{ $stats['pending_applications'] }} pending</span> review
                    </p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <a href="{{ route('applications.index') }}" class="text-xs font-semibold text-purple-600 hover:underline">Review all &rarr;</a>
                    </div>
                </div>

                <!-- Accepted Applications -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Accepted Candidates</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-50">
                            <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['accepted_applications'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">Freelancers hired so far</p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <span class="text-xs text-gray-400">Successful hires made</span>
                    </div>
                </div>
            </div>

            <!-- My Jobs Table + Recent Applications -->
            <div class="anim-3 mt-8 grid gap-8 lg:grid-cols-2">

                <!-- My Job Postings -->
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                        <div>
                            <h2 class="text-base font-bold text-gray-900">My Job Posts</h2>
                            <p class="text-xs text-gray-500">Jobs you have created</p>
                        </div>
                        <a href="{{ route('jobs.create') }}" class="rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">+ New Job</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse ($myJobs->take(6) as $job)
                            <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50/60 transition">
                                <div>
                                    <a href="{{ route('jobs.show', $job) }}" class="text-sm font-semibold text-gray-900 hover:text-blue-600">
                                        {{ Str::limit($job->title, 35) }}
                                    </a>
                                    <div class="mt-0.5 flex items-center gap-2 text-xs text-gray-500">
                                        <span class="text-blue-600 font-medium">{{ $job->category?->name }}</span>
                                        <span>·</span>
                                        <span>${{ number_format($job->budget, 0) }}</span>
                                    </div>
                                </div>
                                <div class="flex shrink-0 items-center gap-2">
                                    @php
                                        $sc = match($job->status) {
                                            'open' => 'bg-emerald-100 text-emerald-700',
                                            'in_progress' => 'bg-blue-100 text-blue-700',
                                            'completed' => 'bg-gray-100 text-gray-600',
                                            default => 'bg-amber-100 text-amber-700',
                                        };
                                    @endphp
                                    <span class="rounded px-2 py-0.5 text-[11px] font-bold capitalize {{ $sc }}">{{ $job->status }}</span>
                                    <a href="{{ route('jobs.edit', $job) }}" class="rounded-lg border border-gray-200 px-2 py-1 text-xs text-blue-600 hover:bg-blue-50">Edit</a>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-10 text-center">
                                <p class="text-sm text-gray-500">You have not posted any jobs yet.</p>
                                <a href="{{ route('jobs.create') }}" class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:underline">Post your first job &rarr;</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Applications Received -->
                <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                        <div>
                            <h2 class="text-base font-bold text-gray-900">Applications Received</h2>
                            <p class="text-xs text-gray-500">Candidates who applied to your jobs</p>
                        </div>
                        <a href="{{ route('applications.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">View all &rarr;</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse ($recentApplications as $app)
                            <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50/60 transition">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $app->applicant_name }}</p>
                                    <p class="text-xs text-gray-500">
                                        Applied for: <span class="font-medium text-blue-600">{{ Str::limit($app->job?->title, 28) }}</span>
                                    </p>
                                    <p class="text-xs text-gray-500">Bid: ${{ number_format($app->expected_salary ?? 0, 0) }}</p>
                                </div>
                                <div class="flex shrink-0 items-center gap-2">
                                    @php
                                        $ac = match($app->status) {
                                            'accepted' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'reviewed' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-amber-100 text-amber-800',
                                        };
                                    @endphp
                                    <span class="rounded px-2 py-0.5 text-[11px] font-bold capitalize {{ $ac }}">{{ $app->status }}</span>
                                    <a href="{{ route('applications.edit', $app) }}" class="rounded-lg border border-gray-200 px-2 py-1 text-xs text-blue-600 hover:bg-blue-50">Update</a>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-10 text-center">
                                <p class="text-sm text-gray-500">No applications received yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Quick Actions Bar -->
            <div class="anim-4 mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">Quick Actions</h3>
                <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-4">
                    <a href="{{ route('jobs.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-blue-300 hover:bg-blue-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-white text-lg font-bold transition group-hover:scale-110">+</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-blue-600">Post New Job</p>
                            <p class="text-[11px] text-gray-500">Start hiring today</p>
                        </div>
                    </a>
                    <a href="{{ route('categories.index') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-indigo-300 hover:bg-indigo-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-600 text-white text-lg font-bold transition group-hover:scale-110">☰</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-indigo-600">Browse Categories</p>
                            <p class="text-[11px] text-gray-500">Find talent by skill</p>
                        </div>
                    </a>
                    <a href="{{ route('companies.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-sky-300 hover:bg-sky-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-600 text-white text-lg font-bold transition group-hover:scale-110">🏢</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-sky-600">Add Company</p>
                            <p class="text-[11px] text-gray-500">Set up your profile</p>
                        </div>
                    </a>
                    <a href="{{ route('reviews.index') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-amber-300 hover:bg-amber-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500 text-white text-lg font-bold transition group-hover:scale-110">★</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-amber-600">View Reviews</p>
                            <p class="text-[11px] text-gray-500">Freelancer feedback</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout>
