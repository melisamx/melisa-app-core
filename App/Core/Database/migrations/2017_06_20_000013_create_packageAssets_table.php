<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageassetsTable extends Migration
{
    /**
     * Run the migrations.
     * @table packageAssets
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packageAssets', function (Blueprint $table) {
            $table->string('id', 150)->primary();
            $table->string('name', 75)->unique();
            $table->string('version', 8)->default('1.0');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('updatedAt', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packageAssets');
    }
}
