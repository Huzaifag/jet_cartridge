<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller\Promotion;
use Illuminate\Http\Request;

class PromotionsController extends Controller
{
    public function index()
    {
        $promotions = Promotion::where('seller_id', auth()->user()->id)->get();
        $products = Product::where('seller_id', auth()->user()->id)->get();
        return view('seller.promotions.index', compact('products','promotions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'discount_type'  => 'required|in:percentage,fixed,bogo',
            'percentage_off' => 'nullable|numeric|min:1|max:100',
            'fixed_amount'   => 'nullable|numeric|min:1',
            'buy_x'          => 'nullable|integer|min:1',
            'get_y'          => 'nullable|integer|min:1',
            'bogo_type'      => 'nullable|in:free,percentOff',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'required|in:active,draft',
            'products'       => 'array',
        ]);

        $validated['seller_id'] = auth()->user()->id;

        $promotion = Promotion::create($validated);

        if ($request->has('products')) {
            $promotion->products()->sync($request->products);
        }

        return redirect()->back()->with('success', 'Promotion created successfully!');
    }

    public function show($id)
    {
        $promotion = Promotion::with('products')->findOrFail($id);

        // Assuming Promotion model has relationships and attributes like title, description, discount_type, etc.
        // Adjust based on your actual model

        return response()->json([
            'title' => $promotion->title,
            'description' => $promotion->description,
            'discount_type' => $promotion->discount_type, // e.g., 'percentage', 'fixed', 'bogo'
            'percentage_off' => $promotion->percentage_off,
            'fixed_amount' => $promotion->fixed_amount,
            'buy_x' => $promotion->buy_x,
            'get_y' => $promotion->get_y,
            'bogo_type' => $promotion->bogo_type,
            'start_date' => $promotion->start_date->format('F d, Y'),
            'end_date' => $promotion->end_date->format('F d, Y'),
            'created_at' => $promotion->created_at->format('F d, Y'),
            'status' => $promotion->status,
            'total_redemptions' => 0, // Assuming a redemptions relationship or query
            'products' => $promotion->products->map(function ($product) {
                // Calculate discounted price based on type (simplified example)
                $discountedPrice = $product->price; // Logic here based on discount_type
                return [
                    'name' => $product->name,
                    'original_price' => '$' . number_format($product->price, 2),
                    'discounted_price' => '$' . number_format($discountedPrice, 2),
                    'sales' => $product->sales_count ?? 0, // Assuming some sales data
                ];
            }),
        ]);
    }

    /**
     * Show the form for editing the specified promotion (for AJAX fill).
     */
    public function edit($id)
    {
        $promotion = Promotion::with('products')->findOrFail($id);
        $allProducts = Product::where('seller_id', auth()->id())->get(); // Assuming products belong to seller

        return response()->json([
            'title' => $promotion->title,
            'description' => $promotion->description,
            'discount_type' => $promotion->discount_type,
            'percentage_off' => $promotion->percentage_off,
            'fixed_amount' => $promotion->fixed_amount,
            'buy_x' => $promotion->buy_x,
            'get_y' => $promotion->get_y,
            'bogo_type' => $promotion->bogo_type,
            'start_date' => $promotion->start_date->format('Y-m-d\TH:i'),
            'end_date' => $promotion->end_date->format('Y-m-d\TH:i'),
            'status' => $promotion->status,
            'selected_products' => $promotion->products->pluck('id')->toArray(),
            'all_products' => $allProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => number_format($product->price, 2),
                ];
            }),
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'discount_type'  => 'required|in:percentage,fixed,bogo',
            'percentage_off' => 'nullable|numeric|min:1|max:100',
            'fixed_amount'   => 'nullable|numeric|min:1',
            'buy_x'          => 'nullable|integer|min:1',
            'get_y'          => 'nullable|integer|min:1',
            'bogo_type'      => 'nullable|in:free,percentOff',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'required|in:active,draft',
            'products'       => 'array',
        ]);

        $promotion = Promotion::findOrFail($id);

        $promotion->update($validated);

        if ($request->has('products')) {
            $promotion->products()->sync($request->products);
        }

        return redirect()->back()->with('success', 'Promotion updated successfully!');
    }

    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();

        return redirect()->back()->with('success', 'Promotion deleted successfully!');
    }

    public function updateStatus ($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->update(['status' => 'ended']);

        return redirect()->back()->with('success', 'Promotion ended successfully!');
    }
}
