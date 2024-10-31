<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator; // For validating requests
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function showCart()
    {
        $c_id=1;
        // Eager load product relationship and filter by c_id
        $cartItems = CartDetail::with('product')
                    ->where('c_id', $c_id) // Filter by c_id
                    ->get();

        // Calculate subtotal by multiplying price and quantity from cart details
        $subTotal = $cartItems->sum(function ($item) {
            return $item->product->P_price * $item->CA_quantity;
        });

        // Total delivery charge (can be static or calculated separately)
        $totalDeliveryCharge = 50;

        // Total cart value
        $total = $subTotal + $totalDeliveryCharge;

        // dd($cartItems, $subTotal, $totalDeliveryCharge, $total);
        // Pass data to the view
        return view('pages.cart', compact('cartItems', 'subTotal', 'totalDeliveryCharge', 'total'));
    }

    public function updateQuantity(Request $request)
    {
        // Validate the request
        $request->validate([
            'cartId' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        // Find the cart item by its ID
        $cartItem = CartDetail::find($request->cartId);

        if ($cartItem) {
            // Update the quantity
            $cartItem->CA_quantity = $request->quantity;
            $cartItem->save();

            // Optionally return the updated total price, etc.
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cart item not found'], 404);
        }
    }

    public function destroy($cartId)
    {
        $cartItem = CartDetail::find($cartId);  // Use CartDetail instead of CartItem

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }

    public function addToCart(Request $request)
    {
        $customerId = $request->user()->id ?? 1;  // รับ customer id
        $productId = $request->input('P_id') ?? $request->route('P_id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId);
        // dd($product);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $price = $product->P_price;
    
        // ตรวจสอบว่าสินค้ามีอยู่ในตะกร้าแล้วหรือไม่
        $existingCartItem = DB::table('cart_details')
            ->where('C_id', $customerId)
            ->where('P_id', $productId)
            ->first();
    
        if ($existingCartItem) {
            // อัพเดทสินค้าที่มีอยู่แล้วในตะกร้า
            DB::table('cart_details')
                ->where('CA_id', $existingCartItem->CA_id)
                ->update([
                    'CA_quantity' => $existingCartItem->CA_quantity + $quantity,
                    'CA_price' => ($existingCartItem->CA_quantity + $quantity) * $price,
                ]);
        } else {
            // เพิ่มสินค้าชิ้นใหม่เข้าตะกร้า
            DB::table('cart_details')->insert([
                'C_id' => $customerId,
                'P_id' => $productId,
                'CA_quantity' => $quantity,
                'CA_price' => $quantity * $price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    
        // เรียกดูรายการสินค้าในตะกร้า
        $cartItems = DB::table('cart_details as ca')
            ->join('products as p', 'ca.P_id', '=', 'p.P_id')
            ->where('ca.C_id', $customerId)
            ->select('p.P_id', 'p.P_name', 'p.P_img', 'p.P_price', 'ca.CA_quantity', DB::raw('ca.CA_quantity * p.P_price as CA_price'))
            ->get();
    
        $totalPrice = $cartItems->sum('CA_price');
    
        // ส่ง JSON กลับไปยัง frontend
        return response()->nocontent();
    }
}
