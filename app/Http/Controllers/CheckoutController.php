<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;

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
        $customerId =Auth::user()->C_id; // Replace with an actual C_id from your database
        
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

    
    public function applyCoupon(Request $request)
{
    $request->validate([
        'coupon_key' => 'required|string',
    ]);

    $customerId =Auth::user()->C_id; // Placeholder C_id for demo

    // Retrieve customer addresses and cart items
    $addresses = Address::where('C_id', $customerId)->get();
    $cartItems = CartDetail::with('product')
                      ->where('c_id', $customerId) // Filter by c_id
                      ->get();

    // Calculate subtotal
    $subTotal = $cartItems->sum(function ($item) {
        return $item->product->P_price * $item->CA_quantity;
    });

    // Define total delivery charge
    $totalDeliveryCharge = 50;

    // Initialize the coupon discount
    $couponValue = 0;

    // Retrieve the coupon from the database
    $coupon = Coupon::where('key', $request->coupon_key)->first();

    if ($coupon && $coupon->quantity > 0) {
        // Apply the coupon discount and adjust total
        $couponValue = $coupon->value;
        $discount = $subTotal * ($couponValue / 100);
        $total = $subTotal + $totalDeliveryCharge - $discount;

        // Decrease the coupon quantity by 1
        $coupon->decrement('quantity');
    } else {
        // If coupon is invalid or has been used up, set total without discount
        $total = $subTotal + $totalDeliveryCharge;
        $couponValue = 0;
    }
    $hasCouponApplied = true;

    // Pass data to the view
    return view('pages.checkout', compact('addresses', 'subTotal', 'totalDeliveryCharge', 'total', 'couponValue','hasCouponApplied'));
}

public function placeOrder(Request $request)
{
    try {
        // Validate the incoming request
        $request->validate([
            'address_id' => 'required|string|not_in:""', // Ensure address_id is not empty
            'subTotal' => 'required|numeric|min:0', // Ensure subTotal is a valid number
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Redirect back with validation errors and status = false
        return redirect()->back()->with(['status' => false, 'errors' => $e->validator->errors()])->withInput();
    }

    $customerId = Auth::user()->C_id; // Placeholder for the customer ID

    // Step 1: Create a new order
    $order = Order::create([
        'C_id' => $customerId,
        'O_Date_time' => now(),
        'O_Total' => $request->subTotal,
        'O_Address' => $request->address_id,
    ]);
    
    // Step 2: Add all items from cart_details to order_details
    $cartItems = CartDetail::where('c_id', $customerId)->get();

    foreach ($cartItems as $cartItem) {
        OrderDetail::create([
            'O_id' => $order->id,
            'P_id' => $cartItem->P_id,
            'OD_quantity' => $cartItem->CA_quantity,
            'OD_price' => $cartItem->product->P_price, // Assuming `P_price` is the price per item
        ]);
    }

    // Step 3: Delete all items from cart_details
    CartDetail::where('c_id', $customerId)->delete();

    // Redirect to order summary with order ID and status = true
    return redirect()->route('order.summary', ['orderId' => $order->id])->with('success', 'Order placed successfully!')->with('status', true);
}

    

    public function orderSummary($orderId)
    {
        // Get order details using the provided order ID
        return $this->getOrderDetails($orderId);
    }

    public function getOrderDetails($orderId)
    {
        // Retrieve the order with specific fields
        $order = Order::select('O_id', 'O_Date_time', 'O_Total', 'O_Address')
            ->where('O_id', $orderId)
            ->first();

        // Check if the order exists
        if (!$order) {
            return redirect()->route('checkout')->with('error', 'Order not found');
        }

        // Retrieve related order details separately
        $orderDetails = OrderDetail::select('O_id', 'P_id', 'OD_quantity', 'OD_price')
            ->where('O_id', $orderId)
            ->get();

        // Pass the order and order details to the view
        return view('pages.ordersummary', [
            'O_Date_time' => $order->O_Date_time,
            'O_Total' => $order->O_Total,
            'O_Address' => $order->O_Address,
            'orderDetails' => $orderDetails, // Using a new variable to hold order details
            'orderId' => $orderId,
        ]);
    }
    

    


}

