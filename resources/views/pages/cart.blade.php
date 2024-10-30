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
    <!-- Cart Page Content -->
    <!-- component -->
    <section class="py-24 relative  ">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">
            <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-black">Shopping Cart</h2>
            
            <div class="hidden lg:grid grid-cols-2 py-6">
                <div class="font-normal text-xl leading-8 text-gray-500">Product</div>
                <p class="font-normal text-xl leading-8 text-gray-500 flex items-center justify-between">
            
                    <span class="w-full max-w-[400px] text-center">Quantity</span>
                    <span class="w-full max-w-[120px] text-center">Total</span>
                    <span class="w-full max-w-[50px] text-center"></span>
               
                </p>
            </div>

            @foreach($cartItems as $item)
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
                                $<span id="price-{{ $item->CA_id }}">{{ number_format($item->product->P_price, 2) }}</span>
                            </h6>
                            
                        </div>
                    </div>
                    <div class="flex items-center flex-col min-[550px]:flex-row w-full max-xl:max-w-xl max-xl:mx-auto gap-2">
                        <div class="flex items-center w-full mx-auto justify-center">
                            <!-- Decrease Button -->
                            <button class="group rounded-l-full px-6 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50" onclick="updateQuantity({{ $item->CA_id }}, -1)">
                                <svg class="stroke-gray-900" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </button>

                            <!-- Quantity Input -->
                            <input type="number" 
                                class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[118px] min-w-[80px] py-[15px] text-center bg-transparent" 
                                id="quantity-{{ $item->CA_id }}" 
                                value="{{ $item->CA_quantity }}" 
                                min="1" 
                                onchange="handleQuantityChange({{ $item->CA_id }})"
                            >


                            <!-- Increase Button -->
                            <button class="group rounded-r-full px-6 py-[18px] border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:shadow-gray-200 hover:border-gray-300 hover:bg-gray-50" onclick="updateQuantity({{ $item->CA_id }}, +1)">
                                <svg class="stroke-gray-900" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke-width="1.6" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                        <h6 class="text-indigo-600 font-manrope font-bold text-2xl leading-9 w-full max-w-[176px] text-center">
                            $<span id="total-price-{{ $item->CA_id }}">{{ number_format($item->product->P_price * $item->CA_quantity, 2) }}</span>
                        </h6>
                        <!-- Modify the delete button to open the confirmation modal -->
                        <button class="group rounded-full p-2 text-white font-semibold shadow-sm transition-all duration-500 hover:bg-red-100" onclick="openModal({{ $item->CA_id }})" aria-label="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>




                    </div>
                </div>
            @endforeach


            <!-- Summary Section -->
            <div class="bg-gray-50 rounded-xl p-6 w-full mb-8 max-lg:max-w-xl max-lg:mx-auto">
                <div class="flex items-center justify-between w-full mb-6">
                    <p class="font-normal text-xl leading-8 text-gray-400">Sub Total</p>
                    <h6 class="font-semibold text-xl leading-8 text-gray-900" id="cart-subtotal">${{ $subTotal }}</h6>
                    
                </div>
                <div class="flex items-center justify-between w-full pb-6 border-b border-gray-200">
                    <p class="font-normal text-xl leading-8 text-gray-400">Delivery Charge</p>
                    <h6 class="font-semibold text-xl leading-8 text-gray-900" id="cart-delivery">${{ $totalDeliveryCharge }}</h6>
                </div>
                <div class="flex items-center justify-between w-full py-6">
                    <p class="font-manrope font-medium text-2xl leading-9 text-gray-900">Total</p>
                    <h6 class="font-manrope font-medium text-2xl leading-9 text-indigo-500" id="cart-total">${{ $total }}</h6>
                </div>
            </div>

            <!-- Checkout Buttons -->
            <div class="flex items-center flex-col sm:flex-row justify-center gap-3 mt-8">
                <a id="checkout-btn" href="#" class="rounded-full w-full max-w-[280px] py-4 text-center justify-center items-center bg-indigo-600 font-semibold text-lg text-white flex transition-all duration-500 hover:bg-indigo-700">
                    Continue to Payment
                    <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                        <path d="M8.75324 5.49609L14.2535 10.9963L8.75 16.4998" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
        <!-- Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Confirm Delete</h2>
                <p class="text-gray-700 mb-6">Are you sure you want to delete this item from your cart?</p>
                
                <div class="flex justify-end space-x-4">
                    <button class="bg-gray-200 hover:bg-gray-300 text-gray-900 px-4 py-2 rounded-md" onclick="closeModal()">Cancel</button>
                    <button id="confirm-delete-btn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">Delete</button>
                </div>
            </div>
        </div>

        <div id="empty-cart-modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold text-gray-900" id="modal-title">Empty Cart</h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">Your cart is empty. Please shop for more items.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button id="close-modal" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Close</button>
          <button id="go-home" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Go to Shop</button>
        </div>
      </div>
    </div>
  </div>
