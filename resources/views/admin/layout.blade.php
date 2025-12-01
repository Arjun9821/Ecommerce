<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { min-height: 100vh; }
        .sidebar { height: 100vh; position: fixed; left: 0; top: 0; width: 220px; background-color: #343a40; color: #fff; }
        .sidebar a { color: #fff; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background-color: #495057; border-radius: 5px; }
        .content { margin-left: 230px; padding: 20px; }
        .card { border-radius: 15px; transition: transform 0.3s ease-in-out; }
        .card:hover { transform: scale(1.03); }
        .badge { font-size: 0.9em; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center py-3">Admin Panel</h3>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="{{ route('admin.products.index') }}"><i class="fas fa-boxes me-2"></i> Products</a>
        <a href="{{ route('admin.categories.index') }}"><i class="fas fa-list-alt me-2"></i> Categories</a>
        <a href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
        <a href="{{ route('admin.cart.index') }}" class="btn btn-primary">Manage Cart Items</a>
        <a href="#"><i class="fas fa-users me-2"></i> Users</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
