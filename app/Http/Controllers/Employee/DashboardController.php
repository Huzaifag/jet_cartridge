<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        $seller = $employee->seller;

        // Grant manage_products permission if not already granted
        if (!$employee->hasPermission('manage_products')) {
            $employee->grantPermission('manage_products');
        }

        // Get product count for the seller
        $productCount = Product::where('seller_id', $seller->id)->count();
        $activeProductCount = Product::where('seller_id', $seller->id)
            ->where('status', 'active')
            ->count();
        $outOfStockCount = Product::where('seller_id', $seller->id)
            ->where('stock_quantity', 0)
            ->count();

        return view('employee.dashboard', compact('productCount', 'activeProductCount', 'outOfStockCount'));
    }

    public function analytics()
    {
        return view('employee.analytics');
    }
} 