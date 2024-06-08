<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->string('booking_name');
            $table->string('phone')->nullable();
            $table->date('checkin_date');
            $table->date('checkout_date'); 
            $table->unsignedBigInteger('checkin_by')->nullable(); 
            $table->unsignedBigInteger('checkout_by')->nullable(); 
            $table->timestamps();
            $table->decimal('total_cost', 10, 2)->nullable();
            $table->string('booking_status');
            $table->integer('occupancy_person')->nullable();
            $table->string('room_type')->nullable();
           
            $table->softDeletes();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
