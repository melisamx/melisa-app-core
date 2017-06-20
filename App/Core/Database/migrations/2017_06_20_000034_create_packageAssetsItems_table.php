<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageassetsitemsTable extends Migration
{
    /**
     * Run the migrations.
     * @table packageAssetsItems
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packageAssetsItems', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->string('idPackageAsset', 150);
            $table->string('idAsset', 150);

            $table->foreign('idPackageAsset')
                ->references('id')->on('packageAssets')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idAsset')
                ->references('id')->on('assets')
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
        Schema::dropIfExists('packageAssetsItems');
    }
}
