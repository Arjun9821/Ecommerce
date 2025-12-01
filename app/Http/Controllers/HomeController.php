<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function welcome()
    {
        // All recent products (limit 8)
        $products = Product::latest()->take(8)->get();

        // Flash products (active discounts)
        $flashProducts = Product::whereNotNull('discount_price')
            ->where('discount_expires_at', '>', now())
            ->latest()
            ->take(8)
            ->get();

        return view('welcome', compact('products', 'flashProducts'));
    }
}
