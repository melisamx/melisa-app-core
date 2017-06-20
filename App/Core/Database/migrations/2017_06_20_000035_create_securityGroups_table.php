<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecuritygroupsTable extends Migration
{
    /**
     * Run the migrations.
     * @table securityGroups
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securityGroups', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->char('idIdentityCreated', 36);
            $table->string('name', 75)->unique();
            $table->boolean('active')->default(1);
            $table->smallInteger('order')->default(0);
            $table->boolean('oneAllowed')->default(1);
            $table->boolean('required')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->string('description', 200)->nullable();
            $table->dateTime('updatedAt')->nullable();

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
       Schema::dropIfExists('securityGroups');
     }
}
