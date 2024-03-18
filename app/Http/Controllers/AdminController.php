<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // REGISTER & LOGINS /////////////////////////////////////////

        public function registerAdmin(Request $request)
        {
            $request->validate([
                'username' => 'required|string|max:255|unique:admins',
                'password' => 'required|string|min:8|confirmed',
            ]);
        
            Admin::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
        
            return redirect()->route('loginAdmin')->with('success', 'Admin registered successfully! Please log in.');
        }
    
        public function loginAdmin(Request $request)
        {

            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
    
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->intended('/');
            } else {
                return back()->withErrors(['error' => 'Invalid username or password']);
            }

        }



}