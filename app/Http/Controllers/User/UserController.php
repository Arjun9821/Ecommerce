<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\Address;

class UserController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $ordersCount = Order::where('user_id', Auth::id())->count();
        $addressesCount = Address::where('user_id', Auth::id())->count();
        return view('user.dashboard', compact('ordersCount', 'addressesCount'));
    }

    // Show Edit Profile Form
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }

    // Handle Profile Update
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.edit.profile')->with('success', 'Profile updated successfully!');
    }

    // List Orders
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('user.orders', compact('orders'));
    }

    // Show single order details
    public function showOrder($orderId)
    {
        // Ensure the order belongs to the logged-in user
        $order = Order::with('products')->where('user_id', Auth::id())->findOrFail($orderId);

        return view('user.order_show', compact('order'));
    }

    // List Addresses
    public function addresses()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('user.addresses', compact('addresses'));
    }

    // Show form to create new address
    public function createAddress()
    {
        return view('user.create-address');
    }

    // Save new address
    public function storeAddress(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        Address::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return redirect()->route('user.addresses')->with('success', 'Address added successfully!');
    }
}
