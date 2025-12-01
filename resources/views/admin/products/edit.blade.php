@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="mb-3">
    <label>Flash Discount (%)</label>
    <input type="number" name="discount_percent" value="{{ $product->discount_percent }}" class="form-control">
</div>

<div class="mb-3">
    <label>Discount Price</label>
    <input type="number" step="0.01" name="discount_price" value="{{ $product->discount_price }}" class="form-control">
</div>

<div class="mb-3">
    <label>Discount Expiry Date</label>
    <input type="datetime-local" name="discount_expires_at"
           value="{{ $product->discount_expires_at ? $product->discount_expires_at->format('Y-m-d\TH:i') : '' }}"
           class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Stock Quantity</label>
    <input type="number" name="stock" min="0" value="{{ $product->stock }}" class="form-control" required>
</div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id==$category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
