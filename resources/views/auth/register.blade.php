@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg,#fbc2eb,#a6c1ee);
    }
    .auth-card {
        width: 100%;
        max-width: 480px;
        background: #ffffffee;
        padding: 40px 35px;
        margin: 40px auto;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .auth-card h2 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 35px;
        color: #db4566;
    }
    .form-label i { color: #db4566; }
    .form-control {
        border-radius: 10px !important;
        padding: 14px 15px;
    }
    .btn-primary {
        background: #db4566;
        border-radius: 10px;
        width: 100%;
        padding: 12px;
        font-weight: 600;
        border: none;
    }
    .btn-primary:hover {
        background: #9242dd;
        box-shadow: 0 6px 12px rgba(146,66,221,0.3);
    }
</style>

<div class="auth-card">
    <h2>Create Your Account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-user me-2"></i>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            <x-input-error :messages="$errors->get('name')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-phone me-2"></i>Phone</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
            <x-input-error :messages="$errors->get('phone')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-location-dot me-2"></i>Address</label>
            <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
            <x-input-error :messages="$errors->get('address')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-user-gear me-2"></i>Register As</label>
            <select name="role" class="form-select">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-lock me-2"></i>Password</label>
            <input type="password" name="password" class="form-control" required>
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-lock me-2"></i>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
        </div>

        <button class="btn btn-primary">Register</button>

        <div class="text-center mt-3">
            Already have an account?
            <a href="{{ route('login') }}" class="fw-bold" style="color:#db4566">Login</a>
        </div>
    </form>
</div>
@endsection
