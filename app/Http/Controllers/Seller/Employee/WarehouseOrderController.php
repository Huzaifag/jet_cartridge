<?php

namespace App\Http\Controllers\Seller\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\DeliveryPerson;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class WarehouseOrderController extends Controller
{
    public function index()
    {
        // Check if the order belongs to the seller
        if (!auth('employee')->user()->seller_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }
        $orders = Order::where('payment_status','paid')->where('seller_id',auth('employee')->user()->seller_id)
        ->whereIn('status', ['pending', 'production', 'assigned'])
        ->with('products')
        ->with('seller')
        ->with('customer')
        ->with('orderItems')
        ->with('deliveryPerson')
        ->get();
        // dd($orders->toArray());

        $deliveryPersons = Employee::where('position', 'delivery_boy')->get();
        // dd($orders->toArray());
        return view('Employees.warehouse.orders.index',compact('orders','deliveryPersons'));
    }

    /**
     * Start production for an order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function startProduction(Request $request, $order)
    {
        $request->validate([
            'estimated_time' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            // // Check if the order belongs to the seller
            // if ($order->seller_id !== auth('employee')->user()->seller_id) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Unauthorized action.'
            //     ], 403);
            // }

            $currentOrder = Order::findOrFail($order);

            // Update order status to 'in_production'
            $currentOrder->seller_id = auth('employee')->user()->seller_id;
            $currentOrder->status = 'production';
            $currentOrder->production_started_at = now();
            $currentOrder->estimated_completion_days = $request->estimated_time;
            $currentOrder->notes = $request->notes;
            $currentOrder->save();

            // Add production notes as a comment or in an order_meta table if you have one
            if ($request->notes) {
                // Assuming you have a comments/notes system or an order_meta table
                // For now, we'll just log it
                \Log::info("Production started for order #{$currentOrder->id}", [
                    'estimated_days' => $request->estimated_time,
                    'notes' => $request->notes,
                    'started_by' => auth('employee')->user()->id
                ]);
            }

            
            return back()->with('success', 'Production started successfully.');

        } catch (\Exception $e) {
            \Log::error('Error starting production: ' . $e->getMessage());
            return back()->with('error', 'Failed to start production. Please try again.' . $e->getMessage());
        }
    }

    /**
     * Assign delivery person to an order
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignDelivery(Request $request)
{
    try {
        $request->validate([
            'deliveryPerson' => 'required|exists:employees,id',
            'deliveryNotes' => 'nullable|string|max:1000',
            'deliveryOrderId' => ['required', 'regex:/^#ORD-\d+$/'],
        ]);

        $orderId = (int) str_replace('#ORD-', '', $request->deliveryOrderId);
        $order = Order::findOrFail($orderId);

        // Check if the order belongs to the seller
        if ($order->seller_id !== auth('employee')->user()->seller_id) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Check if order is in production status
        if ($order->status !== 'production') {
            return back()->with('error', 'Order must be in production status before assigning delivery.');
        }

        // Update order status and delivery information
        $order->status = 'assigned';
        $order->delivery_person_id = $request->deliveryPerson;
        $order->delivery_notes = $request->deliveryNotes ?? null;
        $order->assigned_to_delivery_at = now();
        $order->save();

        return redirect()->route('warehouse.orders')
            ->with('success', 'Delivery assigned successfully to ' . Employee::find($request->deliveryPerson)->name);

    } catch (\Exception $e) {
        \Log::error('Error assigning delivery: ' . $e->getMessage());
        return back()->with('error', 'Failed to assign delivery. ' . $e->getMessage());
    }
}

}
