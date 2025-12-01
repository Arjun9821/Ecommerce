@extends('layouts.app')

@section('content')

<h2 class="fw-bold mb-4">Checkout</h2>

<form method="POST" action="{{ route('checkout.store') }}">
    @csrf

    <div class="mb-3">
        <label class="fw-bold">Full Name</label>
        <input type="text" class="form-control" name="name" required>
    </div>

    <div class="mb-3">
        <label class="fw-bold">Shipping Address</label>
        <textarea class="form-control" name="address" required></textarea>
    </div>

    <button class="btn btn-success btn-lg mt-3">Place Order</button>
</form>

@endsection
