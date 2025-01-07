<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('booking_detail_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('maintenances_status')->nullable();
            $table->dateTime('maintenance_StartDate')->nullable();
            $table->timestamps();  
            $table->softDeletes();
    
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('booking_detail_id')->references('id')->on('booking_details')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenances');
    }
}
