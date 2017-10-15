<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>自动购</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .red { color: red; }
        .price { color: red; font-weight: 800; }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2 style="line-height: 80px;">小自自动售卖系统</h2>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>购买注意事项：</h4>
                        <p>1.由于本站出售商品均为虚拟物品！暂不支持退款，如果疑问请拨打下方的客服电话。</p>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-12">@include('vendor.flash.message')</div>
                        <form action="{{ route('order.post') }}" method="post" class="form-horizontal" onsubmit="return checkPost()">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label class="col-sm-12">请选择商品：</label>
                                <div class="col-sm-12">
                                    <select name="product_id" class="form-control">
                                        <option data-price="0.00" value="0">======请选择商品======</option>
                                        @foreach($products as $product)
                                            <option data-price="{{ $product->now_charge }}"
                                                    value="{{ $product->id }}">
                                                {{ $product->name }}/【{{ $product->now_charge }}】元
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">购买数量</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon dec-num">减</div>
                                        <input type="text" name="buy_num"
                                               class="form-control text-center"
                                               value="1">
                                        <div class="input-group-addon add-num">加</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">价格：</label>
                                <div class="col-sm-12">
                                    <span class="price">0.00</span> 元
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">手机号 <span class="red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="mobile" class="form-control" placeholder="手机号，用于自动发货">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">邮箱 <span class="red">*</span></label>
                                <div class="col-sm-12">
                                    <input type="text" name="email" class="form-control" placeholder="邮箱，用于自动发货">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">支付方式：</label>
                                <div class="col-sm-12">
                                    @foreach($payWays as $item)
                                        <label>
                                            <input type="radio" name="pay_way" value="{{ $item['value'] }}">{{ $item['name'] }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-block btn-primary">购买</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a href="" class="btn btn-block btn-warning">查询订单</a>
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

<script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    var checkPost = function () {
        if ($('input[name="mobile"]').val() == "") {
            alert('请输入手机号')
            return false
        }
        if ($('input[name="email"]').val() == "") {
            alert('请输入邮箱')
            return false
        }
        return confirm('确定下单？')
    }

    var computeSum = function () {
        var price = $('select[name="product_id"]').find('option:selected').attr('data-price')
        var num = $('input[name="buy_num"]').val()
        $('.price').text(price * num)
    }

    $(function () {
        $('.dec-num').click(function () {
            var num = parseInt($('input[name="buy_num"]').val())
            if (num > 1) {
                num = num - 1
                $('input[name="buy_num"]').val(num)
            }
            computeSum()
        });

        $('.add-num').click(function () {
            var num = parseInt($('input[name="buy_num"]').val())
            num = num + 1
            $('input[name="buy_num"]').val(num)
            computeSum()
        });

        $('select[name="product_id"]').change(function () {
            var productPrice = $(this).find('option:selected').attr('data-price')
            computeSum()
        });
    });
</script>
</body>
</html>