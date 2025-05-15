<x-app-layout>

    <div class="max-w-xl mx-auto p-6 mt-10 bg-white rounded-xl shadow">

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-indigo-700">Loyalty Settings</h2>
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-1 text-sm text-gray-600 hover:text-indigo-600 transition"
                title="Back to Dashboard">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 text-green-600 text-sm bg-green-100 rounded px-4 py-2">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
            @csrf

            <!-- Redeem Point Value -->
            <div>
                <label for="redeem_point_value" class="block text-sm font-medium text-gray-700 mb-1">
                    Redeem Cash Value per Point (₱)
                </label>
                <input type="number" name="redeem_point_value" step="0.01" min="0.01" id="redeem_point_value"
                    value="{{ old('redeem_point_value', $redeemRate) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" />

                @error('redeem_point_value')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
