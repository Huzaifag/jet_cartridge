<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('employees.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('employee')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Check if employee is active
            $employee = Auth::guard('employee')->user();
            if (!$employee->is_active) {
                Auth::guard('employee')->logout();
                return back()->with('error', 'Your account is inactive. Please contact your administrator.');
            }

            return redirect()->intended(route('employees.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('employees.login');
    }
} 