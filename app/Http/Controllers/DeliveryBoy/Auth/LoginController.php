<?php

namespace App\Http\Controllers\DeliveryBoy\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:delivery_boy')->except('logout');
    }

    public function showLoginForm()
    {
        return view('delivery-boy.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('delivery_boy')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active'
        ])) {
            return redirect()->intended(route('delivery-boy.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('delivery_boy')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('delivery-boy.login');
    }
} 