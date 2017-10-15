<?php

namespace App\Payments;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Shopex\TeegonClient\TeegonClient as TeegonClient;

class Teegon extends PaymentContract
{

    // 请求地址
    const REQUEST_URL = 'https://api.teegon.com/router';

    // H5页面的支付
    const PAYMENT_METHOD_H5 = 'teegon.payment.charge.pay';

    // PC界面的支付
    const PAYMENT_METHOD_PC = 'teegon.payment.charge.paycode';

    // AppKey
    protected $appKey;

    // AppSecret
    protected $appSecret;

    // PayWays
    protected $payWays = [];

    // 同步返回地址
    protected $returnUrl = '';

    // 异步返回地址
    protected $notifyUrl = '';

    // 支付实例
    protected $paymentInstance = null;

    public function __construct($config, $returnUrl, $notifyUrl)
    {
        $this->appKey = $config['app_key'];
        $this->appSecret = $config['app_secret'];
        $this->payWays = $config['pay_way'];

        $this->returnUrl = $returnUrl;
        $this->notifyUrl = $notifyUrl;

        $this->paymentInstance = new TeegonClient(self::REQUEST_URL, $this->appKey, $this->appSecret);
    }


    /**
     * 获取支付方式
     * @return array
     */
    public function payWays()
    {
        return $this->payWays;
    }

    /**
     * 是否还有该支付方式
     * @param string $payWay 支付方式
     * @return boolean
     */
    public function hasPayWay($payWay)
    {
        $column = array_column($this->payWays, 'value');
        return in_array($payWay, $column);
    }

    /**
     * 提交订单
     * @param \App\Models\Order $order 订单实例
     * @return false|string
     */
    public function payment(Order $order)
    {
        // 订单数据
        $paymentData = [
            'order_no'   => $order->oid,
            'channel'    => $order->pay_way,
            'notify_url' => $this->notifyUrl,
            'return_url' => $this->returnUrl,
            'amount'     => round(0.01, 2),
            'subject'    => sprintf('购买%s', $order->product->name),
            'metadata'   => sprintf("购买%s", $order->product->name),
            'client_ip'  => request()->ip(),
        ];
        // 提交API
        $responseText = $this->paymentInstance->post(self::PAYMENT_METHOD_PC, $paymentData);
        $response = json_decode($responseText, true);
        if ($response['ecode'] != 0) {
            Log::error('创建订单失败，返回：' . $response['emsg']);
            return false;
        }
        return $response['result']['action']['url'];
    }

    /**
     * 异步回调
     * @param \App\Models\Order $order 订单实例
     * @return array
     */
    public function notify(Order $order)
    {

    }

    /**
     * 订单状态查询
     * @param \App\Models\Order $order 订单实例
     * @return array
     */
    public function query(Order $order)
    {

    }

}