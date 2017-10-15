<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use App\Payments\Payment;
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

        // 库存检测
        if ($data['buy_num'] > $product->num) {
            flash()->warning('库存不足');
            return redirect()->back();
        }

        // 支付方式检测
        if (! Payment::getInstance()->getDefaultPaymentInstance()->hasPayWay($data['pay_way'])) {
            flash()->error('请选择支付方式！');
            return redirect()->back();
        }

        // 创建订单
        $orderData = [
            'oid'        => date('YmdHis') . mt_rand(100, 999),
            'product_id' => $product->id,
            'buy_num'    => $data['buy_num'],
            'buy_charge' => $product->now_charge,
            'all_charge' => $product->now_charge * $data['buy_num'],
            'pay_way'    => $data['pay_way'],
            'status'     => -1,
        ];
        $order = Order::create($orderData);
        if (! $order) {
            flash()->error('暂时无法下单，请稍后再试！');
            return redirect()->back();
        }

        // 生成支付订单
        $submitResult = Payment::getInstance()->getDefaultPaymentInstance()->payment($order);
        if ($submitResult === false) {
            flash()->error('创建远程订单失败，请稍后再试！');
            return redirect()->back();
        }
        header('Location:' . $submitResult);
    }

}
