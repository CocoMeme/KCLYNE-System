<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderLine extends Model
{

    protected $fillable = [
        'product_id',
        'order_info_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_info_id');
    }
}