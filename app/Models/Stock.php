<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_stock',
    ];

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
