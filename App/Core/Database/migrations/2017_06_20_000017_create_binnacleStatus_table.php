<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnaclestatusTable extends Migration
{
    /**
     * Run the migrations.
     * @table binnacleStatus
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacleStatus', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->string('name', 75)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binnacleStatus');
    }
}
