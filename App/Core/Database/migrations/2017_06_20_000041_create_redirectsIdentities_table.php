<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectsidentitiesTable extends Migration
{
    /**
     * Run the migrations.
     * @table redirectsIdentities
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirectsIdentities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idRedirect', 36);
            $table->char('idIdentityCreated', 36);
            $table->char('idIdentityRedirect', 36);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idRedirect', 'idIdentityRedirect'], 'unique_redirectsIdentities');

            $table->foreign('idRedirect')
                ->references('id')->on('redirects')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idIdentityCreated')
                ->references('id')->on('identities')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idIdentityRedirect')
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
        Schema::dropIfExists('redirectsIdentities');
    }
}
