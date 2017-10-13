<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';

    protected $fillable = [
        'oid', 'product_id', 'buy_num', 'buy_charge', 'all_charge', 'status',
    ];

}
