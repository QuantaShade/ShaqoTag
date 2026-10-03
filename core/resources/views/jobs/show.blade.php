<x-layout :title="$job->title">
    <article class="mx-auto max-w-4xl px-6 py-12">
        <a href="{{ route('jobs.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
            &larr; Back to jobs
        </a>

        <div class="mt-6 border-b border-gray-200 pb-8">
            <p class="text-sm font-medium text-blue-600">{{ $job->category->name }}</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight">{{ $job->title }}</h1>
            <p class="mt-3 text-sm text-gray-500">
                Posted by {{ $job->client->name }} · {{ $job->created_at->diffForHumans() }}
            </p>
        </div>

        <div class="grid gap-10 py-8 md:grid-cols-[minmax(0,1fr)_15rem]">
            <section>
                <h2 class="font-semibold">Job description</h2>
                <p class="mt-4 whitespace-pre-line text-sm leading-7 text-gray-700">{{ $job->description }}</p>

                <h2 class="mt-8 font-semibold">Skills</h2>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach (collect($job->skills) as $skill)
                        <span class="rounded-md border border-gray-200 px-2.5 py-1 text-xs text-gray-600">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </section>

            <aside class="h-fit border-t border-gray-200 pt-6 md:border-l md:border-t-0 md:pl-6 md:pt-0">
                <p class="text-xs text-gray-500">Budget</p>
                <p class="mt-1 text-xl font-bold">${{ number_format($job->budget, 2) }}</p>
                <p class="mt-4 text-sm capitalize text-gray-600">{{ $job->type }} contract</p>
            </aside>
        </div>
    </article>
</x-layout>