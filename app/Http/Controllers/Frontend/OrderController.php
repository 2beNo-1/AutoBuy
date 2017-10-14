<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitOrderRequest;

class OrderController extends Controller
{

    public function create(SubmitOrderRequest $request, Product $product)
    {
        $data = $request->filldata();
        if ($data['buy_num'] < 1) {
            flash()->warning('请选择商品');
            return redirect()->back();
        }

        // 检测商品
        $product = $product->find($request->input('product_id'));
        if (! $product) {
            flash()->warning('请选择商品');
            return redirect()->back();
        }

        // 创建订单
        $orderData = [
            'oid'        => date('YmdHis') . mt_rand(100, 999),
            'product_id' => $product->id,
            'buy_num'    => $data['buy_num'],
            'buy_charge' => $product->now_charge,
            'all_charge' => $product->now_charge * $data['buy_num'],
            'status'     => -1,
        ];
        $order = Order::create($orderData);
        if (! $order) {
            flash()->error('暂时无法下单，请稍后再试！');
            return redirect()->back();
        }

        // 生成支付订单

    }

}
