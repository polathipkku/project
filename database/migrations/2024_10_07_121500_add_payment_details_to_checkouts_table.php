<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentDetailsToCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('payment_method')->nullable(); // วิธีชำระเงิน
            $table->decimal('amount_paid', 10, 2)->nullable(); // จำนวนเงินที่ลูกค้าจ่าย
            $table->decimal('change', 10, 2)->nullable(); // จำนวนเงินทอน
        });
    }
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'amount_paid', 'change']);
        });
    }
}
