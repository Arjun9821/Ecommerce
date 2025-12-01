@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->count() > 0)
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d M, Y') }}</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($order->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                        @endif
                    </td>
                    <td>Rs {{ number_format($order->total_price ?? $order->total, 2) }}</td>
                    <td>
                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">You have no orders yet.</div>
    @endif
</div>
@endsection
