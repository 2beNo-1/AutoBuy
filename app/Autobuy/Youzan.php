<?php

namespace App\Autobuy;


class Youzan
{

    const PAY_SUCCESS = 9;

    const PAY_SUCCESS_CODE = 'TRADE_RECEIVED';

    protected $instance;

    public function __construct()
    {
        $this->instance = app('youzan');
    }

    public function query($payment_id)
    {
        $result = $this->instance->request('youzan.trades.qr.get', [
            'qr_id' => $payment_id,
            'status' => self::PAY_SUCCESS_CODE,
        ]);
        return $result['total_results'] > 0;
    }

}