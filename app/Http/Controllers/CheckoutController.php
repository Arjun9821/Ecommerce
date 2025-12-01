<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    // Mock store() already exists for cart orders

    // Show checkout page with Stripe payment intent
    public function show($orderId)
    {
        $order = Order::with('products')->findOrFail($orderId);

        // Initialize Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create payment intent
        $paymentIntent = PaymentIntent::create([
            'amount' => $order->total_price * 100, // Stripe expects cents
            'currency' => 'usd',
            'metadata' => ['order_id' => $order->id],
        ]);

        $clientSecret = $paymentIntent->client_secret;

        return view('checkout', compact('order', 'clientSecret'));
    }

    // Handle payment webhook or confirm (optional)
    public function paymentSuccess(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->status = 'completed';
        $order->payment_status = 'Paid';
        $order->save();

        return redirect()->route('user.orders')
                         ->with('success', 'Payment successful! Order confirmed.');
    }
}
