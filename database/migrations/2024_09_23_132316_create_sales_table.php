<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id'); // ผู้ที่ขายสินค้า
            $table->integer('quantity');
            $table->decimal('total_price', 8, 2);
            $table->decimal('change_amount', 8, 2)->nullable();
            $table->enum('payment_method', ['cash', 'transfer']);
            $table->timestamps();

            // กำหนดความสัมพันธ์กับ Product และ User
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
