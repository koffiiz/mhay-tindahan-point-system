<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-10" x-data="qrModal()">
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                class="fixed bottom-6 right-6 z-50 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('earn_summary') || session()->has('redeem_summary'))
            <div x-data="{ showModal: true }" x-show="showModal" x-transition x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm px-4">

                <div class="bg-white w-full max-w-sm rounded-xl shadow-xl p-6 text-center relative">

                    <!-- Icon -->
                    <div
                        class="w-14 h-14 mx-auto flex items-center justify-center
                            rounded-full mb-4
                            {{ session()->has('redeem_summary') ? 'bg-green-100 text-green-600' : 'bg-indigo-100 text-indigo-600' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <!-- Title -->
                    <h2 class="text-xl font-bold text-gray-800 mb-1">
                        {{ session()->has('redeem_summary') ? 'Points Redeemed' : 'Points Earned' }}
                    </h2>

                    <!-- Main Message -->
                    <p class="text-sm text-gray-600">
                        <span class="font-medium text-indigo-600">
                            {{ session('redeem_summary.name') ?? session('earn_summary.name') }}
                        </span>
                        {{ session()->has('redeem_summary') ? 'redeemed' : 'earned' }}
                        <span class="font-semibold">
                            {{ session('redeem_summary.points') ?? session('earn_summary.points') }}
                        </span> points.
                    </p>

                    <!-- Redeem: show payout -->
                    @if (session()->has('redeem_summary'))
                        <p class="text-lg font-semibold text-green-600 mt-4">
                            Please pay ₱{{ session('redeem_summary.points') }} to the customer.
                        </p>
                        <p class="text-xs text-gray-400 mt-1">(1 point = ₱1)</p>
                    @endif

                    <!-- Earn: show earn amount -->
                    @if (session()->has('earn_summary'))
                        <p class="text-xs text-gray-400 mt-1">
                            ₱{{ number_format(session('earn_summary.amount')) }} =
                            {{ session('earn_summary.points') }}
                        </p>
                    @endif

                    <!-- Close Button -->
                    <button @click="showModal = false"
                        class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700 transition">
                        Close
                    </button>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <!-- Title + Icon -->
            <div class="flex items-center gap-2">
                <h1 class="text-2xl font-bold text-indigo-700">Admin Dashboard</h1>
                <a href="{{ route('admin.settings.edit') }}"
                    class="inline-flex items-center justify-center w-9 h-9 rounded-full hover:bg-gray-100 transition"
                    title="Settings">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 hover:text-indigo-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 01.33 1.82l-.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65
                              1.65 0 01-1.82-.33A1.65 1.65 0 0113.5 21h-.09a2 2 0 01-4 0h-.09a1.65
                              1.65 0 01-1-1.51 1.65 1.65 0 01-1.82-.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06a1.65
                              1.65 0 01.33-1.82A1.65 1.65 0 013 13.5v-.09a2 2 0 010-4v-.09a1.65
                              1.65 0 011.51-1 1.65 1.65 0 01.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06a1.65
                              1.65 0 011.82.33H10.5a1.65 1.65 0 011-1.51v-.09a2 2 0 014 0v.09a1.65
                              1.65 0 011 1.51h.09a1.65 1.65 0 011.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06a1.65
                              1.65 0 01-.33 1.82A1.65 1.65 0 0121 9.5v.09a2 2 0 010 4v.09a1.65 1.65 0 01-1.6 1.91z" />
                    </svg>
                </a>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <button @click="openModal = 'earn'"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-xl shadow hover:bg-green-600 transition">
                    Quick Earn
                </button>
                <button @click="openModal = 'redeem'"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-xl shadow hover:bg-red-600 transition">
                    Quick Redeem
                </button>
            </div>
        </div>


        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <h2 class="text-sm font-medium text-gray-600">Total Customers</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <h2 class="text-sm font-medium text-gray-600">Points Issued</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $pointsIssued }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <h2 class="text-sm font-medium text-gray-600">Points Redeemed</h2>
                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $redemptions }}</p>
            </div>
        </div>

        <!-- Customer Table -->
        <div class="bg-white p-6 rounded-xl shadow overflow-x-auto">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Customers</h2>
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-600 uppercase bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3 text-center">Points</th>
                        {{-- <th class="px-4 py-3 text-center">Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $customer->name }}</td>
                            <td class="px-4 py-3">{{ $customer->email }}</td>
                            <td class="px-4 py-3 text-center">{{ $customer->total_points ?? $customer->points }}</td>
                            {{-- <td class="px-4 py-3 text-center">
                                <a href="{{ route('admin.points.form', ['id' => $customer->id, 'type' => 'earn']) }}"
                                    class="text-green-600 hover:underline text-xs font-medium mr-3">Earn</a>
                                <a href="{{ route('admin.points.form', ['id' => $customer->id, 'type' => 'redeem']) }}"
                                    class="text-red-600 hover:underline text-xs font-medium">Redeem</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Overlay -->
        <div x-show="openModal" x-transition x-cloak x-init="init()"
            class="fixed inset-0 bg-black/50 z-40 flex items-center justify-center">

            <!-- Modal Box -->
            <div @click.away="openModal = null" class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-md z-50">

                <h2 class="text-xl font-bold mb-4 text-gray-800"
                    x-text="openModal === 'earn' ? 'Quick Earn Points' : 'Quick Redeem Points'">
                </h2>

                <!-- QR + Search Customer -->
                <div x-data="{ showScanner: false }" class="relative">
                    <label class="text-sm font-medium text-gray-700">Select Customer</label>

                    <!-- Search bar -->
                    <input type="text" x-model="searchQuery" placeholder="Search name or email"
                        class="w-full mt-1 p-2 border rounded" @focus="dropdownOpen = true"
                        @blur="setTimeout(() => dropdownOpen = false, 200)">

                    <!-- Dropdown -->
                    <ul x-show="dropdownOpen && filteredCustomers.length"
                        class="absolute bg-white border mt-1 w-full rounded shadow z-50 max-h-40 overflow-y-auto">
                        <template x-for="customer in filteredCustomers" :key="customer.id">
                            <li @click="selectCustomer(customer)" class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                                x-text="customer.name + ' (' + customer.email + ')'"></li>
                        </template>
                    </ul>

                    <!-- Toggle QR -->
                    <button type="button" @click="showScanner = !showScanner"
                        class="text-xs text-indigo-600 hover:underline mt-2 inline-block">
                        <span x-show="!showScanner">📷 Scan QR Code</span>
                        <span x-show="showScanner">❌ Hide Scanner</span>
                    </button>

                    <!-- QR Reader -->
                    <div x-show="showScanner" class="mt-4 rounded overflow-hidden">
                        <div id="qr-reader" class="w-full h-60 border rounded"></div>
                    </div>
                </div>

                <!-- Point Form -->
                <form method="POST" action="{{ route('admin.points.store') }}" class="space-y-4 mt-6">
                    @csrf
                    <input type="hidden" name="type" :value="openModal">
                    <input type="hidden" name="user_id" :value="selectedCustomer?.id">


                    <div x-show="openModal === 'earn'">
                        <label class="text-sm font-medium text-gray-700">Amount Spent (₱)</label>
                        <input type="number" name="amount" x-bind:disabled="openModal !== 'earn'"
                            min="1" class="w-full mt-1 p-2 border rounded" required>
                        <p class="text-xs text-gray-500 mt-1">₱{{ number_format($cashValuePerPoint, 2) }} = 1 point
                        </p>
                    </div>


                    <!-- Points (Redeem) -->
                    <div x-show="openModal === 'redeem'">
                        <label class="text-sm font-medium text-gray-700">Points to Redeem</label>
                        <input type="number" name="points" x-bind:disabled="openModal !== 'redeem'"
                            step="0.01" min="0.01" class="w-full mt-1 p-2 border rounded" required>
                        <p class="text-xs text-gray-500 mt-1">
                            Available: <span class="font-semibold"
                                x-text="(selectedCustomer?.points ?? 0).toFixed(2)"></span>
                            points
                        </p>
                    </div>


                    <!-- Optional Description -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Description (optional)</label>
                        <input type="text" name="description" class="w-full mt-1 p-2 border rounded">
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-between items-center pt-4">
                        <button type="button" @click="openModal = null"
                            class="px-4 py-2 bg-gray-100 text-sm text-gray-700 rounded hover:bg-gray-200">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-sm text-white rounded hover:bg-indigo-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ✅ Success Toast -->
        <div x-show="showToast" x-transition x-cloak
            class="fixed bottom-6 right-6 bg-green-500 text-white text-sm px-4 py-3 rounded-lg shadow-lg z-50">
            QR matched: <span class="font-semibold" x-text="selectedCustomer?.name"></span>
        </div>


    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function qrModal() {
            return {
                openModal: null,
                searchQuery: '',
                dropdownOpen: false,
                selectedCustomer: null,
                showToast: false,
                qrScanner: null,

                customers: {!! json_encode(
                    $customers->map(function ($c) {
                        $earned = $c->pointTransactions->where('type', 'earn')->sum('points');
                        $redeemed = $c->pointTransactions->where('type', 'redeem')->sum('points');
                        return [
                            'id' => $c->id,
                            'name' => $c->name,
                            'email' => $c->email,
                            'qr_token' => $c->qr_token,
                            'points' => $earned - $redeemed,
                        ];
                    }),
                ) !!},

                get filteredCustomers() {
                    return this.customers.filter(c =>
                        c.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        c.email.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                selectCustomer(customer) {
                    this.selectedCustomer = customer;
                    this.searchQuery = customer.name;
                    this.dropdownOpen = false;
                },

                selectCustomerFromQR(customer) {
                    this.selectedCustomer = customer;
                    this.searchQuery = customer.name;
                    this.dropdownOpen = false;
                    this.showSuccessToast();
                },

                showSuccessToast() {
                    this.showToast = true;
                    setTimeout(() => this.showToast = false, 3000);
                },

                init() {
                    this.$watch('openModal', (value) => {
                        if ((value === 'earn' || value === 'redeem') && !this.qrScanner) {
                            this.startQrScan();
                        }
                    });
                },

                startQrScan() {
                    const self = this;
                    if (this.qrScanner) return;
                    this.qrScanner = new Html5Qrcode("qr-reader");
                    this.qrScanner.start({
                            facingMode: "environment"
                        }, {
                            fps: 10,
                            qrbox: 200
                        },
                        function(decodedText) {
                            const token = decodedText.split('=')[1];
                            const found = self.customers.find(c => c.qr_token === token);
                            if (found) {
                                self.selectCustomerFromQR(found);
                                self.qrScanner.stop();
                                self.qrScanner.clear();
                                self.qrScanner = null;
                            } else {
                                alert('Customer not found.');
                            }
                        },
                        function(error) {
                            console.warn("QR error", error);
                        }
                    );
                },

                stopQrScan() {
                    if (this.qrScanner) {
                        this.qrScanner.stop();
                        this.qrScanner.clear();
                        this.qrScanner = null;
                    }
                }
            }
        }
    </script>
</x-app-layout>
