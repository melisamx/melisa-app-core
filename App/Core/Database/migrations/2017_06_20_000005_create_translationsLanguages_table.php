<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationslanguagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table translationsLanguages
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translationsLanguages', function (Blueprint $table) {
            $table->char('id', 2)->primary();
            $table->string('name', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translationsLanguages');
    }
}
