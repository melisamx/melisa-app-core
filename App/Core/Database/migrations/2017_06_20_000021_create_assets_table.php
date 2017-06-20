<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     * @table assets
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->string('id', 150)->primary();
            $table->smallInteger('idAssetType');
            $table->string('name', 75)->unique();
            $table->string('version', 8)->default('1.0');
            $table->string('path', 150);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();
            $table->string('cdn', 150)->nullable();
            $table->string('extraParams', 100)->nullable();

            $table->foreign('idAssetType')
                ->references('id')->on('assetsTypes')
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
        Schema::dropIfExists('assets');
    }
}
