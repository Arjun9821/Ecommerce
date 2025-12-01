<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();

        // Total sales (sum of total_price in orders)
        $totalSales = Order::sum('total_price'); // Use your column name: total_price

        return view('admin.dashboard', compact('totalUsers', 'totalOrders', 'totalProducts', 'totalSales'));
    }
}
