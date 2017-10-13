<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{

    protected $table = 'product_items';

    protected $fillable = [
        'product_id', 'is_multi', 'item', 'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
