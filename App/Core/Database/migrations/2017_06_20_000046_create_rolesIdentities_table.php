<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesidentitiesTable extends Migration
{
    /**
     * Run the migrations.
     * @table rolesIdentities
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rolesIdentities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idApplicationRol', 36);
            $table->char('idIdentity', 36);
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idApplicationRol', 'idIdentity'], 'unique_rolesIdentities');

            $table->foreign('idApplicationRol')
                ->references('id')->on('applicationsRoles')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idIdentity')
                ->references('id')->on('identities')
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
        Schema::dropIfExists('rolesIdentities');
    }
}
