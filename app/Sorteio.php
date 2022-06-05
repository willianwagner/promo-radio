<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorteio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sorteios';

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
    protected $fillable = ['nome','promocao_id','num_sorteados','num_participantes','somente_maior','somente_igrejinha'];

    public function promocoes()
	{
		return $this->hasMany('App\Promoco');
	}

}
