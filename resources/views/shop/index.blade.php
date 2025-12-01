@extends('layouts.app')

@section('content')

<style>
/* Category hover effect */
.category-hover {
    position: relative;
    transition: all 0.3s ease;
    border-radius: 5px;
    padding: 10px 15px;
    margin-bottom: 5px;
    background: #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 500;
    color: #333;
}

.category-hover::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 0%;
    width: 4px;
    background-color: #fd7e14; /* orange left bar */
    transition: height 0.3s ease;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

.category-hover:hover::before {
    height: 100%;
}

.category-hover:hover {
    background: #fff3e0; /* light orange background */
    transform: translateX(5px);
    font-weight: bold;
    color: #fd7e14;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.category-hover i {
    transition: transform 0.3s;
}

.category-hover:hover i {
    transform: translateX(5px);
}
</style>

<div class="container mt-4">

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">

        <!-- Categories Sidebar -->
        <div class="col-md-3">
            <div class="mb-4">
                <!-- Darker Orange Header -->
                <h5 class="text-center fw-bold py-2 rounded" 
                    style="background-color: #e06a00; color: #fff; box-shadow: 0 3px 6px rgba(0,0,0,0.2);">
                    Categories
                </h5>

                @foreach($categories as $cat)
                    <a href="{{ route('shop.index') }}?category={{ $cat->id }}" 
                       class="category-hover">
                        <span>{{ $cat->name }}</span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-9">
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 position-relative shadow-sm">

                            <!-- Stock Badge -->
                            @if($product->stock <= 0)
                                <span class="position-absolute top-0 end-0 m-2 badge bg-danger" style="z-index: 10;">
                                    Out of Stock
                                </span>
                            @elseif($product->stock <= 5)
                                <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark" style="z-index: 10;">
                                    Only {{ $product->stock }} left
                                </span>
                            @elseif($product->stock <= 10)
                                <span class="position-absolute top-0 end-0 m-2 badge bg-info" style="z-index: 10;">
                                    Limited Stock
                                </span>
                            @endif

                            <!-- Product Image -->
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $product->name }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <span class="text-white">No Image</span>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted small flex-grow-1">
                                    {{ Str::limit($product->short_description ?? $product->description, 60) }}
                                </p>
                                
                                <!-- Price -->
                                <div class="mb-2">
                                    @if($product->discount_price && $product->discount_expires_at && now()->lt($product->discount_expires_at))
                                        <span class="text-danger fw-bold">${{ number_format($product->discount_price, 2) }}</span>
                                        <del class="text-muted small">${{ number_format($product->price, 2) }}</del>
                                    @else
                                        <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>

                                <!-- Stock Info -->
                                <small class="text-muted mb-3">
                                    Stock: {{ $product->stock }} available
                                </small>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('shop.show', $product->id) }}" 
                                       class="btn btn-outline-primary btn-sm flex-grow-1">
                                        View Details
                                    </a>
                                    
                                    @auth
                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" 
                                                  method="POST" 
                                                  class="flex-grow-1">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" 
                                                        class="btn btn-primary btn-sm w-100">
                                                    <i class="fa fa-cart-plus"></i> Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary btn-sm flex-grow-1" disabled>
                                                Out of Stock
                                            </button>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="btn btn-primary btn-sm flex-grow-1">
                                            Login to Buy
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No products found.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>

@endsection
