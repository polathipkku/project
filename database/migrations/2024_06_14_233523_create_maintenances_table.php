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
            $table->unsignedBigInteger('user_id')->nullable();  // ไม่ต้องมี `->change()` ที่นี่
            $table->text('problem_detail')->default('ไม่มีข้อมูล'); // กำหนดค่า default โดยตรงที่นี่
            $table->string('problemType');
            $table->dateTime('maintenance_StartDate');       
            $table->timestamps();  
            $table->softDeletes();
    
            $table->foreign('room_id')->references('id')->on('rooms');
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
