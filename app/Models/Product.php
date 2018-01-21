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

    // 获取有效的产品[用于首页读取产品]
    public static function getEffectiveProduct()
    {
        return self::orderBy('id', 'desc')->get();
    }

    /**
     * 获取还没有使用的产品条例
     * @return string|integer
     */
    public function getNoUseItemCount()
    {
        return $this->items()->where('order_id', 0)->count();
    }

}
