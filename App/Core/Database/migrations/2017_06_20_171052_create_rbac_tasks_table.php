<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRbacTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rbacTasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('idRbacRol');
            $table->unsignedInteger('idTask');
            $table->uuid('idIdentityCreated');
            $table->boolean('active')->default(1);
            $table->boolean('isSystem')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->uuid('idIdentityUpdated')->nullable();
            $table->dateTime('updatedAt')->nullable();
            
            $table->unique(['idRbacRol', 'idTask'], 'unique_rbacTasks');

            $table->foreign('idRbacRol')
                ->references('id')->on('rbacRoles')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idTask')
                ->references('id')->on('tasks')
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
        Schema::dropIfExists('rbacTasks');
    }
}
