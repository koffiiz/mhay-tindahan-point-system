<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PointTransaction;
use App\Models\Setting;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::where('role', 'customer')->count(),
            'pointsIssued' => PointTransaction::where('type', 'earn')->sum('points'),
            'redemptions' => PointTransaction::where('type', 'redeem')->sum('points'),
            'customers' => User::where('role', 'customer')->get(), 
            'cashValuePerPoint' => Setting::get('redeem_point_value')
        ]);
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }
    
    public function showPointForm($id, $type)
    {
        $customer = User::findOrFail($id);
        if (!in_array($type, ['earn', 'redeem'])) abort(404);
        return view('admin.points.form', compact('customer', 'type'));
    }
    
    public function storePoints(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:earn,redeem',
            'description' => 'nullable|string|max:255',
            'amount' => 'required_if:type,earn|nullable|numeric|min:1',
            'points' => 'required_if:type,redeem|nullable|numeric|min:0.01',
        ]);

        $cashValuePerPoint = (float) Setting::get('redeem_point_value');

        $user = User::findOrFail($request->user_id);
    

        if ($request->type === 'earn') {
            $points = round($request->amount / $cashValuePerPoint, 2);

            PointTransaction::create([
                'user_id'     => $user->id,
                'type'        => 'earn',
                'points'      => $points,
                'description' => $request->description ?? 'Earned from ₱' . number_format($request->amount, 2),
            ]);
    
            return redirect()->route('admin.dashboard')->with([
                'success' => 'Points successfully earned!',
                'earn_summary' => [
                    'name'   => $user->name,
                    'amount' => (int) $request->amount,
                    'points' => $points,
                    'description'   => $cashValuePerPoint,
                ],
            ]);
    
        } elseif ($request->type === 'redeem') {
            $points = (int) $request->points;
    
            // Calculate available points
            $availablePoints = $user->pointTransactions->sum(function ($pt) {
                return $pt->type === 'earn' ? $pt->points : -$pt->points;
            });
    
            if ($points > $availablePoints) {
                return back()->withErrors([
                    'points' => 'Customer does not have enough points to redeem. (Available: ' . $availablePoints . ')'
                ]);
            }
    
            $amountToPay = $points * $cashValuePerPoint;
    
            PointTransaction::create([
                'user_id'     => $user->id,
                'type'        => 'redeem',
                'points'      => $points,
                'description' => $request->description ?? 'Manual redemption',
            ]);
    
            return redirect()->route('admin.dashboard')->with([
                'success' => 'Points successfully redeemed!',
                'redeem_summary' => [
                    'name'   => $user->name,
                    'points' => $points,
                    'amount' => $amountToPay,
                ],
            ]);
        }
    }
}
