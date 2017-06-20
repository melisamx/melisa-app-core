<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListenersTable extends Migration
{
    /**
     * Run the migrations.
     * @table listeners
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listeners', function (Blueprint $table) {
            $table->increments('id');
            $table->char('idEvent', 36);
            $table->unsignedInteger('idModule');
            $table->boolean('active');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idEvent', 'idModule'], 'unique_listeners');

            $table->foreign('idEvent')
                ->references('id')->on('events')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idModule')
                ->references('id')->on('modules')
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
        Schema::dropIfExists('listeners');
    }
}
