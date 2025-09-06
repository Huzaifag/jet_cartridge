<?php

namespace App\Http\Controllers\Seller\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('seller_id', auth('employee')->user()->seller_id)
            ->where('status', 'pending')
            ->with('seller')
            ->with('customer')
            ->get();
        // dd($orders->toArray());
        return view('Employees.orders.index', compact('orders'));
    }

    public function createInvoice($id)
    {
        $order = Order::with(['seller', 'customer', 'orderItems.product', 'orderInvoice.customer'])->findOrFail($id);
        $products = Product::where('seller_id', auth('employee')->user()->seller_id)->get();


        return view('Employees.orders.create-invoice', compact('order', 'products'));
    }

    public function show($id)
    {

        $products = Product::where('seller_id', auth('employee')->user()->seller_id)->get();

        $order = Order::find($id)->with('seller')->with('customer')->with('orderItems')->get();

        return view('Employees.orders.create-invoice', compact('order', 'products'));
    }

    public function storeOrderItem(Request $request, $orderId)
    {
        $request->validate([
            'product_names' => 'required|array',
            'product_names.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
        ]);

        try {
            $order = Order::findOrFail($orderId);

            // Start a database transaction
            \DB::beginTransaction();

            // Delete existing items
            $order->orderItems()->delete();

            // Create new items
            $items = [];
            foreach ($request->product_names as $key => $productId) {
                $items[] = [
                    'product_id' => $productId,
                    'quantity' => $request->quantities[$key],
                    'price' => $request->prices[$key],
                    'order_id' => $orderId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $order->orderItems()->insert($items);

            // Recalculate order total
            $subtotal = array_reduce($items, function ($carry, $item) {
                return $carry + ($item['quantity'] * $item['price']);
            }, 0);

            $tax = $subtotal * 0.1; // 10% tax
            $total = $subtotal + $tax;

            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);

            // Commit the transaction
            \DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order items updated successfully',
                'order' => [
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                ]
            ]);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            \DB::rollBack();

            \Log::error('Error updating order items: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update order items. Please try again.' . $e->getMessage(),
            ], 500);
        }
    }

    public function sendInvoice(Request $request, $orderId)
    {
        try {
            $order = Order::with('orderItems')->findOrFail($orderId);

            // ✅ Validate only what you actually need
            $validated = $request->validate([
                'amount'        => 'required|numeric|min:0',
                'status'        => 'required|string',
                'accountant_id' => 'required|exists:employees,id',
                'customer_id'   => 'required|exists:users,id',
            ]);

            // ✅ Calculate amounts
            $tax = 10;
            $shipping = 100;
            $subtotal = $order->orderItems->sum(fn($item) => $item->price * $item->quantity);
            $total = $subtotal + $shipping + $tax;

            $orderItemsCount = $order->orderItems->count();
            $orderItems = $order->orderItems;

            // ✅ Generate PDF and save
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
                'seller.pdf.download-order-invoice',
                compact('order', 'tax', 'subtotal', 'shipping', 'total', 'orderItemsCount', 'orderItems')
            );

            $directory = public_path('invoices');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $fileName = 'invoice_' . $order->id . '.pdf';
            $pdf->save($directory . '/' . $fileName);

            $invoiceFilePath = 'invoices/' . $fileName;

            // ✅ Create or update invoice
            $invoice = $order->orderInvoice;
            if ($invoice) {
                $invoice->update([
                    'amount'        => $validated['amount'],
                    'status'        => 'pending',
                    'accountant_id' => $validated['accountant_id'],
                    'customer_id'   => $validated['customer_id'],
                    'sent_at'       => now(),
                    'invoice_file'  => $invoiceFilePath,
                ]);
            } else {
                $invoice = $order->orderInvoice()->create([
                    'order_id'      => $order->id,
                    'amount'        => $validated['amount'],
                    'status'        => 'pending',
                    'accountant_id' => $validated['accountant_id'],
                    'customer_id'   => $validated['customer_id'],
                    'sent_at'       => now(),
                    'invoice_file'  => $invoiceFilePath,
                ]);
            }

            // TODO: Send email to customer
            // Mail::to($order->customer->email)->send(new InvoiceSent($invoice));

            return response()->json([
                'success' => true,
                'message' => 'Invoice has been sent to the customer successfully.',
                'invoice' => $invoice->fresh()
            ]);
        } catch (\Exception $e) {
            \Log::error('Error sending invoice: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send invoice: ' . $e->getMessage()
            ], 500);
        }
    }
}
