<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Optional: filter by category if passed
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12); // or all()
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
         $recommendedProducts = Product::where('category_id', $product->category_id)
                              ->where('id', '!=', $id)
                              ->take(4)
                              ->get();
        return view('shop.show', compact('product','recommendedProducts'));
    }
}
