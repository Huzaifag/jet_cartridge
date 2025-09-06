<?php

namespace App\Providers;

use App\Models\Employee;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<string, string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('is-delivery', function () {
            $employee = Auth::guard('employee')->user();
            return $employee && $employee->position === 'Delivery_boy';
        });
    
        Gate::define('is-warehouse', function () {
            $employee = Auth::guard('employee')->user();
            return $employee && $employee->position === 'Warehouse';
        });
    
        Gate::define('is-accountant', function () {
            $employee = Auth::guard('employee')->user();
            return $employee && $employee->position === 'Accountant';
        });
    }
} 