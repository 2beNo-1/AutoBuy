<?php

use Illuminate\Database\Seeder;

class MockOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 状态
        $status = [-9,-7,-5,-3,-1,1,3,9];

        // 获取产品
        $products = \App\Models\Product::where('deleted_at', null)->get();

        $num = 100;
        while ($num > 0) {
            $buyNum = mt_rand(1, 10);
            $product = $products->random();
            $data = [
                'oid' => date('Ymd') . mt_rand(1000, 9999),
                'product_id' => $product->id,
                'buy_num' => $buyNum,
                'buy_charge' => $product->now_charge,
                'all_charge' => $product->now_charge * $buyNum,
                'status' => $status[mt_rand(0, count($status) - 1)],
            ];

            \App\Models\Order::create($data);
            $num--;
        }
    }
}
