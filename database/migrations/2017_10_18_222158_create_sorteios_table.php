<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSorteiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteios', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('promocao_id')->nullable()->unsigned();
            $table->string('nome');
            $table->integer('somente_maior');
            $table->string('num_sorteados');
            $table->string('num_participantes');
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
        Schema::drop('sorteios');
    }
}
