@extends('layouts.app')

@section('content')
<div class="container mt-5">
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

    <!-- Back Button -->
    <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Back to Shop
    </a>

    <div class="row">
        <!-- Product Image -->
        <div class="col-md-5 position-relative">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded">
            @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" 
                     style="height: 400px;">
                    <span>No Image Available</span>
                </div>
            @endif

            <!-- Stock Badge on Image -->
            @if($product->stock <= 0)
                <span class="position-absolute top-0 end-0 m-3 badge bg-danger fs-6">
                    Out of Stock
                </span>
            @elseif($product->stock <= 5)
                <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark fs-6">
                    Only {{ $product->stock }} left!
                </span>
            @elseif($product->stock <= 10)
                <span class="position-absolute top-0 end-0 m-3 badge bg-info fs-6">
                    Limited Stock
                </span>
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-7">
            <h2>{{ $product->name }}</h2>

            <!-- Flash Discount / Price -->
            <div class="product-price mb-3">
                @if($product->discount_price && $product->discount_expires_at && now()->lt($product->discount_expires_at))
                    <p>
                        <span class="text-danger fw-bold fs-4">Flash Offer: Rs {{ number_format($product->discount_price, 2) }}</span>
                        <del class="text-muted">Rs {{ number_format($product->price, 2) }}</del>
                    </p>
                    <small class="text-warning">
                        <i class="fa fa-clock"></i> Expires: {{ $product->discount_expires_at->diffForHumans() }}
                    </small>
                @else
                    <p class="fs-4 fw-bold">Price: Rs {{ number_format($product->price, 2) }}</p>
                @endif
            </div>

            <!-- Stock Availability -->
            <div class="mb-3">
                <strong>Availability: </strong>
                @if($product->stock > 0)
                    <span class="text-success">
                        <i class="fa fa-check-circle"></i> In Stock ({{ $product->stock }} available)
                    </span>
                @else
                    <span class="text-danger">
                        <i class="fa fa-times-circle"></i> Out of Stock
                    </span>
                @endif
            </div>

            <p class="text-muted">{{ $product->short_description }}</p>

            <!-- Add to Cart Form -->
            @auth
                @if($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add', $product->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-bold">Quantity:</label>
                            <div class="input-group" style="max-width: 200px;">
                                <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <input type="number" 
                                       name="quantity" 
                                       id="quantity" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}"
                                       class="form-control text-center"
                                       required>
                                <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <small class="text-muted">Maximum: {{ $product->stock }} units</small>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa fa-cart-plus"></i> Add to Cart
                        </button>
                    </form>
                    <form action="{{ route('buy.now', $product->id) }}" method="POST">
    @csrf
    <button class="btn btn-warning w-100 mt-2">Buy Now</button>
</form>


                @else
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> 
                        This product is currently out of stock. Please check back later.
                    </div>
                @endif
            @else
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> 
                    Please <a href="{{ route('login') }}" class="alert-link">login</a> to add this product to your cart.
                </div>
            @endauth
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="row mt-5">
        <div class="col-12">
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Reviews</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="recommendations-tab" data-bs-toggle="tab" data-bs-target="#recommendations" type="button">Recommendations</button>
                </li>
            </ul>

            <div class="tab-content mt-3" id="productTabContent">
                <!-- Overview -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel">
                    <p>{{ $product->short_description }}</p>
                </div>

                <!-- Details -->
                <div class="tab-pane fade" id="details" role="tabpanel">
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Reviews -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    <h5>Customer Reviews</h5>
                    @forelse($product->reviews ?? [] as $review)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $review->user->name }}</strong>
                                    <span class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <p class="mt-2">{{ $review->comment }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No reviews yet. Be the first to review this product!</p>
                    @endforelse
                </div>

                <!-- Recommendations -->
                <div class="tab-pane fade" id="recommendations" role="tabpanel">
                    <h5>You May Also Like</h5>
                    <div class="row">
                        @forelse($recommendedProducts ?? [] as $rec)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 position-relative">
                                    <!-- Stock Badge for Recommended -->
                                    @if($rec->stock <= 0)
                                        <span class="position-absolute top-0 end-0 m-2 badge bg-danger" style="z-index: 10;">
                                            Out of Stock
                                        </span>
                                    @elseif($rec->stock <= 5)
                                        <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark" style="z-index: 10;">
                                            Only {{ $rec->stock }} left
                                        </span>
                                    @endif

                                    @if($rec->image)
                                        <img src="{{ asset('storage/' . $rec->image) }}" 
                                             class="card-img-top" 
                                             alt="{{ $rec->name }}"
                                             style="height: 150px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" 
                                             style="height: 150px;">
                                            <span>No Image</span>
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <h6 class="card-title">{{ $rec->name }}</h6>
                                        <p class="card-text">
                                            @if($rec->discount_price && $rec->discount_expires_at && now()->lt($rec->discount_expires_at))
                                                <span class="text-danger">Rs {{ number_format($rec->discount_price, 2) }}</span>
                                                <del class="text-muted">Rs {{ number_format($rec->price, 2) }}</del>
                                            @else
                                                Rs {{ number_format($rec->price, 2) }}
                                            @endif
                                        </p>
                                        <a href="{{ route('shop.show', $rec->id) }}" class="btn btn-sm btn-primary">View</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No recommendations available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const maxStock = {{ $product->stock }};
    
    function incrementQuantity() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue < maxStock) {
            input.value = currentValue + 1;
        }
    }
    
    function decrementQuantity() {
        const input = document.getElementById('quantity');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }
    
    // Prevent manual input beyond max stock
    document.getElementById('quantity').addEventListener('input', function() {
        if (parseInt(this.value) > maxStock) {
            this.value = maxStock;
        }
        if (parseInt(this.value) < 1) {
            this.value = 1;
        }
    });
</script>
@endsection