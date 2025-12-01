<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Show cart items
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Add product to cart
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);
        $quantity = $request->quantity;

        if ($product->stock <= 0) {
            return back()->with('error', 'This product is out of stock!');
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        $totalQuantity = $cartItem ? $cartItem->quantity + $quantity : $quantity;

        if ($totalQuantity > $product->stock) {
            return back()->with('error', "Only {$product->stock} items available in stock!");
        }

        if ($cartItem) {
            $cartItem->quantity = $totalQuantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully!');
    }

    // Remove item from cart
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart successfully!');
    }

    // Update cart item quantity
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::with('product')->findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $newQuantity = $request->quantity;

        if ($newQuantity > $cartItem->product->stock) {
            return back()->with('error', "Only {$cartItem->product->stock} items available in stock!");
        }

        $cartItem->quantity = $newQuantity;
        $cartItem->save();

        return back()->with('success', 'Cart updated successfully!');
    }
}
