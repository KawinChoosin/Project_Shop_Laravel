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
<section class="bg-white py-8 antialiased md:py-16">
  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <ol class="items-center flex w-full max-w text-center text-sm font-medium text-gray-500 sm:text-base">
       <li class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
        <a href="{{ url('/cart') }}" >
          <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] sm:after:hidden">
          <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Cart
        </span>
      </a>
      </li>
      
      

      <li class="after:border-1 flex items-center text-green-600 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
        <span class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] sm:after:hidden">
          <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          Checkout
        </span>
      </li>


      <li class="flex shrink-0 items-center">
        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        Order summary
      </li>
    </ol>
   
    <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
  <div class="min-w-0 flex-1 space-y-8">
    <div class="space-y-4">
      <h2 class="text-xl font-semibold text-gray-900 " >Delivery Details</h2>
     
      
        <h3 class="mb-4 block text-base font-semibold text-gray-900  ">Please select address (required *)</h3>
        <form id="addressForm" onsubmit="update(event)">
        <select id="addresses" name="address_id" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" onchange="updateAddressId()">
            <option selected disabled>Select an address</option>
            @foreach($addresses as $address)
                <option value="{{ $address->id }}">
                    {{ $address->A_name }}, {{ $address->A_address_line1 }}, {{ $address->A_city }}, {{ $address->A_country }}, {{ $address->A_phone_number }}
                </option>
            @endforeach
            
        </select>
        </form>
        <!-- @if (session('status') === false && session('errors'))
    <div class=" text-sm ml-4 text-red-600">
        <p>address require</p>
    </div>
@endif -->

        <div class="flex items-center my-4">
            <hr class="flex-grow border-t border-gray-200">
            <span class="mx-4 text-gray-500">or</span>
            <hr class="flex-grow border-t border-gray-200">
        </div>
        <h3 class="mb-4 block text-base font-semibold text-gray-900">Add new address</h3>
        <form action="{{ route('checkout.store_address') }}" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
            <label for="A_name" class="mb-2 block text-sm font-medium text-gray-900">Your name</label>
            <input type="text" id="A_name" name="A_name" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="Bonnie Green" required />
        </div>

        <div>
            <label for="A_address_line1" class="mb-2 block text-sm font-medium text-gray-900">Address</label>
            <input type="text" id="A_address_line1" name="A_address_line1" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="Address Line 1" required>
        </div>

        <div>
            <label for="A_city" class="mb-2 block text-sm font-medium text-gray-900">City</label>
            <input type="text" id="A_city" name="A_city" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="City" required>
        </div>

        <div>
            <label for="A_state" class="mb-2 block text-sm font-medium text-gray-900">State</label>
            <input type="text" id="A_state" name="A_state" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="State" required>
        </div>

        <div>
            <label for="A_postal_code" class="mb-2 block text-sm font-medium text-gray-900">Postal code(number)</label>
            <input type="text" id="A_postal_code" name="A_postal_code" 
                   class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" 
                   placeholder="Postal Code" required pattern="\d+" inputmode="numeric">
        </div>

        <div>
            <label for="A_country" class="mb-2 block text-sm font-medium text-gray-900">Country</label>
            <input type="text" id="A_country" name="A_country" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="Country" required>
        </div>

        <div>
            <label for="A_phone_number" class="mb-2 block text-sm font-medium text-gray-900">Phone Number(number)</label>
            <input type="tel" id="A_phone_number" name="A_phone_number" 
                   class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900" 
                   placeholder="Your Phone Number" required pattern="\d+" inputmode="numeric">
        </div>

        <div class="sm:col-span-2">
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                </svg>
                Add new address
            </button>
        </div>
    </div>
