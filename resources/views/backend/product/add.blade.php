@extends('layouts.backend')

@section('title')产品管理@endsection

@section('body')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">返回列表</a>
        </div>
        <div class="col-sm-12">
            <form action="" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="control-label col-sm-2">产品名</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="" placeholder="产品名">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">原价</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="old_charge" class="form-control" value="" placeholder="原价">
                            <div class="input-group-addon">元</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">现价</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="now_charge" class="form-control" value="" placeholder="现价">
                            <div class="input-group-addon">元</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">库存</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="num" class="form-control" value="" placeholder="库存">
                            <div class="input-group-addon">件</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">销量</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="sales_num" class="form-control" value="" placeholder="销量">
                            <div class="input-group-addon">件</div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">描述(可选)</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control"
                                  cols="30" rows="5"
                                  placeholder="产品描述"></textarea>
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