@extends('layouts.backend')

@section('title')修改密码@endsection

@section('body')

    <div class="row">
        <div class="col-sm-12">
            <form action="" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="control-label col-sm-2">原密码</label>
                    <div class="col-sm-3">
                        <input type="password" name="old_password" class="form-control" placeholder="原密码">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">新密码</label>
                    <div class="col-sm-3">
                        <input type="password" name="new_password" class="form-control" placeholder="新密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection