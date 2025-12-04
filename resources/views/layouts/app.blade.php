<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Click&Collect') }}</title>

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fa;
        }

        /* Top Navigation Bar */
        .top-nav {
            width: 100%;
            background: #fd7e14;
            border-bottom: 1px solid #e06614;
            display: flex;
            align-items: center;
            padding: 0 20px;
            height: 60px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        /* Logo */
        .top-nav .logo {
            display: flex;
            align-items: center;
            margin-right: 30px;
        }

        .top-nav .logo img {
            height: 40px;
            width: auto;
            margin-right: 10px;
            border-radius: 5px;
        }

        .top-nav .logo span {
            color: #fff;
            font-weight: bold;
            font-size: 20px;
        }

        .top-nav .nav-item {
            position: relative;
            margin-right: 25px;
            display: flex;
            align-items: center;
            padding: 10px 0;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }

        .top-nav .nav-item i {
            margin-right: 8px;
            transition: 0.3s;
        }

        .top-nav .nav-item::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: #fff;
            transition: 0.3s;
        }

        .top-nav .nav-item:hover {
            color: #ffd1a3;
        }

        .top-nav .nav-item:hover i {
            transform: scale(1.2);
            color: #ffd1a3;
        }

        .top-nav .nav-item:hover::after {
            width: 100%;
            background: #fff;
        }

        .top-nav .nav-item.active {
            color: #fff;
            font-weight: bold;
        }

        .top-nav .nav-item.active::after {
            width: 100%;
            background: #fff;
        }

        .content-area {
            margin-top: 70px;
            padding: 25px;
        }

        a.nav-item {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <div class="top-nav">

        <!-- Logo -->
        <div class="logo d-flex align-items-center">
            <img src="{{ asset('images/ecom/CandC.jpg') }}" alt="Logo">
            <span>{{ config('app.name', 'Click&Collect') }}</span>
        </div>

        <!-- Navigation Links -->
        <a href="{{ route('shop.index') }}" class="nav-item {{ request()->routeIs('shop.index') ? 'active' : '' }}">
            <i class="fa fa-store"></i> Shop
        </a>

        <a href="{{ route('contact') }}" class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="fa fa-envelope"></i> Contact
        </a>

        @auth
            <a href="{{ route('user.dashboard') }}" class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fa fa-user"></i> Dashboard
            </a>

            <a href="{{ route('cart.index') }}" class="nav-item {{ request()->routeIs('cart.index') ? 'active' : '' }}">
                <i class="fa fa-shopping-cart"></i> Cart
            </a>

            <a href="{{ route('user.orders') }}" class="nav-item {{ request()->routeIs('user.orders') ? 'active' : '' }}">
                <i class="fa fa-box"></i> My Orders
            </a>

            <a href="{{ route('logout') }}" class="nav-item"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
                <i class="fa fa-sign-in-alt"></i> Login
            </a>

            <a href="{{ route('register') }}" class="nav-item {{ request()->routeIs('register') ? 'active' : '' }}">
                <i class="fa fa-user-plus"></i> Register
            </a>
        @endauth

        @can('admin')
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt"></i> Admin Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fa fa-box-open"></i> Products
            </a>

            <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fa fa-tags"></i> Categories
            </a>

            <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa fa-receipt"></i> Orders
            </a>
        @endcan

    </div>

    <!-- Main Content -->
    <div class="content-area">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
