<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'oid', 'product_id', 'buy_num', 'buy_charge', 'all_charge', 'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function statusText()
    {
        $s = '';
        switch ($this->status) {
            case 1:
                $s = '已支付';
                break;
            case 3:
                $s = '已发货';
                break;
            case 9:
                $s = '已完成';
                break;
            case -1:
                $s = '未支付';
                break;
            case -3:
                $s = '已取消';
                break;
            case -5:
                $s = '退款中';
                break;
            case -7:
                $s = '拒绝退款';
                break;
            case -9:
                $s = '已退款';
                break;
        }
        return $s;
    }

}
