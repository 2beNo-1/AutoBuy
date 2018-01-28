@extends('layouts.app')

@section('title')
    收银台
@endsection

@section('header')
    <style>
        body { background-color: #f4f4f4; padding-top: 20px; }
        .main-body { background-color: #ffffff; border-radius: 2px; border: 1px solid #ddd; }
        .header { border-bottom: 1px solid #ddd; }
        .order-info { border-right: 1px solid #dddddd; }
        .qrcode { padding-top: 30px; padding-bottom: 30px; }

        .copyright,.back-button { color: #999999; }

        .message-full-screen {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 100;
            background-color: rgba(0, 0, 0, 0.5); display: none;
        }
        .message-center {
            position: fixed; top: 50%; left: 50%; z-index: 200;
            width: 400px; height: auto; margin-left: -250px; margin-top: -100px;
            padding: 0px 50px; background-color: #ffffff; border-radius: 10px;
        }
        .message-box-close {
            position: absolute; right: 10px; top: 10px; width: 40px; height: 40px;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

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
            <div class="col-xs-12 text-center copyright">
                @include('frontend.components.copyright')
            </div>
        </div>
    </div>

    <div class="message-full-screen">
        <div class="message-center">
            <img class="message-box-close" src="data:image/png;base64,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">
            <h3 class="text-center">新消息</h3>
            <div class="message-deliver">
                <p>订单号：<span class="label label-primary message-order-id"></span></p>
                <p>发货信息如下：</p>
                <p class="message-deliver-content"></p>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        if (typeof window.Echo !== 'undefined') {
            Echo.private('order.{{$order->oid}}|{{$order->optionInfo->mobile}}')
                .listen('OrderPayedSuccess', function (e) {
                    $('.message-order-id').text(e.oid);
                    $('.message-deliver-content').html(e.items.join('<br>'));
                    $('.message-full-screen').show();
                });
        }

        $(function () {
            $('.message-box-close').click(function () {
                $('.message-full-screen').hide();
            });
        });
    </script>
@endsection