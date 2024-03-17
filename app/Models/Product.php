<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'supplier_price',
        'seller_retail_price',
        'category',
        'product_image',
    ];

    // Define the relationship with Stock
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}
