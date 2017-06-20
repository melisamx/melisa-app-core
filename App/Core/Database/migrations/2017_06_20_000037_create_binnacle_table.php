<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinnacleTable extends Migration
{
    /**
     * Run the migrations.
     * @table binnacle
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binnacle', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('idBinnacleStatus')->default(1);
            $table->char('idEvent', 36);
            $table->char('idIdentityCreated', 36);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('isProcessed');
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->text('data')->nullable();
            $table->dateTime('processedAt')->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->foreign('idBinnacleStatus')
                ->references('id')->on('binnacleStatus')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idEvent')
                ->references('id')->on('events')
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
        Schema::dropIfExists('binnacle');
    }
}
