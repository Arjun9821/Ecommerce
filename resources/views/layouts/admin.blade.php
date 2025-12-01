<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            left: 0;
            top: 0;
            background: #1b1f3b;
            color: white;
            padding-top: 30px;
        }
        .sidebar a {
            padding: 12px 20px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #4c5fb1;
        }
        .content {
            margin-left: 240px;
            padding: 30px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h4 class="text-center mb-4">Admin Panel</h4>

    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>

    <a href="{{ route('admin.products.index') }}"><i class="fas fa-box me-2"></i> Products</a>

    <a href="{{ route('admin.categories.index') }}"><i class="fas fa-list me-2"></i> Categories</a>

    <a href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-bag me-2"></i> Orders</a>
    
    <a class="nav-link" href="{{ route('admin.cart-items.index') }}">
    <i class="fa fa-shopping-cart"></i> Cart Items
</a>



    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
