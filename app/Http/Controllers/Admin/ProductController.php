<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Store new product (with stock + flash discount)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',

            // 🔥 Stock Added
            'stock' => 'required|integer|min:0',

            // Flash discount fields
            'discount_percent' => 'nullable|numeric|min:0|max:90',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_expires_at' => 'nullable|date',
        ]);

        $data = $request->all();

        // Auto-calculate discount price if percent exists
        if ($request->discount_percent && !$request->discount_price) {
            $data['discount_price'] = $request->price - ($request->price * ($request->discount_percent / 100));
        }

        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Generate slug
        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product added successfully with stock!');
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',

            // 🔥 Stock Added
            'stock' => 'required|integer|max:0',

            // Flash discount fields
            'discount_percent' => 'nullable|numeric|min:0|max:90',
            'discount_price' => 'nullable|numeric|min:0',
            'discount_expires_at' => 'nullable|date',
        ]);

        $data = $request->all();

        // Auto-calc discount_price
        if ($request->discount_percent && !$request->discount_price) {
            $data['discount_price'] = $request->price - ($request->price * ($request->discount_percent / 100));
        }

        // Replace image
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = $product->image;
        }

        // Update slug
        $data['slug'] = Str::slug($request->name);

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully with stock!');
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    // Show product on shop page
    public function show($id)
    {
        $product = Product::with('reviews')->findOrFail($id);

        $recommendedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'recommendedProducts'));
    }
}
