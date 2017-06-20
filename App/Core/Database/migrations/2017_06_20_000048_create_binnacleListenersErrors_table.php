<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnaclelistenerserrorsTable extends Migration
{
    /**
     * Run the migrations.
     * @table binnacleListenersErrors
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacleListenersErrors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idBinnacleListener', 36);
            $table->text('error');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('idBinnacleListener')
                ->references('id')->on('binnacleListeners')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binnacleListenersErrors');
    }
}
