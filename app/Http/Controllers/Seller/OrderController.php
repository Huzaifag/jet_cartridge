<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Order;
use App\Models\OrderItemSplit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        // null

        $orders = Order::with('customer')
            ->where('seller_id', auth('seller')->user()->id)
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
        return view('seller.orders.index', compact('orders'));
    }

    public function bulkIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::with('customer')
            ->where('seller_id', auth('seller')->user()->id)
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

        return view('seller.orders.index', compact('orders'));
    }




    public function show($id)
    {
        $order = Order::with('customer')->with('products')->with('orderItems')->where('seller_id', auth('seller')->user()->id)->findOrFail($id);
        // want to calculate 
        $tax = 10;
        $subtotal = $order->orderItems->sum('price');
        $shipping = 100;
        $total = $subtotal + $shipping + $tax;

        $orderItemsCount = $order->orderItems->count();
        $orderItems = $order->orderItems;

        // dd($orderItems->toArray());

        // TODO: Implement order details view
        return view('seller.orders.show', compact('order', 'tax', 'subtotal', 'shipping', 'total', 'orderItemsCount', 'orderItems'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);

        $order = Order::with(['customer', 'products', 'orderItems'])
            ->where('seller_id', auth('seller')->user('seller')->id)
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
            $pdf = \PDF::loadView('seller.pdf.download-order-invoice', compact(
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

            $accountant = Employee::where('seller_id', auth('seller')->user('seller')->id)->where('position', 'Accountant')->first();



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
            ->route('seller.orders.show', $id)
            ->with('success', 'Order reviewed successfully! and Send to accountant')
            ->with('invoice_file', $invoice_file); // pass file path to session
    }



    public function printInvoice($id)
    {
        $order = Order::with('customer')->with('products')->with('orderItems')->where('seller_id', auth('seller')->user('seller')->id)->findOrFail($id);
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
        $order = Order::with('customer')->with('products')->with('orderItems')->with('orderItemSplit')->where('seller_id', auth('seller')->user('seller')->id)->findOrFail($id);
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
        return view('seller.orders.order-split', compact('order', 'tax', 'subtotal', 'shipping', 'total', 'orderItemsCount', 'orderItems', 'orderItemsCount', 'orderItemSplits'));
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


    public function trackIndex()
    {
        return view('seller.orders.track-index');
    }
}
