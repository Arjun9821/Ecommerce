@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary fw-bold">My Orders</h2>

    @if($orders->count() > 0)
        <div class="table-responsive shadow rounded">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-white">
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Placed At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="table-light">
                            <td>#{{ $order->id }}</td>
                            <td class="fw-bold text-success">${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                                @elseif($order->status == 'completed')
                                    <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                                @elseif($order->status == 'canceled')
                                    <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center shadow-sm">
            <i class="bi bi-info-circle-fill me-2"></i>You have not placed any orders yet.
        </div>
    @endif
</div>
@endsection
