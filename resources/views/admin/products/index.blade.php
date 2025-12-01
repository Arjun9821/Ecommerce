@extends('layouts.app')

@section('content')
<h2>All Products</h2>

<a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
    Add New Product
</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>   <!-- NEW -->
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>

                <td>{{ $product->name }}</td>

                <td>{{ $product->category->name ?? '-' }}</td>

                <td>${{ number_format($product->price, 2) }}</td>

                <!-- STOCK COLUMN -->
                <td>
                    @if($product->stock > 0)
                        <span class="badge bg-success">{{ $product->stock }} left</span>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                    @endif
                </td>

                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="50">
                    @endif
                </td>

                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                       class="btn btn-sm btn-warning">
                       Edit
                    </a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}" 
                          method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this product?');">
                            Delete
                        </button>
                    </form>
                </td>

            </tr>

        @empty
            <tr>
                <td colspan="7" class="text-center">No products found.</td>
            </tr>
        @endforelse
    </tbody>

</table>

@endsection