</div>

    </section>

    @include('components.footer')


<script>
    function updateQuantity(cartId, change) {
        // Get the current quantity from the input field
        let currentQuantity = parseInt(document.getElementById(`quantity-${cartId}`).value);

        // Calculate the new quantity based on the change (increment or decrement)
        let newQuantity = currentQuantity + change;

        // Check if quantity is valid (e.g., >= 1)
        if (newQuantity < 1) {
            return; // Prevent reducing below 1
        }

        // Send an AJAX request to update the quantity in the backend
        fetch(`/cart/update-quantity`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                cartId: cartId,
                quantity: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update the quantity on the frontend
                document.getElementById(`quantity-${cartId}`).value = newQuantity;

                // Update the total price for this item
                let productPrice = parseFloat(document.getElementById(`price-${cartId}`).innerText);
                let totalPriceElement = document.getElementById(`total-price-${cartId}`);
                totalPriceElement.innerText = (productPrice * newQuantity).toFixed(2);

                // Optionally update the cart subtotal and total (if needed)
                updateCartTotals();
            } else {
                console.error('Failed to update quantity');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function handleQuantityChange(cartId) {
        // Get the new quantity from the input field
        let newQuantity = parseInt(document.getElementById(`quantity-${cartId}`).value);

        // Ensure the new quantity is valid (e.g., >= 1)
        if (isNaN(newQuantity) || newQuantity < 1) {
            document.getElementById(`quantity-${cartId}`).value = 1; // Set to 1 if invalid
            newQuantity = 1;
        }

        // Send the updated quantity to the backend
        fetch(`/cart/update-quantity`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                cartId: cartId,
                quantity: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Quantity updated successfully');
                
                // Update the total price for this item
                let productPrice = parseFloat(document.getElementById(`price-${cartId}`).innerText);
                let totalPriceElement = document.getElementById(`total-price-${cartId}`);
                totalPriceElement.innerText = (productPrice * newQuantity).toFixed(2);

                // Optionally update the cart subtotal and total (if needed)
                updateCartTotals();
            } else {
                console.error('Failed to update quantity');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function updateCartTotals() {
    let subTotal = 0;
    let deliveryCharge = 50; // Default delivery charge
    
    // Loop through all items' total prices to calculate the subtotal
    document.querySelectorAll('[id^="total-price-"]').forEach(element => {
        subTotal += parseFloat(element.innerText);
    });

    // Calculate the grand total (subtotal + delivery charge)
    let total = subTotal + deliveryCharge;

    // Update the cart summary on the page
    document.getElementById('cart-subtotal').innerText = subTotal.toFixed(2);
    document.getElementById('cart-total').innerText = total.toFixed(2);
    document.getElementById('cart-delivery').innerText = deliveryCharge.toFixed(2);
}

 
    // Show a confirmation dialog to the user
    let currentCartId = null;

// Function to open the delete confirmation modal
function openModal(cartId) {
    currentCartId = cartId; // Store the cartId for the item to be deleted
    document.getElementById('delete-confirmation-modal').classList.remove('hidden');
}

// Function to close the delete confirmation modal
function closeModal() {
    document.getElementById('delete-confirmation-modal').classList.add('hidden');
}


// Function to handle item deletion
function confirmDelete() {
    if (currentCartId !== null) {
        fetch(`/cart/delete/${currentCartId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Network response was not ok');
        })
        .then(data => {
            if (data.success) {
                // Remove the cart item from the DOM
                const cartItemElement = document.getElementById(`cart-item-${currentCartId}`);
                if (cartItemElement) {
                    cartItemElement.remove();
                }

                // Update the cart totals
                updateCartTotals();

                // Close the modal
                closeModal();
            } else {
                console.error('Failed to delete cart item');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Attach the confirmDelete function to the delete button in the modal
document.getElementById('confirm-delete-btn').addEventListener('click', confirmDelete);







</script>

<script>
document.getElementById('checkout-btn').addEventListener('click', function(event) {
    // Prevent the default link behavior
    event.preventDefault();

    // Check if cart items exist
    if ({{ count($cartItems) }} === 0) {
        // Show the modal if the cart is empty
        document.getElementById('empty-cart-modal').classList.remove('hidden');
    } else {
        // Proceed to payment if cart is not empty
        window.location.href = '{{ url('/checkout') }}';
    }
});

// Close modal when close button is clicked
document.getElementById('close-modal').addEventListener('click', function() {
    document.getElementById('empty-cart-modal').classList.add('hidden');
});

// Go to shop when the button is clicked
document.getElementById('go-home').addEventListener('click', function() {
    window.location.href = '/'; // Change this to your shop URL
});

</script>



</body>
</html>
