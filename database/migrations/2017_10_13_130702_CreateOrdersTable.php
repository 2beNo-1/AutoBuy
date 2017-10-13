<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('oid', 64)->unique()->comment('订单号');
            $table->integer('product_id')->comment('商品ID');
            $table->integer('buy_num')->comment('购买件数');
            $table->decimal('buy_charge', 10, 2)->comment('购买的价格');
            $table->decimal('all_charge', 10, 2)->comment('总价');
            $table->tinyInteger('status')->default(-1)->comment('-1未支付,1已支付,3已发货,9已完成,-3已取消,-5申请退款,-7已退款');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
