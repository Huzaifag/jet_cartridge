<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::where('status', 'approved')->paginate(12);
        return view('seller.index', compact('sellers'));
    }

    public function show(Request $request, $sellerId)
    {
        // Check if this is a registration route
        if ($sellerId === 'register') {
            return redirect()->route('seller.register');
        }

        try {
            $seller = Seller::where('id', $sellerId)
                          ->where('status', 'approved')
                          ->firstOrFail();
            
            // Get seller's featured products
            $products = $seller->products()
                ->where('status', 'active')
                ->where('is_featured', true)
                ->latest()
                ->take(6)
                ->get();

            return view('seller.public-profile', compact('seller', 'products'));
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error in seller profile: ' . $e->getMessage());
            
            // Return with debug information in development
            if (config('app.debug')) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'seller_id' => $sellerId,
                    'trace' => $e->getTraceAsString()
                ], 404);
            }
            
            return abort(404, 'Seller not found');
        }
    }
} 