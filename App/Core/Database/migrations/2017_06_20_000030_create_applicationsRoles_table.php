<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsrolesTable extends Migration
{
    /**
     * Run the migrations.
     * @table applicationsRoles
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicationsRoles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('idApplication', 36);
            $table->char('idIdentityCreated', 36);
            $table->string('role', 75);
            $table->boolean('active')->default(1);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('description', 100);
            $table->boolean('isSystem')->default(0);
            $table->dateTime('updatedAt')->nullable();
            $table->string('idIdentityUpdated', 36)->nullable();

            $table->unique(['idApplication', 'role'], 'unique_applicationsRoles');

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
        Schema::dropIfExists('applicationsRoles');
    }
}
