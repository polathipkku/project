<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_name');
            $table->string('room_description');
            $table->integer('price_night');
            $table->integer('price_temporary');
            $table->string('room_image');
            $table->string('room_status');
            $table->integer('room_occupancy');
            $table->integer('room_bed');
            $table->integer('room_bathroom');
            $table->timestamps();
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
        Schema::dropIfExists('rooms');

    }
}
