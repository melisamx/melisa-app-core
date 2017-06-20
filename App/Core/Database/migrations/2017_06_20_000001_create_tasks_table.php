<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     * @table tasks
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key', 255)->unique();
            $table->string('name', 255);
            $table->boolean('active')->default(1);
            $table->boolean('isSystem')->default(0);
            $table->string('description', 250);
            /* ENUM('all','all.crud','all.create','all.read','all.update','all.delete','all.access','access','create','read','update','delete','select','service','library') */
            $table->smallInteger('pattern')->default(8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
