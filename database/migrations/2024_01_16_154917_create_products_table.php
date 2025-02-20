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
            $table->unsignedBigInteger('stocks_id')->nullable();
            $table->unsignedBigInteger('product_types_id')->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->string('product_status')->nullable();
            $table->string('product_img')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('stocks_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('product_types_id')->references('id')->on('product_types')->onDelete('cascade');
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
