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
    
    <section class="py-24 relative  ">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-black">Successfully order</h2>
            
            <div class="hidden lg:grid grid-cols-2 py-6">
                <div class="font-normal text-xl leading-8 text-gray-500">Product</div>
                <p class="font-normal text-xl leading-8 text-gray-500 flex items-center justify-between">
            
                    <span class="w-full max-w-[450px] text-center">Quantity</span>
                    <span class="w-full max-w-[160px] text-center">Total</span>
                    <span class="w-full max-w-[30px] text-center"></span>
               
                </p>
            </div>

            @foreach($orderDetails as $item)
                <div id="cart-item-{{ $item->CA_id }}" class="grid grid-cols-1 lg:grid-cols-2 min-[550px]:gap-6 border-t border-gray-200 py-6">
                    <div class="flex items-center flex-col min-[550px]:flex-row gap-3 min-[550px]:gap-6 w-full max-xl:justify-center max-xl:max-w-xl max-xl:mx-auto">
                        <div class="img-box">
                            <img src="{{ $item->product->P_img }}" alt="{{ $item->product->P_name }}" class="xl:w-[140px] rounded-xl object-cover">
                        </div>
                        <div class="pro-data w-full max-w-sm">
                            <h5 class="font-semibold text-xl leading-8 text-black max-[550px]:text-center">{{ $item->product->P_name }}</h5>
                            <p class="font-normal text-lg leading-8 text-gray-500 my-2 min-[550px]:my-3 max-[550px]:text-center">
                                {{ $item->category }}
                            </p>
                            <h6 class="font-medium text-lg leading-8 text-indigo-600 max-[550px]:text-center">
                                $<span id="price-{{ $item->CA_id }}">{{ number_format($item->OD_price, 2) }}</span>
                            </h6>
                            
                        </div>
                    </div>
                    <div class="flex items-center flex-col min-[550px]:flex-row w-full max-xl:max-w-xl max-xl:mx-auto gap-2">
                        <div class="flex items-center w-full mx-auto justify-center">
                            <h6 class="font-medium text-lg leading-8 text-indigo-600 max-[550px]:text-center">
                                <span id="price-{{ $item->CA_id }}">{{ number_format($item->OD_quantity) }}</span>
                            </h6>
                        </div>
                        <h6 class="text-indigo-600 font-manrope font-bold text-2xl leading-9 w-full max-w-[176px] text-center">
                            $<span id="total-price-{{ $item->CA_id }}">{{ number_format($item->OD_quantity * $item->OD_price, 2) }}</span>
                        </h6>
                    </div>
                </div>
            @endforeach


            <!-- Summary Section -->
            <div class="bg-gray-50 rounded-xl p-6 w-full mb-8 max-lg:max-w-xl max-lg:mx-auto mt-6">
           
            <div class="flex items-center justify-between w-full mb-6">
                    <p class="font-normal text-xl leading-8 text-gray-400">Time</p>
                    <h6 class="font-semibold text-base leading-8 text-gray-900" id="cart-subtotal">{{ $O_Date_time  }}</h6>
                    
                </div>
                <div class="flex items-center justify-between w-full mb-6">
                    <p class="font-normal text-xl leading-8 text-gray-400">Address</p>
                    <h6 class="font-semibold text-base leading-8 text-gray-900" id="cart-subtotal">{{  $O_Address }}</h6>
                    
                </div>
                <div class="flex items-center justify-between w-full mb-6">
                    <p class="font-normal text-xl leading-8 text-gray-400">Total(discount if have coupon code)</p>    
                    <h6 class="font-semibold text-base leading-8 text-gray-900" id="cart-subtotal">${{ number_format( $O_Total , 2) }}</h6>
                    
                </div>
              
            </div>

            <!-- Checkout Buttons -->
            <div class="flex items-center flex-col sm:flex-row justify-center gap-3 mt-8">
      
                <a href="{{ url('/') }}" class=" rounded-full w-full max-w-[280px] py-4 text-center justify-center items-center bg-green-600 font-semibold text-lg text-white flex transition-all duration-500 hover:bg-green-700">
                    Shop more item
                   
                </a>

            </div>
        </div>

  

    </section>

    @include('components.footer')


</body>
</html>
