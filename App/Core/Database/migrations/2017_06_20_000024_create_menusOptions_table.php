<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusoptionsTable extends Migration
{
    /**
     * Run the migrations.
     * @table menusOptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menusOptions', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->smallInteger('idMenu');
            $table->smallInteger('idOption');
            $table->smallInteger('order')->default(0);
            $table->smallInteger('idOptionParent')->nullable();

            $table->unique(['idMenu', 'idOption'], 'unique_menusOptions');

            $table->foreign('idMenu')
                ->references('id')->on('menus')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idOption')
                ->references('id')->on('options')
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
        Schema::dropIfExists('menusOptions');
    }
}
