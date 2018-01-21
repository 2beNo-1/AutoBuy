<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::getEffectiveProduct();
        return view('frontend.index.index', compact('products'));
    }
}
