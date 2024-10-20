<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

            <form method="POST" action="{{ route('cart.add', ['P_id' => $product->P_id]) }}" class="mt-6">
                @csrf
                <div style="display: flex; width: 130px; align-items: center; border: 1px solid #0B68D2; border-radius: 4px;">
                    <button type="button" class="bg-blue-600 text-white w-10 h-10" onclick="decreaseQuantity()">-</button>
                    <input type="text" id="quantity" name="quantity" value="0" 
                        class="w-12 h-10 text-center border-l border-r border-blue-600" 
                        onchange="validateQuantity(this, {{ $product->P_quantity }})">
                    <button type="button" class="bg-blue-600 text-white w-10 h-10" onclick="increaseQuantity({{ $product->P_quantity }})">+</button>
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
