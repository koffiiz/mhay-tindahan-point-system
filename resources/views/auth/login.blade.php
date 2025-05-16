<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 md:p-10 space-y-6">

            <div class="text-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/hero-icon.svg') }}" alt="Welcome"
                        class="w-16 h-16 mx-auto mb-4 hover:opacity-80 transition duration-200">
                </a>
                <h1 class="text-3xl font-bold text-indigo-600">Welcome Back</h1>
                <p class="text-sm text-gray-500 mt-1">Login to continue to your store dashboard</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span>Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg shadow-md transition">
                        Log in
                    </button>
                </div>
            </form>

            <!-- Register Prompt -->
            @if (Route::has('register'))
                <div class="text-center text-sm text-gray-500 pt-2">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Register</a>
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
