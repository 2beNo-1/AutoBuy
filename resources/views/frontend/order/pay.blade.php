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

@endsection