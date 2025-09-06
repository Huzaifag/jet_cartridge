<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectEmployeeByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $employee = Auth::guard('employee')->user();
        
        if (!$employee) {
            return $next($request);
        }

        $currentRoute = $request->route()->getName();
        $targetRoute = null;

        // Determine the target route based on employee position
        switch ($employee->position) {
            case 'Accountant':
                $targetRoute = 'seller.employees.accountant.dashboard';
                break;
            case 'Warehouse':
                $targetRoute = 'seller.employees.warehouse.dashboard';
                break;
            case 'Delivery_boy':
                $targetRoute = 'seller.employees.delivery_person.dashboard';
                break;
            default:
                $targetRoute = 'seller.employees.dashboard';
                break;
        }

        // Only redirect if not already on the target route
        if ($currentRoute !== $targetRoute) {
            return redirect()->route($targetRoute);
        }

        return $next($request);
    }
}
