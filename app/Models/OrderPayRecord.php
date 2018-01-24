<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayRecord extends Model
{

    const PAY_SUCCESS = 9;

    const PAY_NONE = -1;

    protected $table = 'order_pay_records';

    protected $fillable = [
        'order_id', 'payment_id', 'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
