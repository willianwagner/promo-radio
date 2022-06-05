<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOuvintesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ouvintes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('cpf');
            $table->string('cidade');
            $table->string('genero');
            $table->date('data_nascimento');
            $table->string('email');
            $table->string('telefone');
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
        Schema::dropIfExists('ouvintes');
    }
}
