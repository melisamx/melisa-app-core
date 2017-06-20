<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     * @table modules
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('url', 150);
            $table->boolean('active')->default(1);
            $table->string('version', 8);
            $table->string('description', 200);
            $table->string('iconClassSmall', 75)->default('fa fa-window-maximize fa-lg');
            $table->string('iconClassMedium', 75)->default('fa fa-window-maximize fa-3x');
            $table->string('iconClassLarge', 75)->default('fa fa-window-maximize fa-5x');
            $table->string('nameSpace', 255)->nullable();

            $table->unique(['name', 'url'], 'unique_modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
