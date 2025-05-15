<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Calculate total points
        $totalEarned = $user->pointTransactions()->where('type', 'earn')->sum('points');
        $totalRedeemed = $user->pointTransactions()->where('type', 'redeem')->sum('points');

        $totalPoints = number_format($totalEarned - $totalRedeemed, 2);
        
        // Get latest transactions (e.g., last 10)
        $transactions = $user->pointTransactions()->latest()->take(10)->get();

        // Last redemption (optional)
        $lastRedemption = $user->pointTransactions()
            ->where('type', 'redeem')
            ->latest()
            ->first();

        return view('customer.dashboard', compact(
            'totalPoints',
            'transactions',
            'lastRedemption'
        ));
    }

    public function qrCard()
    {
        $user = auth()->user();
        return view('customer.qr-card', compact('user'));
    }
}
