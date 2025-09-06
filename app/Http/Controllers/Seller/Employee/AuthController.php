<?php

namespace App\Http\Controllers\Seller\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Authentication methods for Employee can be added here
    function __construct()
    {
        $this->middleware('guest:employee')->except('logout');
    }
    // --- IGNORE ---
    // Other methods for Employee authentication can be added here
    public function showLoginForm()
    {
        return view('Employees.auth.login');
    }
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        if (auth()->guard('employee')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // If successful, then redirect to their intended location
            return redirect()->intended(route('seller.employees.dashboard'));
        }

        // If unsuccessful, then redirect back to the login with the form data
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        auth()->guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('seller.employees.login');
    }    
}
