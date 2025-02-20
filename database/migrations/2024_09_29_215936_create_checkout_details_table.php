<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('product_room_id')->nullable();
            $table->unsignedBigInteger('booking_detail_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->decimal('totalpriceroom', 10, 2)->nullable();
            $table->string('productroom_name')->nullable();
            $table->string('thing_status')->default('รอซ่อม');
            $table->string('repairmaintenances_type')->nullable();

            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onDelete('cascade');
            $table->foreign('product_room_id')->references('id')->on('product_rooms')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
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
        Schema::dropIfExists('checkout_details');
    }
}
