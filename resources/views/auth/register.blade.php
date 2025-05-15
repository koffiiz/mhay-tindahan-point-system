<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-6">
        <div class="w-full max-w-md bg-white rounded-2xl p-8 md:p-10 shadow-md space-y-6">
            
            <!-- Clickable Logo -->
            <div class="text-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('storage/hero-icon.svg') }}" alt="Welcome" class="w-16 h-16 mx-auto mb-4 hover:opacity-80 transition duration-200">
                </a>
                <h1 class="text-3xl font-bold text-indigo-600">Create an Account</h1>
                <p class="text-sm text-gray-500 mt-1">Register to start rewarding your customers</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                        class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required
                        class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 w-full px-4 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" />
                </div>

                <!-- Register Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg shadow-md transition">
                        Register
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center text-sm text-gray-500 pt-2">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Log in</a>
            </div>
        </div>
    </div>
</x-guest-layout>
