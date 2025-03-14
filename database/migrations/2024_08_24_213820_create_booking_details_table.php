<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->string('booking_detail_status');
            $table->string('booking_name');
            $table->string('phone');
            $table->string('bookingto_username')->nullable();  
            $table->string('bookingto_phone')->nullable();
            $table->integer('occupancy_person')->nullable();
            $table->integer('occupancy_child')->nullable();
            $table->integer('occupancy_baby')->nullable();
            $table->date('checkin_date');
            $table->date('checkout_date'); 
            $table->string('room_type')->nullable();
            $table->dateTime('soap_requested')->nullable();
            $table->integer('extra_bed_count')->default(0);
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}
