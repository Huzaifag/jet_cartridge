<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeRoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $employee = Auth::guard('employee')->user();

        if (!$employee) {
            return redirect()->route('seller.employees.login');
        }

        if (!$employee->hasAnyRole($roles)) {
            abort(403, 'Unauthorized. You do not have access to this section.');
        }

        return $next($request);
    }
}
