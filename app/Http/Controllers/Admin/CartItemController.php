<?php 
 namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;

class CartItemController extends Controller
{
    public function index()
{
    // Get all cart items with user and product relationships
    $cartItems = \App\Models\CartItem::with(['user', 'product'])->get();

    return view('admin.cart.index', compact('cartItems'));
}


    public function edit($id)
    {
        $item = CartItem::findOrFail($id);
        $products = Product::all();
        $users = User::all();

        return view('admin.cart.edit', compact('item', 'products', 'users'));
    }

    public function update($id)
    {
        $item = CartItem::findOrFail($id);

        $item->update([
            'user_id'    => request('user_id'),
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
        ]);

        return redirect()->route('admin.cart.index')->with('success', 'Cart item updated successfully');
    }

    public function destroy($id)
    {
        CartItem::destroy($id);
        return back()->with('success', 'Cart item deleted');
    }
}
