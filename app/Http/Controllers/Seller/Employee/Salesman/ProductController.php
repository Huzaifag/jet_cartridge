<?php

namespace App\Http\Controllers\Seller\Employee\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $seller_id = auth('employee')->user()->seller_id;
        $seller = Seller::find($seller_id);
        $query = $seller->products();

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

        return view('Employees.salesman.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Employees.salesman.products.show', compact('product'));
    }

    public function createBulkProducts()
    {
        return view('Employees.salesman.products.create-bulk');
    }

    
    public function create()
    {
        return view('Employees.salesman.products.create');
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
            'redirect' => route('Employees.salesman.products.index')
        ]);
    }

    public function edit(Product $product)
    {
        // $this->authorize('update', $product);
        return view('Employees.salesman.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

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
            'redirect' => route('Employees.salesman.products.index')
        ]);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

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
