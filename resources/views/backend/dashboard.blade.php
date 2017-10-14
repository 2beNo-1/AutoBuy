@extends('layouts.backend')

@section('title')主面板@endsection

@section('body')

    <div class="row">
        <div class="col-sm-3">
            <h2 class="text-center">今日订单</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::todayEffectiveCount() }}</b> 单</h3>
        </div>
        <div class="col-sm-3">
            <h2 class="text-center">今日收入</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::todayTotalMoney() }}</b> 元</h3>
        </div>
        <div class="col-sm-3">
            <h2 class="text-center">总订单</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::effectiveCount() }}</b> 单</h3>
        </div>
        <div class="col-sm-3">
            <h2 class="text-center">总金额</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::totalMoney() }}</b> 元</h3>
        </div>
    </div>

@endsection