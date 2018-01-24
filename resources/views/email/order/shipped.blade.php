<p>您好，您在本站购买了如下商品</p>

<p>订单号：{{ $order->oid }}</p>
<p>下单时间：{{ $order->created_at }}</p>
<p>购买产品：{{ $order->product->name }}</p>
<p>购买数量：{{ $order->buy_num }} 件</p>
<p>产品如下：</p>
<ul>
    @foreach($order->productItems as $item)
    <li>{{ $item->item }}</li>
    @endforeach
</ul>
<p>如有疑问，请联系客服。</p>