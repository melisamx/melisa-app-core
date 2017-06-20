<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordlessTable extends Migration
{
    /**
     * Run the migrations.
     * @table passwordless
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passwordless', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idUser', 36);
            $table->char('idIdentityCreated', 36);
            $table->string('name', 65)->name();
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->foreign('idUser')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idIdentityCreated')
                ->references('id')->on('identities')
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
        Schema::dropIfExists('passwordless');
    }
}
