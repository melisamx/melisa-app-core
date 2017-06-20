<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     * @table options
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->string('key', 65)->unique();
            $table->string('name', 255);
            $table->boolean('isSubMenu')->default(0);
            $table->string('iconClassSmall', 75)->nullable()->default('fa fa-cog fa-lg');
            $table->string('iconClassMedium', 75)->nullable()->default('fa fa-cog fa-3x');
            $table->string('iconClassLarge', 75)->nullable()->default('fa fa-cog fa-5x');
            $table->string('text', 75)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
