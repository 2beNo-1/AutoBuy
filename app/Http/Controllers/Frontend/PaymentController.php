<?php

namespace App\Http\Controllers\Frontend;

use App\Autobuy\Youzan;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderPayRecord;
use App\Events\OrderPayedSuccess;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

    public function notify(Request $request, Youzan $youzan)
    {
        Log::info($request->input());

        if (! $youzan->checkSign($request)) {
            return response()->json(['code' => 403]);
        }

        if ($request->get('type') == 'TRADE_ORDER_STATE'
            && $request->get('status') == 'TRADE_SUCCESS') {
            $order = app('youzan')->request('youzan.trade.get', ['tid' => $request->id]);

            $payment_id = $order['trade']['qr_id'];
            $payment = OrderPayRecord::where('payment_id', $payment_id)
                                        ->where('status', '<>', OrderPayRecord::PAY_SUCCESS)
                                        ->first();
            if ($payment) {
                $payment->status = OrderPayRecord::PAY_SUCCESS;
                if ($payment->save()) {
                    event(new OrderPayedSuccess($payment->order));
                }
            }
        }

        return response()->json(['code' => 0, 'msg' => 'success']);
    }

}
