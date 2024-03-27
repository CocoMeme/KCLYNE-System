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

// ADMIN PRIVILEGES ==========================================================

    // Showing in the Product Management
    public function productManagement()
    {
        $products = Product::all();
        return view('Admins.productManagement', compact('products'));
    }

    // Creating Product
    public function createProduct(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'supplier_price' => 'required|numeric',
            'seller_retail_price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple images
        ]);

        // Handle image upload
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('Images/Products'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        // Store product in database
        $productData = $validatedData;
        $productData['product_image'] = implode('|', $imageNames);
        $product = Product::create($productData);

        // Redirect back or wherever you want after product creation
        return redirect()->back()->with('success', 'Product created successfully!');
    }


    
}
