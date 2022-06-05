<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AceiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('aceites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_aceite',150)->nullable();
            $table->string('ip',15)->nullable();
            $table->string('nome_promocao',150)->nullable();
            $table->string('tipo',15)->nullable();
            $table->string('versao',5)->nullable();
            $table->integer('ouvinte_id')->unsigned()->nullable();
            $table->foreign('ouvinte_id')->references('id')->on('ouvintes');
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
        Schema::dropIfExists('imagens');
    }
}
