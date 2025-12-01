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
    .auth-footer a {
        color: #db4566;
        text-decoration: none;
    }
</style>

<div class="auth-card">
    <h2>Login to Your Account</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-envelope me-2"></i>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <div class="mb-3">
            <label class="form-label"><i class="fa-solid fa-lock me-2"></i>Password</label>
            <input type="password" name="password" class="form-control" required>
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label">Remember Me</label>
        </div>

        <button class="btn btn-primary">Login</button>

        <div class="auth-footer text-center mt-3">
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot password?</a><br>
            @endif
            <span>Don't have an account? <a href="{{ route('register') }}">Register</a></span>
        </div>
    </form>
</div>
@endsection
