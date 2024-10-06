<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutextendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkoutextends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_detail_id')->constrained()->onDelete('cascade'); // เชื่อมต่อกับ booking_detail
            $table->integer('extended_days')->default(0); // จำนวนวันที่เลื่อนเวลาเช็คเอาท์
            $table->decimal('extra_charge', 8, 2)->default(0); // ค่าใช้จ่ายเพิ่มเติม
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkoutextends');
    }
}
