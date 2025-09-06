<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Get the guard name
        $guard = null;
        if ($user instanceof \App\Models\Employee) {
            $guard = 'employee';
        } elseif ($user instanceof \App\Models\DeliveryBoy) {
            $guard = 'delivery-boy';
        } elseif ($user instanceof \App\Models\AccountPerson) {
            $guard = 'account-person';
        }

        // If profile is not completed and not already on the complete-profile page
        if (!$user->is_profile_completed && !$request->is("*/complete-profile")) {
            return redirect()->route("$guard.complete-profile");
        }

        return $next($request);
    }
} 