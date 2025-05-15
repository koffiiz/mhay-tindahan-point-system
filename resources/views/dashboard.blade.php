<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- Top Navbar -->
        <header class="bg-white shadow sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-indigo-600">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 hover:underline">Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="py-10 px-6 max-w-7xl mx-auto space-y-8">
            <!-- Hero Welcome Box -->
            <div class="bg-white rounded-xl shadow p-6 md:p-8">
                <h2 class="text-2xl font-bold text-indigo-700 mb-2">Welcome to your Sari-Sari Dashboard 🎉</h2>
                <p class="text-gray-600 text-sm">Track points, manage customers, and reward loyalty with ease.</p>
            </div>

            <!-- Placeholder Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700">Total Customers</h3>
                    <p class="text-3xl text-indigo-600 font-bold mt-2">0</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700">Points Issued</h3>
                    <p class="text-3xl text-indigo-600 font-bold mt-2">0</p>
                </div>
                <div class="bg-white rounded-xl shadow p-5">
                    <h3 class="text-lg font-semibold text-gray-700">Redemptions</h3>
                    <p class="text-3xl text-indigo-600 font-bold mt-2">0</p>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
