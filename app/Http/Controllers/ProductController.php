<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Show the product management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function productManagement()
    {
        // Your logic to fetch and display products goes here
        return view('Admins/productManagement');
    }

    public function createProduct(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'supplier_price' => 'required|numeric',
            'seller_retail_price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming image upload
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('Images/Products'), $imageName);
    
            $validatedData['product_image'] = $imageName;
        }
    
        // Store product in database
        $product = Product::create($validatedData);
    
        // Redirect back or wherever you want after product creation
        return redirect()->back()->with('success', 'Product created successfully!');
    }

    
}
