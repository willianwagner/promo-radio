<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promoco extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promocoes';

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
    protected $fillable = ['nome', 'status', 'categoria','imagem'];

    public function getPdf($type,$request,$data,$promocoes,$cidades)
    {
        $pdf = app('dompdf.wrapper')->loadView('promocoes/print', [
            'request' => $request, 
            'data' => $data, 
            'promocoes' => $promocoes,
            'cidades' => $cidades
        ]);
    
        if ($type == 'stream') {
            return $pdf->stream('relatorio.pdf');
        }
    
        if ($type == 'download') {
            return $pdf->download('relatorio.pdf');
        }
    }
}
