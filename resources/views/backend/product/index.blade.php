@extends('layouts.backend')

@section('title')产品管理@endsection

@section('body')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.product.add') }}" class="btn btn-primary">添加产品</a>
        </div>
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>产品名</th>
                    <th>价格</th>
                    <th>库存/销量</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->old_charge }}/{{ $product->now_charge }}</td>
                    <td>{{ $product->num }}/{{ $product->sales_num }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="javascript:void(0)"
                               onclick="deleteConfirm('{{ route('admin.product.destroy', ['id' => $product->id]) }}')"
                               class="btn btn-warning">删除</a>
                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                               class="btn btn-primary">编辑</a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 text-center">
            {{ $products->render() }}
        </div>
    </div>

@endsection