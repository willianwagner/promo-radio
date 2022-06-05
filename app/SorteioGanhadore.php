<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SorteioGanhadore extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sorteio_ganhadores';

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
    protected $fillable = ['ouvinte_id', 'sorteio_id', 'promocao_id'];
}
