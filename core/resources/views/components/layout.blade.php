
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ShaqoTag' }} | ShaqoTag</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-gray-950 antialiased">

    <header class="sticky top-0 z-50 border-b border-gray-200 bg-white/95 backdrop-blur">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-lg font-bold text-white">W</span>
                <span class="text-xl font-bold tracking-tight">ShaqoTag</span>
            </a>

            <div class="hidden items-center gap-8 text-sm font-medium text-gray-600 md:flex">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-blue-600' : 'hover:text-gray-950' }}">
                    Home
                </a>
                <a href="{{ route('jobs.index') }}"
                   class="{{ request()->routeIs('jobs.*') ? 'text-blue-600' : 'hover:text-gray-950' }}">
                    Find Jobs
                </a>
                <a href="{{ route('home') }}#how-it-works" class="hover:text-gray-950">
                    How it works
                </a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <span class="hidden text-sm text-gray-600 sm:block">
                        Hi, {{ auth()->user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">
                            Log out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="hidden rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 sm:block">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                       class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                        Get started
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="mt-20 border-t border-gray-200 bg-gray-50">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-4 px-6 py-8 sm:flex-row sm:items-center">
            <div>
                <span class="font-bold">ShaqoTag</span>
                <p class="mt-1 text-sm text-gray-500">
                    Connecting talent with opportunity.
                </p>
            </div>
            <p class="text-sm text-gray-500">
                © {{ date('Y') }} ShaqoTag. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>