<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomserviceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomservice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('roomservice_id');
            $table->unsignedBigInteger('booking_id');
            $table->integer('quantity')->default(1); // Number of extra beds
            $table->decimal('total_price', 10, 2); // Total price for the extra beds
            $table->softDeletes(); // For soft delete
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('roomservice_id')->references('id')->on('roomservices')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }
    


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roomservice_details');
    }
}
