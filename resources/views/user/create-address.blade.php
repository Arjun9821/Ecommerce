@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add New Address</h3>
    <form action="{{ route('user.address.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>State</label>
            <input type="text" name="state" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Postal Code</label>
            <input type="text" name="postal_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Address</button>
    </form>
</div>
@endsection
