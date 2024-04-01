<?php

// app/Http/Controllers/CustomerController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{

    public function showRegistrationForm()
    {
        return view('Customers.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
            'birth_date' => 'required|date',
            'sex' => 'required|in:Male,Female',
            'phone' => 'nullable|string|max:20',
            'house_no' => 'nullable|integer',
            'street' => 'nullable|string|max:255',
            'baranggay' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Set default image if no image uploaded
        $imageName = 'default_photo.png';
    
        // Handle image upload if present
        if ($request->hasFile('customer_image')) {
            $customerImage = $request->file('customer_image');
            $imageName = $customerImage->getClientOriginalName();
            $customerImage->move(public_path('images/customers'), $imageName);
        }
    
        // Create the customer record with 'Pending' status
        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'house_no' => $request->house_no,
            'street' => $request->street,
            'baranggay' => $request->baranggay,
            'city' => $request->city,
            'province' => $request->province,
            'customer_image' => $imageName,
            'status' => 'Pending', // Set the default status to 'Pending'
        ]);
    
        return redirect()->route('home')->with('success', 'Registration successful. Please log in.');
    }
    

    public function showLoginForm()
    {
        return view('customers.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/'); // Redirect to customer dashboard
        }
        // Authentication failed
        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }

    public function logoutCustomer()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('customer.login.submit')->with('success', 'You have been logged out.');
    }
    public function shop()
    {
        $products = Product::all();
        return view('Customers.shop', compact('products'));
    }


    
}
