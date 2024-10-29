<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CartDetail;

class CheckoutController extends Controller
{
   

    public function saveAddress(Request $request)
    {
        // Validate the address form inputs
        $request->validate([
            'A_address_line1' => 'required|string|max:255',
            'A_city' => 'required|string|max:100',
            'A_state' => 'required|string|max:100',
            'A_postal_code' => 'required|string|max:20',
            'A_country' => 'required|string|max:100',
        ]);

        // Temporarily hardcode C_id for testing
        $customerId = 1; // Replace with an actual C_id from your database
        
        // Save the new address or update existing
        $address = Address::updateOrCreate(
            ['C_id' => $customerId, 'A_is_default' => true], // Update if default address exists
            [
                'A_address_line1' => $request->A_address_line1,
                'A_city' => $request->A_city,
                'A_state' => $request->A_state,
                'A_postal_code' => $request->A_postal_code,
                'A_country' => $request->A_country,
                'A_is_default' => true,
            ]
        );

        return redirect()->route('checkout.index')->with('success', 'Address saved successfully!');
    }

    public function createOrder(Request $request)
    {
        // Validate the necessary fields for creating an order
        $request->validate([
            'O_Total' => 'required|numeric',
        ]);

        // Temporarily hardcode C_id for testing
        $customerId = 1; // Replace with an actual C_id from your database
        $customer = Customer::find($customerId);
        $address = Address::where('C_id', $customer->C_id)->where('A_is_default', true)->first();

        if (!$address) {
            return redirect()->back()->withErrors(['msg' => 'Please add an address before checking out.']);
        }

        $order = Order::create([
            'C_id' => $customer->C_id,
            'O_Date_time' => now(),
            'O_Total' => $request->O_Total,
            'O_Address' => $address->A_address_line1,
        ]);

        return redirect()->route('checkout.index')->with('success', 'Order placed successfully!');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_key' => 'required|string',
        ]);

        $customerId = 1; // Placeholder C_id for demo
        $addresses = Address::where('C_id', $customerId)->get();
        $cartItems = CartDetail::with('product')
                          ->where('c_id', $customerId) // Filter by c_id
                          ->get();

        // Calculate subtotal
        $subTotal = $cartItems->sum(function ($item) {
            return $item->product->P_price * $item->CA_quantity;
        });

        // Total delivery charge
        $totalDeliveryCharge = 50;

        // Total cart value
        $total = $subTotal + $totalDeliveryCharge;

        // Fetch the coupon from the database
        $coupon = Coupon::where('key', $request->coupon_key)->first();

        if ($coupon) {
            // Check if the coupon quantity is greater than 0
            if ($coupon->quantity > 0) {
                // Calculate the new total after applying the coupon
                $discount = $total * ($coupon->value / 100);
                $total -= $discount;

                // Optionally reduce the coupon quantity or mark it as used
                $coupon->decrement('quantity'); // Decrease the quantity by 1
            } else {
                return redirect()->back()->withErrors(['coupon_key' => 'Coupon has been used up.']);
            }
        } else {
            return redirect()->back()->withErrors(['coupon_key' => 'Invalid coupon key.']);
        }

        // Pass data to the view
        return view('pages.checkout', compact('addresses', 'subTotal', 'totalDeliveryCharge', 'total', 'coupon'));
    }
}

