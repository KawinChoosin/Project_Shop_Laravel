<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body>
    @include('components.nav')
    <section class="py-24 relative">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-black">Profile</h2>

            <div class="hidden lg:grid grid-cols-2 py-6">
                <div class="font-normal text-xl leading-8 text-gray-500">Username: {{ $customer->name }}</div>
            </div>
            <div class="font-normal text-xl leading-8 text-gray-500">Email: {{ $customer->email }}</div>
            
            <!-- Log Out Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Log Out
                </button>
            </form>

            <!-- Summary Section for Orders -->
            <div class="rounded-xl p-6 w-full mb-8 max-lg:max-w-xl max-lg:mx-auto">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Order Summary</h3>

                @if($orders->isEmpty())
                    <p class="text-gray-500">You have no orders yet.</p>
                @else
                    @foreach($orders as $order)
                        <div class="order-item mb-4 p-4 bg-gray-100 rounded-lg">
                            <div>
                                <span class="font-semibold">Order ID:</span> {{ $order->O_id }}
                            </div>
                            <div>
                                <span class="font-semibold">Order Date:</span> {{ $order->created_at->format('d M Y') }}
                            </div>
                            <div>
                                <span class="font-semibold">Total:</span> ${{ number_format($order->O_Total, 2) }}
                            </div>

                            <!-- Show product details -->
                            <div class="mt-4">
                                <h4 class="font-semibold text-lg">Items:</h4>
                                @foreach($order->orderDetails as $detail)
                                    <div class="order-detail-item py-2 px-4 bg-white rounded mb-2">
                                        <div>
                                            <span class="font-semibold">Product:</span> {{ $detail->product->P_name }} <!-- Display product name -->
                                        </div>
                                        <div>
                                            <img src="{{ asset($detail->product->P_img) }}" alt="{{ $detail->product->P_name }}" class="w-20 h-20 object-cover rounded">
                                        </div>
                                        <div>
                                            <span class="font-semibold">Quantity:</span> {{ $detail->OD_quantity }}
                                        </div>
                                        <div>
                                            <span class="font-semibold">Price per Item:</span> ${{ number_format($detail->OD_price, 2) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <!-- Modal HTML remains as you have it -->
    </section>

    @include('components.footer')

    <!-- Scripts remain unchanged -->
    <script>
        // Your existing JavaScript code...
    </script>
</body>
</html>
