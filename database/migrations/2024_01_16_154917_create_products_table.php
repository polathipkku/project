<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('stocks_id');
            $table->unsignedBigInteger('product_types_id');
            $table->string('product_name');
            $table->integer('product_price');
            $table->string('product_detail');
            $table->string('product_status');
            $table->string('product_img');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stocks_id')->references('id')->on('stocks');
            $table->foreign('product_types_id')->references('id')->on('product_types');
            
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
