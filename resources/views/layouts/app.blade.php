<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sari-Sari Store') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-100 text-gray-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">

        <!-- Top Navbar (Optional Global Layout Header) -->
        <nav class="bg-white border-b shadow-sm sticky top-0 z-20">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <a href="/" class="text-indigo-600 font-bold text-lg hover:underline">Mhay Tindahan</a>

                <div class="flex items-center space-x-4">
                    <span class="text-sm hidden sm:inline">Hello, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content Slot -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- Footer (Optional) -->
        <footer class="text-center text-sm text-gray-400 py-4 border-t bg-white mt-10">
            &copy; {{ now()->year }} Mhay Tindahan. All rights reserved. Powered by Raven
        </footer>

    </div>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
