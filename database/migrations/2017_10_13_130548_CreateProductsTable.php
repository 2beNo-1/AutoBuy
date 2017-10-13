<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128)->comment('产品名');
            $table->decimal('old_charge', 10, 2)->default(0)->comment('原价');
            $table->decimal('now_charge', 10, 2)->default(0)->comment('现价');
            $table->integer('num')->default(0)->comment('库存');
            $table->integer('sales_num')->default(0)->comment('已买数量');
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
        Schema::dropIfExists('products');
    }
}
