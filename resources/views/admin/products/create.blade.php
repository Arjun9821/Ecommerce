@extends('layouts.app')

@section('content')
<h2>Add Product</h2>
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" step="0.01" required>
    </div>
    <div class="mb-3">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div> 
    <div class="mb-3">
    <label class="form-label">Stock Quantity</label>
    <input type="number" name="stock" min="0" class="form-control" required>
</div>

    <div class="mb-3">
    <label>Flash Discount (%)</label>
    <input type="number" name="discount_percent" class="form-control" min="0" max="90">
</div>

<div class="mb-3">
    <label>Discounted Price (optional)</label>
    <input type="number" step="0.01" name="discount_price" class="form-control">
</div>

<div class="mb-3">
    <label>Discount Expiry Date</label>
    <input type="datetime-local" name="discount_expires_at" class="form-control">
</div>

    <button type="submit" class="btn btn-success">Add Product</button>
</form>
@endsection
