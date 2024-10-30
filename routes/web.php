<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;

// Home
Route::get('/', [ProductController::class, 'getProductsByCategory'])->name('home');

// Profile Information
Route::get('/profile', function () {
    return view('pages.profile'); 
})->name('profile');

// Cart
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add-to-cart', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/cart/delete/{cartId}', [CartController::class, 'destroy']);

// Order
Route::get('/checkout', function () {
    return view('pages.checkout'); 
})->name('favorites');

Route::get('/ordersummary', function () {
    return view('pages.ordersummary'); 
})->name('ordersummary');

Route::post('/checkout/store-address', [AddressController::class, 'store'])->name('checkout.store_address');

Route::get('/checkout', [AddressController::class, 'showAddresses'])->name('checkout');

Route::get('/test-form', function () {
    return view('test_form'); // This should point to the view you created
})->name('test.form');

Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply_coupon');   
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place_order');

Route::get('/order-summary', [CheckoutController::class, 'orderSummary'])->name('order.summary');
Route::get('/order/summary/{orderId}', [CheckoutController::class, 'orderSummary'])->name('order.summary');

// Product Detail (must be the lastest route)
Route::get('/{P_id}', [ProductController::class, 'show'])->name('pages.detail');