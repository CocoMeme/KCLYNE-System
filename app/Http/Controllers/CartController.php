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
        $cartItems = Cart::where('customer_id', auth('customer')->id())->get();
        return view('Customers.cart', ['cartItems' => $cartItems]);
    }

    public function addToCart(Request $request)
    {
        // Validate the request data if necessary

        // Create a new record in the carts table
        Cart::create([
            'product_id' => $request->input('product_id'),
            'customer_id' => auth('customer')->id(),
            'quantity' => $request->input('quantity'),
            // Add other fields here as needed
        ]);

        // Redirect the user to the cart page or any other page
        return redirect()->route('cart.index');
    }
}
