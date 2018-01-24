<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{

    protected $table = 'product_items';

    protected $fillable = [
        'product_id', 'order_id', 'item',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
