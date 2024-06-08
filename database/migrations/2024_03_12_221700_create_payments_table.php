<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('payment_date');
            $table->string('payment_status');
            $table->string('payment_slip');
            $table->decimal('total_price', 10, 2);
            $table->decimal('pay_price', 10, 2);
            $table->decimal('pay_change', 10, 2);
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('payment_type_id');
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
