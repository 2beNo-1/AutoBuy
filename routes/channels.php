<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('order.{orderId}', function ($user, $orderId) {
    if (strpos($orderId, '|') === false) {
        return false;
    }
    list($oid, $mobile) = explode('|', $orderId);
    $order = \App\Models\Order::where('oid', $oid)->first();
    if (! $order) {
        return false;
    }
    if ($order->optionInfo->mobile != $mobile) {
        return false;
    }
    return true;
});
