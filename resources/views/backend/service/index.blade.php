@extends('layouts.backend')

@section('title')资金统计@endsection

@section('body')

    <div class="row" style="background-color: #fbfbfb;">
        <div class="col-sm-4">
            <h2 class="text-center">今日订单</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::todayEffectiveCount() }}</b> 单</h3>
        </div>
        <div class="col-sm-4">
            <h2 class="text-center">昨日订单</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::yesterdayEffectiveCount() }}</b> 单</h3>
        </div>
        <div class="col-sm-4">
            <h2 class="text-center">总订单</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::effectiveCount() }}</b> 单</h3>
        </div>
        <div class="col-sm-4">
            <h2 class="text-center">今日收入</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::todayTotalMoney() }}</b> 元</h3>
        </div>
        <div class="col-sm-4">
            <h2 class="text-center">昨日收入</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::yesterdayTotalMoney() }}</b> 元</h3>
        </div>
        <div class="col-sm-4">
            <h2 class="text-center">总金额</h2>
            <h3 class="text-center"><b>{{ \App\Models\Order::totalMoney() }}</b> 元</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" style="margin-top: 10px;">
            <h2>最近一个月的收入状况：</h2>
        </div>
        <div class="col-sm-12" id="charts"></div>
    </div>

@endsection

@section('js')
    <script src="https://a.alipayobjects.com/g/datavis/g2/2.3.12/index.js"></script>
    <script>
        $(function () {
            var data = @json($charts);
            var chart = new G2.Chart({
                id: 'charts',
                width : $('#charts').width(),
                height : 400
            });
            chart.source(data, {
                genre: {
                    alias: '时间'
                },
                sold: {
                    alias: '资金总额'
                }
            });
            chart.interval().position('x*y').color('x')
            chart.render();
        });
    </script>
@endsection