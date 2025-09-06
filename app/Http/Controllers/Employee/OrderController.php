<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $employee = Auth::guard('employee')->user();
        $orders = Order::where('seller_id', $employee->seller_id)
            ->latest()
            ->paginate(10);

        return view('employee.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('employee.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Order status updated successfully');
    }
} 