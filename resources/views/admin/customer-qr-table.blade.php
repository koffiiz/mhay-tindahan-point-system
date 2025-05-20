<x-app-layout>

    <div class="max-w-6xl mx-auto px-6 py-10" x-data="qrPrintTable()">
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 text-sm px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow-sm hover:bg-gray-200 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>
        </div>
        <!-- Search Bar -->
        <div class="mb-4 flex gap-2 items-center">
            <input type="text" x-model="searchQuery" placeholder="Search name or email"
                class="w-full p-2 border rounded" />
        </div>

        <!-- Bulk Print Button -->
        <form :action="bulkPrintRoute" method="POST" target="_blank" @submit="submitPrintForm">
            @csrf

            <div class="mb-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
                    :disabled="selectedIds.length === 0">
                    🖨️ Print Selected QR Cards
                </button>
            </div>

            <!-- Customer Table -->
            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                        <tr>
                            <th class="p-3">
                                <input type="checkbox" @change="toggleAll($event)" />
                            </th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Email</th>
                            <th class="p-3 text-center">Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="customer in filteredCustomers" :key="customer.id">
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">
                                    <input type="checkbox" :value="customer.id" x-model="selectedIds" />
                                </td>
                                <td class="p-3" x-text="customer.name"></td>
                                <td class="p-3" x-text="customer.email"></td>
                                <td class="p-3 text-center" x-text="customer.points ?? 0"></td>
                            </tr>
                        </template>
                        <tr x-show="filteredCustomers.length === 0">
                            <td colspan="4" class="text-center text-gray-400 py-4">No customers found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
        function qrPrintTable() {
            return {
                searchQuery: '',
                selectedIds: [],
                bulkPrintRoute: '{{ route('admin.customers.qr.bulk') }}',
                customers: {!! json_encode(
                    $customers->map(
                        fn($c) => [
                            'id' => $c->id,
                            'name' => $c->name,
                            'email' => $c->email,
                            'points' => $c->total_points,
                        ],
                    ),
                ) !!},
                get filteredCustomers() {
                    if (!this.searchQuery) return this.customers;
                    const q = this.searchQuery.toLowerCase();
                    return this.customers.filter(c =>
                        c.name.toLowerCase().includes(q) ||
                        c.email.toLowerCase().includes(q)
                    );
                },

                toggleAll(event) {
                    const visibleIds = this.filteredCustomers.map(c => c.id);
                    if (event.target.checked) {
                        this.selectedIds = [...new Set([...this.selectedIds, ...visibleIds])];
                    } else {
                        this.selectedIds = this.selectedIds.filter(id => !visibleIds.includes(id));
                    }
                },

                submitPrintForm(e) {
                    if (this.selectedIds.length === 0) {
                        e.preventDefault();
                        alert("Select at least one customer.");
                    }

                    const form = e.target;
                    form.querySelectorAll('input[name="customer_ids[]"]').forEach(el => el.remove());

                    this.selectedIds.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'customer_ids[]';
                        input.value = id;
                        form.appendChild(input);
                    });
                }
            }
        }
    </script>
</x-app-layout>
