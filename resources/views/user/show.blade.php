<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary">Order #{{ $order->id }}</h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card shadow p-4">
            <h4>Order Information</h4>
            <p><strong>Placed On:</strong> {{ $order->created_at->format('d M Y') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $order->status=='pending'?'warning':'success' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Total:</strong> ${{ number_format($order->total,2) }}</p>

            <hr>

            <h5>Items</h5>
            <ul class="list-group mb-3">
                @foreach($order->items as $item)
                    <li class="list-group-item d-flex justify-content-between">
                        {{ $item->product->name }} x {{ $item->quantity }}
                        <span>${{ number_format($item->product->price * $item->quantity,2) }}</span>
                    </li>
                @endforeach
            </ul>

            <a href="{{ route('user.orders') }}" class="btn btn-secondary hover-scale">
                <i class="fas fa-arrow-left me-1"></i> Back to Orders
            </a>
        </div>
    </div>

    <style>
        .hover-scale:hover { transform: scale(1.03); transition: 0.3s ease-in-out; }
    </style>
</x-app-layout>
