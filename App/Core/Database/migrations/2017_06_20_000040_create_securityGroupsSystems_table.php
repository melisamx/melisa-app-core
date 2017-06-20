<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecuritygroupssystemsTable extends Migration
{
    /**
     * Run the migrations.
     * @table securityGroupsSystems
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securityGroupsSystems', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->smallInteger('idSecurityGroup');
            $table->smallInteger('idSystemSecurity');
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->smallInteger('order')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idSecurityGroup', 'idSystemSecurity'], 'unique_securityGroupsSystems');

            $table->foreign('idSecurityGroup')
                ->references('id')->on('securityGroups')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idSystemSecurity')
                ->references('id')->on('systemsSecurity')
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
        Schema::dropIfExists('securityGroupsSystems');
    }
}
