<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // For special user types, redirect to their dashboards
                if ($guard === 'employee') {
                    return redirect()->route('seller.employees.dashboard');
                } elseif ($guard === 'delivery_boy') {
                    return redirect()->route('seller.delivery-boys.dashboard');
                } elseif ($guard === 'account-person') {
                    return redirect()->route('seller.account-person.dashboard');
                } elseif ($guard === 'seller') {
                    return redirect()->route('seller.dashboard');
                }
                
                // For regular users, redirect to home
                return redirect('/');
            }
        }

        return $next($request);
    }
} 