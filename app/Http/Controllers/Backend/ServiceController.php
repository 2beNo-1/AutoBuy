<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{

    public function index()
    {
        $startDate = date('Y-m-d', strtotime('-30 days'));
        $endData = date('Y-m-d');

        // 获取指定时间内的数据
        $where = [
            ['deleted_at', null],
            ['created_at', '>=', $startDate],
            ['created_at', '<', $endData],
        ];
        $orders = Order::where($where)
                        ->whereIn('status', [1, 3, 9])
                        ->get();

        // 整合数据
        $data = [];
        while (strtotime($startDate) < strtotime($endData)) {
            $data[$startDate] = 0;
            $startDate = date('Y-m-d', strtotime($startDate) + 3600*24);
        }
        foreach ($orders as $order) {
            $key = date('Y-m-d', strtotime($order->created_at));
            $data[$key] += $order->all_charge;
        }

        // 封装数据
        $charts = [];
        foreach ($data as $key => $item) {
            $charts[] = [
                'x' => $key,
                'y' => $item,
            ];
        }

        return view('backend.service.index', compact('charts'));
    }

}
