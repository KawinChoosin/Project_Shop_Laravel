<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('components.nav')

    @if($product)
        <section class="flex justify-center items-stretch py-8 bg-gradient-to-bl from-blue-100 to-purple-100 min-h-[68vh]">
            <!-- Image Section -->
            <div class="flex-1 flex justify-center items-center">
                <img src="{{ $product->P_img }}" alt="{{ $product->P_name }}" class="max-w-[50%] rounded-md object-contain">
            </div>
            <!-- Product Detail Section -->
            <div class="flex-1 bg-white p-6 rounded-md shadow-lg mr-5">
                <h2 class="text-2xl font-semibold text-gray-900">
                    {{ $product->P_name }}
                </h2>
                <p class="mt-2 text-gray-600">
                    {{ $product->P_description }}
                </p>
                <h5 class="mt-4 text-xl font-semibold text-red-600">
                    ฿{{ number_format($product->P_price, 2) }}
                </h5>
                <p class="mt-2 text-green-600">
                    In Stock: {{ $product->P_quantity }}
                </p>

                <form method="POST" action="{{ route('cart.addToCart', ['P_id' => $product->P_id]) }}" class="mt-6">
                    @csrf
                    <div class="flex items-center">
                        <button type="button" class="group rounded-l-full px-4 py-[10px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50" onclick="decreaseQuantity()">
                            <svg class="stroke-gray-900" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        </button>
                        <input type="text" id="quantity" name="quantity" value="0" 
                            class="border border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[100px] py-[7px] text-center bg-transparent" 
                            onchange="validateQuantity(this, {{ $product->P_quantity }})">
                        <button type="button" class="group rounded-r-full px-4 py-[10px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50" onclick="increaseQuantity({{ $product->P_quantity }})">
                            <svg class="stroke-gray-900" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                <path d="M11 5.5V16.5M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>

                    <button type="submit" class="mt-6 bg-gray-800 text-white px-6 py-2 rounded disabled:opacity-50" id="add-to-cart-btn" disabled>
                        Add to cart
                    </button>
                </form>
            </div>
        </section>

        <script>
            let quantity = 0;
            
            const setQuantity = (value) => {
                quantity = value;
                const quantityInput = document.getElementById('quantity');
                quantityInput.value = value;
                const addToCartBtn = document.getElementById('add-to-cart-btn');
                addToCartBtn.disabled = quantity < 1 || quantity > {{ $product->P_quantity }};
            };

            const increaseQuantity = (maxQuantity) => {
                if (quantity < maxQuantity) {
                    setQuantity(quantity + 1);
                }
            };

            const decreaseQuantity = () => {
                if (quantity > 0) {
                    setQuantity(quantity - 1);
                }
            };

            const validateQuantity = (input, maxQuantity) => {
                const value = Math.max(0, parseInt(input.value) || 0);
                setQuantity(value <= maxQuantity ? value : maxQuantity);
            };
        </script>
    @else
        <p class="text-center text-gray-700">Product not found.</p>
    @endif

    @include('components.footer')
</body>
</html>