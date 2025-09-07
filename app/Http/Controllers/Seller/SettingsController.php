<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentSetting;
use App\Models\TwoFactorSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SettingsController extends Controller
{
    public function index()
    {
        $paymentSetting = PaymentSetting::where('seller_id', auth('seller')->user()->id)->first();
        $twoFactorSetting = TwoFactorSetting::where('seller_id', auth('seller')->user()->id)->first();
        // TODO: Implement settings page
        return view('seller.settings.index', compact('paymentSetting', 'twoFactorSetting'));
    }

    public function update(Request $request)
    {
        // TODO: Implement settings update logic
        return redirect()->route('seller.settings')->with('success', 'Settings updated successfully');
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user = auth('seller')->user();

            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Current password is incorrect.'], 422);
            }

            // Update new password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Password updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the password.' . $e->getMessage()], 500);
        }
    }
}
