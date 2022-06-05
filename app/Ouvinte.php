<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ouvinte extends Model
{
    protected $fillable = [
        'nome', 'cpf', 'data_nascimento', 'email', 'telefone','cidade','genero'
    ];
}
