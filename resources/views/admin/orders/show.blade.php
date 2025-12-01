@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Order #{{ $order->id }}</h2>

    <div class="mb-4">
        <h5>User: {{ $order->user->name }}</h5>
        <h5>Email: {{ $order->user->email }}</h5>
        <h5>Date: {{ $order->created_at->format('d M Y, H:i') }}</h5>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price,2) }}</td>
                    <td>${{ number_format($item->quantity * $item->price,2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <h5>Total Amount: ${{ number_format($order->total,2) }}</h5>
    </div>

    <div class="mt-3">
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex align-items-center gap-2">
            @csrf
            <select name="status" class="form-select w-auto">
                <option value="pending" {{ $order->status=='pending' ? 'selected':'' }}>Pending</option>
                <option value="completed" {{ $order->status=='completed' ? 'selected':'' }}>Completed</option>
            </select>
            <button type="submit" class="btn btn-success">Update Status</button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
