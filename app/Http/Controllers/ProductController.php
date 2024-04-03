<?php

namespace App\Http\Controllers;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
        $products = Product::with('stock')->get();
        return view('Admins.productManagement', compact('products'));
    }
    

    // Creating Product
    public function createProduct(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255|min:8|unique:products', // Specify the unique rule for the products table
            'description' => 'required|string|min:10',
            'supplier_price' => 'required|numeric',
            'seller_retail_price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'stock' => 'required|numeric', // Stock validation
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Multiple images
        ]);
    
        // Handle image upload
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('Images/Products'), $imageName);
                $imageNames[] = $imageName;
            }
        } else {
            // If no images uploaded, set default image
            $imageNames[] = 'no_product_image.jpg';
        }
    
        // Store product in database
        try {
            $productData = $validatedData;
            $productData['product_image'] = implode('|', $imageNames);
            $product = Product::create($productData);
    
            // Create stock entry
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->product_stock = $validatedData['stock'];
            $stock->save();
    
            // Redirect back with success message if successful
            return redirect()->back()->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            // If an exception occurs (e.g., unique constraint violation), return back with error message
            return redirect()->back()->withErrors(['error' => 'Failed to create product. Please check your input.'])->withInput();
        }
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::with('stock')->get(); // Retrieve all products with stock information
        return view('Admins.productUpdate', compact('product', 'products'));
    }
    
    

    public function updateProduct(Request $request, $id)
    {
        // Validate request
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255|min:8',
            'description' => 'required|string',
            'supplier_price' => 'required|numeric',
            'seller_retail_price' => 'required|numeric',
            'category' => 'required|string|max:255',
            'stock' => 'required|numeric', 
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        // Handle image upload
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('Images/Products'), $imageName);
                $imageNames[] = $imageName;
            }
        } else {
            $imageNames = explode('|', $product->product_image);
        }
    
        // Update product data
        $product->update([
            'product_name' => $validatedData['product_name'],
            'description' => $validatedData['description'],
            'supplier_price' => $validatedData['supplier_price'],
            'seller_retail_price' => $validatedData['seller_retail_price'],
            'category' => $validatedData['category'],
            'product_image' => implode('|', $imageNames),
        ]);
    
        // Update stock
        $product->stock()->update([
            'product_stock' => $validatedData['stock'],
        ]);
    
        // Redirect back or wherever you want after product update
        return redirect()->route('product.management')->with('success', 'Product updated successfully!');
    }
    
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.management')->with('success', 'Product deleted successfully!');
    }

    // Search 

    public function searchProducts(Request $request)
    {
        $searchQuery = $request->input('query');

        // dd($searchQuery);
    
        // Perform search query based on $searchQuery
        // For example, if you have a Product model:
        if ($searchQuery) {
            $searchedProducts = Product::where('product_name', 'like', '%'.$searchQuery.'%')->get();
        } else {
            $searchedProducts = [];
        }
        
        return view('layouts.home', compact('searchQuery', 'searchedProducts'));
    }
    

    
}
