<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     * @table identities
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->smallInteger('idProfile');
            $table->string('display', 75);
            $table->string('displayEspecific', 75);
            $table->boolean('active')->default(1);
            $table->boolean('isSystem')->default(0);
            $table->boolean('isDefault')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['displayEspecific'], 'unique_identities');

            $table->foreign('idProfile')
                ->references('id')->on('profiles')
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
        Schema::dropIfExists('identities');
    }
}
