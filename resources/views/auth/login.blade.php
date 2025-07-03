<x-guest-layout>
    <div class="w-full max-w-md p-6">
        <div class="flex justify-center mb-6">
            <a href="/">
                <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </a>
        </div>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white">Welcome back</h1>
            <p class="mt-2 text-gray-400">Log in to continue to Memories.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" value="Email address" class="text-gray-400 text-sm" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                              class="block mt-1 w-full bg-gray-800 border-transparent rounded-lg focus:border-blue-500 focus:ring-blue-500 text-white" 
                              placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="password" value="Password" class="text-gray-400 text-sm" />
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                              class="block mt-1 w-full bg-gray-800 border-transparent rounded-lg focus:border-blue-500 focus:ring-blue-500 text-white" 
                              placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Log in
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-gray-400">
            Not a member?
            <a href="{{ route('register') }}" class="font-semibold text-blue-500 hover:underline">
                Sign up
            </a>
        </p>
    </div>
</x-guest-layout>