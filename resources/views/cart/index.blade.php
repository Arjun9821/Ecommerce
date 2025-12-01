@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">Your Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if($cartItems->count() > 0)
        <div class="row g-3">
            @foreach($cartItems as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top" style="height:200px; object-fit:cover;" alt="{{ $item->product->name }}">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white" style="height:200px;">
                                No Image
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text text-muted mb-2">${{ number_format($item->product->price, 2) }}</p>
                            
                            <!-- Quantity Form -->
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center mb-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="form-control form-control-sm me-2" style="width:70px;">
                                <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-sync-alt"></i> Update</button>
                            </form>

                            <p class="mb-2"><strong>Subtotal:</strong> ${{ number_format($item->quantity * $item->product->price, 2) }}</p>

                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100"><i class="fa fa-trash"></i> Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total -->
        <div class="mt-4 text-end">
            <h4>Total: <span class="text-success">${{ number_format($total, 2) }}</span></h4>
            <a href="{{ route('checkout.store') }}" class="btn btn-lg btn-primary mt-2"><i class="fa fa-credit-card"></i> Proceed to Checkout</a>
        </div>

    @else
        <div class="alert alert-info text-center mt-5">Your cart is empty.</div>
        <div class="text-center mt-3">
            <a href="{{ route('shop.index') }}" class="btn btn-primary"><i class="fa fa-store"></i> Go to Shop</a>
        </div>
    @endif
</div>
@endsection
