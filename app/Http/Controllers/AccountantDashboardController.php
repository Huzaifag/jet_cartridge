<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountantDashboardController extends Controller
{
    public function index()
    {
        return view('employees.accountant.dashboard.index');
    }
}
