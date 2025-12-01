@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Addresses</h2>

    <a href="{{ route('user.address.create') }}" class="btn btn-success mb-3">Add New Address</a>

    @if($addresses->count() > 0)
        <div class="row">
            @foreach($addresses as $address)
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <h5>{{ $address->name }}</h5>
                    <p>
                        {{ $address->street }}, {{ $address->city }}<br>
                        {{ $address->state }}, {{ $address->zipcode }}<br>
                        {{ $address->country }}
                    </p>
                    <p><strong>Phone:</strong> {{ $address->phone }}</p>
                    <a href="{{ route('user.address.edit', $address->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('user.address.delete', $address->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this address?')">Delete</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p>You have no addresses saved.</p>
    @endif
</div>
@endsection
