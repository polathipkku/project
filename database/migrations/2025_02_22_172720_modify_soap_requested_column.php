<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySoapRequestedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->dateTime('soap_requested')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('booking_details', function (Blueprint $table) {
            $table->boolean('soap_requested')->nullable()->change();
        });
    }
}
