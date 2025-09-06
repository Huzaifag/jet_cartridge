<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function view(Employee $employee, Order $order)
    {
        return $employee->seller_id === $order->seller_id;
    }

    public function update(Employee $employee, Order $order)
    {
        return $employee->seller_id === $order->seller_id && $employee->hasPermission('manage_orders');
    }
} 