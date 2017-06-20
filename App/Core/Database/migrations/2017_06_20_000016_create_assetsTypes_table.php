<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetstypesTable extends Migration
{
    /**
     * Run the migrations.
     * @table assetsTypes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetsTypes', function (Blueprint $table) {
            $table->smallInteger('id')->primary();
            $table->string('name', 75)->unique();
            $table->string('key', 45)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assetsTypes');
    }
}
