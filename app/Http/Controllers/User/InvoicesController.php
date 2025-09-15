<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\OrderInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Auth::user()->invoices;
        return view('frontend.invoices.index', compact('invoices'));
    }

    public function download($id)
    {

        $invoice = OrderInvoice::findOrFail($id);
        $filePath = public_path($invoice->invoice_file);

        return response()->download($filePath);
    }

    public function pay($id, Request $request)
    {
        try {
            $invoice = OrderInvoice::findOrFail($id);

            DB::transaction(function () use ($invoice, $request) {
                // Update invoice
                $invoice->update([
                    'status' => 'paid',
                ]);

                // Update order
                $invoice->order->update([
                    'payment_status' => 'paid',
                    'payment_method' => $request->input('payment_method'),
                ]);
            });

            return response()->json([
                'success' => 'Thank you! Your order has been marked as paid and will be delivered in a few days.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to process payment: ' . $e->getMessage()
            ], 500);
        }
    }
}
