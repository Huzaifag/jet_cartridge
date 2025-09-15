<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = auth('seller')->user()->products();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->stock_range) {
            list($min, $max) = explode('-', $request->stock_range);
            $query->whereBetween('stock_quantity', [(int)$min, (int)$max]);
        }

        if ($request->price_range) {
            list($min, $max) = explode('-', $request->price_range);
            $query->whereBetween('price', [(int)$min, (int)$max]);
        }

        $products = $query->latest()->paginate(10);

        return view('seller.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('seller.products.show', compact('product'));
    }

    public function createBulkProducts()
    {
        return view('seller.products.create-bulk');
    }

    /**
     * Delete multiple products at once
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkDelete(Request $request)
    {
        if (!Auth::guard('seller')->check()) {
            return redirect()->route('seller.login')->with('error', 'You are not logged in as a seller');
        }

        // if (!Auth::guard('seller')->user()->hasRole('seller')) {
        //     return redirect()->route('seller.login')->with('error', 'You are not a seller');
        // }

        // dd($request->all());
        
        $request->validate([
            'selected_ids' => 'required|string',
        ]);

        $ids = json_decode($request->selected_ids, true);
        
        if (empty($ids) || !is_array($ids)) {
            return redirect()->back()->with('error', 'No products selected for deletion.');
        }

        // Only delete products that belong to the authenticated seller
        $deleted = auth('seller')->user()->products()->whereIn('id', $ids)->delete();

        if ($deleted > 0) {
            return redirect()->route('seller.products.index')
                ->with('success', $deleted . ' product(s) have been deleted successfully.');
        }

        return redirect()->back()->with('error', 'No products were deleted.');
    }

    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'moq' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specifications' => 'nullable|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive,out_of_stock',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product-images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Parse specifications from JSON string
        $specifications = [];
        if (!empty($validated['specifications'])) {
            $specifications = $validated['specifications'] ?? [];
        }

        // Create product
        $product = Auth::user()->products()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'moq' => $validated['moq'],
            'stock_quantity' => $validated['stock_quantity'],
            'category' => $validated['category'],
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'specifications' => $specifications,
            'images' => $imagePaths,
            'status' => $validated['status'],
            'verification_status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'redirect' => route('seller.products.index')
        ]);
    }

    public function edit(Product $product)
    {
        dd('This page has to be build soon');
        if (!Auth::guard('seller')->check()) {
            return redirect()->route('seller.login')->with('error', 'You are not logged in as a seller');
        }
        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if (!Auth::guard('seller')->check()) {
            return redirect()->route('seller.login')->with('error', 'You are not logged in as a seller');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'moq' => 'required|integer|min:1',
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specifications' => 'nullable|array',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive,out_of_stock',
            'remove_images' => 'nullable|array',
        ]);

        // Handle image uploads and removals
        $imagePaths = $product->images ?? [];

        // Remove selected images
        if ($request->remove_images) {
            foreach ($request->remove_images as $index) {
                if (isset($imagePaths[$index])) {
                    Storage::disk('public')->delete($imagePaths[$index]);
                    unset($imagePaths[$index]);
                }
            }
            $imagePaths = array_values($imagePaths); // Reindex array
        }

        // Add new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $path = $image->store('product-images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Update product
        $product->update([
            ...$validated,
            'images' => $imagePaths,
            'specifications' => $request->specifications ?? [],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'redirect' => route('seller.products.index')
        ]);
    }

    public function destroy(Product $product)
    {
        if (!Auth::guard('seller')->check()) {
            return redirect()->route('seller.login')->with('error', 'You are not logged in as a seller');
        }

        // Delete product images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
