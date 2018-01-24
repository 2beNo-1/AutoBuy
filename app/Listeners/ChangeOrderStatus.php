<?php

namespace App\Listeners;

use App\Events\OrderPayedSuccess;
use App\Models\Order;
use App\Models\OrderPayRecord;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeOrderStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderPayedSuccess  $event
     * @return void
     */
    public function handle(OrderPayedSuccess $event)
    {
        if ($event->order->status != OrderPayRecord::PAY_SUCCESS) {
            $event->order->status = OrderPayRecord::PAY_SUCCESS;
            $event->order->save();
        }
    }
}
