<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('productroom_name');
            $table->decimal('productroom_price', 8, 2);
            $table->integer('product_qty');
            $table->string('productroom_category');
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
        Schema::dropIfExists('product_rooms');
    }
}
