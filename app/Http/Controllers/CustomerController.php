<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function showProfile(Request $request)
    {
        // Get the authenticated user
        $customerId = $request->user()->id; // Assuming you are using Laravel's Auth
        
        // Retrieve customer details
        $customer = Customer::find($customerId);
        
        return view('pages.profile', compact('customer'));
    }
}
