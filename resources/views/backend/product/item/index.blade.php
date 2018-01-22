@extends('layouts.backend')

@section('title')产品条例@endsection

@section('body')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.product.item.add') }}" class="btn btn-primary">添加产品条例</a>
        </div>
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
            <p>共 <b>{{ $productItems->total() }}</b> 条数据。</p>
        </div>
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>产品</th>
                    <th>条例内容</th>
                    <th>添加时间</th>
                    <th>使用</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productItems as $productItem)
                    <tr>
                        <td>{{ $productItem->id }}</td>
                        <td>{{ $productItem->product->name }}</td>
                        <td>{{ $productItem->item }}</td>
                        <td>{{ $productItem->created_at }}</td>
                        <td>
                            @if($productItem->order)
                                <span class="label label-info">{{ $productItem->order->oid }}</span>
                                @else
                                <span class="label label-warning">否</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="javascript:void(0)"
                                   onclick="deleteConfirm('{{ route('admin.product.item.destroy', ['id' => $productItem->id]) }}')"
                                   class="btn btn-warning">删除</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 text-center">
            {{ $productItems->appends(request()->input())->render() }}
        </div>
    </div>

@endsection