<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductStoreRequest;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if ($request->has('keywords')) {
            $where['name'] = ['like', '"%' . $request->input('keywords') . '%"'];
        }
        $products = Product::where($where)->paginate(15);
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        return view('backend.product.add');
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->filldata();
        $product = Product::create(array_except($data, 'description'));
        if (! $product) {
            flash()->error('添加失败');
        } else {
            ProductDetail::create([
                'product_id' => $product->id,
                'description' => $data['description'],
            ]);
            flash()->success('添加成功');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.edit', compact('product'));
    }

    public function update(ProductEditRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->filldata();
        if (! $product->update(array_except($data, 'description'))) {
            flash()->error('更新失败');
            return redirect()->back();
        }
        ProductDetail::where(['product_id' => $product->id])
                       ->update(array_only($data, 'description'));
        flash()->success('编辑成功');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        flash()->success('删除成功');
        return redirect()->back();
    }

}
