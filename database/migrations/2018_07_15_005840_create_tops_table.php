<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tops', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('posicao');
            $table->string('artista');
            $table->string('musica');
            $table->string('capa');
            $table->string('ano');
            $table->string('mes');
            $table->string('ativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tops');
    }
}
