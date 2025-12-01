@extends('layouts.app')

@section('content')

<h2 class="fw-bold mb-4">Contact Us</h2>

<form>
    <div class="mb-3">
        <label class="fw-bold">Your Name</label>
        <input class="form-control">
    </div>

    <div class="mb-3">
        <label class="fw-bold">Your Email</label>
        <input class="form-control">
    </div>

    <div class="mb-3">
        <label class="fw-bold">Message</label>
        <textarea class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Send Message</button>
</form>

@endsection
