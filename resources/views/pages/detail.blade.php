<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @if($status==true)
        @include('components.nav')
    
    @if($product)
        <section class="flex justify-center items-stretch py-8 bg-gradient-to-bl from-blue-100 to-purple-100 min-h-[78vh]">
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
        <!-- Modal Structure -->
<div id="success-modal" class="fixed inset-0 z-10 hidden w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 10A10 10 0 118 4a10 10 0 0110 10z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Add to Cart Successful</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">The product has been added to your cart.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button id="close-modal" type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        // Show the modal
        const modal = document.getElementById('success-modal');
        modal.classList.remove('hidden');

        // Hide the modal after 5 seconds
        setTimeout(function() {
            modal.classList.add('hidden');
        }, 3000);
    });

    document.getElementById('close-modal').addEventListener('click', function() {
        const modal = document.getElementById('success-modal');
        modal.classList.add('hidden');
    });
</script>


    @else
        <p class="text-center text-gray-700">Product not found.</p>
    @endif

    @include('components.footer')
        
    @else
        <script>
            window.location.href = '/login'; // replace with your target URL
        </script>
    @endif
    
</body>
</html>