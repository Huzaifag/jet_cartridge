<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function index()
    {
        // Fetch all active products with seller and creator
        $featuredProducts = Product::where('status', 'active')
            ->with(['seller', 'creator'])
            ->latest()
            ->get();

        $sellers = Seller::with('products')->where('status', 'approved')->latest()->paginate(6);



        return view('frontend.index', compact('featuredProducts', 'sellers'));
    }

    public function seller($slug)
    {
        try {
            $seller = Seller::with('products')->where('slug', $slug)->where('status', 'approved')->firstOrFail();
            $products = $seller->products;
            // dd($products->toArray());

            return view('frontend.seller', compact('seller', 'products'));
        } catch (\Exception $e) {
            Log::error('Error fetching seller or products: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Seller not found or an error occurred.');
        }
    }
}
