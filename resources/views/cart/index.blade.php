@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>

        <div id="cart-items" class="space-y-4">
            <!-- รายการสินค้าจะถูกแสดงที่นี่โดย JavaScript -->
        </div>

        <div class="text-right mt-4">
            <p class="text-2xl font-bold" id="total-price">Total: ฿0.00</p>
        </div>
    </div>

    <!-- ปุ่มเพิ่มสินค้าในที่อื่น (ตัวอย่าง) -->
    <button id="add-to-cart-btn">Add to Cart</button>
    <input type="hidden" id="product-id" value="{{ $product->P_id }}">
    <input type="number" id="quantity" value="1">
@endsection
