<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function welcome()
    {
        // 1️⃣ Get the 8 most recent products
        $products = Product::latest()->take(8)->get();

        // 2️⃣ Get the 8 products with active discounts
        $flashProducts = Product::whereNotNull('discount_price')       
            ->where('discount_expires_at', '>', now())                 
            ->latest()
            ->take(8)
            ->get();

        // 3️⃣ Return view with both collections
        return view('welcome', compact('products', 'flashProducts'));
    }
}
