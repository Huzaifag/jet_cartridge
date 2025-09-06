<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WarehouseDashboardController extends Controller
{
    public function index()
    {
        return view('employees.warehouse.dashboard.index');
    }
}
