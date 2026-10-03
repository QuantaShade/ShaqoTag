<x-layout title="Find Freelance Work">

    <section class="relative overflow-hidden bg-gray-50">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-12 lg:grid-cols-2">
            <div>
                <h1 class="max-w-xl text-4xl font-bold leading-tight tracking-tight text-gray-950 sm:text-5xl lg:text-6xl">
                    Find the right work.
                    <span class="text-blue-600">Build your future.</span>
                </h1>

                <p class="mt-6 max-w-lg text-base leading-7 text-gray-600">
                    Discover meaningful projects, connect with great clients,
                    and turn your skills into opportunities with ShaqoTag.
                </p>

                <form action="{{ route('jobs.index') }}" method="GET"
                      class="mt-8 flex max-w-xl flex-col gap-2 rounded-xl border border-gray-200 bg-white p-2 shadow-sm sm:flex-row">
                    <input type="text" name="q"
                           placeholder="Search jobs, skills, or keywords..."
                           class="min-w-0 flex-1 rounded-lg px-3 py-3 text-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-blue-100">
                    <button type="submit"
                            class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                        Search jobs
                    </button>
                </form>

                <div class="mt-10 flex flex-wrap gap-10">
                    <div>
                        <p class="text-2xl font-bold">10K+</p>
                        <p class="mt-1 text-sm text-gray-500">Active jobs</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold">5K+</p>
                        <p class="mt-1 text-sm text-gray-500">Freelancers</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold">2K+</p>
                        <p class="mt-1 text-sm text-gray-500">Happy clients</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -inset-4 rounded-3xl bg-blue-100/60 blur-2xl"></div>
                <div class="relative rounded-2xl border border-gray-200 bg-white p-6 shadow-xl">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-5">
                        <div>
                            <p class="text-sm text-gray-500">Featured opportunity</p>
                            <h3 class="mt-1 font-semibold">Full Stack Developer</h3>
                        </div>
                        <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-medium text-green-700">
                            Remote
                        </span>
                    </div>

                    <div class="py-6">
                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gray-950 text-xl font-bold text-white">
                            &lt;/&gt;
                        </div>
                        <p class="mt-5 text-sm leading-6 text-gray-600">
                            Build modern web applications using Laravel,
                            React and modern technologies.
                        </p>
                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach (['Laravel', 'React', 'Tailwind CSS'] as $skill)
                                <span class="rounded-md bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-700">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-100 pt-5">
                        <div>
                            <p class="text-xs text-gray-500">Project budget</p>
                            <p class="mt-1 text-xl font-bold">$500 - $1,000</p>
                        </div>
                        <a href="{{ route('jobs.index') }}"
                           class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                            Explore jobs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="flex items-end justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Explore categories</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Find projects that match your expertise.
                </p>
            </div>
            <a href="{{ route('jobs.index') }}"
               class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                View all jobs →
            </a>
        </div>

        <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ([
                ['Web Development', 'WD'],
                ['Mobile Development', 'MD'],
                ['UI/UX Design', 'UX'],
                ['Graphic Design', 'GD'],
                ['Writing', 'WR'],
                ['Marketing', 'MK'],
            ] as [$name, $symbol])
                <a href="{{ route('jobs.index', ['category' => $name]) }}"
                   class="group rounded-xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-blue-200 hover:shadow-md">
                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-blue-600 group-hover:bg-blue-600 group-hover:text-white">
                        {{ $symbol }}
                    </div>
                    <h3 class="mt-4 text-sm font-semibold">{{ $name }}</h3>
                    <p class="mt-1 text-xs text-gray-500">Explore jobs</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="how-it-works" class="bg-gray-50">
        <div class="mx-auto max-w-7xl px-6 py-16">
            <div class="text-center">
                <h2 class="text-2xl font-bold tracking-tight">How ShaqoTag works</h2>
                <p class="mt-2 text-sm text-gray-500">Get started in three simple steps.</p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach ([
                    ['01', 'Discover opportunities', 'Browse projects that match your skills and interests.'],
                    ['02', 'Submit your application', 'Introduce yourself, explain your approach and submit your bid.'],
                    ['03', 'Get hired and work', 'Connect with clients and start working on your project.'],
                ] as [$number, $title, $description])
                    <div class="rounded-xl border border-gray-200 bg-white p-6">
                        <span class="text-sm font-bold text-blue-600">{{ $number }}</span>
                        <h3 class="mt-4 font-semibold">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">{{ $description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-16">
        <div class="flex flex-col items-center justify-between gap-6 rounded-2xl bg-gray-950 px-8 py-12 text-center text-white sm:flex-row sm:text-left">
            <div>
                <h2 class="text-2xl font-bold">Ready to take the next step?</h2>
                <p class="mt-2 text-sm text-gray-300">Join ShaqoTag and discover new opportunities.</p>
            </div>
            <a href="{{ route('register') }}"
               class="shrink-0 rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-500">
                Create your account
            </a>
        </div>
    </section>

</x-layout>