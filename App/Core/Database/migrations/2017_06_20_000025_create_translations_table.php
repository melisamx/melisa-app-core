<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     * @table translations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('idTranslationLanguage', 2);
            $table->string('key', 150);
            $table->string('text', 255);

            $table->unique(['idTranslationLanguage', 'key'], 'unique_translations');

            $table->foreign('idTranslationLanguage')
                ->references('id')->on('translationsLanguages')
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
        Schema::dropIfExists('translations');
    }
}
