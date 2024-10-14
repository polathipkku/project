<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('campaign_name', 255);
            $table->string('promo_code', 255)->index();
            $table->integer('discount_value')->default(0);
            $table->integer('max_usage_per_code')->nullable();
            $table->enum('type', ['fix', 'percentage'])->default('percentage'); 
            $table->integer('minimum_nights')->nullable();
            $table->decimal('minimum_booking_amount', 10, 2)->nullable();
            $table->boolean('promotion_status')->default(1);            
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('usage_count')->default(0);
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
