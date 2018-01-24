@extends('layouts.app')

@section('title')
    订单查询
@endsection

@section('header')
    <style>
        .red { color: red; }
        .price { color: red; font-weight: 800; }
    </style>
@endsection

@section('content')
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
                                    <p>信息如下(共计 <span style="color: red;">{{ count($order->productItems) }}</span> 条)：</p>
                                    <ul>
                                        @foreach($order->productItems as $item)
                                            <li>{{ $item->item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <form action="" method="post" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-sm-12">订单号： <span class="red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="oid" value="{{ request()->input('oid') }}"
                                           class="form-control" placeholder="请输入订单号">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">手机号/邮箱： <span class="red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="info" class="form-control" placeholder="手机号/邮箱">
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
@endsection

@section('footer')
    <script>
        $(function () {
            $('.captcha').click(function () {
                $(this).attr('src', '{{ captcha_src() }}?r=' + Math.random());
            });
        });
    </script>
@endsection