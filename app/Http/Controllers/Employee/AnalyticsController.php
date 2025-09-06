<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Get the authenticated employee's seller
        $seller = auth()->guard('employee')->user()->seller;

        // Gather analytics data
        $analytics = [
            'total_products' => Product::where('seller_id', $seller->id)->count(),
            'active_products' => Product::where('seller_id', $seller->id)
                                      ->where('status', 'active')
                                      ->count(),
            'out_of_stock_products' => Product::where('seller_id', $seller->id)
                                             ->where('stock_quantity', 0)
                                             ->count(),
            'total_orders' => Order::where('seller_id', $seller->id)->count(),
            'pending_orders' => Order::where('seller_id', $seller->id)
                                   ->where('status', 'pending')
                                   ->count(),
            'completed_orders' => Order::where('seller_id', $seller->id)
                                     ->where('status', 'completed')
                                     ->count(),
        ];

        return view('employee.analytics.index', compact('analytics'));
    }
} 