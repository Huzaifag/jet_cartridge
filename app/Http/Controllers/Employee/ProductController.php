<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $seller = Auth::user()->seller;
        $products = Product::where('seller_id', $seller->id)
            ->latest()
            ->paginate(10);

        return view('employee.products.index', compact('products'));
    }

    public function create()
    {
        return view('employee.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specifications' => 'nullable|array',
            'specifications.*.key' => 'required|string|max:255',
            'specifications.*.value' => 'required|string|max:255',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:active,inactive,out_of_stock',
            'moq' => 'required|integer|min:1'
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product-images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Format specifications
        $specifications = [];
        if (!empty($validated['specifications'])) {
            foreach ($validated['specifications'] as $spec) {
                if (!empty($spec['key']) && !empty($spec['value'])) {
                    $specifications[$spec['key']] = $spec['value'];
                }
            }
        }

        $employee = Auth::guard('employee')->user();
        
        // Create product
        $product = new Product([
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
            'verification_status' => 'pending',
            'seller_id' => $employee->seller_id,
            'created_by' => $employee->id
        ]);

        $product->save();

        return redirect()->route('employee.products.index')
            ->with('success', 'Product created successfully');
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        return view('employee.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('employee.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('employee.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return redirect()->route('employee.products.index')
            ->with('success', 'Product deleted successfully.');
    }
} 