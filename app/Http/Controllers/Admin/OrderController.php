<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        // Only admins can access these routes
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of all orders.
     */
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show a specific order details.
     */
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status (e.g., pending, shipped, delivered).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    /**
     * Delete an order (if needed).
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    /**
     * Optional: Export order as PDF or Excel
     */
    public function export($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);

        // Example: return PDF or Excel
        // return PDF::loadView('admin.orders.invoice', compact('order'))->download('order_'.$id.'.pdf');

        return view('admin.orders.export', compact('order'));
    }
}
