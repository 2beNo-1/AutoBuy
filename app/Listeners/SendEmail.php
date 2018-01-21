<?php

namespace App\Listeners;

use App\Mail\OrderShipped;
use App\Events\OrderPayedSuccess;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail
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
        Mail::to($order->optionInfo->email)->send(new OrderShipped($order));
    }
}
