<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('checked_in_by')->nullable();
            $table->dateTime('checkin');
            $table->string('name'); // ชื่อ
            $table->string('id_card'); // บัตรประชาชน
            $table->string('phone'); // เบอร์โทร
            $table->string('address'); // ที่อยู่
            $table->string('sub_district'); // ตำบล
            $table->string('province'); // จังหวัด
            $table->string('district'); // อำเภอ
            $table->string('postcode'); // รหัสไปรษณีย์
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('checked_in_by')->references('id')->on('users');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkins');
    }
}
