<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiaryEntryController;

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

Route::get('/checkout', [AddressController::class, 'showAddresses'])->name('checkout');
Route::get('/test-form', function () {
    return view('test_form'); // This should point to the view you created
})->name('test.form');
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.apply_coupon');   
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place_order');

Route::get('/order-summary', [CheckoutController::class, 'orderSummary'])->name('order.summary');
Route::get('/order/summary/{orderId}', [CheckoutController::class, 'orderSummary'])->name('order.summary');

Route::post('/checkout/store-address', [AddressController::class, 'store'])->name('checkout.store_address');

Route::get('/checkout', [AddressController::class, 'showAddresses'])->name('checkout');

    Route::get('/order-summary', [CheckoutController::class, 'orderSummary'])->name('order.summary');
    Route::get('/order/summary/{orderId}', [CheckoutController::class, 'orderSummary'])->name('order.summary');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->middleware(['auth', 'verified'])->name('profile');
    
    Route::middleware('auth')->group(function () {
        // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // Route to show the bio
        Route::get('/profile/bio', [UserController::class, 'showBio'])->name('profile.show-bio');
        // Route to handle updating the bio
        Route::patch('/profile/bio', [UserController::class, 'updateBio'])->name('profile.update-bio');
        Route::resource('diary', DiaryEntryController::class);
        Route::get('/display_diary', [DiaryEntryController::class, 'display_diary'])->name('diary.display_diary');
        Route::get('/diary_summary', [DiaryEntryController::class, 'summary'])->name('diary.summary');
        Route::get('/conflict', [DiaryEntryController::class, 'conflict'])->name('diary.conflict');
    });
    
    Route::post('/profile-photo', [UserController::class, 'updateProfilePhoto'])->name('profile-photo.update');

    require __DIR__ . '/auth.php';
    Route::get('/{P_id}', [ProductController::class, 'show'])->name('pages.detail');

    
