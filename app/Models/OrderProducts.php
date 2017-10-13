<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{

    protected $table = 'order_products';

    protected $fillable = [
        'product_id', 'order_id', 'notify_num',
    ];

}
