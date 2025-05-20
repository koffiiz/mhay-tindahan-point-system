<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerQRController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = User::query()
            ->when($search, fn($q) =>
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
            )
            ->orderBy('name')
            ->get();

        return view('admin.customer-qr-table', compact('customers', 'search'));
    }

    public function bulkPrint(Request $request)
    {
        $ids = $request->input('customer_ids', []);
        $customers = User::whereIn('id', $ids)->get();

        return view('admin.qr-bulk-print', compact('customers'));
    }
}
