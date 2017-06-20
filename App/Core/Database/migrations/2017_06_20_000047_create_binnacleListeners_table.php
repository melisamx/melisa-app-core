<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnaclelistenersTable extends Migration
{
    /**
     * Run the migrations.
     * @table binnacleListeners
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacleListeners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('idBinnacleListenerStatus')->default(1);
            $table->char('idBinnacle', 36);
            $table->unsignedInteger('idListener');
            $table->char('idIdentityCreated', 36);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->index('idBinnacle');

            $table->foreign('idBinnacleListenerStatus')
                ->references('id')->on('binnacleListenersStatus')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idBinnacle')
                ->references('id')->on('binnacle')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idListener')
                ->references('id')->on('listeners')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idIdentityCreated')
                ->references('id')->on('identities')
                ->onDelete('no action')
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
        Schema::dropIfExists('binnacleListeners');
    }
}
