<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id')->nullable()->after('type');
            $table->string('expenses_name')->nullable();
            $table->decimal('expenses_price', 10, 2);
            $table->date('expenses_date'); 
            $table->string('type')->nullable(); 
            $table->softDeletes();

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');
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
        Schema::dropIfExists('expenses');
    }
}
