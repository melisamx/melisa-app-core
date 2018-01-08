<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApplicationsVersions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicationsVersions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('idApplication');
            $table->string('version', 8);
            $table->string('comments');
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updatedAt')->nullable();
            
            $table->foreign('idApplication')
                ->references('id')->on('applications')
                ->onDelete('cascade')
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
        Schema::dropIfExists('applicationsVersions');
    }
}
