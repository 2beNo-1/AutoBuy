<?php

namespace App\Listeners;

use App\Events\OrderPayedSuccess;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementSaleNum
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
        $product = $event->order->product;
        $product->sales_num++;
        $product->num -= $event->order->buy_num;
        $product->save();
    }
}
