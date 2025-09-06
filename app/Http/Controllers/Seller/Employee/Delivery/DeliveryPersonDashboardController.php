<?php

namespace App\Http\Controllers\Seller\Employee\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryPersonDashboardController extends Controller
{
    public function index()
    {
        return view('Employees.delivery-person.dashboard.index');
    }
}
