@extends('layouts.backend')

@section('title')添加产品条例@endsection

@section('body')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.product.item.index') }}" class="btn btn-primary">返回产品条例列表</a>
        </div>
        <div class="col-sm-12">
            <form action="" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="control-label col-sm-2">选择产品</label>
                    <div class="col-sm-10">
                        <select name="product_id" class="form-control">
                            <option value="0">请选择产品</option>
                            @foreach(\App\Models\Product::getEffectiveProduct() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">条例类容：</label>
                    <div class="col-sm-10">
                        <textarea name="item" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-sm-10 col-sm-offset-2">
                        <p>注意：每行一条记录</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection