<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- Content -->
        <main class="py-10 px-6 max-w-3xl mx-auto space-y-8">
            <div class="bg-white rounded-xl shadow p-6 md:p-8 text-center">
                <h2 class="text-2xl font-bold text-indigo-700 mb-2">Welcome 🎉</h2>
                <p class="text-gray-600 text-sm">Track your rewards, see recent purchases, and stay updated with your
                    points.</p>
            </div>

            <!-- Customer QR Code Section -->
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Your QR Code</h3>

                <div class="flex justify-center">
                    {!! QrCode::size(200)->generate('token=' . Auth::user()->qr_token) !!}
                </div>

                <p class="mt-2 text-sm text-gray-500">Scan this at the store to earn or redeem points.</p>
                <a href="{{ route('customer.qr-card') }}"
                    class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg shadow hover:bg-indigo-700 transition">
                    View / Print My QR Card
                </a>
            </div>

            <!-- Points Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-xl shadow text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Current Points</h3>
                    <div class="flex items-center justify-center gap-1 mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-500" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.074 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.075 3.292c.3.921-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.075-3.292a1 1 0 00-.364-1.118L2.977 8.72c-.783-.57-.38-1.81.588-1.81h3.462a1 1 0 00.95-.69l1.074-3.292z" />
                        </svg>
                        <p class="text-3xl font-bold text-indigo-600">{{ number_format($totalPoints, 2) }}</p>
                    </div>
                    <p class="text-md text-gray-500">points</p>
                </div>

                <!-- Last Redemption -->
                <div class="bg-white rounded-xl shadow p-5 text-center">
                    <h3 class="text-lg font-semibold text-gray-700">Last Redemption</h3>
                    @if ($lastRedemption)
                        <p class="text-lg text-red-600 font-bold mt-2">-{{ $lastRedemption->points }} pts</p>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $lastRedemption->description ?? 'No description' }}<br>
                            <span class="text-xs text-gray-500">
                                {{ $lastRedemption->created_at->format('M d, Y h:i A') }}
                            </span>
                        </p>
                    @else
                        <p class="text-sm text-gray-500 mt-2">No redemptions yet</p>
                    @endif
                </div>
            </div>

            <!-- Recent Point Transactions -->
            <div class="bg-white rounded-xl shadow p-6 md:p-8">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Point Transactions</h3>

                @forelse($transactions as $transaction)
                    <div class="flex justify-between items-center py-2 border-b last:border-none">
                        <div>
                            <p class="text-sm font-medium text-gray-800">
                                {{ ucfirst($transaction->type) }}: {{ $transaction->description ?? 'No description' }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $transaction->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                        <div class="text-right">
                            <span
                                class="text-sm font-semibold {{ $transaction->type === 'earn' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type === 'earn' ? '+' : '-' }}{{ $transaction->points }} pts
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No transactions yet.</p>
                @endforelse
            </div>
        </main>
    </div>
</x-app-layout>
