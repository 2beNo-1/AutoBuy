<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $where = [
            ['deleted_at', null],
        ];
        $products = Product::where($where)
                             ->orderBy('id', 'desc')
                             ->get();

        return view('frontend.index.index', compact('products'));
    }
}
