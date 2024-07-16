<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_slip')->nullable();
            $table->decimal('total_price', 10, 2)->default(0.00);
            $table->decimal('pay_price', 10, 2)->default(0.00);
            $table->decimal('pay_change', 10, 2)->default(0.00);
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->string('payment_intent_id')->nullable();
            $table->timestamp('expiration_time')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->decimal('amount', 10, 2)->nullable();

            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
