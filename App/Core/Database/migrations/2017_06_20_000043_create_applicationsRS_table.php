<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsrsTable extends Migration
{
    /**
     * Run the migrations.
     * @table applicationsRS
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicationsRS', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idApplicationRol', 36);
            $table->smallInteger('idScope');
            $table->char('idIdentityCreated', 36);
            $table->boolean('isDefault')->default(0);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();
            $table->string('idIdentityUpdate', 36)->nullable();

            $table->unique(['idApplicationRol', 'idScope'], 'unique_applicationsRS');

            $table->foreign('idApplicationRol')
                ->references('id')->on('applicationsRoles')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idScope')
                ->references('id')->on('scopes')
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
        Schema::dropIfExists('applicationsRS');
    }
}
