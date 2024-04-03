<?php

// app/Http/Controllers/CustomerController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Str;

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
        $customer = new Customer;
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->birth_date = $request->birth_date;
        $customer->sex = $request->sex;
        $customer->phone = $request->phone;
        $customer->house_no = $request->house_no;
        $customer->street = $request->street;
        $customer->baranggay = $request->baranggay;
        $customer->city = $request->city;
        $customer->province = $request->province;
        $customer->customer_image = $imageName;
        $customer->status = 'Pending';
        $customer->remember_token = Str::random(40);

        //dd($customer);
        $customer->save();


    
        // Send registration email
        if ($customer && !empty($customer->email) && filter_var($customer->email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($customer->email)->send(new RegisterMail($customer));
        } else {
            // Log error or handle invalid email address
            return redirect()->route('customer.register')->with('error', 'Invalid email address.');
        }
    
        // Redirect after successful registration
        return redirect()->route('customer.login')->with('success', 'Registration successful. Please verify your account.');
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


    // Verify

    public function verify($token)
    {
        $customer = Customer::where('remember_token', '=', $token)->first();
        if(!empty($customer))
        {
            $customer->email_verified_at = date('Y-m-d H:i:s');
            $customer->save();

            return redirect()->route('customer.login')->with('success', 'Verified successfully');
        }
        else
        {
            abort(404);
        }
    }

    
}
