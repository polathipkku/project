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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('promotion_id')->nullable();
            $table->string('booking_random_id')->nullable()->unique();
            $table->integer('room_quantity');
            $table->integer('person_count')->default(2);
            $table->decimal('total_cost', 10, 2);
            $table->integer('total_bed')->default(0);
            $table->string('booking_status')->default('รอชำระเงิน');

            
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
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
