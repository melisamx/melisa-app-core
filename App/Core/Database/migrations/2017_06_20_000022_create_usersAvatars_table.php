<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersavatarsTable extends Migration
{
    /**
     * Run the migrations.
     * @table usersAvatars
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersAvatars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idUser', 36);
            $table->char('idFileAvatar', 36);
            $table->boolean('active')->default(1);
            $table->boolean('isDefault')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idUser', 'idFileAvatar'], 'unique_usersAvatars');

            $table->foreign('idUser')
                ->references('id')->on('users')
                ->onDelete('cascade')
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
        Schema::dropIfExists('usersAvatars');
    }
}
