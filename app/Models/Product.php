<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name', 'old_charge', 'now_charge', 'num', 'sales_num',
    ];

    protected $dates = ['deleted_at'];

    public function detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }

    public function items()
    {
        return $this->hasMany(ProductItem::class, 'product_id');
    }

}
