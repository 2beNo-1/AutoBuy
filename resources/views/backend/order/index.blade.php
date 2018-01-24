@extends('layouts.backend')

@section('title')订单管理@endsection

@section('body')

    <div class="row">
        <div class="col-sm-12">
            <form action="" method="get" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-4">产品</label>
                    <div class="col-sm-4">
                        <select name="product_id" class="form-control">
                            <option value="0">请选择产品</option>
                            @foreach(\App\Models\Product::getEffectiveProduct() as $product)
                                <option value="{{ $product->id }}"
                                        {{ $product->id == request()->input('product_id') ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                        <button type="submit" class="btn btn-primary">过滤</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12">
            <p>共 <b>{{ $orders->total() }}</b> 条数据</p>
        </div>
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>订单号</th>
                    <th>商品</th>
                    <th>价格</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->oid }}</td>
                        <td><span class="label label-info">{{ $order->product->name }}</span></td>
                        <td>{{ $order->buy_charge }} * {{ $order->buy_num }} = {{ $order->all_charge }}</td>
                        <td><span class="label label-info">{{ $order->statusText() }}</span></td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:void(0)"
                                   onclick="deleteConfirm('{{ route('admin.order.destroy', ['id' => $order->id]) }}')"
                                   class="btn btn-warning">删除</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 text-center">
            {{ $orders->appends(request()->input())->render() }}
        </div>
    </div>

@endsection