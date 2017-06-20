<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectsprofilesTable extends Migration
{
    /**
     * Run the migrations.
     * @table redirectsProfiles
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirectsProfiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idRedirect', 36);
            $table->char('idIdentityCreated', 36);
            $table->smallInteger('idProfile');
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idRedirect', 'idProfile'], 'unique_redirectsProfiles');

            $table->foreign('idRedirect')
                ->references('id')->on('redirects')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idIdentityCreated')
                ->references('id')->on('identities')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('idProfile')
                ->references('id')->on('profiles')
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
        Schema::dropIfExists('redirectsProfiles');
    }
}
