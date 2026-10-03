
<x-layout title="Log in">

    <section class="flex min-h-[75vh] items-center justify-center bg-gray-50 px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-200 bg-white p-8 shadow-sm sm:p-10">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-xl font-bold text-white">W</div>
                <h1 class="mt-6 text-2xl font-bold tracking-tight">Welcome back</h1>
                <p class="mt-2 text-sm text-gray-500">Log in to your ShaqoTag account.</p>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="email" class="text-sm font-medium">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           required autofocus autocomplete="email"
                           placeholder="you@example.com"
                           class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between">
                        <label for="password" class="text-sm font-medium">Password</label>
                        <a class="text-xs font-medium text-blue-600 hover:underline">
                            Forgot password?
                        </a>
                    </div>
                    <input id="password" name="password" type="password" required
                           autocomplete="current-password"
                           placeholder="Enter your password"
                           class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" value="1"
                           class="h-4 w-4 rounded border-gray-300 accent-blue-600">
                    Remember me
                </label>

                <button type="submit"
                        class="w-full rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                    Sign in
                </button>
            </form>

            <p class="mt-7 text-center text-sm text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:underline">Sign up</a>
            </p>
        </div>
    </section>

</x-layout>