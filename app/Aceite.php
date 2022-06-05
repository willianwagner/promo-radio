<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aceite extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aceites';

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
    protected $fillable = ['ip','nome_promocao','ouvinte_id'];

    
}
