<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductItemStoreRequest;

class ProductItemController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if ($request->input('product_id')) {
            $where[] = ['product_id', '=', $request->input('product_id')];
        }

        $productItems = ProductItem::where($where)->orderBy('id', 'desc')->paginate(15);
        return view('backend.product.item.index', compact('productItems'));
    }

    public function create()
    {
        return view('backend.product.item.add');
    }

    public function store(ProductItemStoreRequest $request)
    {
        $data = $request->filldata();
        $product = Product::findOrFail($data['product_id']);

        $insertData = [];
        foreach ($data['item'] as $item) {
            $insertData[] = ['item' => $item];
        }
        if (! $product->items()->createMany($insertData)) {
            flash()->error('添加失败');
        } else {
            flash()->success('添加成功');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        ProductItem::destroy($id);
        flash()->success('删除成功');
        return redirect()->back();
    }

}
