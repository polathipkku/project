<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    { 
        Schema::create('users', function (Blueprint $table) { 
            $table->id(); 
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->timestamp('email_verified_at')->nullable(); 
    
            $table->string('userType')->default('2');//เพิ่ม 
            $table->string('tel')->default('');//เพิ่ม 
            $table->date('start_date')->nullable();//เพิ่ม 
            $table->date('birthday')->nullable();//เพิ่ม 
            $table->text('address')->default('');//เพิ่ม 
            $table->string('image')->default('');//เพิ่ม 
            $table->decimal('salary', 10, 2)->nullable(); // เงินเดือน 
            $table->string('work_shift')->nullable();    // กะเวลาการทำงาน 
            $table->string('position')->nullable();      // ตำแหน่ง 
            $table->string('payment_date', 2)->nullable();    // เวลาจ่ายเงินเดือน 
            
            // เพิ่มฟิลด์สำหรับสัญชาติและข้อมูลที่เกี่ยวข้อง
            $table->string('nationality')->default('thai'); // สัญชาติ default เป็นไทย
            $table->string('id_card')->nullable(); // สำหรับคนไทย
            
            // สำหรับชาวต่างชาติ
            $table->string('passport_number')->nullable(); // เลขพาสปอร์ต
            $table->string('country')->nullable(); // ประเทศ
            $table->string('work_permit_number')->nullable(); // เลขใบอนุญาตทำงาน
            $table->date('permit_expiry_date')->nullable(); // วันหมดอายุใบอนุญาต
            $table->string('visa_type')->nullable(); // ประเภทวีซ่า
            
            $table->string('password'); 
            $table->rememberToken(); 
            $table->foreignId('current_team_id')->nullable(); 
            $table->string('profile_photo_path', 2048)->nullable(); 
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
        Schema::dropIfExists('users');
    }
};
