<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'product_id',
        'quantity',
        'customer_id',
        'cart_date_placed',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->product->price;
    }
}
