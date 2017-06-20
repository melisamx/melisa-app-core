<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsrtTable extends Migration
{
    /**
     * Run the migrations.
     * @table applicationsRT
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicationsRT', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idApplicationRol', 36);
            $table->unsignedInteger('idTask');
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->boolean('isSystem')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idApplicationRol', 'idTask'], 'unique_applicationsRT');

            $table->foreign('idApplicationRol')
                ->references('id')->on('applicationsRoles')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idTask')
                ->references('id')->on('tasks')
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
        Schema::dropIfExists('applicationsRT');
    }
}
