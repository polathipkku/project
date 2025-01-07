<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProblemColumnsFromMaintenances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn('problemType');
            $table->dropColumn('problem_detail');
        });
    }
    
    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->string('problemType');
            $table->text('problem_detail')->default('ไม่มีรายละเอียด');
        });
    }
    
}
