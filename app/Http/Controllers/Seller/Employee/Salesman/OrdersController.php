<?php

namespace App\Http\Controllers\Seller\Employee\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderItemSplit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $seller_id = auth('employee')->user()->seller_id;

        // null

        $orders = Order::with('customer')
            ->where('seller_id', $seller_id)
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->get();

        // dd($orders->toArray());    
        // TODO: Implement order listing
        return view('Employees.salesman.orders.index', compact('orders'));
    }

    public function bulkIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $seller_id = auth('employee')->user()->seller_id;

        $orders = Order::with('customer')
            ->where('seller_id', $seller_id)
            ->whereHas('customer', function ($query) {
                $query->role('retailer'); // only customers with retailer role
            })
            ->when($search, function ($query, $search) {
                return $query->whereHas('customer', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->get();

        return view('Employees.salesman.orders.index', compact('orders'));
    }




    public function show($id)
    {
        $order = Order::with('customer')->with('products')->with('orderItems')->where('seller_id', auth('employee')->user()->seller_id)->findOrFail($id);
        // want to calculate 
        $tax = 10;
        $subtotal = $order->orderItems->sum('price');
        $shipping = 100;
        $total = $subtotal + $shipping + $tax;

        $orderItemsCount = $order->orderItems->count();
        $orderItems = $order->orderItems;

        // dd($orderItems->toArray());

        // TODO: Implement order details view
        return view('Employees.salesman.orders.show', compact('order', 'tax', 'subtotal', 'shipping', 'total', 'orderItemsCount', 'orderItems'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);
        $seller_id = auth('employee')->user()->seller_id;
        $order = Order::with(['customer', 'products', 'orderItems'])
            ->where('seller_id', $seller_id)
            ->findOrFail($id);

        // Calculate totals
        $tax = 10;
        $subtotal = $order->orderItems->sum(fn($item) => $item->price * $item->quantity);
        $shipping = 100;
        $total = $subtotal + $shipping + $tax;

        $orderItemsCount = $order->orderItems->count();
        $orderItems = $order->orderItems;

        $order->update(['status' => $request->status]);

        $invoice_file = null;

        // Create invoice pdf only if approved
        if ($request->status == 'approved') {
            $order->update(['status' => 'pending']);
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('seller.pdf.download-order-invoice', compact(
                'order',
                'tax',
                'subtotal',
                'shipping',
                'total',
                'orderItemsCount',
                'orderItems'
            ));

            $directory = storage_path('app/public/invoices');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $invoice_file = 'invoices/invoice_' . $order->id . '.pdf';
            $pdf->save(storage_path('app/public/' . $invoice_file));

            $accountant = Employee::where('seller_id', $seller_id)->where('position', 'Accountant')->first();



            $order->orderInvoice()->updateOrCreate(
                ['order_id' => $order->id],
                [
                    'amount' => $total,
                    'status' => $order->payment_status ?? 'pending',
                    'invoice_file' => $invoice_file,
                    'accountant_id' => $accountant->id,
                ]
            );
        }

        return redirect()
            ->back()
            ->with('success', 'Order reviewed successfully! and Send to accountant')
            ->with('invoice_file', $invoice_file); // pass file path to session
    }



    public function printInvoice($id)
    {
        $seller_id = auth('employee')->user()->seller_id;
        $order = Order::with('customer')->with('products')->with('orderItems')->where('seller_id', $seller_id)->findOrFail($id);
        // want to calculate 
        $tax = 10;
        $subtotal = $order->orderItems->sum('price');
        $shipping = 100;
        $total = $subtotal + $shipping + $tax;

        $orderItemsCount = $order->orderItems->count();
        $orderItems = $order->orderItems;

        // dd(
        //     [
        //         'order' => $order->toArray(),
        //         'tax' => $tax,
        //         'subtotal' => $subtotal,
        //         'shipping' => $shipping,
        //         'total' => $total,
        //         'orderItemsCount' => $orderItemsCount,
        //         'orderItems' => $orderItems->toArray(),
        //     ]
        // );

        // dd($orderItems->toArray());

        // TODO: Implement print invoice view
        $pdf = Pdf::loadView('seller.pdf.download-order-invoice', compact('order', 'tax', 'subtotal', 'shipping', 'total', 'orderItemsCount', 'orderItems', 'orderItemsCount'));
        return $pdf->stream('order-invoice.pdf');
    }

    public function orderSplit($id)
    {
        $seller_id = auth('employee')->user()->seller_id;
        $order = Order::with('customer')->with('products')->with('orderItems')->with('orderItemSplit')->where('seller_id', $seller_id)->findOrFail($id);
        // want to calculate 
        $tax = 10;
        $subtotal = $order->orderItems->sum('price');
        $shipping = 100;
        $total = $subtotal + $shipping + $tax;

        $orderItemsCount = $order->orderItems->count();
        $orderItems = $order->orderItems;


        $orderItemSplits = OrderItemSplit::where('order_id', $order->id)->get();
        // dd($orderItemSplits);


        // TODO: Implement print invoice view
        return view('Employees.salesman.orders.order-split', compact('order', 'tax', 'subtotal', 'shipping', 'total', 'orderItemsCount', 'orderItems', 'orderItemsCount', 'orderItemSplits'));
    }
    public function orderSplitStore(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'order_item_ids' => 'required|array|min:1',
            'order_item_ids.*' => 'exists:order_items,id',
        ]);

        OrderItemSplit::create([
            'order_id' => $request->order_id,
            'order_item_ids' => $request->order_item_ids, // auto-cast to JSON (if model has cast)
        ]);

        return back()
            ->with('success', 'Order split created successfully!');
    }
}
