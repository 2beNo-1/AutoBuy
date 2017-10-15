<?php

namespace App\Payments;

use App\Models\Order;

abstract class PaymentContract
{

    protected $request;

    public function setRequest($request)
    {
        $this->request = $request;
    }

    // 获取支付URL
    public abstract function payment(Order $order);

    // 回调通知
    public abstract function notify(Order $order);

    // 支付订单查询
    public abstract function query(Order $order);

    // 获取所有的支付方式
    public abstract function payWays();

    // 判断是否含有指定的支付方式
    public abstract function hasPayWay($payWay);

}