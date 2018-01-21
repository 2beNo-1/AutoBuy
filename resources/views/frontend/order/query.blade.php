<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>自动购</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .red { color: red; }
        .price { color: red; font-weight: 800; }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 style="line-height: 80px;">订单查询</h2>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-sm-12">@include('vendor.flash.message')</div>
                    @if(isset($order))
                    <div class="col-sm-12">
                        <div class="alert alert-warning">
                            <p><b>查询结果：</b> {{ $order->getQueryResult() }}</p>
                        </div>
                    </div>
                    @endif
                    <form action="" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-12">订单号： <span class="red">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" name="oid" class="form-control" placeholder="请输入订单号">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">验证码： <span class="red">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="captcha_id" class="form-control" placeholder="验证码">
                            </div>
                            <div class="col-sm-4">
                                <img src="{{ captcha_src() }}" width="120" height="36" class="captcha">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-block btn-primary">立即查询</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{ url('/') }}" class="btn btn-block btn-warning">我要购买！</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer text-center">
                    <p>CopyRight AutoBuy.APP</p>
                    <p>联系QQ：616896861 客服电话：13675626825</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>