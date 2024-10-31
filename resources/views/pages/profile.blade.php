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
                <div class="font-normal text-xl leading-8 text-gray-500">Username: {{Auth::user()->name}}</div>
            </div>
            <div class="font-normal text-xl leading-8 text-gray-500">Email: {{Auth::user()->email}}</div>

            <!-- Summary Section -->
            <div class=" rounded-xl p-6 w-full mb-8 max-lg:max-w-xl max-lg:mx-auto">
                <div class="flex items-center justify-between w-full mb-6">

                </div>
                <div class="flex items-center justify-between w-full pb-6">

                </div>
                <div class="flex items-center justify-between w-full py-6">

                </div>
            </div>

            <!-- Checkout Buttons -->

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
