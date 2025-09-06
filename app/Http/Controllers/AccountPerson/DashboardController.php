<?php

namespace App\Http\Controllers\AccountPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $accountPerson = Auth::guard('account-person')->user();
        $seller = $accountPerson->seller;

        // You can add more data here as needed for the dashboard
        $data = [
            'accountPerson' => $accountPerson,
            'seller' => $seller,
            'recentTransactions' => [], // Placeholder for recent transactions
            'statistics' => [
                'totalTransactions' => 0,
                'pendingTransactions' => 0,
                'completedTransactions' => 0,
                'thisMonthTransactions' => 0
            ]
        ];

        return view('account-person.dashboard', $data);
    }
} 