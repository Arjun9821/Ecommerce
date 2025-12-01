@extends('layouts.admin') <!-- your admin layout -->

@section('content')
<div class="container mt-4">
    <h1>Admin Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Users</h5>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Products</h5>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Orders</h5>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <h5>Total Sales</h5>
                <h3>${{ number_format($totalSales, 2) }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
