<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    protected $fillable = [
        'name', 'old_charge', 'now_charge', 'num', 'sales_num',
    ];

    public function detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class, 'product_id');
    }

}
