<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by search term
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by stock range
        if ($request->filled('stock_range')) {
            [$minStock, $maxStock] = explode('-', $request->stock_range);
            $query->whereBetween('stock', [(int)$minStock, (int)$maxStock]);
        }

        // Filter by price range
        if ($request->filled('price_range')) {
            [$minPrice, $maxPrice] = explode('-', $request->price_range);
            $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }

        $products = $query
            ->with(['seller', 'creator'])
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        // Load the seller and creator relationships
        $product->load(['seller', 'creator']);

        // You might want to increment view count or track product visits here

        return view('frontend.product-details', compact('product'));
    }

}
