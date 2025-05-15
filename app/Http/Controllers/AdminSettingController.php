<?php

namespace App\Http\Controllers;

use App\Models\Setting;

use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function edit()
    {
        $redeemRate = Setting::get('redeem_point_value', 1);
        return view('admin.settings.edit', compact('redeemRate'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'redeem_point_value' => 'required|numeric|min:0.01'
        ]);
    
        Setting::set('redeem_point_value', $request->redeem_point_value);
    
        return back()->with('success', 'Redeem point value updated.');
    }
}
