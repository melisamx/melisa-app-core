<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordlessemailsTable extends Migration
{
    /**
     * Run the migrations.
     * @table passwordlessEmails
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passwordlessEmails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idPasswordless', 36);
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->string('token', 60);
            $table->string('email', 90);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('dateExpiry');
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idPasswordless', 'email'], 'unique_passwordlessEmails');

            $table->foreign('idPasswordless')
                ->references('id')->on('passwordless')
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
        Schema::dropIfExists('passwordlessEmails');
    }
}
