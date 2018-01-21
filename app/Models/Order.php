<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'oid', 'product_id', 'buy_num', 'buy_charge', 'all_charge',
        'status', 'pay_way',
    ];

    public function optionInfo()
    {
        return $this->hasOne(OrderOption::class, 'order_id');
    }

    public function payRecord()
    {
        return $this->hasOne(OrderPayRecord::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productItems()
    {
        return $this->hasMany(ProductItem::class, 'order_id');
    }

    /**
     * 获取订单查询结果[订单查询页面]
     * @return string
     */
    public function getQueryResult()
    {
        if (! in_array($this->status, [1, 3, 9])) {
            return '该订单无查询结果！';
        }
        $productItem = $this->productItem;
        if (! $productItem) {
            return '当前订单未发货，请联系管理员！';
        }
        return $productItem->item;
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

    public static function todayEffectiveCount()
    {
        $where = [
            ['deleted_at', null],
            ['created_at', '>=', date('Y-m-d')],
        ];
        return self::where($where)
                    ->whereIn('status', [1, 3, 9])
                    ->count();
    }

    public static function yesterdayEffectiveCount()
    {
        $where = [
            ['deleted_at', null],
            ['created_at', '<', date('Y-m-d')],
            ['created_at', '>=', date('Y-m-d', strtotime('-1 days'))],
        ];
        return self::where($where)
                    ->whereIn('status', [1, 3, 9])
                    ->count();
    }

    public static function effectiveCount()
    {
        return self::where('deleted_at', null)
                    ->whereIn('status', [1, 3, 9])
                    ->count();
    }

    public static function todayTotalMoney()
    {
        $where = [
            ['deleted_at', null],
            ['created_at', '>=', date('Y-m-d')],
        ];
        $orders = self::where($where)->whereIn('status', [1, 3, 9])->get();
        $sum = $orders ? $orders->sum('all_charge') : 0;
        return $sum;
    }

    public static function yesterdayTotalMoney()
    {
        $where = [
            ['deleted_at', null],
            ['created_at', '>=', date('Y-m-d', strtotime('-1 days'))],
            ['created_at', '<', date('Y-m-d')],
        ];
        $orders = self::where($where)->whereIn('status', [1, 3, 9])->get();
        $sum = $orders ? $orders->sum('all_charge') : 0;
        return $sum;
    }

    public static function totalMoney()
    {
        $orders = self::where('deleted_at', null)
                        ->whereIn('status', [1, 3, 9])
                        ->get();
        $sum = $orders ? $orders->sum('all_charge') : 0;
        return $sum;
    }

}
