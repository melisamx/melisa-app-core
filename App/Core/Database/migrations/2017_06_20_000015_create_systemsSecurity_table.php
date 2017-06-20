<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemssecurityTable extends Migration
{
    /**
     * Run the migrations.
     * @table systemsSecurity
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systemsSecurity', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->string('key', 10)->unique();
            $table->string('description', 100);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('systemsSecurity');
    }
}
