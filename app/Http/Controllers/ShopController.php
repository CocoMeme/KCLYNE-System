<?php

namespace App\Http\Controllers;


use App\Models\Customer;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        return redirect()->route('cartInfo')->with('success', 'Product added to cart successfully!');
    }
}
    

