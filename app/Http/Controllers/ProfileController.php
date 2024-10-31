<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the customer's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'customer' => $request->customer(),
        ]);
    }

    /**
     * Update the customer's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->customer()->fill($request->validated());

        if ($request->customer()->isDirty('email')) {
            $request->customer()->email_verified_at = null;
        }

        $request->customer()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the customer's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('customerDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $customer = $request->customer();

        Auth::logout();

        $customer->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    // public function showProfile()
    // {
    //     $customer = Auth::customer();
        
    //     // Retrieve the customer's orders with their associated items
    //     $orders = Order::with('orderDetails.product')
    //         ->where('customer_id', $customer->id)
    //         ->get();

    //     return view('profile', compact('customer', 'orders'));
    // }
}
