<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectsTable extends Migration
{
    /**
     * Run the migrations.
     * @table redirects
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idApplication', 36);
            $table->char('idIdentityCreated', 36);
            $table->string('name', 75)->unique();
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->string('description', 200)->nullable();
            $table->string('path', 45)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->foreign('idApplication')
                ->references('id')->on('applications')
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
        Schema::dropIfExists('redirects');
    }
}
