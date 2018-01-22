<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>支付</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f4f4; padding-top: 20px; }
        .main-body { background-color: #ffffff; border-radius: 2px; border: 1px solid #ddd; }
        .header { border-bottom: 1px solid #ddd; }
        .order-info { border-right: 1px solid #dddddd; }
        .qrcode { padding-top: 30px; padding-bottom: 30px; }

        .copyright,.back-button { color: #999999; }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p><a href="{{ url('/') }}" class="back-button">返回首页</a></p>
            </div>
        </div>
        <div class="row main-body">
            <div class="col-xs-12 header">
                <h1>收银台</h1>
            </div>
            <div class="col-xs-7 order-info">
                <h3>订单信息</h3>
                <p>订单号： <span style="color: red;">{{ $order->oid }}</span> </p>
                <p>商品：{{ $order->product->name }}</p>
                <p>数量：{{ $order->buy_num }}</p>
                <p>价格： <span style="color: red;">￥{{ $order->all_charge }}</span> </p>
                <p>购买时间：{{ $order->created_at }}</p>
                <h3>支付方式</h3>
                <p>
                    <img src="{{ asset('/images/pay.png') }}" width="250" height="134">
                </p>
            </div>
            <div class="col-xs-5 text-center qrcode">
                <p>请扫描下方二维码支付</p>
                <p>
                    <img src="{{ $payment['qr_code'] }}" width="240" height="240">
                </p>
                <p>
                    <a href="{{ route('order.query') . '?oid=' . $order->oid }}" class="btn btn-success">支付完成</a>
                    <a href="{{ url('/') }}" onclick="return confirm('确定取消支付？')" class="btn btn-warning">取消支付</a>
                </p>
            </div>
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-xs-12">
                <p class="text-center copyright">Copyright Autobuy.CC</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.bootcss.com/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>