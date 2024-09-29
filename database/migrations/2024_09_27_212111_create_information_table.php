<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Foreign key
            $table->string('name'); // ชื่อ
            $table->string('id_card'); // บัตรประชาชน
            $table->string('phone'); // เบอร์โทร
            $table->string('address'); // ที่อยู่
            $table->string('sub_district'); // ตำบล
            $table->string('province'); // จังหวัด
            $table->string('district'); // อำเภอ
            $table->string('postcode'); // เลขรหัสไปรษณีย์
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
}
