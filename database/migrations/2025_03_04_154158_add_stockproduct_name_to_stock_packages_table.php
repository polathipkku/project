<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockproductNameToStockPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_packages', function (Blueprint $table) {
            $table->string('stockproduct_name')->after('stock_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('stock_packages', function (Blueprint $table) {
            $table->dropColumn('stockproduct_name');
        });
    }
    
}
