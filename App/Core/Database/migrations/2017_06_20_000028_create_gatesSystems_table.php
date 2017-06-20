<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatessystemsTable extends Migration
{
    /**
     * Run the migrations.
     * @table gatesSystems
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gatesSystems', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('idGate');
            $table->smallInteger('idSystemSecurity');
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();
            $table->string('idIdentityUpdated', 36)->nullable();

            $table->unique(['idGate', 'idSystemSecurity'], 'unique_gatesSystems');

            $table->foreign('idGate')
                ->references('id')->on('gates')
                ->onDelete('no action')
                ->onUpdate('cascade');

            $table->foreign('idSystemSecurity')
                ->references('id')->on('systemsSecurity')
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
        Schema::dropIfExists('gatesSystems');
    }
}
