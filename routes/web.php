<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ContactMessageController;

use Illuminate\Support\Facades\Route;

// ── Frontend ──────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// ── Auth Required (Frontend) ──────────────────────────
Route::middleware('auth')->group(function () {

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // My Orders (Frontend)
    Route::get('/my-orders', [MyOrderController::class, 'index'])->name('my-orders');
    Route::get('/my-orders/{id}', [MyOrderController::class, 'show'])->name('my-orders.show');
    Route::get('/my-orders/{id}/success', [MyOrderController::class, 'success'])->name('orders.success');

});

// ── Dashboard redirect ────────────────────────────────
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// ── Admin ─────────────────────────────────────────────
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Sliders
        Route::resource('sliders', SliderController::class);

        // Categories
        Route::resource('categories', CategoryController::class);

        // Products
        Route::resource('products', AdminProductController::class);

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');
        Route::put('/orders/{order}', [AdminOrderController::class, 'update'])
            ->name('orders.update');

        // Customers
        Route::get('/customers', [CustomerController::class, 'index'])
            ->name('customers.index');

        // Contacts
        Route::get('/contacts', [ContactMessageController::class, 'index'])
            ->name('contacts.index');
        Route::post('/contacts/{id}/reply', [ContactMessageController::class, 'reply'])
            ->name('contacts.reply');

    });

// Cart Routes
Route::middleware('auth')->group(function () {
    Route::get('/cart',              [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add',         [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}',[App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear',       [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
});

// Checkout Routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout',  [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/orders',      [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/success/{id}', function($id) {
        $order = \App\Models\Order::findOrFail($id);
        return view('frontend.orders.success', compact('order'));
    })->name('orders.success');
});

require __DIR__ . '/auth.php';
