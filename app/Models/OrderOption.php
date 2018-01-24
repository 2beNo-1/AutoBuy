<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderOption extends Model
{

    protected $table = 'order_options';

    public $timestamps = false;

    protected $fillable = [
        'order_id', 'mobile', 'email',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

}
