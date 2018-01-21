<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderPayRecord;
use App\Events\OrderPayedSuccess;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

    public function query(Request $request)
    {
        $oid = $request->post('oid', '');
        if (! $oid) {
            return response()->json(['status' => 406, 'message' => '参数错误']);
        }

        $order = Order::where('oid', $oid)->first();
        if (! $order) {
            return response()->json(['status' => 404, 'message' => '订单不存在']);
        }
        
        return response()->json(['status' => 200, 'message' => '', 'data' => ['status' => $order->status]]);
    }

    public function notify(Request $request)
    {
        Log::info($request->input());

        if ($request->get('type') == 'TRADE_ORDER_STATE'
            && $request->get('status') == 'TRADE_SUCCESS') {
            $order = app('youzan')->request('youzan.trade.get', ['tid' => $request->id]);

            $payment_id = $order['trade']['qr_id'];
            $payment = OrderPayRecord::where('payment_id', $payment_id)->where('status', '<>', OrderPayRecord::PAY_SUCCESS)->first();
            if ($payment) {
                event(new OrderPayedSuccess($payment->order));
            }
        }
    }

}
