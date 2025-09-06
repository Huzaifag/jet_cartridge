<?php

namespace App\Http\Controllers\Seller\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryPersonOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('delivery_person_id', Auth::guard('employee')->user()->id)
            ->with('customer')
            ->with('seller')
            ->with('orderInvoice')
            ->with('orderItems')
            ->with('orderItems.product')
            ->get();

        return view('Employees.delivery-person.orders.index', compact('orders'));
    }

    public function markDelivered(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            // 'customer_id' => 'required|exists:users,id',
            'delivery_date' => 'required|date',
            'delivery_time' => 'required',
            'proof_of_delivery' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'delivery_notes' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            // Handle proof upload if file exists
            $proofPath = null;
            if ($request->hasFile('proof_of_delivery')) {
                $proofPath = $request->file('proof_of_delivery')
                    ->store('proof_of_delivery', 'public');
            }
            $order = Order::findOrFail($validated['order_id']);
            // Save delivery record
            $delivery = OrderDelivery::create([
                'order_id' => $validated['order_id'],
                'delivery_date' => $validated['delivery_date'],
                'customer_id' => $order->customer_id,
                'delivery_time' => $validated['delivery_time'],
                'proof_of_delivery' => $proofPath,
                'delivery_notes' => $validated['delivery_notes'] ?? null,
            ]);

            
            

            // Update order status
            
            $order->status = 'delivered';
            $order->assigned_to_delivery_at = now(); // optional: add a timestamp
            $order->save();

            DB::commit();

            // $customer_id = $order->customer_id;

            return response()->json([
                'success' => true,
                'message' => 'Order marked as delivered successfully',
                'delivery' => $delivery
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            \Illuminate\Support\Facades\Log::error('Failed to mark order delivered: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while marking the order delivered. ' . $e->getMessage()
            ], 500);
        }
    }
}
