@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4" style="color: #e06a00;">My Dashboard</h2>

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <div class="list-group shadow-sm">
                <a href="{{ route('user.dashboard') }}" 
                   class="list-group-item list-group-item-action active"
                   style="background-color: #e06a00; border-color: #e06a00; color: #fff;">
                    Dashboard Home
                </a>
                <a href="{{ route('user.orders') }}" 
                   class="list-group-item list-group-item-action"
                   style="color: #e06a00;">
                    My Orders
                </a>
                <a href="{{ route('user.addresses') }}" 
                   class="list-group-item list-group-item-action"
                   style="color: #e06a00;">
                    My Addresses
                </a>
                <a href="{{ route('user.profile.edit') }}" 
                   class="list-group-item list-group-item-action"
                   style="color: #e06a00;">
                    Edit Profile
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 style="color: #e06a00;">Welcome, {{ Auth::user()->name }}!</h4>
                    <p class="text-muted">Here’s a quick overview of your account.</p>

                    <div class="row text-center mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3 shadow-sm" style="border-color: #e06a00;">
                                <h5 class="text-warning">{{ $ordersCount ?? 0 }}</h5>
                                <p style="color: #e06a00;">Orders</p>
                                <a href="{{ route('user.orders') }}" class="btn btn-sm" style="background-color: #e06a00; color: #fff;">
                                    View Orders
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded p-3 shadow-sm" style="border-color: #e06a00;">
                                <h5 class="text-warning">{{ $addressesCount ?? 0 }}</h5>
                                <p style="color: #e06a00;">Addresses</p>
                                <a href="{{ route('user.addresses') }}" class="btn btn-sm" style="background-color: #e06a00; color: #fff;">
                                    Manage Addresses
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p style="color: #555;">Use the sidebar to quickly navigate through your account settings and orders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
