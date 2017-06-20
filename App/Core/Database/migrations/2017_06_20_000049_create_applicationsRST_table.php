<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsrstTable extends Migration
{
    /**
     * Run the migrations.
     * @table applicationsRST
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicationsRST', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idApplicationRS', 36);
            $table->unsignedInteger('idTask');
            $table->char('idIdentityCreated', 36);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('idIdentityUpdated', 36)->nullable();
            $table->dateTime('updatedAt')->nullable();

            $table->unique(['idApplicationRS', 'idTask'], 'unique_applicationsRST');

            $table->foreign('idApplicationRS')
                ->references('id')->on('applicationsRS')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('idTask')
                ->references('id')->on('tasks')
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
        Schema::dropIfExists('applicationsRST');
    }
}
