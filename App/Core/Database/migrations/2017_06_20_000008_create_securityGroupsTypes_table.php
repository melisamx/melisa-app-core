<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecuritygroupstypesTable extends Migration
{
    /**
     * Run the migrations.
     * @table securityGroupsTypes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securityGroupsTypes', function (Blueprint $table) {
            $table->smallInteger('id', true);
            $table->string('name', 75)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('securityGroupsTypes');
    }
}
