<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mhay Points</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gradient-to-br from-indigo-100 via-blue-50 to-white text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col">

        <!-- Header -->
        <header class="flex justify-between items-center px-6 py-4 bg-white/50 backdrop-blur-sm border-b shadow-sm">
            <h1 class="text-xl font-bold text-indigo-600">Mhay Points</h1>
            <nav class="space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:underline">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:underline">Login</a>
                    <a href="{{ route('register') }}"
                        class="text-sm font-medium text-indigo-600 hover:underline">Register</a>
                @endauth
            </nav>
        </header>

        <!-- Hero Section -->
        <main class="flex flex-col md:flex-row items-center justify-center flex-1 px-6 py-16 max-w-7xl mx-auto gap-10">
            <!-- SVG on Left (inline SVG content) -->
            <div class="w-full md:w-1/2 max-w-md">
                <img src="{{ asset('images/hero-icon.svg') }}" alt="Welcome" class="w-full h-auto">
            </div>

            <!-- Text Content on Right -->
            <div class="w-full md:w-1/2 text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-extrabold text-indigo-700 mb-4">Reward Loyal Customers</h2>
                <p class="text-gray-600 text-lg mb-6">Turn every purchase into points and give back to your community.
                    Build loyalty with ease using a digital sari-sari store rewards system.</p>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium shadow transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-medium shadow transition">
                        Get Started
                    </a>
                @endauth
            </div>
        </main>

        <!-- Footer -->
        <footer class="text-center text-sm text-gray-400 py-6 border-t bg-white/30 backdrop-blur-sm">
            &copy; {{ now()->year }} Sari-Sari Points. All rights reserved.
        </footer>

    </div>
</body>

</html>
