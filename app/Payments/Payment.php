<?php

namespace App\Payments;


class Payment
{

    protected static $instance = null;

    protected static $config;

    private function __construct($config)
    {
        self::$config = $config;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self(config('payment'));
        }
        return self::$instance;
    }

    /**
     * 获取异步返回URL
     * @return string
     */
    public function getNotifyUrl()
    {
        return self::$config['notify_url'];
    }

    /**
     * 获取同步返回URL
     * @return string
     */
    public function getReturnUrl()
    {
        return self::$config['return_url'];
    }

    /**
     * 获取指定的支付渠道配置
     * @param string $payment 支付渠道名
     * @return array
     */
    public function getPaymentConfig($payment)
    {
        return self::$config[strtolower($payment)];
    }

    /**
     * 获取默认的支付渠道名
     * @return string
     */
    public function getDefaultPayment()
    {
        return self::$config['default'];
    }

    /**
     * 获取默认支付对象实例
     * @return \App\Payments\PaymentContract
     */
    public function getDefaultPaymentInstance()
    {
        $defaultPaymentName = self::getDefaultPayment();
        $classPath = '\\App\\Payments\\' . $defaultPaymentName;
        // 初始化实例
        $instance = new $classPath(
            self::getPaymentConfig($defaultPaymentName),
            self::getReturnUrl(),
            self::getNotifyUrl()
        );
        // 注入Request实例
        $client = new \GuzzleHttp\Client();
        $instance->setRequest($client);
        return $instance;
    }

}