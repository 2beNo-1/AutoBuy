<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Payments\Payment;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        // 获取产品
        $products = Product::getEffectiveProduct();

        // 获取支付方式
        $payWays = Payment::getInstance()->getDefaultPaymentInstance()->payWays();

        return view('frontend.index.index', compact('payWays', 'products'));
    }
}
