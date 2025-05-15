@if ($type === 'earn')
    <div>
        <label for="amount" class="text-sm font-medium text-gray-700">Amount Spent (₱)</label>
        <input type="number" name="amount" id="amount" class="w-full mt-1 p-2 border rounded" min="1" required>
        <p class="text-xs text-gray-500 mt-1">₱100 = 1 point</p>
    </div>
@else
    <div>
        <label for="points" class="text-sm font-medium text-gray-700">Points to Redeem</label>
        <input type="number" name="points" id="points" class="w-full mt-1 p-2 border rounded" min="1"
            required>
    </div>
@endif
