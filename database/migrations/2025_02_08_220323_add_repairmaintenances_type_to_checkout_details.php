<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRepairmaintenancesTypeToCheckoutDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkout_details', function (Blueprint $table) {
            $table->string('repairmaintenances_type')->nullable()->after('thing_status');
        });
    }

    public function down()
    {
        Schema::table('checkout_details', function (Blueprint $table) {
            $table->dropColumn('repairmaintenances_type');
        });
    }
}
