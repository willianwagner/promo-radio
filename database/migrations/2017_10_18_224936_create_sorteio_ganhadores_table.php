<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSorteioGanhadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteio_ganhadores', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ouvinte_id');
            $table->string('sorteio_id');
            $table->string('promocao_id');
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
        Schema::drop('sorteio_ganhadores');
    }
}
