
<x-layout title="Create account">

    <section class="flex min-h-[75vh] items-center justify-center bg-gray-50 px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-200 bg-white p-8 shadow-sm sm:p-10">
            <div class="text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-xl font-bold text-white">W</div>
                <h1 class="mt-6 text-2xl font-bold tracking-tight">Create your account</h1>
                <p class="mt-2 text-sm text-gray-500">Join ShaqoTag and start your journey.</p>
            </div>

            @if ($errors->any())
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label class="text-sm font-medium">I want to join as</label>
                    <div class="mt-2 grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="client"
                                   class="peer sr-only" {{ old('role', 'freelancer') === 'client' ? 'checked' : '' }}>
                            <div class="rounded-lg border border-gray-200 p-3 text-center text-sm font-medium text-gray-600 transition peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700">
                                I'm a Client
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="freelancer"
                                   class="peer sr-only" {{ old('role', 'freelancer') === 'freelancer' ? 'checked' : '' }}>
                            <div class="rounded-lg border border-gray-200 p-3 text-center text-sm font-medium text-gray-600 transition peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700">
                                I'm a Freelancer
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="text-sm font-medium">Full name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                           required autocomplete="name" placeholder="Your full name"
                           class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="text-sm font-medium">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           required autocomplete="email" placeholder="you@example.com"
                           class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-sm font-medium">Password</label>
                    <input id="password" name="password" type="password" required
                           autocomplete="new-password" placeholder="Create a strong password"
                           class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-medium">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           required autocomplete="new-password" placeholder="Confirm your password"
                           class="mt-2 w-full rounded-lg border border-gray-200 px-3 py-3 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                </div>

                <button type="submit"
                        class="w-full rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700">
                    Create account
                </button>
            </form>

            <p class="mt-7 text-center text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('signin') }}" class="font-semibold text-blue-600 hover:underline">Log in</a>
            </p>
        </div>
    </section>

</x-layout>