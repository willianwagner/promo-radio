<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tops';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['posicao', 'artista', 'musica', 'capa', 'ano', 'mes', 'ativo'];

    
}
