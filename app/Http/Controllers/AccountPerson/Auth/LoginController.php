<?php

namespace App\Http\Controllers\AccountPerson\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountPerson;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('account-person.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('account-person')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Check if account person is active
            $accountPerson = Auth::guard('account-person')->user();
            if ($accountPerson->status !== 'active') {
                Auth::guard('account-person')->logout();
                return back()->with('error', 'Your account is inactive. Please contact your administrator.');
            }

            return redirect()->intended(route('account-person.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('account-person')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('account-person.login');
    }
} 