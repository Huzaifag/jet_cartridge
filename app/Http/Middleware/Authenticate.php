<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // For special user types, redirect to their specific login pages
            if ($request->is('employee*')) {
                return route('unified.login.form');
            } elseif ($request->is('delivery-boy*')) {
                return route('unified.login.form');
            } elseif ($request->is('account-person*')) {
                return route('unified.login.form');
            } elseif ($request->is('seller*')) {
                return route('seller.login');
            }
            
            // For regular users, redirect to the standard login page
            return route('login');
        }
        return null;
    }
} 