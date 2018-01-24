<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPayRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pay_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('payment_id')->comment('远程支付系统订单号');
            $table->tinyInteger('status')->default(-1)->comment('-1无状态,9已支付');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_pay_records');
    }
}
