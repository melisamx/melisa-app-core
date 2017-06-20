<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 30)->unique();
            $table->string('password', 60)->unique();
            $table->string('email', 90);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('active')->default(1);
            $table->boolean('isSystem')->default(0);
            $table->boolean('firstLogin')->default(0);
            $table->boolean('changePassword')->default(0);
            $table->boolean('isGod')->default(0);
            $table->dateTime('updatedAt')->nullable();
            $table->string('rememberToken', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
