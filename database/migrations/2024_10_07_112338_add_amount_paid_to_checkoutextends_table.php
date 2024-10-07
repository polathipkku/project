<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountPaidToCheckoutextendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkoutextends', function (Blueprint $table) {
            $table->decimal('amount_paid', 8, 2)->after('payment_method')->nullable(); // Add amount_paid column
        });
    }

    public function down()
    {
        Schema::table('checkoutextends', function (Blueprint $table) {
            $table->dropColumn('amount_paid');
        });
    }
}
