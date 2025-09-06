<?php

namespace App\Http\Controllers\Seller\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesManDashboardController extends Controller
{
    public function index()
    {
        return view('Employees.salesman.dashboard.index');
    }
}
