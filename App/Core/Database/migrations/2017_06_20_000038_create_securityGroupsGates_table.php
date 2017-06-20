<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecuritygroupsgatesTable extends Migration
{
    /**
     * Run the migrations.
     * @table securityGroupsGates
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securityGroupsGates', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->smallInteger('idSecurityGroup');
            $table->smallInteger('idGate');
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idSecurityGroup', 'idGate'], 'unique_securityGroupsGates');

            $table->foreign('idSecurityGroup')
                ->references('id')->on('securityGroups')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idGate')
                ->references('id')->on('gates')
                ->onDelete('cascade')
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
        Schema::dropIfExists('securityGroupsGates');
    }
}
