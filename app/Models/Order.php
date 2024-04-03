<?php

// Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{    
    protected $fillable = [
        'customer_id',
        'order_date_placed',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
