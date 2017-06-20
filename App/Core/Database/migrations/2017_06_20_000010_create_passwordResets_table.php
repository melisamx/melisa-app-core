<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordresetsTable extends Migration
{
    /**
     * Run the migrations.
     * @table passwordResets
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passwordResets', function (Blueprint $table) {
            $table->string('email', 90)->primary();
            $table->string('token', 90);
            $table->dateTime('createdAt')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passwordResets');
    }
}
