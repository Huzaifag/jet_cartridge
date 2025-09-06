<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryBoyAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('delivery-boy')->check()) {
            return redirect()->route('delivery-boy.login');
        }

        return $next($request);
    }
} 