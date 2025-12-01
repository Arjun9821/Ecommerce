@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="text-center py-5 bg-light">
    <h1 class="fw-bold">Welcome to Click&Collect</h1>
    <p class="lead">Best products with best prices</p>
    <a href="{{ route('shop.index') }}" class="btn btn-primary btn-lg mt-3">Shop Now</a>
</div>

<!-- Flash Offers Section -->
<div class="mt-5">
    <h3 class="fw-bold mb-4">Flash Offers</h3>
    <div class="row">
        @forelse($flashProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $product->name }}</h5>

                        @if($product->discount_price && $product->discount_expires_at && now()->lt($product->discount_expires_at))
                            <p>
                                <span class="text-danger fw-bold">Rs {{ number_format($product->discount_price, 2) }}</span>
                                <del class="text-muted">Rs {{ number_format($product->price, 2) }}</del>
                            </p>
                            <small class="text-warning">Expires: {{ \Carbon\Carbon::parse($product->discount_expires_at)->diffForHumans() }}</small>
                        @else
                            <p>Rs {{ number_format($product->price, 2) }}</p>
                        @endif

                        <a href="{{ route('shop.show', $product->id) }}" class="btn btn-sm btn-primary mt-2">View Product</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No flash offers available right now.</p>
        @endforelse
    </div>
</div>

<!-- Latest Products Section -->
<div class="mt-5">
    <h3 class="fw-bold mb-4">Latest Products</h3>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $product->name }}</h5>
                        <p>Rs {{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('shop.show', $product->id) }}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
