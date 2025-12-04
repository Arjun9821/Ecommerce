<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BuyNowController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

/*
|--------------------------------------------------------------------------
| Auth Routes (Login / Register)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Profile
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');

    // Addresses
    Route::get('/addresses', [UserController::class, 'addresses'])->name('user.addresses');
    Route::get('/addresses/create', [UserController::class, 'createAddress'])->name('user.address.create');
    Route::post('/addresses', [UserController::class, 'storeAddress'])->name('user.address.store');

    // Orders
    Route::get('/myorders', [UserController::class, 'orders'])->name('user.orders');
    Route::get('/user/orders/{order}', [UserController::class, 'showOrder'])->name('user.orders.show');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    /*
    |--------------------------------------------------------------------------
    | Checkout Routes — FIXED
    |--------------------------------------------------------------------------
    */

    // Show checkout page (GET)
    Route::get('/checkout/{order}', [CheckoutController::class, 'show'])
        ->name('checkout');

    // Process checkout (POST)
    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Payment success callback
    Route::post('/checkout/{order}/success', [CheckoutController::class, 'paymentSuccess'])
        ->name('checkout.success');

    // Buy Now
    Route::post('/buy-now/{id}', [BuyNowController::class, 'buyNow'])->name('buy.now');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Categories & Products CRUD
        Route::resource('products', AdminProductController::class);
        Route::resource('categories', AdminCategoryController::class);

        // Orders
        Route::resource('orders', AdminOrderController::class)
            ->except(['create', 'edit', 'store', 'update']);
        Route::post('orders/{id}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

        // Admin Cart Items
        Route::get('cart-items', [\App\Http\Controllers\Admin\CartItemController::class, 'index'])
            ->name('cart-items.index');
        Route::get('cart-items/{id}/edit', [\App\Http\Controllers\Admin\CartItemController::class, 'edit'])
            ->name('cart-items.edit');
        Route::post('cart-items/{id}/update', [\App\Http\Controllers\Admin\CartItemController::class, 'update'])
            ->name('cart-items.update');
        Route::delete('cart-items/{id}', [\App\Http\Controllers\Admin\CartItemController::class, 'destroy'])
            ->name('cart-items.destroy');
    });

