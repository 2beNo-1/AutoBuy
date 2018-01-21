<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>支付</title>
    <style>
        .pay {
            position: fixed; top: 10%; left: 50%; z-index: 11;
            width: 500px; height: auto; margin-left: -250px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="pay">
        <h2>请用微信/支付宝扫描下方二维码支付</h2>
        <p>
            <img src="{{ $payment['qr_code'] }}" width="200" height="200">
        </p>
    </div>

</body>
</html>