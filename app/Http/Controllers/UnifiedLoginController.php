<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\DeliveryBoy;
use App\Models\AccountPerson;

class UnifiedLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.unified-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:employee,delivery_boy,account-person'
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->role;

        // Convert role name to guard name if needed
        $guard = match ($role) {
            'delivery_boy' => 'delivery_boy',
            'account-person' => 'account-person',
            default => $role
        };

        if (Auth::guard($guard)->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return match ($guard) {
                'employee' => redirect()->route('seller.employee.dashboard'),
                'delivery_boy' => redirect()->route('seller.delivery_boy.dashboard'),
                'account-person' => redirect()->route('seller.account-person.dashboard'),
                default => redirect()->route('login')
            };
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Invalid credentials for selected role.']);
    }
} 