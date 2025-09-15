<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function index()
    {
        if (!auth()->user()->hasRole('customer')) {
            return redirect('/');
        }

        $cart = auth()->user()->cart;
        $subtotal = $cart ? $cart->total() : 0;
        $shipping = 10;

        $tax = 5;
        $total = $subtotal + $shipping + $tax;
        return view('frontend.cart.index', compact('cart', 'total', 'subtotal', 'shipping', 'tax'));
    }

    public function removeFromCart(CartItem $item)
    {
        if (!auth()->user()->hasRole('customer')) {
            return redirect('/');
        }

        $item->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
    }

    public function addToCart(Product $product)
    {
        if (!auth()->user()->hasRole('customer')) {
            return redirect('/');
        }

        // Debug session
        \Log::info('Session ID: ' . session()->getId());
        \Log::info('Session data: ', session()->all());

        // Get or create user's active cart
        $cart = auth()->user()->cart()->firstOrCreate([
            'status' => 'active'
        ]);

        // Check if product already exists in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // If it exists, increase the quantity by 1
            $cartItem->increment('quantity', 1);
        } else {
            // Otherwise, create a new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        // Debug session
        if (!session()->has('success')) {
            \Log::error('Session not set properly');
            return back()->with('error', 'Failed to add product to cart');
        }

        return redirect()->back()->with('success', 'Product added to cart');
    }



    public function order(Cart $cart)
    {
        // This array will store created orders to return later
        $createdOrders = [];

        DB::transaction(function () use ($cart, &$createdOrders) {

            // Group cart items by seller
            $itemsBySeller = $cart->items->groupBy(fn($item) => $item->product->seller_id);

            foreach ($itemsBySeller as $sellerId => $items) {

                // Calculate total for this seller
                $total = $items->sum(fn($item) => $item->price * $item->quantity);

                // Create order for this seller
                $order = Order::create([
                    'seller_id' => $sellerId,
                    'customer_id' => auth()->user()->id,
                    'total' => $total,
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'payment_method' => 'cod',
                    'shipping_address' => auth()->user()->address ?? 'N/A',
                    'billing_address' => auth()->user()->address ?? 'N/A',
                    'notes' => '',
                    'is_bulk' => $items->count() > 1,
                ]);

                OrderStatus::insert([
                    ['order_id' => $order->id, 'stage' => 'order_placed', 'status' => 'completed', 'started_at' => now(), 'completed_at' => now()],
                    ['order_id' => $order->id, 'stage' => 'with_accountant', 'status' => 'in_progress', 'started_at' => null, 'completed_at' => null],
                    ['order_id' => $order->id, 'stage' => 'invoice_stage', 'status' => 'pending', 'started_at' => null, 'completed_at' => null],
                    ['order_id' => $order->id, 'stage' => 'in_production', 'status' => 'pending', 'started_at' => null, 'completed_at' => null],
                    ['order_id' => $order->id, 'stage' => 'delivery', 'status' => 'pending', 'started_at' => null, 'completed_at' => null],
                ]);

                // Create order items for this seller
                foreach ($items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                    ]);
                }

                // Add created order to the array
                $createdOrders[] = $order;
            }

            // Optionally: Clear the cart after order
            $cart->items()->delete();
            $cart->delete();
        });

        // Return created orders for confirmation or further processing
        return redirect()->back()->with('success', 'Order placed successfully!');
    }
}
