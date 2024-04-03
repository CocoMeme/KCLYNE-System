<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('Customers.shopInfo', ['product' => $product]);
    }
}

