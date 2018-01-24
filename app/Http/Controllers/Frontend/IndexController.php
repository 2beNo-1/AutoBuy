<?php

namespace App\Http\Controllers\Frontend;

use App\Autobuy\Oid;
use App\Models\Product;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Oid $oid)
    {
        $products = Product::getEffectiveProduct();
        $oid = $oid->get();
        return view('frontend.index.index', compact('oid', 'products'));
    }
}