</form>
        </div>

        <div class="space-y-4">
          <h3 class="text-xl font-semibold text-gray-900">Delivery Methods</h3>

          <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4">
            <div class="flex items-start">
              <div class="flex h-5 items-center">
                <input id="express" aria-describedby="express-text" type="radio" name="delivery-method" value="" class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600" checked="checked" />
              </div>

              <div class="ms-4 text-sm">
                <label for="express" class="font-medium leading-none text-gray-900"> $50 - Express Delivery (Cash on delivery) </label>
                <p id="express-text" class="mt-1 text-xs font-normal text-gray-500">Get it in 2-3 days</p>
              </div>
            </div>
          </div>
        </div>

        <div>
            <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900">Enter a coupon code</label>
            <form action="{{ route('checkout.apply_coupon') }}" method="POST">
                @csrf
                <div class="flex max-w-md items-center gap-4">
                    <input type="text" id="voucher" name="coupon_key" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500" placeholder="Enter coupon code" required />
                    <button type="submit" class="flex items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                        Apply
                    </button>
                </div>
            </form>
                    @if($couponValue==0 && $hasCouponApplied == true)
                        <div class=" text-sm font-medium text-red-400 mt-2 ml-2">
                            invalid coupon code
                        </div>
                    @elseif($couponValue>=0 && $hasCouponApplied == true)
                        <div class=" text-sm font-medium text-green-400 mt-2 ml-2">
                            coupon code successfully add
                        </div>
                    @endif
        </div>



       

        
      </div>
     
      <div class="mt-10 flex-1 rounded-lg border border-gray-200 bg-gray-50 p-4 shadow sm:p-8 lg:mt-0 lg:p-6 xl:p-8">
        <h3 class="text-xl font-semibold text-gray-900">Order Summary</h3>
        <ul class="divide-y divide-gray-200">
          <li class="flex items-center justify-between py-4">
            <p class="text-sm font-medium text-gray-900">Subtotal</p>
            <p class="text-sm font-medium text-gray-900">${{ $subTotal }}</p>
          </li>
          <li class="flex items-center justify-between py-4">
            <p class="text-sm font-medium text-gray-900">Shipping</p>
            <p class="text-sm font-medium text-gray-900">${{ $totalDeliveryCharge }}</p>
          </li>
          @if($couponValue > 0)
          <li class="flex items-center justify-between py-4">
            <p  class="text-sm font-medium text-gray-400">Coupon Applied {{$couponValue}}% </>
            <p class="text-sm font-medium text-gray-400">-${{$couponValue/100 * $subTotal  }}</p>
          </li>
          @endif
          
          <li class="flex items-center justify-between py-4">
            <p class="text-sm font-medium text-gray-900">Total</p>
            <p class="text-sm font-medium text-gray-900">${{ $total }}</p>
            
          </li>
      
        </ul>
        <form action="{{ route('checkout.place_order') }}" method="POST" class="below-form">
        @csrf
        <input type="hidden" name="address_id" id="selectedAddressId">
        <input type="hidden" name="subTotal" value="{{ $total }}">
       
            
     
        <button type="submit" class="mt-6 flex w-full items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-2.5 font-semibold text-lg text-white hover:bg-primary-100 focus:outline-none focus:ring-4 focus:ring-primary-300">
          Place Order
        </button>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
        // Add an event listener to the select element
        document.getElementById('addresses').addEventListener('change', updateAddressId);

        function updateAddressId() {
            // Get the selected value from the dropdown
            const selectElement = document.getElementById('addresses');
            const selectedAddressId = selectElement.value; // Get the selected address ID

            // Update the hidden input with the selected address ID
           

            // Display the selected address ID and text for debugging
            const selectedAddressText = selectElement.options[selectElement.selectedIndex].text;
            document.getElementById('selectedAddressId').value = selectedAddressText;
            document.getElementById('selectedAddressDisplay').innerText = 
                "Selected Address ID: " + selectedAddressId + "\n" +
                "Selected Address Text: " + selectedAddressText;

            // Log to console to check if the function is working as expected
            console.log("Function `updateAddressId` called.");
            console.log("Selected Address ID:", selectedAddressId);
            console.log("Selected Address Text:", selectedAddressText);
        }
    </script>
<script>
function update(event) {
    event.preventDefault(); // Prevent the default form submission

    // Gather data from the form
    const formData = new FormData(document.getElementById('addressForm'));
    
    // Optionally, use fetch or another AJAX method to send the data
    fetch('/update-address', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Handle success (e.g., display a success message)
        console.log(data);
    })
    .catch(error => {
        // Handle error (e.g., display an error message)
        console.error('Error:', error);
    });
}
</script>

</body>
</html>