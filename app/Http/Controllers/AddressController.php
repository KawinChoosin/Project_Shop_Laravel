<?php
// app/Http/Controllers/AddressController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Product;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
{
     
    $validatedData = $request->validate([
        'A_name' => 'required|string|max:255',
        'A_address_line1' => 'required|string|max:255',
        'A_city' => 'required|string|max:100',
        'A_state' => 'required|string|max:100',
        'A_postal_code' => 'required|string|max:20',
        'A_country' => 'required|string|max:100',
        'A_phone_number' => 'required|string|max:15',
    ]);
   
    // Set default C_id for demonstration (you might want to get this from the session or user)
    $validatedData['C_id'] =Auth::user()->C_id;; 

    // Attempt to create a new address record
    $address = Address::create($validatedData);

    // Check if the address was created
    return redirect()->route('checkout')->with('success', 'Address added successfully!');
}


    public function showAddresses()
{
    $customerId =Auth::user()->C_id;; // Placeholder C_id for demo
    $addresses = Address::where('C_id', $customerId)->get();
    $cartItems = CartDetail::with('product')
                      ->where('c_id', $customerId) // Filter by c_id
                      ->get();
                     
    $subTotal = $cartItems->sum(function ($item) {
        return $item->product->P_price * $item->CA_quantity;
    });
                
    // Total delivery charge (can be static or calculated separately)
    $totalDeliveryCharge = 50;
            
    // Total cart value
    $total = $subTotal + $totalDeliveryCharge;
    $couponValue = 0;             
    $hasCouponApplied = false;
    // Pass addresses to the checkout view
    return view('pages.checkout', compact('addresses', 'subTotal', 'totalDeliveryCharge', 'total','couponValue','hasCouponApplied'));
}



}
