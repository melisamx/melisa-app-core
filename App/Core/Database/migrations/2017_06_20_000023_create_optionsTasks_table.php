<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionstasksTable extends Migration
{
    /**
     * Run the migrations.
     * @table optionsTasks
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optionsTasks', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('idOption');
            $table->unsignedInteger('idTask');

            $table->foreign('idOption', 'fk_optionsTasks_options1')
                ->references('id')->on('options')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idTask', 'fk_optionsTasks_tasks1')
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
        Schema::dropIfExists('optionsTasks');
    }
}
