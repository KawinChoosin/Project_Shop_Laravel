<!-- Category Buttons -->
<div style="display: flex; background: linear-gradient(to bottom left, #ebf8ff, #f3e8ff); align-items: center; width: 100%; justify-content:center;">
    <div style="width: 80%; padding: 16px; height: 100%;">
        <div style="display: flex; flex-wrap: wrap; justify-content: center; height: 100%;">
            <!-- Loop through products -->
             
            @forelse ($products ?? [] as $product)
                <div class="product-card" style="padding: 8px; box-sizing: border-box;">
                    <!-- Flexbox layout for card -->
                    <div style="background-color: none; border-radius: 8px;  solid #e0e0e0; padding: 16px; display: flex; flex-direction: column; height: 100%;">
                        <div style="background-color: white; border-radius: 8px; border: 1px solid #e0e0e0; padding: 16px; display: flex; flex-direction: column; height: 80%;">
                            <a href="{{ $product->P_id }}">
                                <img src="{{ $product->P_img }}" alt="{{ $product->P_name }}" style="width: 100%; height: 300px; object-fit: scale-down; border-radius: 8px; margin-bottom: 16px;">
                            </a>
                        </div>
                        <h3 class="ml-2 mt-4 text-sm text-gray-700">{{ $product->P_name }}</h3>
                        <p class="ml-2 mt-1 text-lg font-medium text-gray-900">${{ $product->P_price }}</p>
                    </div>
                    
                </div>
            @empty
                <div style="width: 100%;">
                    <p>No products found for this category.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add media queries for responsiveness -->
<style>
    /* Fullscreen: 3 products per row */
    
    .product-card {
        width: calc(100% / 3); /* 33.33% width for 3 products per row */
    }

    /* Product name font size */
    .product-name {
        font-size: 1.5rem; /* Default font size for full screen */
    }

    /* Product description font size */
    .product-description {
        font-size: 1.1rem; /* Default font size for full screen */
    }

    /* Product price font size */
    .product-price {
        font-size: 2rem; /* Default font size for full screen */
    }

    /* Smaller screens: 2 products per row */
    @media (max-width: 768px) {
        .product-card {
            width: calc(100% / 2); /* 50% width for 2 products per row */
        }
        /* Smaller screens font size adjustments */
        .product-name {
            font-size: 1.25rem; /* Reduce the product name font size */
        }
        .product-description {
            font-size: 1rem; /* Reduce the description font size */
        }
        .product-price {
            font-size: 1.75rem; /* Reduce the price font size */
        }
    }

    /* Extra small screens (optional): 1 product per row */
    @media (max-width: 580px) {
        .product-card {
            width: 100%; /* Full width for 1 product per row */
        }
        /* Extra small screens font size adjustments */
        .product-name {
            font-size: 1.1rem; /* Further reduce the product name font size */
        }
        .product-description {
            font-size: 0.9rem; /* Further reduce the description font size */
        }
        .product-price {
            font-size: 1.5rem; /* Further reduce the price font size */
        }
    }
</style>