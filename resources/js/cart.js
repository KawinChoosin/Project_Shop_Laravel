document
    .getElementById("add-to-cart-btn")
    .addEventListener("click", function () {
        let productId = document.getElementById("product-id").value;
        let quantity = document.getElementById("quantity").value;

        fetch("/cart", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                P_id: productId,
                quantity: quantity,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    alert(data.error);
                } else {
                    updateCartUI(data.cartItems, data.totalPrice);
                }
            })
            .catch((error) => console.error("Error:", error));
    });

function updateCartUI(cartItems, totalPrice) {
    const cartContainer = document.getElementById("cart-items");
    cartContainer.innerHTML = ""; // เคลียร์รายการสินค้าที่มีอยู่แล้ว

    cartItems.forEach((item) => {
        const cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");
        cartItem.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="${item.P_img}" alt="${
            item.P_name
        }" class="w-12 h-12 object-cover mr-4">
                    <div>
                        <h3 class="text-lg font-semibold">${item.P_name}</h3>
                        <p class="text-gray-600">฿${item.P_price.toFixed(2)}</p>
                    </div>
                </div>
                <div>
                    <p class="text-gray-600">Quantity: ${item.CA_quantity}</p>
                    <p class="text-red-600 font-semibold">Subtotal: ฿${item.CA_price.toFixed(
                        2
                    )}</p>
                </div>
            </div>
        `;
        cartContainer.appendChild(cartItem);
    });

    // อัปเดทราคารวม
    document.getElementById(
        "total-price"
    ).textContent = `Total: ฿${totalPrice.toFixed(2)}`;
}
