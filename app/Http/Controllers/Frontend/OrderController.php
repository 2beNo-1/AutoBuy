<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitOrderRequest;

class OrderController extends Controller
{

    // 订单查询页面
    public function page()
    {
        return view('frontend.order.query');
    }

    public function query(Request $request)
    {
        $oid = $request->input('oid');
        $order = Order::where('oid', $oid)->first();
        if (! $order) {
            flash()->error('订单不存在');
            return redirect()->back();
        }
        return view('frontend.order.query', compact('order'));
    }

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
            flash()->error('暂时无法下单，请稍后再试！Code:5000');
            return redirect()->back();
        }

        $optionInfoCreateResult = $order->optionInfo()->create([
            'mobile' => $data['mobile'],
            'email' => $data['email'],
        ]);
        if (! $optionInfoCreateResult) {
            flash()->error('暂时无法下单，请稍后再试！Code:5000');
            return redirect()->back();
        }

        // 创建远程支付订单
        $payment = app('youzan')->request('youzan.pay.qrcode.create', [
            'qr_type' => 'QR_TYPE_DYNAMIC',
//            'qr_price' => intval($order->all_charge * 100),
            'qr_price' => 1,
            'qr_name' => '购买商品' . $product->name,
            'qr_source' => $order->oid,
        ]);

        // 支付记录与订单关联
        $payRecordCreateResult = $order->payRecord()->create([
            'payment_id' => $payment['qr_id'],
        ]);
        if (! $payRecordCreateResult) {
            flash()->error('创建支付订单失败，请稍后重试！');
            return redirect()->back();
        }

        return view('frontend.order.pay', compact('payment'));
    }

}
