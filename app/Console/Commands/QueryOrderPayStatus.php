<?php

namespace App\Console\Commands;

use App\Autobuy\Youzan;
use App\Events\OrderPayedSuccess;
use App\Models\Order;
use App\Models\OrderPayRecord;
use Illuminate\Console\Command;

class QueryOrderPayStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'query order pay status.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // 定时查询订单支付状态
        // 处理逻辑如下：
        // 读取自创建订单12个小时之内的未支付订单

        $youzan = new Youzan;

        $expired_at = date('Y-m-d H:i:s', strtotime(time() - 3600 * 12));
        $payRecords = OrderPayRecord::where('created_at', '>', $expired_at)
                                      ->where('status', OrderPayRecord::PAY_NONE)
                                      ->limit(5)
                                      ->get();
        if (! $payRecords) {
            return;
        }
        foreach ($payRecords as $record) {
            $queryResult = $youzan->query($record->payment_id);
            if ($queryResult) {
                $record->status = OrderPayRecord::PAY_SUCCESS;
                if ($record->save()) {
                    event(new OrderPayedSuccess($record->order));
                }
            } else {
                $record->updated_at = date('Y-m-d H:i:s');
                $record->save();
            }
        }
    }

}
