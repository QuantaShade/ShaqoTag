<x-layout title="Freelancer Dashboard">
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
        .stat-num { animation: countUp .6s cubic-bezier(.16,1,.3,1) both; }
        .card-hover {
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px -8px rgba(0,0,0,.09);
            border-color: #a5b4fc;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-violet-50/40 to-purple-50/40">
        <div class="mx-auto max-w-7xl px-6 py-8">

            <!-- Hero Header - Freelancer -->
            <div class="anim-1 relative overflow-hidden rounded-3xl bg-gradient-to-r from-violet-700 via-purple-800 to-indigo-900 p-8 text-white shadow-2xl">
                <!-- Decorative glows -->
                <div class="absolute -right-16 -top-16 h-72 w-72 rounded-full bg-purple-400/20 blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-10 left-1/4 h-56 w-56 rounded-full bg-violet-300/20 blur-3xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-purple-100 backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Freelancer Dashboard
                        </div>
                        <h1 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">
                            Hello, {{ auth()->user()->name }}!
                        </h1>
                        <p class="mt-2 max-w-xl text-sm text-purple-100/80">
                            Find new work opportunities, track your applications, manage your reviews, and grow your freelance career.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-violet-700 shadow-lg transition hover:scale-105 hover:shadow-xl active:scale-95">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Browse Jobs
                        </a>
                        <a href="{{ route('applications.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-5 py-3 text-sm font-semibold text-white backdrop-blur-md transition hover:bg-white/20 hover:scale-105 active:scale-95">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="anim-2 mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Total Applications Sent -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Applications Sent</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50">
                            <svg class="h-5 w-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['total_applications'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        <span class="font-semibold text-amber-600">{{ $stats['pending_applications'] }} pending</span> review
                    </p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <a href="{{ route('applications.index') }}" class="text-xs font-semibold text-violet-600 hover:underline">View all &rarr;</a>
                    </div>
                </div>

                <!-- Accepted Proposals -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Accepted Proposals</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['accepted_applications'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        <span class="font-semibold text-red-500">{{ $stats['rejected_applications'] }} rejected</span>
                    </p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <span class="text-xs text-gray-400">Your win rate</span>
                    </div>
                </div>

                <!-- My Reviews -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">My Reviews</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50">
                            <svg class="h-5 w-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['total_reviews'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">
                        @if ($stats['avg_rating'] > 0)
                            <span class="font-bold text-amber-500">★ {{ $stats['avg_rating'] }}</span> avg rating
                        @else
                            No ratings yet
                        @endif
                    </p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <a href="{{ route('reviews.index') }}" class="text-xs font-semibold text-amber-600 hover:underline">View reviews &rarr;</a>
                    </div>
                </div>

                <!-- Available Jobs -->
                <div class="card-hover rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Open Opportunities</span>
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    </div>
                    <p class="stat-num mt-4 text-3xl font-black text-gray-900">{{ $stats['open_jobs'] }}</p>
                    <p class="mt-1 text-xs text-gray-500">Live jobs to apply for</p>
                    <div class="mt-4 border-t border-gray-100 pt-3">
                        <a href="{{ route('jobs.index') }}" class="text-xs font-semibold text-blue-600 hover:underline">Find work &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="anim-3 mt-8 grid gap-8 lg:grid-cols-3">

                <!-- My Application History -->
                <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                        <div>
                            <h2 class="text-base font-bold text-gray-900">My Applications</h2>
                            <p class="text-xs text-gray-500">Proposals you have submitted</p>
                        </div>
                        <a href="{{ route('applications.create') }}" class="rounded-lg bg-violet-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-violet-700">+ Apply</a>
                    </div>
                    <div class="divide-y divide-gray-50">
                        @forelse ($myApplications->take(6) as $app)
                            <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50/60 transition">
                                <div>
                                    <a href="{{ route('applications.show', $app) }}" class="text-sm font-semibold text-gray-900 hover:text-violet-600">
                                        {{ Str::limit($app->job?->title ?? 'N/A', 35) }}
                                    </a>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        Bid: <span class="font-semibold text-gray-700">${{ number_format($app->expected_salary ?? 0, 0) }}</span>
                                        · {{ $app->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="shrink-0">
                                    @php
                                        $ac = match($app->status) {
                                            'accepted' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'reviewed' => 'bg-blue-100 text-blue-800',
                                            default => 'bg-amber-100 text-amber-800',
                                        };
                                    @endphp
                                    <span class="rounded px-2.5 py-1 text-[11px] font-bold capitalize {{ $ac }}">{{ $app->status }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-10 text-center">
                                <p class="text-sm text-gray-500">You haven't applied for any jobs yet.</p>
                                <a href="{{ route('jobs.index') }}" class="mt-3 inline-block text-sm font-semibold text-violet-600 hover:underline">Browse open jobs &rarr;</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Right Column: Available Jobs + My Reviews -->
                <div class="space-y-8">
                    <!-- Latest Open Jobs -->
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                        <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                            <h2 class="text-sm font-bold text-gray-900">Latest Opportunities</h2>
                            <a href="{{ route('jobs.index') }}" class="text-xs font-semibold text-violet-600 hover:underline">All jobs &rarr;</a>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @forelse ($availableJobs as $job)
                                <div class="px-5 py-3 hover:bg-gray-50/60 transition">
                                    <div class="flex items-start justify-between gap-2">
                                        <div>
                                            <a href="{{ route('jobs.show', $job) }}" class="text-xs font-bold text-gray-900 hover:text-violet-600 leading-snug">
                                                {{ Str::limit($job->title, 30) }}
                                            </a>
                                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $job->category?->name }}</p>
                                        </div>
                                        <span class="shrink-0 text-xs font-bold text-emerald-600">${{ number_format($job->budget, 0) }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="px-5 py-4 text-xs text-gray-500 text-center">No open jobs found.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- My Reviews -->
                    @if ($myReviews->count() > 0)
                        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
                            <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                                <h2 class="text-sm font-bold text-gray-900">My Reviews</h2>
                                <a href="{{ route('reviews.index') }}" class="text-xs font-semibold text-amber-600 hover:underline">All &rarr;</a>
                            </div>
                            <div class="divide-y divide-gray-50">
                                @foreach ($myReviews->take(3) as $rev)
                                    <div class="px-5 py-4">
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs font-semibold text-gray-700">{{ Str::limit($rev->job?->title, 25) }}</p>
                                            <span class="text-xs font-bold text-amber-500">★ {{ $rev->rating }}/5</span>
                                        </div>
                                        <p class="mt-1 text-[11px] text-gray-500 italic line-clamp-2">"{{ $rev->comment }}"</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Bar -->
            <div class="anim-4 mt-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">Quick Actions</h3>
                <div class="grid gap-3 sm:grid-cols-2 md:grid-cols-4">
                    <a href="{{ route('jobs.index') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-violet-300 hover:bg-violet-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-violet-600 text-white text-lg font-bold transition group-hover:scale-110">🔍</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-violet-600">Find Jobs</p>
                            <p class="text-[11px] text-gray-500">Browse open listings</p>
                        </div>
                    </a>
                    <a href="{{ route('applications.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-purple-300 hover:bg-purple-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-600 text-white text-lg font-bold transition group-hover:scale-110">+</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-purple-600">Submit Application</p>
                            <p class="text-[11px] text-gray-500">Pitch your proposal</p>
                        </div>
                    </a>
                    <a href="{{ route('reviews.create') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-amber-300 hover:bg-amber-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500 text-white text-lg font-bold transition group-hover:scale-110">★</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-amber-600">Write Review</p>
                            <p class="text-[11px] text-gray-500">Share your feedback</p>
                        </div>
                    </a>
                    <a href="{{ route('companies.index') }}" class="group flex items-center gap-3 rounded-xl border border-gray-100 bg-gray-50 p-4 transition hover:border-sky-300 hover:bg-sky-50">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-600 text-white text-lg font-bold transition group-hover:scale-110">🏢</div>
                        <div>
                            <p class="text-xs font-bold text-gray-900 group-hover:text-sky-600">Companies</p>
                            <p class="text-[11px] text-gray-500">View employers</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-layout>
