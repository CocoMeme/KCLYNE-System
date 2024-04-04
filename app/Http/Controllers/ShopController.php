<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Customers.shopInfo', ['product' => $product]);
    }

    public function buyNow(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $customerId = Auth::guard('customer')->id();

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new order
            $order = Order::create([
                'customer_id' => $customerId,
                'order_date_placed' => now(),
                'status' => 'Pending', // You can set the initial status as needed
            ]);

            // Create a new order line for the product
            OrderLine::create([
                'order_info_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);

            // Update the product stock
            $product = Product::findOrFail($productId);
            $product->stock->product_stock -= $quantity;
            $product->stock->save();

            // Commit the transaction
            DB::commit();

            // Redirect or return response as needed
            return redirect()->route('successPage')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurred
            DB::rollBack();

            // Handle the error (e.g., show error message)
            return back()->with('error', 'Failed to place order. Please try again later.');
        }
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
        return redirect()->route('shop')->with('success', 'Product added to cart successfully!');
    }



public function checkout(Request $request)
{
    // Retrieve the current logged-in customer ID
    $customerId = auth()->guard('customer')->id();

    // Retrieve cart items for the current customer
    $cartItems = Cart::where('customer_id', $customerId)->get();

    // Start a database transaction
    \DB::beginTransaction();

    try {
        // Create a new order record
        $order = new Order();
        $order->customer_id = $customerId;
        $order->order_date_placed = now(); // or any other date/time format
        $order->status = 'pending'; // or any other status
        $order->save();

        // Process each cart item
        foreach ($cartItems as $cartItem) {
            // Create a new order line record
            $orderLine = new OrderLine();
            $orderLine->order_info_id = $order->id;
            $orderLine->product_id = $cartItem->product_id;
            $orderLine->quantity = $cartItem->quantity;
            $orderLine->save();

            // Delete the cart item
            $cartItem->delete();
        }

        // Commit the transaction
        \DB::commit();

        // Redirect the user to a success page or any other appropriate action
        return redirect()->route('shop')->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        // Rollback the transaction in case of any error
        \DB::rollback();
        
        // Redirect the user to an error page or any other appropriate action
        return redirect()->route('cartInfo')->with('error', 'Failed to place order. Please try again later.');
    }
}


}
    

