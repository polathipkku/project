<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->integer('pack_qty');
            $table->integer('items_per_pack');
            $table->enum('package_type', ['แพ็คใหญ่', 'แพ็คเล็ก']);
            $table->integer('sumitem')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_packages');
    }
}
