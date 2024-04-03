<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function index()
    {
        $cartItems = Cart::with('product')->where('customer_id', auth()->guard('customer')->user()->id)->get();
        return view('Customers.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $customerId = Auth::guard('customer')->id();

        // Create a new cart item
        Cart::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'cart_date_placed' => now(),
        ]);

        // Redirect or return response as needed
// Redirect or return response as needed
return redirect()->route('shop')->with('success', 'Cart placed successfully!');    }
}
