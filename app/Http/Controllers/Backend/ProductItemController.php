<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Models\ProductItem;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductItemStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductItemController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if ($request->input('product_id')) {
            $where[] = ['product_id', $request->input('product_id')];
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
        // 判断产品是否存在
        if (! Product::find($data['product_id'])) {
            flash()->warning('请选择产品');
            return redirect()->back();
        }

        if ($data['is_multi']) {
            $insertData = [];
            foreach ($data['item'] as $item) {
                $insertData[] = array_merge(
                    array_only($data, ['product_id', 'is_multi']),
                    [
                        'item' => $item,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                );
            }
            $data = $insertData;
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        DB::table('product_items')->insert($data);
        flash()->success('添加成功');
        return redirect()->back();
    }

    public function destroy($id)
    {
        ProductItem::destroy($id);
        flash()->success('删除成功');
        return redirect()->back();
    }

}
