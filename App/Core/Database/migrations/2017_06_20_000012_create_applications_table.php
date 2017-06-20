<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     * @table applications
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 45)->unique();
            $table->string('description', 100);
            $table->string('key', 65)->unique();
            $table->boolean('active')->default(1);
            $table->string('iconClassSmall', 45)->default('fa fa-cube fa-lg');
            $table->string('iconClassMedium', 75)->default('fa fa-cube fa-3x');
            $table->string('iconClassLarge', 75)->default('fa fa-cube fa-5x');
            $table->string('nameSpace', 75);
            $table->string('typeSecurity', 10)->default('art');
            $table->boolean('isSystem')->default(0);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('version', 8)->default('1.0.0');
            $table->dateTime('updatedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
