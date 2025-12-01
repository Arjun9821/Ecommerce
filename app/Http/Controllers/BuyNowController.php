<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuyNowController extends Controller
{
    public function buyNow($productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);
        $address = $user->address ?? 'No Address';

        $order = null;

        DB::transaction(function () use ($user, $product, $address, &$order) {
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $product->price,
                'status' => 'pending',
                'address' => $address,
            ]);

            $order->products()->attach($product->id, ['quantity' => 1]);
        });

        return redirect()->route('checkout', ['order' => $order->id])
                         ->with('success', 'Order placed successfully!');
    }
}
