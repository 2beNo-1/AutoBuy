<?php

namespace App\Listeners;

use App\Events\OrderPayedSuccess;
use App\Models\ProductItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BindProductItem
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
        $order = $event->order;
        $count = $order->buy_num;
        while ($count > 0) {
            $productItem = $order->product->items()->where('order_id', 0)->first();
            if ($productItem) {
                $productItem->update(['order_id' => $order->id]);
            }
            $count--;
        }
    }
}
