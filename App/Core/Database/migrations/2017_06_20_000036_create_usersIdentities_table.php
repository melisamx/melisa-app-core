<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersidentitiesTable extends Migration
{
    /**
     * Run the migrations.
     * @table usersIdentities
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersIdentities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idUser', 36);
            $table->char('idIdentity', 36)->unique();
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('idUser')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idIdentity')
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
        Schema::dropIfExists('usersIdentities');
    }
}
