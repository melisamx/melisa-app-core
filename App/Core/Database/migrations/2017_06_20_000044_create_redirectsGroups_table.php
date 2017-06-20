<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectsgroupsTable extends Migration
{
    /**
     * Run the migrations.
     * @table redirectsGroups
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirectsGroups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idRedirect', 36);
            $table->char('idIdentityCreated', 36);
            $table->char('idGroup', 36);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idRedirect', 'idGroup'], 'unique_redirectsGroups');

            $table->foreign('idRedirect')
                ->references('id')->on('redirects')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idIdentityCreated')
                ->references('id')->on('identities')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idGroup')
                ->references('id')->on('groups')
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
        Schema::dropIfExists('redirectsGroups');
    }
}
