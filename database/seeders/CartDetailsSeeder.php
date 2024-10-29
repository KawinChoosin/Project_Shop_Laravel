<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartDetail;

class CartDetailsSeeder extends Seeder
{
    public function run()
    {
        // Sample cart details data
        $cartDetails = [
            [
                'C_id' => 1, // Cart ID
                'P_id' => 1, // Product ID (e.g., Bike)
                'CA_quantity' => 2, // Quantity of the product in the cart
                'CA_price' => 200, // Total price for the product (2 * 100)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'C_id' => 1, // Same Cart ID for a different product
                'P_id' => 2, // Product ID (e.g., Football)
                'CA_quantity' => 3, 
                'CA_price' => 75, // 3 * 25
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'C_id' => 2, // Another cart
                'P_id' => 4, // Product ID (e.g., T-Shirt)
                'CA_quantity' => 5,
                'CA_price' => 75, // 5 * 15
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert cart details data into the cart_details table
        foreach ($cartDetails as $detail) {
            CartDetail::create($detail);
        }
    }
}
