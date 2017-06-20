<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulestasksTable extends Migration
{
    /**
     * Run the migrations.
     * @table modulesTasks
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulesTasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idModule');
            $table->unsignedInteger('idTask');

            $table->unique(['idModule', 'idTask'], 'unique_modulesTasks');

            $table->foreign('idModule')
                ->references('id')->on('modules')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idTask')
                ->references('id')->on('tasks')
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
        Schema::dropIfExists('modulesTasks');
    }
}
