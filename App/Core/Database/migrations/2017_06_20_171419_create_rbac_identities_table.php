<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRbacIdentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbacIdentities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idRbacRol', 36);
            $table->char('idIdentity', 36);
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('isSystem')->default(0);
            $table->dateTime('updatedAt')->nullable();
            $table->string('idIdentityUpdated', 36)->nullable();
            
            $table->unique(['idRbacRol', 'idIdentity'], 'rol_identity_UNIQUE');
            
            $table->foreign('idRbacRol')
                ->references('id')->on('rbacRoles')
                ->onDelete('cascade')
                ->onUpdate('no action');
            
            $table->foreign('idIdentity')
                ->references('id')->on('identities')
                ->onDelete('cascade')
                ->onUpdate('no action');
            
            $table->foreign('idIdentityCreated')
                ->references('id')->on('identities')
                ->onDelete('no action')
                ->onUpdate('no action');
            
            $table->foreign('idIdentityUpdated')
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
        Schema::dropIfExists('rbacIdentities');
    }
}
