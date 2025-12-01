@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Order Details - #{{ $order->id }}</h2>

    <div class="card p-3 mb-3">
        <h5>Products:</h5>
        <ul>
            @foreach($order->products as $product)
                <li>
                    {{ $product->name }} - Qty: {{ $product->pivot->quantity }} - ${{ number_format($product->price, 2) }}
                </li>
            @endforeach
        </ul>

        <h4>Total: ${{ number_format($order->total_price, 2) }}</h4>
        <p>Status: <strong>{{ ucfirst($order->status) }}</strong></p>
        @if(isset($order->payment_status))
            <p>Payment Status: <strong>{{ ucfirst($order->payment_status) }}</strong></p>
        @endif
        <p>Address: {{ $order->address }}</p>
    </div>

    <a href="{{ route('user.orders') }}" class="btn btn-secondary">Back to My Orders</a>
</div>
@endsection
