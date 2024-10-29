<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;

// Home route
Route::get('/', function () {
    return view('home'); 
})->name('home');

// About route
Route::get('/profile', function () {
    return view('pages.profile'); 
})->name('profile');

// Services route
Route::get('/favorites', function () {
    return view('pages.fav'); 
})->name('favorites');

// Contact route
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');


Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/', [ProductController::class, 'getProductsByCategory'])->name('home');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('/cart/delete/{cartId}', [CartController::class, 'destroy']);

Route::get('/checkout', function () {
    return view('pages.checkout'); 
})->name('favorites');


    Route::post('/checkout/store-address', [AddressController::class, 'store'])->name('checkout.store_address');

    Route::get('/checkout', [AddressController::class, 'showAddresses'])->name('checkout');
    Route::get('/test-form', function () {
        return view('test_form'); // This should point to the view you created
    })->name('test.form');
    Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply_coupon');