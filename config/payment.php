<?php
return [
    // 同步返回地址
    'return_url' => 'http://easyvideo.org/home.php',

    // 异步回调接口
    'notify_url' => 'http://easyvideo.org/home.php',

    // 默认接口
    'default' => 'Teegon',

    // 天工支付配置
    'teegon' => [
        'app_key' => 'KFWAHFG',
        'app_secret' => 'Hd8aGiyNMsDMKGcdSJ8s',
        'pay_way' => [
            [
                'name' => '微信支付',
                'value' => 'wxpaynative_pinganpay',
            ],
            [
                'name' => '支付宝支付',
                'value' => 'alipay_pinganpay',
            ],
            [
                'name' => '京东支付',
                'value' => 'jdh5_pinganpay',
            ],
            [
                'name' => '翼支付',
                'value' => 'besth5_pinganpay',
            ],
        ],
    ],
];